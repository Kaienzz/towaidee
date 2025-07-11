<?php

/**
 * This file is mainly concerned with the Who's Online list.
 * Although, it also handles credits. :P
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
 * Who's online, and what are they doing?
 * This function prepares the who's online data for the Who template.
 * It requires the who_view permission.
 * It is enabled with the who_enabled setting.
 * It is accessed via ?action=who.
 *
 * Uses Who template, main sub-template
 * Uses Who language file.
 */
function Who()
{
	global $context, $scripturl, $txt, $modSettings, $memberContext, $smcFunc;

	// Permissions, permissions, permissions.
	isAllowedTo('who_view');

	// You can't do anything if this is off.
	if (empty($modSettings['who_enabled']))
		fatal_lang_error('who_off', false);

	// Discourage robots from indexing this page.
	$context['robot_no_index'] = true;

	// Load the 'Who' template.
	loadTemplate('Who');
	loadLanguage('Who');

	// Sort out... the column sorting.
	$sort_methods = array(
		'user' => 'mem.real_name',
		'time' => 'lo.log_time'
	);

	$show_methods = array(
		'members' => '(lo.id_member != 0)',
		'guests' => '(lo.id_member = 0)',
		'all' => '1=1',
	);

	// Store the sort methods and the show types for use in the template.
	$context['sort_methods'] = array(
		'user' => $txt['who_user'],
		'time' => $txt['who_time'],
	);
	$context['show_methods'] = array(
		'all' => $txt['who_show_all'],
		'members' => $txt['who_show_members_only'],
		'guests' => $txt['who_show_guests_only'],
	);

	// Can they see spiders too?
	if (!empty($modSettings['show_spider_online']) && ($modSettings['show_spider_online'] == 2 || allowedTo('admin_forum')) && !empty($modSettings['spider_name_cache']))
	{
		$show_methods['spiders'] = '(lo.id_member = 0 AND lo.id_spider > 0)';
		$show_methods['guests'] = '(lo.id_member = 0 AND lo.id_spider = 0)';
		$context['show_methods']['spiders'] = $txt['who_show_spiders_only'];
	}
	elseif (empty($modSettings['show_spider_online']) && isset($_SESSION['who_online_filter']) && $_SESSION['who_online_filter'] == 'spiders')
		unset($_SESSION['who_online_filter']);

	// Does the user prefer a different sort direction?
	if (isset($_REQUEST['sort']) && isset($sort_methods[$_REQUEST['sort']]))
	{
		$context['sort_by'] = $_SESSION['who_online_sort_by'] = $_REQUEST['sort'];
		$sort_method = $sort_methods[$_REQUEST['sort']];
	}
	// Did we set a preferred sort order earlier in the session?
	elseif (isset($_SESSION['who_online_sort_by']))
	{
		$context['sort_by'] = $_SESSION['who_online_sort_by'];
		$sort_method = $sort_methods[$_SESSION['who_online_sort_by']];
	}
	// Default to last time online.
	else
	{
		$context['sort_by'] = $_SESSION['who_online_sort_by'] = 'time';
		$sort_method = 'lo.log_time';
	}

	$context['sort_direction'] = isset($_REQUEST['asc']) || (isset($_REQUEST['sort_dir']) && $_REQUEST['sort_dir'] == 'asc') ? 'up' : 'down';

	$conditions = array();
	if (!allowedTo('moderate_forum'))
		$conditions[] = '(COALESCE(mem.show_online, 1) = 1)';

	// Fallback to top filter?
	if (isset($_REQUEST['submit_top']) && isset($_REQUEST['show_top']))
		$_REQUEST['show'] = $_REQUEST['show_top'];
	// Does the user wish to apply a filter?
	if (isset($_REQUEST['show']) && isset($show_methods[$_REQUEST['show']]))
		$context['show_by'] = $_SESSION['who_online_filter'] = $_REQUEST['show'];
	// Perhaps we saved a filter earlier in the session?
	elseif (isset($_SESSION['who_online_filter']))
		$context['show_by'] = $_SESSION['who_online_filter'];
	else
		$context['show_by'] = 'members';

	$conditions[] = $show_methods[$context['show_by']];

	// Get the total amount of members online.
	$request = $smcFunc['db_query']('', '
		SELECT COUNT(*)
		FROM {db_prefix}log_online AS lo
			LEFT JOIN {db_prefix}members AS mem ON (lo.id_member = mem.id_member)' . (!empty($conditions) ? '
		WHERE ' . implode(' AND ', $conditions) : ''),
		array(
		)
	);
	list ($totalMembers) = $smcFunc['db_fetch_row']($request);
	$smcFunc['db_free_result']($request);

	// Prepare some page index variables.
	$context['page_index'] = constructPageIndex($scripturl . '?action=who;sort=' . $context['sort_by'] . ($context['sort_direction'] == 'up' ? ';asc' : '') . ';show=' . $context['show_by'], $_REQUEST['start'], $totalMembers, $modSettings['defaultMaxMembers']);
	$context['start'] = $_REQUEST['start'];

	// Look for people online, provided they don't mind if you see they are.
	$request = $smcFunc['db_query']('', '
		SELECT
			lo.log_time, lo.id_member, lo.url, lo.ip AS ip, mem.real_name,
			lo.session, mg.online_color, COALESCE(mem.show_online, 1) AS show_online,
			lo.id_spider
		FROM {db_prefix}log_online AS lo
			LEFT JOIN {db_prefix}members AS mem ON (lo.id_member = mem.id_member)
			LEFT JOIN {db_prefix}membergroups AS mg ON (mg.id_group = CASE WHEN mem.id_group = {int:regular_member} THEN mem.id_post_group ELSE mem.id_group END)' . (!empty($conditions) ? '
		WHERE ' . implode(' AND ', $conditions) : '') . '
		ORDER BY {raw:sort_method} {raw:sort_direction}
		LIMIT {int:offset}, {int:limit}',
		array(
			'regular_member' => 0,
			'sort_method' => $sort_method,
			'sort_direction' => $context['sort_direction'] == 'up' ? 'ASC' : 'DESC',
			'offset' => $context['start'],
			'limit' => $modSettings['defaultMaxMembers'],
		)
	);
	$context['members'] = array();
	$member_ids = array();
	$url_data = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$actions = $smcFunc['json_decode']($row['url'], true);
		if ($actions === array())
			continue;

		// Send the information to the template.
		$context['members'][$row['session']] = array(
			'id' => $row['id_member'],
			'ip' => allowedTo('moderate_forum') ? inet_dtop($row['ip']) : '',
			// It is *going* to be today or yesterday, so why keep that information in there?
			'time' => strtr(timeformat($row['log_time']), array($txt['today'] => '', $txt['yesterday'] => '')),
			'timestamp' => $row['log_time'],
			'query' => $actions,
			'is_hidden' => $row['show_online'] == 0,
			'id_spider' => $row['id_spider'],
			'color' => empty($row['online_color']) ? '' : $row['online_color']
		);

		$url_data[$row['session']] = array($row['url'], $row['id_member']);
		$member_ids[] = $row['id_member'];
	}
	$smcFunc['db_free_result']($request);

	// Load the user data for these members.
	loadMemberData($member_ids);

	// Load up the guest user.
	$memberContext[0] = array(
		'id' => 0,
		'name' => $txt['guest_title'],
		'group' => $txt['guest_title'],
		'href' => '',
		'link' => $txt['guest_title'],
		'email' => $txt['guest_title'],
		'is_guest' => true
	);

	// Are we showing spiders?
	$spiderContext = array();
	if (!empty($modSettings['show_spider_online']) && ($modSettings['show_spider_online'] == 2 || allowedTo('admin_forum')) && !empty($modSettings['spider_name_cache']))
	{
		foreach ($smcFunc['json_decode']($modSettings['spider_name_cache'], true) as $id => $name)
			$spiderContext[$id] = array(
				'id' => 0,
				'name' => $name,
				'group' => $txt['spiders'],
				'href' => '',
				'link' => $name,
				'email' => $name,
				'is_guest' => true
			);
	}

	$url_data = determineActions($url_data);

	// Setup the linktree and page title (do it down here because the language files are now loaded..)
	$context['page_title'] = $txt['who_title'];
	$context['linktree'][] = array(
		'url' => $scripturl . '?action=who',
		'name' => $txt['who_title']
	);

	// Put it in the context variables.
	foreach ($context['members'] as $i => $member)
	{
		if ($member['id'] != 0)
			$member['id'] = loadMemberContext($member['id']) ? $member['id'] : 0;

		// Keep the IP that came from the database.
		$memberContext[$member['id']]['ip'] = $member['ip'];
		$context['members'][$i]['action'] = isset($url_data[$i]) ? $url_data[$i] : array('label' => 'who_hidden', 'class' => 'em');
		if ($member['id'] == 0 && isset($spiderContext[$member['id_spider']]))
			$context['members'][$i] += $spiderContext[$member['id_spider']];
		else
			$context['members'][$i] += $memberContext[$member['id']];
	}

	// Some people can't send personal messages...
	$context['can_send_pm'] = allowedTo('pm_send');
	$context['can_send_email'] = allowedTo('send_email_to_members');

	// any profile fields disabled?
	$context['disabled_fields'] = isset($modSettings['disabled_profile_fields']) ? array_flip(explode(',', $modSettings['disabled_profile_fields'])) : array();

}

