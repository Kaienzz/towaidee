<?php

/**
 * This file concerns itself with logging, whether in the database or files.
 *
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2025 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.5
 */

if (!defined('SMF'))
	die('No direct access...');

/**
 * Put this user in the online log.
 *
 * @param bool $force Whether to force logging the data
 */
function writeLog($force = false)
{
	global $user_info, $user_settings, $context, $modSettings, $settings, $topic, $board, $smcFunc, $sourcedir, $cache_enable;

	// If we are showing who is viewing a topic, let's see if we are, and force an update if so - to make it accurate.
	if (!empty($settings['display_who_viewing']) && ($topic || $board))
	{
		// Take the opposite approach!
		$force = true;
		// Don't update for every page - this isn't wholly accurate but who cares.
		if ($topic)
		{
			if (isset($_SESSION['last_topic_id']) && $_SESSION['last_topic_id'] == $topic)
				$force = false;
			$_SESSION['last_topic_id'] = $topic;
		}
	}

	// Are they a spider we should be tracking? Mode = 1 gets tracked on its spider check...
	if (!empty($user_info['possibly_robot']) && !empty($modSettings['spider_mode']) && $modSettings['spider_mode'] > 1)
	{
		require_once($sourcedir . '/ManageSearchEngines.php');
		logSpider();
	}

	// Don't mark them as online more than every so often.
	if (!empty($_SESSION['log_time']) && $_SESSION['log_time'] >= (time() - 8) && !$force)
		return;

	if (!empty($modSettings['who_enabled']))
	{
		$encoded_get = truncate_array($_GET) + array('USER_AGENT' => mb_substr($_SERVER['HTTP_USER_AGENT'], 0, 128));

		// In the case of a dlattach action, session_var may not be set.
		if (!isset($context['session_var']))
			$context['session_var'] = $_SESSION['session_var'];

		unset($encoded_get['sesc'], $encoded_get[$context['session_var']]);
		$encoded_get = $smcFunc['json_encode']($encoded_get);

		// Sometimes folks mess with USER_AGENT & $_GET data, so one last check to avoid 'data too long' errors
		if (mb_strlen($encoded_get) > 2048)
			$encoded_get = '';
	}
	else
		$encoded_get = '';

	// Guests use 0, members use their session ID.
	$session_id = $user_info['is_guest'] ? 'ip' . $user_info['ip'] : session_id();

	// Grab the last all-of-SMF-specific log_online deletion time.
	$do_delete = cache_get_data('log_online-update', 30) < time() - 30;

	// If the last click wasn't a long time ago, and there was a last click...
	if (!empty($_SESSION['log_time']) && $_SESSION['log_time'] >= time() - $modSettings['lastActive'] * 20)
	{
		if ($do_delete)
		{
			$smcFunc['db_query']('delete_log_online_interval', '
				DELETE FROM {db_prefix}log_online
				WHERE log_time < {int:log_time}
					AND session != {string:session}',
				array(
					'log_time' => time() - $modSettings['lastActive'] * 60,
					'session' => $session_id,
				)
			);

			// Cache when we did it last.
			cache_put_data('log_online-update', time(), 30);
		}

		$smcFunc['db_query']('', '
			UPDATE {db_prefix}log_online
			SET log_time = {int:log_time}, ip = {inet:ip}, url = {string:url}
			WHERE session = {string:session}',
			array(
				'log_time' => time(),
				'ip' => $user_info['ip'],
				'url' => $encoded_get,
				'session' => $session_id,
			)
		);

		// Guess it got deleted.
		if ($smcFunc['db_affected_rows']() == 0)
			$_SESSION['log_time'] = 0;
	}
	else
		$_SESSION['log_time'] = 0;

	// Otherwise, we have to delete and insert.
	if (empty($_SESSION['log_time']))
	{
		if ($do_delete || !empty($user_info['id']))
			$smcFunc['db_query']('', '
				DELETE FROM {db_prefix}log_online
				WHERE ' . ($do_delete ? 'log_time < {int:log_time}' : '') . ($do_delete && !empty($user_info['id']) ? ' OR ' : '') . (empty($user_info['id']) ? '' : 'id_member = {int:current_member}'),
				array(
					'current_member' => $user_info['id'],
					'log_time' => time() - $modSettings['lastActive'] * 60,
				)
			);

		$smcFunc['db_insert']($do_delete ? 'ignore' : 'replace',
			'{db_prefix}log_online',
			array('session' => 'string', 'id_member' => 'int', 'id_spider' => 'int', 'log_time' => 'int', 'ip' => 'inet', 'url' => 'string'),
			array($session_id, $user_info['id'], empty($_SESSION['id_robot']) ? 0 : $_SESSION['id_robot'], time(), $user_info['ip'], $encoded_get),
			array('session')
		);
	}

	// Mark your session as being logged.
	$_SESSION['log_time'] = time();

	// Well, they are online now.
	if (empty($_SESSION['timeOnlineUpdated']))
		$_SESSION['timeOnlineUpdated'] = time();

	// Set their login time, if not already done within the last minute.
	if (SMF != 'SSI' && !empty($user_info['last_login']) && $user_info['last_login'] < time() - 60 && (!isset($_REQUEST['action']) || !in_array($_REQUEST['action'], array('.xml', 'login2', 'logintfa'))))
	{
		// Don't count longer than 15 minutes.
		if (time() - $_SESSION['timeOnlineUpdated'] > 60 * 15)
			$_SESSION['timeOnlineUpdated'] = time();

		$user_settings['total_time_logged_in'] += time() - $_SESSION['timeOnlineUpdated'];
		updateMemberData($user_info['id'], array('last_login' => time(), 'member_ip' => $user_info['ip'], 'member_ip2' => $_SERVER['BAN_CHECK_IP'], 'total_time_logged_in' => $user_settings['total_time_logged_in']));

		if (!empty($cache_enable) && $cache_enable >= 2)
			cache_put_data('user_settings-' . $user_info['id'], $user_settings, 60);

		$user_info['total_time_logged_in'] += time() - $_SESSION['timeOnlineUpdated'];
		$_SESSION['timeOnlineUpdated'] = time();
	}
}