/**
 * This function determines the actions of the members passed in urls.
 *
 * Adding actions to the Who's Online list:
 * Adding actions to this list is actually relatively easy...
 *  - for actions anyone should be able to see, just add a string named whoall_ACTION.
 *    (where ACTION is the action used in index.php.)
 *  - for actions that have a subaction which should be represented differently, use whoall_ACTION_SUBACTION.
 *  - for actions that include a topic, and should be restricted, use whotopic_ACTION.
 *  - for actions that use a message, by msg or quote, use whopost_ACTION.
 *  - for administrator-only actions, use whoadmin_ACTION.
 *  - for actions that should be viewable only with certain permissions,
 *    use whoallow_ACTION and add a list of possible permissions to the
 *    $allowedActions array, using ACTION as the key.
 *
 * @param mixed $urls a single url (string) or an array of arrays, each inner array being (JSON-encoded request data, id_member)
 * @param string|bool $preferred_prefix = false
 * @return array an array of descriptions if you passed an array, otherwise the string describing their current location.
 */
function determineActions($urls, $preferred_prefix = false)
{
	global $txt, $user_info, $modSettings, $smcFunc, $scripturl, $context;

	if (!allowedTo('who_view'))
		return array();
	loadLanguage('Who');

	// Actions that require a specific permission level.
	$allowedActions = array(
		'admin' => array('moderate_forum', 'manage_membergroups', 'manage_bans', 'admin_forum', 'manage_permissions', 'send_mail', 'manage_attachments', 'manage_smileys', 'manage_boards', 'edit_news'),
		'ban' => array('manage_bans'),
		'boardrecount' => array('admin_forum'),
		'calendar' => array('calendar_view'),
		'corefeatures' => array('admin_forum'),
		'editnews' => array('edit_news'),
		'featuresettings' => array('admin_forum'),
		'languages' => array('admin_forum'),
		'logs' => array('admin_forum'),
		'mailing' => array('send_mail'),
		'mailqueue' => array('admin_forum'),
		'maintain' => array('admin_forum'),
		'manageattachments' => array('manage_attachments'),
		'manageboards' => array('manage_boards'),
		'managecalendar' => array('admin_forum'),
		'managesearch' => array('admin_forum'),
		'managesmileys' => array('manage_smileys'),
		'membergroups' => array('manage_membergroups'),
		'mlist' => array('view_mlist'),
		'moderate' => array('access_mod_center', 'moderate_forum', 'manage_membergroups'),
		'modsettings' => array('admin_forum'),
		'news' => array('edit_news', 'send_mail', 'admin_forum'),
		'optimizetables' => array('admin_forum'),
		'packages' => array('admin_forum'),
		'paidsubscribe' => array('admin_forum'),
		'permissions' => array('manage_permissions'),
		'postsettings' => array('admin_forum'),
		'regcenter' => array('admin_forum', 'moderate_forum'),
		'repairboards' => array('admin_forum'),
		'reports' => array('admin_forum'),
		'scheduledtasks' => array('admin_forum'),
		'search' => array('search_posts'),
		'search2' => array('search_posts'),
		'securitysettings' => array('admin_forum'),
		'sengines' => array('admin_forum'),
		'serversettings' => array('admin_forum'),
		'setcensor' => array('moderate_forum'),
		'setreserve' => array('moderate_forum'),
		'stats' => array('view_stats'),
		'theme' => array('admin_forum'),
		'viewerrorlog' => array('admin_forum'),
		'viewmembers' => array('moderate_forum'),
	);
	call_integration_hook('who_allowed', array(&$allowedActions));

	if (!is_array($urls))
		$url_list = array(array($urls, $user_info['id']));
	else
		$url_list = $urls;

	// These are done to later query these in large chunks. (instead of one by one.)
	$topic_ids = array();
	$profile_ids = array();
	$board_ids = array();

	$data = array();
	foreach ($url_list as $k => $url)
	{
		// Get the request parameters..
		$actions = $smcFunc['json_decode']($url[0], true);
		if ($actions === array())
			continue;

		// If it's the admin or moderation center, and there is an area set, use that instead.
		if (isset($actions['action']) && ($actions['action'] == 'admin' || $actions['action'] == 'moderate') && isset($actions['area']))
			$actions['action'] = $actions['area'];

		// Check if there was no action or the action is display.
		if (!isset($actions['action']) || $actions['action'] == 'display')
		{
			// It's a topic!  Must be!
			if (isset($actions['topic']))
			{
				// Assume they can't view it, and queue it up for later.
				$data[$k] = array('label' => 'who_hidden', 'class' => 'em');
				$topic_ids[(int) $actions['topic']][$k] = $txt['who_topic'];
			}
			// It's a board!
			elseif (isset($actions['board']))
			{
				// Hide first, show later.
				$data[$k] = array('label' => 'who_hidden', 'class' => 'em');
				$board_ids[$actions['board']][$k] = $txt['who_board'];
			}
			// It's the board index!!  It must be!
			else
				$data[$k] = sprintf($txt['who_index'], $scripturl, $context['forum_name_html_safe']);
		}
		// Probably an error or some goon?
		elseif ($actions['action'] == '')
			$data[$k] = sprintf($txt['who_index'], $scripturl, $context['forum_name_html_safe']);
		// Some other normal action...?
		else
		{
			// Viewing/editing a profile.
			if ($actions['action'] == 'profile')
			{
				// Whose?  Their own?
				if (empty($actions['u']))
					$actions['u'] = $url[1];

				$data[$k] = array('label' => 'who_hidden', 'class' => 'em');
				$profile_ids[(int) $actions['u']][$k] = $actions['u'] == $url[1] ? $txt['who_viewownprofile'] : $txt['who_viewprofile'];
			}
			elseif (($actions['action'] == 'post' || $actions['action'] == 'post2') && empty($actions['topic']) && isset($actions['board']))
			{
				$data[$k] = array('label' => 'who_hidden', 'class' => 'em');
				$board_ids[(int) $actions['board']][$k] = isset($actions['poll']) ? $txt['who_poll'] : $txt['who_post'];
			}
			// A subaction anyone can view... if the language string is there, show it.
			elseif (isset($actions['sa']) && isset($txt['whoall_' . $actions['action'] . '_' . $actions['sa']]))
				$data[$k] = $preferred_prefix && isset($txt[$preferred_prefix . $actions['action'] . '_' . $actions['sa']]) ? $txt[$preferred_prefix . $actions['action'] . '_' . $actions['sa']] : sprintf($txt['whoall_' . $actions['action'] . '_' . $actions['sa']], $scripturl);
			// An action any old fellow can look at. (if ['whoall_' . $action] exists, we know everyone can see it.)
			elseif (isset($txt['whoall_' . $actions['action']]))
				$data[$k] = $preferred_prefix && isset($txt[$preferred_prefix . $actions['action']]) ? $txt[$preferred_prefix . $actions['action']] : sprintf($txt['whoall_' . $actions['action']], $scripturl);
			// Viewable if and only if they can see the board...
			elseif (isset($txt['whotopic_' . $actions['action']]))
			{
				// Find out what topic they are accessing.
				$topic = (int) (isset($actions['topic']) ? $actions['topic'] : (isset($actions['from']) ? $actions['from'] : 0));

				$data[$k] = array('label' => 'who_hidden', 'class' => 'em');
				$topic_ids[$topic][$k] = $txt['whotopic_' . $actions['action']];
			}
			elseif (isset($txt['whopost_' . $actions['action']]))
			{
				// Find out what message they are accessing.
				$msgid = (int) (isset($actions['msg']) ? $actions['msg'] : (isset($actions['quote']) ? $actions['quote'] : 0));

				$result = $smcFunc['db_query']('', '
					SELECT m.id_topic, m.subject
					FROM {db_prefix}messages AS m
						' . ($modSettings['postmod_active'] ? 'INNER JOIN {db_prefix}topics AS t ON (t.id_topic = m.id_topic AND t.approved = {int:is_approved})' : '') . '
					WHERE m.id_msg = {int:id_msg}
						AND {query_see_message_board}' . ($modSettings['postmod_active'] ? '
						AND m.approved = {int:is_approved}' : '') . '
					LIMIT 1',
					array(
						'is_approved' => 1,
						'id_msg' => $msgid,
					)
				);
				list ($id_topic, $subject) = $smcFunc['db_fetch_row']($result);
				$data[$k] = sprintf($txt['whopost_' . $actions['action']], $id_topic, $subject, $scripturl);
				$smcFunc['db_free_result']($result);

				if (empty($id_topic))
					$data[$k] = array('label' => 'who_hidden', 'class' => 'em');
			}
			// Viewable only by administrators.. (if it starts with whoadmin, it's admin only!)
			elseif (allowedTo('moderate_forum') && isset($txt['whoadmin_' . $actions['action']]))
				$data[$k] = sprintf($txt['whoadmin_' . $actions['action']], $scripturl);
			// Viewable by permission level.
			elseif (isset($allowedActions[$actions['action']]))
			{
				if (allowedTo($allowedActions[$actions['action']]) && !empty($txt['whoallow_' . $actions['action']]))
					$data[$k] = sprintf($txt['whoallow_' . $actions['action']], $scripturl);
				elseif (in_array('moderate_forum', $allowedActions[$actions['action']]))
					$data[$k] = $txt['who_moderate'];
				elseif (in_array('admin_forum', $allowedActions[$actions['action']]))
					$data[$k] = $txt['who_admin'];
				else
					$data[$k] = array('label' => 'who_hidden', 'class' => 'em');
			}
			elseif (!empty($actions['action']))
				$data[$k] = $txt['who_generic'] . ' ' . $actions['action'];
			else
				$data[$k] = array('label' => 'who_unknown', 'class' => 'em');
		}

		if (isset($actions['error']))
		{
			loadLanguage('Errors');

			if (isset($txt[$actions['error']]))
				$error_message = str_replace('"', '&quot;', empty($actions['error_params']) ? $txt[$actions['error']] : vsprintf($txt[$actions['error']], (array) $actions['error_params']));
			elseif ($actions['error'] == 'guest_login')
				$error_message = str_replace('"', '&quot;', $txt['who_guest_login']);
			else
				$error_message = str_replace('"', '&quot;', $actions['error']);

			if (!empty($error_message))
			{
				$error_message = ' <span class="main_icons error" title="' . $error_message . '"></span>';

				if (is_array($data[$k]))
					$data[$k]['error_message'] = $error_message;
				else
					$data[$k] .= $error_message;
			}
		}

		// Maybe the action is integrated into another system?
		if (count($integrate_actions = call_integration_hook('integrate_whos_online', array($actions))) > 0)
		{
			foreach ($integrate_actions as $integrate_action)
			{
				if (!empty($integrate_action))
				{
					$data[$k] = $integrate_action;
					if (isset($actions['topic']) && isset($topic_ids[(int) $actions['topic']][$k]))
						$topic_ids[(int) $actions['topic']][$k] = $integrate_action;
					if (isset($actions['board']) && isset($board_ids[(int) $actions['board']][$k]))
						$board_ids[(int) $actions['board']][$k] = $integrate_action;
					if (isset($actions['u']) && isset($profile_ids[(int) $actions['u']][$k]))
						$profile_ids[(int) $actions['u']][$k] = $integrate_action;
					break;
				}
			}
		}
	}

	// Load topic names.
	if (!empty($topic_ids))
	{
		$result = $smcFunc['db_query']('', '
			SELECT t.id_topic, m.subject
			FROM {db_prefix}topics AS t
				INNER JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_first_msg)
			WHERE {query_see_topic_board}
				AND t.id_topic IN ({array_int:topic_list})' . ($modSettings['postmod_active'] ? '
				AND t.approved = {int:is_approved}' : '') . '
			LIMIT {int:limit}',
			array(
				'topic_list' => array_keys($topic_ids),
				'is_approved' => 1,
				'limit' => count($topic_ids),
			)
		);
		while ($row = $smcFunc['db_fetch_assoc']($result))
		{
			// Show the topic's subject for each of the actions.
			foreach ($topic_ids[$row['id_topic']] as $k => $session_text)
				$data[$k] = sprintf($session_text, $row['id_topic'], censorText($row['subject']), $scripturl);
		}
		$smcFunc['db_free_result']($result);
	}

	// Load board names.
	if (!empty($board_ids))
	{
		$result = $smcFunc['db_query']('', '
			SELECT b.id_board, b.name
			FROM {db_prefix}boards AS b
			WHERE {query_see_board}
				AND b.id_board IN ({array_int:board_list})
			LIMIT {int:limit}',
			array(
				'board_list' => array_keys($board_ids),
				'limit' => count($board_ids),
			)
		);
		while ($row = $smcFunc['db_fetch_assoc']($result))
		{
			// Put the board name into the string for each member...
			foreach ($board_ids[$row['id_board']] as $k => $session_text)
				$data[$k] = sprintf($session_text, $row['id_board'], $row['name'], $scripturl);
		}
		$smcFunc['db_free_result']($result);
	}

	// Load member names for the profile. (is_not_guest permission for viewing their own profile)
	$allow_view_own = allowedTo('is_not_guest');
	$allow_view_any = allowedTo('profile_view');
	if (!empty($profile_ids) && ($allow_view_any || $allow_view_own))
	{
		$result = $smcFunc['db_query']('', '
			SELECT id_member, real_name
			FROM {db_prefix}members
			WHERE id_member IN ({array_int:member_list})
			LIMIT ' . count($profile_ids),
			array(
				'member_list' => array_keys($profile_ids),
			)
		);
		while ($row = $smcFunc['db_fetch_assoc']($result))
		{
			// If they aren't allowed to view this person's profile, skip it.
			if (!$allow_view_any && ($user_info['id'] != $row['id_member']))
				continue;

			// Set their action on each - session/text to sprintf.
			foreach ($profile_ids[$row['id_member']] as $k => $session_text)
				$data[$k] = sprintf($session_text, $row['id_member'], $row['real_name'], $scripturl);
		}
		$smcFunc['db_free_result']($result);
	}

	call_integration_hook('whos_online_after', array(&$urls, &$data));

	if (!is_array($urls))
		return isset($data[0]) ? $data[0] : false;
	else
		return $data;
}