/**
 * Logs the last database error into a file.
 * Attempts to use the backup file first, to store the last database error
 * and only update db_last_error.php if the first was successful.
 */
function logLastDatabaseError()
{
	global $boarddir, $cachedir;

	// Make a note of the last modified time in case someone does this before us
	$last_db_error_change = @filemtime($cachedir . '/db_last_error.php');

	// save the old file before we do anything
	$file = $cachedir . '/db_last_error.php';
	$dberror_backup_fail = !@is_writable($cachedir . '/db_last_error_bak.php') || !@copy($file, $cachedir . '/db_last_error_bak.php');
	$dberror_backup_fail = !$dberror_backup_fail ? (!file_exists($cachedir . '/db_last_error_bak.php') || filesize($cachedir . '/db_last_error_bak.php') === 0) : $dberror_backup_fail;

	clearstatcache();
	if (filemtime($cachedir . '/db_last_error.php') === $last_db_error_change)
	{
		// Write the change
		$write_db_change = '<' . '?' . "php\n" . '$db_last_error = ' . time() . ';' . "\n" . '?' . '>';
		$written_bytes = file_put_contents($cachedir . '/db_last_error.php', $write_db_change, LOCK_EX);

		// survey says ...
		if ($written_bytes !== strlen($write_db_change) && !$dberror_backup_fail)
		{
			// Oops. maybe we have no more disk space left, or some other troubles, troubles...
			// Copy the file back and run for your life!
			@copy($cachedir . '/db_last_error_bak.php', $cachedir . '/db_last_error.php');
		}
		else
		{
			@touch($boarddir . '/' . 'Settings.php');
			return true;
		}
	}

	return false;
}

/**
 * This function shows the debug information tracked when $db_show_debug = true
 * in Settings.php
 */