/**
 * It prepares credit and copyright information for the credits page or the admin page
 *
 * @param bool $in_admin = false, if parameter is true the it will not load the sub-template nor the template file
 */
function Credits($in_admin = false)
{
	global $context, $smcFunc, $forum_copyright, $txt, $user_info, $scripturl;

	// Don't blink. Don't even blink. Blink and you're dead.
	loadLanguage('Who');

	// Discourage robots from indexing this page.
	$context['robot_no_index'] = true;

	if ($in_admin)
	{
		$context[$context['admin_menu_name']]['tab_data'] = array(
			'title' => $txt['support_credits_title'],
			'help' => '',
			'description' => '',
		);
	}

	$context['credits'] = array(
		array(
			'pretext' => $txt['credits_intro'],
			'title' => $txt['credits_team'],
			'groups' => array(
				array(
					'title' => $txt['credits_groups_pm'],
					'members' => array(
						'Aleksi "Lex" Kilpinen',
						// Former Project Managers
						'Michele "Illori" Davis',
						'Jessica "Suki" González',
						'Will "Kindred" Wagner',
					),
				),
				array(
					'title' => $txt['credits_groups_dev'],
					'members' => array(
						// Lead Developer
						'Jon "Sesquipedalian" Stovell',
						// Developers
						'John "live627" Rayes',

						// Former Developers
						'Aaron van Geffen',
						'Antechinus',
						'Bjoern "Bloc" Kristiansen',
						'Brad "IchBin™" Grow',
						'Colin Schoen',
						'emanuele',
						'Hendrik Jan "Compuart" Visser',
						'Jessica "Suki" González',
						'Jon "Sesquipedalian" Stovell',
						'Juan "JayBachatero" Hernandez',
						'Karl "RegularExpression" Benson',
						'Matthew "Labradoodle-360" Kerle',
						$user_info['is_admin'] ? 'Matt "Grudge" Wolf' : 'Grudge',
						'Michael "Oldiesmann" Eshom',
						'Michael "Thantos" Miller',
						'Norv',
						'Oscar "Ozp" Rydhé',
						'Peter "Arantor" Spicer',
						'Selman "[SiNaN]" Eser',
						'Shawn Bulen',
						'Shitiz "Dragooon" Garg',
						// 'Spuds', // Doesn't want to be listed here
						// 'Steven "Fustrate" Hoffman',
						'Theodore "Orstio" Hildebrandt',
						'Thorsten "TE" Eurich',
						'winrules',
					),
				),
				array(
					'title' => $txt['credits_groups_support'],
					'members' => array(
						// Lead Support Specialist
						'Will "Kindred" Wagner',
						// Support Specialists
						'Doug Heffernan',
						'lurkalot',

						// Former Support Specialists
						'Aleksi "Lex" Kilpinen',
						'br360',
						'GigaWatt',
						'ziycon',
						'Adam Tallon',
						'Bigguy',
						'Bruno "margarett" Alves',
						'CapadY',
						'ChalkCat',
						'Chas Large',
						'Duncan85',
						'gbsothere',
						'JimM',
						'Justyne',
						'Kat',
						'Kevin "greyknight17" Hou',
						'Krash',
						'Mashby',
						'Michael Colin Blaber',
						'Old Fossil',
						'S-Ace',
						'shadav',
						'Steve',
						'Storman™',
						'Wade "sησω" Poulsen',
						'xenovanis',
					),
				),
				array(
					'title' => $txt['credits_groups_customize'],
					'members' => array(
						// Lead Customizer
						'Diego Andrés',
						// Customizers
						'GL700Wing',
						'Johnnie "TwitchisMental" Ballew',
						'Jonathan "vbgamer45" Valentin',

						// Former Customizers
						'Sami "SychO" Mazouz',
						'Brannon "B" Hall',
						'Gary M. Gadsdon',
						'Jack "akabugeyes" Thorsen',
						'Jason "JBlaze" Clemons',
						'Joey "Tyrsson" Smith',
						'Kays',
						'Michael "Mick." Gomez',
						'NanoSector',
						'Ricky.',
						'Russell "NEND" Najar',
						'SA™',
					),
				),
				array(
					'title' => $txt['credits_groups_docs'],
					'members' => array(
						// Doc Coordinator
						'Michele "Illori" Davis',
						// Doc Writers
						'Irisado',

						// Former Doc Writers
						'AngelinaBelle',
						'Chainy',
						'Graeme Spence',
						'Joshua "groundup" Dickerson',
					),
				),
				array(
					'title' => $txt['credits_groups_internationalizers'],
					'members' => array(
						// Lead Localizer
						'Nikola "Dzonny" Novaković',
						// Localizers
						'm4z',
						// Former Localizers
						'Francisco "d3vcho" Domínguez',
						'Robert Monden',
						'Relyana',
					),
				),
				array(
					'title' => $txt['credits_groups_marketing'],
					'members' => array(
						// Marketing Coordinator

						// Marketing

						// Former Marketing
						'Adish "(F.L.A.M.E.R)" Patel',
						'Bryan "Runic" Deakin',
						'Marcus "cσσкιє мσηѕтєя" Forsberg',
						'Ralph "[n3rve]" Otowo',
					),
				),
				array(
					'title' => $txt['credits_groups_site'],
					'members' => array(
						'Jeremy "SleePy" Darwood',
					),
				),
				array(
					'title' => $txt['credits_groups_servers'],
					'members' => array(
						'Derek Schwab',
						'Michael Johnson',
						'Liroy van Hoewijk',
					),
				),
			),
		),
	);

	// Give the translators some credit for their hard work.
	if (!is_array($txt['translation_credits']))
		$txt['translation_credits'] = array_filter(array_map('trim', explode(',', $txt['translation_credits'])));

	if (!empty($txt['translation_credits']))
		$context['credits'][] = array(
			'title' => $txt['credits_groups_translation'],
			'groups' => array(
				array(
					'title' => $txt['credits_groups_translation'],
					'members' => $txt['translation_credits'],
				),
			),
		);

	$context['credits'][] = array(
		'title' => $txt['credits_special'],
		'posttext' => $txt['credits_anyone'],
		'groups' => array(
			array(
				'title' => $txt['credits_groups_consultants'],
				'members' => array(
					'albertlast',
					'Brett Flannigan',
					'Mark Rose',
					'René-Gilles "Nao 尚" Deberdt',
					'tinoest',
					$txt['credits_code_contributors'],
				),
			),
			array(
				'title' => $txt['credits_groups_beta'],
				'members' => array(
					$txt['credits_beta_message'],
				),
			),
			array(
				'title' => $txt['credits_groups_translators'],
				'members' => array(
					$txt['credits_translators_message'],
				),
			),
			array(
				'title' => $txt['credits_groups_founder'],
				'members' => array(
					'Unknown W. "[Unknown]" Brackets',
				),
			),
			array(
				'title' => $txt['credits_groups_orignal_pm'],
				'members' => array(
					'Jeff Lewis',
					'Joseph Fung',
					'David Recordon',
				),
			),
			array(
				'title' => $txt['credits_in_memoriam'],
				'members' => array(
					'Crip',
					'K@',
					'metallica48423',
					'Paul_Pauline',
					'Rock Lee',
				),
			),
		),
	);

	// Give credit to any graphic library's, software library's, plugins etc
	$context['credits_software_graphics'] = array(
		'graphics' => array(
			'<a href="http://p.yusukekamiyamane.com/">Fugue Icons</a> | © 2012 Yusuke Kamiyamane | These icons are licensed under a Creative Commons Attribution 3.0 License',
			'<a href="https://techbase.kde.org/Projects/Oxygen/Licensing#Use_on_Websites">Oxygen Icons</a> | These icons are licensed under <a href="http://www.gnu.org/copyleft/lesser.html">GNU LGPLv3</a>',
		),
		'software' => array(
			'<a href="https://jquery.org/">JQuery</a> | © John Resig | Licensed under <a href="https://github.com/jquery/jquery/blob/master/LICENSE.txt">The MIT License (MIT)</a>',
			'<a href="https://briancherne.github.io/jquery-hoverIntent/">hoverIntent</a> | © Brian Cherne | Licensed under <a href="https://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
			'<a href="https://www.sceditor.com/">SCEditor</a> | © Sam Clarke | Licensed under <a href="https://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
			'<a href="http://wayfarerweb.com/jquery/plugins/animadrag/">animaDrag</a> | © Abel Mohler | Licensed under <a href="https://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
			'<a href="https://github.com/mzubala/jquery-custom-scrollbar">jQuery Custom Scrollbar</a> | © Maciej Zubala | Licensed under <a href="http://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
			'<a href="http://slippry.com/">jQuery Responsive Slider</a> | © booncon ROCKETS | Licensed under <a href="http://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
			'<a href="https://github.com/ichord/At.js">At.js</a> | © chord.luo@gmail.com | Licensed under <a href="https://github.com/ichord/At.js/blob/master/LICENSE-MIT">The MIT License (MIT)</a>',
			'<a href="https://github.com/ttsvetko/HTML5-Desktop-Notifications">HTML5 Desktop Notifications</a> | © Tsvetan Tsvetkov | Licensed under <a href="https://github.com/ttsvetko/HTML5-Desktop-Notifications/blob/master/License.txt">The Apache License Version 2.0</a>',
			'<a href="https://github.com/enygma/gauth">GAuth Code Generator/Validator</a> | © Chris Cornutt | Licensed under <a href="https://github.com/enygma/gauth/blob/master/LICENSE">The MIT License (MIT)</a>',
			'<a href="https://github.com/enyo/dropzone">Dropzone.js</a> | © Matias Meno | Licensed under <a href="http://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
			'<a href="https://github.com/matthiasmullie/minify">Minify</a> | © Matthias Mullie | Licensed under <a href="http://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
			'<a href="https://github.com/true/php-punycode">PHP-Punycode</a> | © True B.V. | Licensed under <a href="http://en.wikipedia.org/wiki/MIT_License">The MIT License (MIT)</a>',
		),
		'fonts' => array(
			'<a href="https://fontlibrary.org/en/font/anonymous-pro"> Anonymous Pro</a> | © 2009 | This font is licensed under the SIL Open Font License, Version 1.1',
			'<a href="https://fontlibrary.org/en/font/consolamono"> ConsolaMono</a> | © 2012 | This font is licensed under the SIL Open Font License, Version 1.1',
			'<a href="https://fontlibrary.org/en/font/phennig"> Phennig</a> | © 2009-2012 | This font is licensed under the SIL Open Font License, Version 1.1',
		),
	);

	// Support for mods that use the <credits> tag via the package manager
	$context['credits_modifications'] = array();
	if (($mods = cache_get_data('mods_credits', 86400)) === null)
	{
		$mods = array();
		$request = $smcFunc['db_query']('substring', '
			SELECT version, name, credits
			FROM {db_prefix}log_packages
			WHERE install_state = {int:installed_mods}
				AND credits != {string:empty}
				AND SUBSTRING(filename, 1, 9) != {string:patch_name}',
			array(
				'installed_mods' => 1,
				'patch_name' => 'smf_patch',
				'empty' => '',
			)
		);

		while ($row = $smcFunc['db_fetch_assoc']($request))
		{
			$credit_info = $smcFunc['json_decode']($row['credits'], true);

			$copyright = empty($credit_info['copyright']) ? '' : $txt['credits_copyright'] . ' © ' . $smcFunc['htmlspecialchars']($credit_info['copyright']);
			$license = empty($credit_info['license']) ? '' : $txt['credits_license'] . ': ' . (!empty($credit_info['licenseurl']) ? '<a href="' . $smcFunc['htmlspecialchars']($credit_info['licenseurl']) . '">' . $smcFunc['htmlspecialchars']($credit_info['license']) . '</a>' : $smcFunc['htmlspecialchars']($credit_info['license']));
			$version = $txt['credits_version'] . ' ' . $row['version'];
			$title = (empty($credit_info['title']) ? $row['name'] : $smcFunc['htmlspecialchars']($credit_info['title'])) . ': ' . $version;

			// build this one out and stash it away
			$mod_name = empty($credit_info['url']) ? $title : '<a href="' . $credit_info['url'] . '">' . $title . '</a>';
			$mods[] = $mod_name . (!empty($license) ? ' | ' . $license : '') . (!empty($copyright) ? ' | ' . $copyright : '');
		}
		cache_put_data('mods_credits', $mods, 86400);
	}
	$context['credits_modifications'] = $mods;

	$context['copyrights'] = array(
		'smf' => sprintf($forum_copyright, SMF_FULL_VERSION, SMF_SOFTWARE_YEAR, $scripturl),
		/* Modification Authors:  You may add a copyright statement to this array for your mods.
			Copyright statements should be in the form of a value only without a array key.  I.E.:
				'Some Mod by Thantos © 2010',
				$txt['some_mod_copyright'],
		*/
		'mods' => array(
		),
	);

	// Support for those that want to use a hook as well
	call_integration_hook('integrate_credits');

	if (!$in_admin)
	{
		loadTemplate('Who');
		$context['sub_template'] = 'credits';
		$context['robot_no_index'] = true;
		$context['page_title'] = $txt['credits'];
	}
}

?>