function displayDebug()
{
	global $context, $scripturl, $boarddir, $sourcedir, $cachedir, $settings, $modSettings;
	global $db_cache, $db_count, $cache_misses, $cache_count_misses, $db_show_debug, $cache_count, $cache_hits, $smcFunc, $txt, $cache_enable;

	// Add to Settings.php if you want to show the debugging information.
	if (!isset($db_show_debug) || $db_show_debug !== true || (isset($_GET['action']) && $_GET['action'] == 'viewquery'))
		return;

	if (empty($_SESSION['view_queries']))
		$_SESSION['view_queries'] = 0;
	if (empty($context['debug']['language_files']))
		$context['debug']['language_files'] = array();
	if (empty($context['debug']['sheets']))
		$context['debug']['sheets'] = array();

	$files = get_included_files();
	$total_size = 0;
	for ($i = 0, $n = count($files); $i < $n; $i++)
	{
		if (file_exists($files[$i]))
			$total_size += filesize($files[$i]);
		$files[$i] = strtr($files[$i], array($boarddir => '.', $sourcedir => '(Sources)', $cachedir => '(Cache)', $settings['actual_theme_dir'] => '(Current Theme)'));
	}

	$warnings = 0;
	if (!empty($db_cache))
	{
		foreach ($db_cache as $q => $query_data)
		{
			if (!empty($query_data['w']))
				$warnings += count($query_data['w']);
		}

		$_SESSION['debug'] = &$db_cache;
	}

	// Gotta have valid HTML ;).
	$temp = ob_get_contents();
	ob_clean();

	echo preg_replace('~</body>\s*</html>~', '', $temp), '
<div class="smalltext" style="text-align: left; margin: 1ex;">
	', $txt['debug_browser'], $context['browser_body_id'], ' <em>(', implode('</em>, <em>', array_reverse(array_keys($context['browser'], true))), ')</em><br>
	', $txt['debug_templates'], count($context['debug']['templates']), ': <em>', implode('</em>, <em>', $context['debug']['templates']), '</em>.<br>
	', $txt['debug_subtemplates'], count($context['debug']['sub_templates']), ': <em>', implode('</em>, <em>', $context['debug']['sub_templates']), '</em>.<br>
	', $txt['debug_language_files'], count($context['debug']['language_files']), ': <em>', implode('</em>, <em>', $context['debug']['language_files']), '</em>.<br>
	', $txt['debug_stylesheets'], count($context['debug']['sheets']), ': <em>', implode('</em>, <em>', $context['debug']['sheets']), '</em>.<br>
	', $txt['debug_hooks'], empty($context['debug']['hooks']) ? 0 : count($context['debug']['hooks']) . ' (<a href="javascript:void(0);" onclick="document.getElementById(\'debug_hooks\').style.display = \'inline\'; this.style.display = \'none\'; return false;">', $txt['debug_show'], '</a><span id="debug_hooks" style="display: none;"><em>' . implode('</em>, <em>', $context['debug']['hooks']), '</em></span>)', '<br>
	', (isset($context['debug']['instances']) ? ($txt['debug_instances'] . (empty($context['debug']['instances']) ? 0 : count($context['debug']['instances'])) . ' (<a href="javascript:void(0);" onclick="document.getElementById(\'debug_instances\').style.display = \'inline\'; this.style.display = \'none\'; return false;">' . $txt['debug_show'] . '</a><span id="debug_instances" style="display: none;"><em>' . implode('</em>, <em>', array_keys($context['debug']['instances'])) . '</em></span>)' . '<br>') : ''), '
	', $txt['debug_files_included'], count($files), ' - ', round($total_size / 1024), $txt['debug_kb'], ' (<a href="javascript:void(0);" onclick="document.getElementById(\'debug_include_info\').style.display = \'inline\'; this.style.display = \'none\'; return false;">', $txt['debug_show'], '</a><span id="debug_include_info" style="display: none;"><em>', implode('</em>, <em>', $files), '</em></span>)<br>';

	if (function_exists('memory_get_peak_usage'))
		echo $txt['debug_memory_use'], ceil(memory_get_peak_usage() / 1024), $txt['debug_kb'], '<br>';

	// What tokens are active?
	if (isset($_SESSION['token']))
		echo $txt['debug_tokens'] . '<em>' . implode(',</em> <em>', array_keys($_SESSION['token'])), '</em>.<br>';

	if (!empty($cache_enable) && !empty($cache_hits))
	{
		$missed_entries = array();
		$entries = array();
		$total_t = 0;
		$total_s = 0;
		foreach ($cache_hits as $cache_hit)
		{
			$entries[] = $cache_hit['d'] . ' ' . $cache_hit['k'] . ': ' . sprintf($txt['debug_cache_seconds_bytes'], comma_format($cache_hit['t'], 5), $cache_hit['s']);
			$total_t += $cache_hit['t'];
			$total_s += $cache_hit['s'];
		}
		if (!isset($cache_misses))
			$cache_misses = array();
		foreach ($cache_misses as $missed)
			$missed_entries[] = $missed['d'] . ' ' . $missed['k'];

		echo '
	', $txt['debug_cache_hits'], $cache_count, ': ', sprintf($txt['debug_cache_seconds_bytes_total'], comma_format($total_t, 5), comma_format($total_s)), ' (<a href="javascript:void(0);" onclick="document.getElementById(\'debug_cache_info\').style.display = \'inline\'; this.style.display = \'none\'; return false;">', $txt['debug_show'], '</a><span id="debug_cache_info" style="display: none;"><em>', implode('</em>, <em>', $entries), '</em></span>)<br>
	', $txt['debug_cache_misses'], $cache_count_misses, ': (<a href="javascript:void(0);" onclick="document.getElementById(\'debug_cache_misses_info\').style.display = \'inline\'; this.style.display = \'none\'; return false;">', $txt['debug_show'], '</a><span id="debug_cache_misses_info" style="display: none;"><em>', implode('</em>, <em>', $missed_entries), '</em></span>)<br>';
	}

	echo '
	<a href="', $scripturl, '?action=viewquery" target="_blank" rel="noopener">', $warnings == 0 ? sprintf($txt['debug_queries_used'], (int) $db_count) : sprintf($txt['debug_queries_used_and_warnings'], (int) $db_count, $warnings), '</a><br>
	<br>';

	if ($_SESSION['view_queries'] == 1 && !empty($db_cache))
		foreach ($db_cache as $q => $query_data)
		{
			$is_select = strpos(trim($query_data['q']), 'SELECT') === 0 || preg_match('~^INSERT(?: IGNORE)? INTO \w+(?:\s+\([^)]+\))?\s+SELECT .+$~s', trim($query_data['q'])) != 0 || strpos(trim($query_data['q']), 'WITH') === 0;
			// Temporary tables created in earlier queries are not explainable.
			if ($is_select)
			{
				foreach (array('log_topics_unread', 'topics_posted_in', 'tmp_log_search_topics', 'tmp_log_search_messages') as $tmp)
					if (strpos(trim($query_data['q']), $tmp) !== false)
					{
						$is_select = false;
						break;
					}
			}
			// But actual creation of the temporary tables are.
			elseif (preg_match('~^CREATE TEMPORARY TABLE .+?SELECT .+$~s', trim($query_data['q'])) != 0)
				$is_select = true;

			// Make the filenames look a bit better.
			if (isset($query_data['f']))
				$query_data['f'] = preg_replace('~^' . preg_quote($boarddir, '~') . '~', '...', $query_data['f']);

			echo '
	<strong>', $is_select ? '<a href="' . $scripturl . '?action=viewquery;qq=' . ($q + 1) . '#qq' . $q . '" target="_blank" rel="noopener" style="text-decoration: none;">' : '', nl2br(str_replace("\t", '&nbsp;&nbsp;&nbsp;', $smcFunc['htmlspecialchars'](ltrim($query_data['q'], "\n\r")))) . ($is_select ? '</a></strong>' : '</strong>') . '<br>
	&nbsp;&nbsp;&nbsp;';
			if (!empty($query_data['f']) && !empty($query_data['l']))
				echo sprintf($txt['debug_query_in_line'], $query_data['f'], $query_data['l']);

			if (isset($query_data['s'], $query_data['t']) && isset($txt['debug_query_which_took_at']))
				echo sprintf($txt['debug_query_which_took_at'], round($query_data['t'], 8), round($query_data['s'], 8)) . '<br>';
			elseif (isset($query_data['t']))
				echo sprintf($txt['debug_query_which_took'], round($query_data['t'], 8)) . '<br>';
			echo '
	<br>';
		}

	echo '
	<a href="' . $scripturl . '?action=viewquery;sa=hide">', $txt['debug_' . (empty($_SESSION['view_queries']) ? 'show' : 'hide') . '_queries'], '</a>
</div></body></html>';
}

/**
 * Track Statistics.
 * Caches statistics changes, and flushes them if you pass nothing.
 * If '+' is used as a value, it will be incremented.
 * It does not actually commit the changes until the end of the page view.
 * It depends on the trackStats setting.
 *
 * @param array $stats An array of data
 * @return bool Whether or not the info was updated successfully
 */
function trackStats($stats = array())
{
	global $modSettings, $smcFunc;
	static $cache_stats = array();

	if (empty($modSettings['trackStats']))
		return false;
	if (!empty($stats))
		return $cache_stats = array_merge($cache_stats, $stats);
	elseif (empty($cache_stats))
		return false;

	$setStringUpdate = '';
	$insert_keys = array();
	$date = smf_strftime('%Y-%m-%d', time());
	$update_parameters = array(
		'current_date' => $date,
	);
	foreach ($cache_stats as $field => $change)
	{
		$setStringUpdate .= '
			' . $field . ' = ' . ($change === '+' ? $field . ' + 1' : '{int:' . $field . '}') . ',';

		if ($change === '+')
			$cache_stats[$field] = 1;
		else
			$update_parameters[$field] = $change;
		$insert_keys[$field] = 'int';
	}

	$smcFunc['db_query']('', '
		UPDATE {db_prefix}log_activity
		SET' . substr($setStringUpdate, 0, -1) . '
		WHERE date = {date:current_date}',
		$update_parameters
	);
	if ($smcFunc['db_affected_rows']() == 0)
	{
		$smcFunc['db_insert']('ignore',
			'{db_prefix}log_activity',
			array_merge($insert_keys, array('date' => 'date')),
			array_merge($cache_stats, array($date)),
			array('date')
		);
	}

	// Don't do this again.
	$cache_stats = array();

	return true;
}

/**
 * This function logs an action to the database. It is a
 * thin wrapper around {@link logActions()}.
 *
 * @example logAction('remove', array('starter' => $id_member_started));
 *
 * @param string $action A code for the report; a list of such strings
 * can be found in Modlog.{language}.php (modlog_ac_ strings)
 * @param array $extra An associated array of parameters for the
 * item being logged. Typically this will include 'topic' for the topic's id.
 * @param string $log_type A string reflecting the type of log.
 *
 * @return int The ID of the row containing the logged data
 */
function logAction($action, array $extra = array(), $log_type = 'moderate')
{
	return logActions(array(array(
		'action' => $action,
		'log_type' => $log_type,
		'extra' => $extra,
	)));
}

/**
 * Log changes to the forum, such as moderation events or administrative
 * changes. This behaves just like {@link logAction()} in SMF 2.0, except
 * that it is designed to log multiple actions at once.
 *
 * SMF uses three log types:
 *
 * - `user` for actions executed that aren't related to
 *    moderation (e.g. signature or other changes from the profile);
 * - `moderate` for moderation actions (e.g. topic changes);
 * - `admin` for administrative actions.
 *
 * @param array $logs An array of log data
 *
 * @return int The last logged ID
 */
function logActions(array $logs)
{
	global $modSettings, $user_info, $smcFunc, $sourcedir, $txt;

	$inserts = array();
	$log_types = array(
		'moderate' => 1,
		'user' => 2,
		'admin' => 3,
	);
	$always_log = array('agreement_accepted', 'policy_accepted', 'agreement_updated', 'policy_updated');

	call_integration_hook('integrate_log_types', array(&$log_types, &$always_log));

	foreach ($logs as $log)
	{
		if (!isset($log_types[$log['log_type']]) && (empty($modSettings[$log['log_type'] . 'log_enabled']) || !in_array($log['action'], $always_log)))
			continue;

		if (!is_array($log['extra']))
		{
			loadLanguage('Errors');
			throw new \TypeError(sprintf($txt['logActions_not_array'], $log['action']));
		}

		// Pull out the parts we want to store separately, but also make sure that the data is proper
		if (isset($log['extra']['topic']))
		{
			if (!is_numeric($log['extra']['topic']))
			{
				loadLanguage('Errors');
				throw new \TypeError($txt['logActions_topic_not_numeric']);
			}
			$topic_id = empty($log['extra']['topic']) ? 0 : (int) $log['extra']['topic'];
			unset($log['extra']['topic']);
		}
		else
			$topic_id = 0;

		if (isset($log['extra']['message']))
		{
			if (!is_numeric($log['extra']['message']))
			{
				loadLanguage('Errors');
				throw new \TypeError($txt['logActions_message_not_numeric']);
			}
			$msg_id = empty($log['extra']['message']) ? 0 : (int) $log['extra']['message'];
			unset($log['extra']['message']);
		}
		else
			$msg_id = 0;

		// @todo cache this?
		// Is there an associated report on this?
		if (in_array($log['action'], array('move', 'remove', 'split', 'merge')))
		{
			$request = $smcFunc['db_query']('', '
				SELECT id_report
				FROM {db_prefix}log_reported
				WHERE {raw:column_name} = {int:reported}
				LIMIT 1',
				array(
					'column_name' => !empty($msg_id) ? 'id_msg' : 'id_topic',
					'reported' => !empty($msg_id) ? $msg_id : $topic_id,
				)
			);

			// Alright, if we get any result back, update open reports.
			if ($smcFunc['db_num_rows']($request) > 0)
			{
				require_once($sourcedir . '/Subs-ReportedContent.php');
				updateSettings(array('last_mod_report_action' => time()));
				recountOpenReports('posts');
			}
			$smcFunc['db_free_result']($request);
		}

		if (isset($log['extra']['member']) && !is_numeric($log['extra']['member']))
		{
			loadLanguage('Errors');
			throw new \TypeError($txt['logActions_member_not_numeric']);
		}

		if (isset($log['extra']['board']))
		{
			if (!is_numeric($log['extra']['board']))
			{
				loadLanguage('Errors');
				throw new \TypeError($txt['logActions_board_not_numeric']);
			}
			$board_id = empty($log['extra']['board']) ? 0 : (int) $log['extra']['board'];
			unset($log['extra']['board']);
		}
		else
			$board_id = 0;

		if (isset($log['extra']['board_to']))
		{
			if (!is_numeric($log['extra']['board_to']))
			{
				loadLanguage('Errors');
				throw new \TypeError($txt['logActions_board_to_not_numeric']);
			}
			if (empty($board_id))
			{
				$board_id = empty($log['extra']['board_to']) ? 0 : (int) $log['extra']['board_to'];
				unset($log['extra']['board_to']);
			}
		}

		if (isset($log['extra']['member_affected']))
			$memID = $log['extra']['member_affected'];
		else
			$memID = $user_info['id'] ?? $log['extra']['member'] ?? 0;

		if (isset($user_info['ip']))
			$memIP = $user_info['ip'];
		else
			$memIP = 'null';

		$inserts[] = array(
			time(), $log_types[$log['log_type']], $memID, $memIP, $log['action'],
			$board_id, $topic_id, $msg_id, $smcFunc['json_encode']($log['extra']),
		);
	}

	$id_action = $smcFunc['db_insert']('',
		'{db_prefix}log_actions',
		array(
			'log_time' => 'int', 'id_log' => 'int', 'id_member' => 'int', 'ip' => 'inet', 'action' => 'string',
			'id_board' => 'int', 'id_topic' => 'int', 'id_msg' => 'int', 'extra' => 'string-65534',
		),
		$inserts,
		array('id_action'),
		1
	);

	return $id_action;
}

?>