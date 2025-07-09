<?php
/**********************************************************************************
* Subs-Seo.php																      *
***********************************************************************************
*																				  *
* SMFPacks SEO v2.4.3														 	  *
* Copyright (c) 2011-2020 by SMFPacks.com. All rights reserved.					  *
* Powered by www.smfpacks.com													  *
* Created by NIBOGO for SMFPacks.com											  *
*																				  *
***********************************************************************************
* You can't redistribute this program, this is a PAID Mod and only can be		  *
* downloaded from the SMFPacks site (http://www.smfpacks.com if you downloaded	  *
* this package from another website please report it to the SMFPacks Team.		  *
**********************************************************************************/

if (!defined('SMF'))
	die('Hacking attempt...');
	
function seo_error_pages()
{
	global $context, $scripturl, $txt, $modSettings;
	
	loadtemplate('Seo');
	loadlanguage('Seo');

	$context['request_url'] = (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$context['page_title'] = $txt['seo_error' . $_GET['c']];
	$context['sub_template'] = 'seo_error_pages';
	
	if (!empty($modSettings['seo_nofollow_error']))
		$context['html_headers'] .= '
			<meta name="robots" content="noindex" />';

	$context['linktree'][] = array(
		'url' => $scripturl,
		'name' => $txt['seo_error'] . ' ' . $_GET['c'],
	);

	// Logged!
	seo_log_warn($_GET['c'] . rand(1, 20000), $txt['seo_error' . $_GET['c']] . ' (' . $context['request_url'] . ')');
}

function seo_sitemap()
{
	global $context, $scripturl, $txt, $modSettings;
	
	if (empty($modSettings['seo_enable_sitemap']))
		fatal_lang_error('seo_error_sitemap_disabled', false);

	loadtemplate('Seo');
	loadlanguage('Seo');
	
	$context['linktree'][] = array(
		'url' => $scripturl . '?action=sitemap',
		'name' => $txt['seo_sitemap'],
	);
	
	// Sitemaps should be indexed!
	$context['robot_no_index'] = true;
	
	// Let's load the sitemap xml
	if (isset($_REQUEST['style']))
		seo_sitemap_style();
	elseif (isset($_REQUEST['xml']) && empty($_REQUEST['b']))
		seo_sitemap_xml_index();
	elseif (isset($_REQUEST['xml']) && !empty($_REQUEST['b']))
		seo_sitemap_xml_board();
	elseif (!empty($_REQUEST['b']))
		seo_sitemap_board();
	else
		seo_sitemap_index();	  
}

function seo_sitemap_index()
{
	global $context, $smcFunc, $user_info, $txt, $sourcedir, $modSettings;
	
	// Find the boards/cateogories they can see.
	require_once($sourcedir . '/Subs-MessageIndex.php');
	$boardListOptions = array(
		'use_permissions' => true,
		'selected_board' => isset($context['current_board']) ? $context['current_board'] : 0,
		'not_redirection' => true,
	);
	
	// There is a recycle board?
	if (!empty($modSettings['recycle_enable']) && !empty($modSettings['recycle_board']))
		$boardListOptions['excluded_boards'] = array($modSettings['recycle_board']);
	
	$context['jump_to'] = getBoardList($boardListOptions);

	// Make the board safe for display.
	foreach ($context['jump_to'] as $id_cat => $cat)
	{
		$context['jump_to'][$id_cat]['name'] = un_htmlspecialchars(strip_tags($cat['name']));
		foreach ($cat['boards'] as $id_board => $board)
			$context['jump_to'][$id_cat]['boards'][$id_board]['name'] = un_htmlspecialchars(strip_tags($board['name']));
	}
	
	$context['sub_template'] = 'seo_sitemap_index';	
	$context['page_title'] = ($txt['seo_sitemap'] . ' - ' . $context['forum_name']);
}

function seo_sitemap_board()
{
	global $context, $smcFunc, $user_info, $modSettings, $boarddir, $txt, $scripturl;

	// Load the Board info from the DB
	$dbresult = $smcFunc['db_query']('', '
	SELECT 
		b.id_board, b.name, b.description, b.redirect
	FROM {db_prefix}boards as b
		LEFT JOIN {db_prefix}messages as m ON (m.id_msg = b.id_last_msg)
	WHERE {query_see_board}
		AND b.id_board = {int:board_id}
		AND b.redirect = ""
	LIMIT 1',
		array(
			   'board_id' => (int) $_REQUEST['b'], 
		)
	);	
	
	if ($smcFunc['db_num_rows']($dbresult) == 0)
		fatal_lang_error('board_doesnt_exist', false);
	
	$board = array();

	while ($row = $smcFunc['db_fetch_assoc']($dbresult))
	{
		$board = array(
			'id_board' => $row['id_board'],
			'board_name' => $row['name'],
			'description' => $row['description'],	 			
		);
	}
	$smcFunc['db_free_result']($dbresult);
	$context['board'] = $board;	
	
	// Get the total amount of entries.
	$request2 = $smcFunc['db_query']('', '
		SELECT COUNT(*)
		FROM {db_prefix}topics
		WHERE approved = {int:is_approved}
			AND id_board = {int:board_id}',
			array(
				'board_id' => $context['board']['id_board'],
				'is_approved' => '1',
			)
		);

	list ($totaltopics) = $smcFunc['db_fetch_row']($request2);
	$smcFunc['db_free_result']($request2);

	// Set the linktree, page_title, meta data, sub_template & pages  
	$context['linktree'][] = array(
		'url' => ''.$scripturl.'?action=sitemap;b='.$context['board']['id_board'].'',
		'name' => $context['board']['board_name'],
	); 
	$context['sub_template'] = 'seo_sitemap_board';	
	$context['page_index'] = constructPageIndex($scripturl . '?action=sitemap;b='.$context['board']['id_board'].'', $_REQUEST['start'], $totaltopics, $modSettings['seo_sitemap_topics']);
	$context['start'] = $_REQUEST['start'];
	$context['seo_description'] = seo_meta_description($context['board']['description']);
	$key1 = seo_meta_keywords($context['board']['description']);
	$key2 = seo_meta_keywords($context['board']['board_name']);
	$context['page_title'] = ($txt['seo_sitemap'] . ' - ' . $context['board']['board_name']);
	$context['seo_keywords'] = ($key1 . ',' . $key2);
	
	// Now the Topics!
	$request = $smcFunc['db_query']('', '
		SELECT m.id_topic, m.subject
		FROM {db_prefix}messages as m, {db_prefix}topics as t, {db_prefix}boards as b
		WHERE m.id_board = {int:board_id}
			AND b.id_board = {int:board_id}
			AND {query_see_board}
			AND m.id_msg = t.id_first_msg 
		ORDER BY m.poster_time ASC
		LIMIT {int:start}, {int:end}',
		array(
			 'board_id' => (int) $_REQUEST['b'],
			 'start' => $context['start'],
			 'end' => $modSettings['seo_sitemap_topics'],	 			 
		)
	);

	// Assign it to the array
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$context['topics'][] = array(			
			'id_topic' => $row['id_topic'],
			'subject' => $row['subject'],
		);
	}
	$smcFunc['db_free_result']($request);
}

function seo_sitemap_xml_index()
{
	global $context, $smcFunc, $user_info, $boarddir, $modSettings;
	
	// Load all the info from the DB
	$dbrequest = $smcFunc['db_query']('', '
		SELECT b.id_board, m.poster_time, b.num_topics
		FROM {db_prefix}boards as b
			LEFT JOIN {db_prefix}messages as m ON (m.id_msg = b.id_last_msg)
		WHERE {query_see_board}
			AND b.num_topics > 0
			AND b.redirect = ""' . (empty($modSettings['recycle_enable']) ? '' : '
			AND b.id_board != {int:recycle_board}'). '
		ORDER BY b.num_topics DESC',
		array(
			'recycle_board' => !empty($modSettings['recycle_board']) ? $modSettings['recycle_board'] : 0,
		)
	);
		
	$context['boards'] = array();
	while ($row = $smcFunc['db_fetch_assoc']($dbrequest))
	{
		$context['boards'][] = array(
			'id' => $row['id_board'],
			'poster_time' => gmdate('Y-m-d\TH:i:s'.'+00:00', intval($row['poster_time'])),
			'num_topics' => $row['num_topics'],
		);
	}
	$smcFunc['db_free_result']($dbrequest);
	$context['sub_template'] = 'seo_sitemap_xml_index';
	
	// Compressed index?
	if (!empty($modSettings['seo_enable_compressed_xml']))
	{
		// Set our sitemap name
		$sitemap_name = 'sitemap.xml.gz';
		$sitemap_file = $boarddir . '/sitemaps/' . $sitemap_name;
	
		// Already there less than 6 hours ago?
		if (!file_exists($sitemap_file) || time() - filemtime($sitemap_file) > (60 * 60 * 6))
		{	
			// Load the sitemapindex
			seo_sitemap_xml_get_sitemapindex(false);
			
			// Store the new gz file!
			$gzdata = gzencode($context['xml_output'], 9);
			$fp = fopen($sitemap_file, "w");
			fwrite($fp, $gzdata);
			fclose($fp);
		}
		
		// Download!
		seo_sitemap_download($sitemap_name, $sitemap_file);
	}
	// Just give me the output
	else
		seo_sitemap_xml_get_sitemapindex(true);
}

function seo_sitemap_xml_get_sitemapindex($add_style = false)
{
	global $context, $scripturl, $modSettings, $boardurl, $modSettings;
	
	// How many urls?
	$sitemap_url_limit = !empty($modSettings['sitemap_url_limit']) ? (int) $modSettings['sitemap_url_limit'] : 5000;
	
	// Prepare output
	$context['xml_output'] = '<?xml version="1.0" encoding="UTF-8"?>';

	// Add style?
	if ($add_style && empty($modSettings['seo_sitemap_disable_style']))
		$context['xml_output'] .= '
<?xml-stylesheet type="text/xsl" href="' . $boardurl . '/SeoSitemapStyle.php"?>';
	
	$context['xml_output'] .= '
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="
	http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/09/siteindex.xsd">
	<!-- Generated by SMFPacks SEO PRO Mod - www.smfpacks.com -->';
		
	if (!empty($context['boards']))
	{
	    foreach ($context['boards'] as $board)
	    {
	    	// We need to divide sitemaps per 10.000 urls, Google allows more but we can be safe with this one!
	    	if ($board['num_topics'] > $sitemap_url_limit)
	    	{
	    		for ($i = 0; $i < ceil($board['num_topics'] / $sitemap_url_limit); $i++)
	    		{
	$context['xml_output'] .= '
	<sitemap>
	      <loc>' . $scripturl . '?action=sitemap;xml;b=' . $board['id'] . ';s=' . $i . '</loc>
	      <lastmod>' . $board['poster_time'] . '</lastmod>
	</sitemap>';
				}
			}
			// No more than 10.000 topics? No problem!
			else
			{
	$context['xml_output'] .= '
	<sitemap>
	      <loc>' . $scripturl . '?action=sitemap;xml;b=' . $board['id'] . '</loc>
	      <lastmod>' . $board['poster_time'] . '</lastmod>
	</sitemap>';
			}
		}
	}
	
	$context['xml_output'] .= '
</sitemapindex>';
}

function seo_sitemap_xml_board()
{
	global $context, $smcFunc, $user_info, $scripturl, $boardurl, $boarddir, $modSettings;
	
	// Pagination?
	if (isset($_GET['s']))
		$_GET['s'] = (int) $_GET['s'];
	else
		$_GET['s'] = 0;
	
	// Setup the main forum url...
	$context['sub_template'] = 'seo_sitemap_xml_board';
	
	// Get the board if
	$board_id = (int) $_REQUEST['b'];

	// Load all the info from the DB
	$dbrequest = $smcFunc['db_query']('', '
		SELECT b.id_board, m.poster_time, b.num_topics, b.name
		FROM {db_prefix}boards as b
			LEFT JOIN {db_prefix}messages as m ON (m.id_msg = b.id_last_msg)
		WHERE b.id_board = {int:board_id}
			AND {query_see_board}
			AND b.redirect = ""
		LIMIT 1',
		array
		(
			'board_id' => $board_id,
		)
	);
	
	if ($smcFunc['db_num_rows']($dbrequest) == 0)
		fatal_lang_error('board_doesnt_exist', false);
		
	$context['board'] = array();
	while ($row = $smcFunc['db_fetch_assoc']($dbrequest))
	{
		$url = $scripturl . '?board=' . $row['id_board'].  '.0';
		if (!empty($modSettings['enable_pretty_boards']) && !empty($modSettings['enable_pretty_urls']))
		{
			// Directories structure are the coolest thing ever!
			if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
				$pattern = $boardurl . '/{BOARD_NAME}/{BOARD_ID}/';
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')	
				$pattern = $boardurl . '/b{BOARD_ID}/';
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
				$pattern = $boardurl . '/b{BOARD_ID}_{BOARD_NAME}/';
			else
				$pattern = $boardurl . '/board{BOARD_ID}/';
				
			$url = str_replace(array('{BOARD_ID}', '{BOARD_NAME}'), array($row['id_board'], format_url($row['name'])), $pattern);
		}
		
		$context['board'] = array(
			'loc' => $url,
			'poster_time' => gmdate('Y-m-d\TH:i:s'.'+00:00', intval($row['poster_time'])),
			'frequency' => seo_sitemap_frequency($row['poster_time'], $row['num_topics']),
			'priority' => seo_sitemap_priority($row['poster_time']),
			'name'		=> $row['name'],
		);
	}
	$smcFunc['db_free_result']($dbrequest);
	
	// Serving a compressed file?
	if (!empty($modSettings['seo_enable_compressed_xml']))
	{
		// Set our sitemap name
		$sitemap_name = 'sitemap_board' . $board_id . '_start' . $_GET['s'] . '.xml.gz';
		$sitemap_file = $boarddir . '/sitemaps/' . $sitemap_name;
	
		// Already there less than 6 hours ago?
		if (!file_exists($sitemap_file) || time() - filemtime($sitemap_file) > (60 * 60 * 6))
		{	
			// Load topics
			seo_sitemap_xml_get_topics($board_id, false);
			
			// Store the new gz file!
			$gzdata = gzencode($context['xml_output'], 9);
			$fp = fopen($sitemap_file, "w");
			fwrite($fp, $gzdata);
			fclose($fp);
		}
		
		// Download!
		seo_sitemap_download($sitemap_name, $sitemap_file);
	}
	// Not compression, so just load topics!
	else
	{
		seo_sitemap_xml_get_topics($board_id, true);
	}
}


function seo_sitemap_xml_get_topics($board_id, $add_style = false)
{
	global $context, $smcFunc, $scripturl, $modSettings, $boardurl;
	
	// How many urls?
	$sitemap_url_limit = !empty($modSettings['sitemap_url_limit']) ? (int) $modSettings['sitemap_url_limit'] : 5000;
	
	// Pagination?
	if (isset($_GET['s']))
		$_GET['s'] = (int) $_GET['s'];
	
	// Now get the topics!
	$request = $smcFunc['db_query']('', "
		SELECT t.id_topic, t.num_replies, m.poster_time as first_time, mes.poster_time, t.id_board, m.subject, b.name
		FROM {db_prefix}topics as t
			INNER JOIN {db_prefix}messages as m ON (m.id_msg = t.id_first_msg)
			INNER JOIN {db_prefix}boards as b ON (b.id_board = t.id_board)
			INNER JOIN {db_prefix}messages as mes ON (mes.id_msg = t.id_last_msg)
		WHERE t.id_board = {int:board_id}
			AND {query_see_board}
		ORDER BY m.poster_time DESC" . (!isset($_GET['s']) ? '' : '
		LIMIT ' . ($_GET['s'] * $sitemap_url_limit) . ', ' . ((1 + $_GET['s']) * $sitemap_url_limit)),
		array(
			   'board_id' => $board_id,
		)
	);

	// Assign it to the array
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$url = $scripturl . '?topic=' . $row['id_topic'].  '.0';
		
		if (!empty($modSettings['enable_pretty_topics']) && !empty($modSettings['enable_pretty_urls']))
		{
			// Directories structure are the coolest thing ever!
			if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
				$pattern = $boardurl . '/{BOARD_NAME}/{BOARD_ID}';
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')	
				$pattern = $boardurl . '/b{BOARD_ID}';
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
				$pattern = $boardurl . '/b{BOARD_ID}_{BOARD_NAME}';
			else
				$pattern = $boardurl . '/board{BOARD_ID}';
			
			if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'subject/id')
				$topic_pattern = '{TOPIC_SUBJECT}/{TOPIC_ID}';
			else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'tid')
				$topic_pattern = 't{TOPIC_ID}';
			else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'topicid')
				$topic_pattern = 'topic{TOPIC_ID}';
			else
				$topic_pattern = 't{TOPIC_ID}_{TOPIC_SUBJECT}';
				
			$board_name = str_replace(array('{BOARD_ID}', '{BOARD_NAME}'), array($row['id_board'], format_url($row['name'])), $pattern);
			$topic_name = str_replace(array('{TOPIC_SUBJECT}', '{TOPIC_ID}'), array(format_url($row['subject']), $row['id_topic']), $topic_pattern);
			
			if ($smcFunc['substr']($topic_name, 0, 1) == '/')
				$topic_name = $smcFunc['substr']($topic_name, 1);
					
			$url = $board_name . '/' . $topic_name;
		}
		
		$context['topics'][] = array(			
			'loc' => $url,
			'poster_time' => gmdate('Y-m-d\TH:i:s'.'+00:00', intval($row['poster_time'])),
			'frequency' => seo_sitemap_frequency($row['first_time'], $row['num_replies']),
			'priority' => seo_sitemap_priority($row['poster_time']),
		);
	}

	// Free the result
	$smcFunc['db_free_result']($request);
	
	// Prepare output
	$context['xml_output'] = '<?xml version="1.0" encoding="UTF-8"?>';

	// Add style?
	if ($add_style && empty($modSettings['seo_sitemap_disable_style']))
		$context['xml_output'] .= '
<?xml-stylesheet type="text/xsl" href="' . $boardurl . '/SeoSitemapStyle.php"?>';
	
	$context['xml_output'] .= '
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<!-- Generated by SMFPacks SEO PRO Mod - www.smfpacks.com -->';
		
	if (!empty($context['board']))
		$context['xml_output'] .= '
	<url>
		<loc>' . $context['board']['loc'] . '</loc>
		<lastmod>' . $context['board']['poster_time'] . '</lastmod>
		<changefreq>' . $context['board']['frequency'] . '</changefreq>
		<priority>' . $context['board']['priority'] . '</priority>
	</url>';
		
	if (!empty($context['topics']))
		foreach ($context['topics'] as $topic)
			$context['xml_output'] .= '
	<url>
		<loc>' . $topic['loc'] . '</loc>
		<lastmod>' . $topic['poster_time'] . '</lastmod>
		<changefreq>' . $topic['frequency'] . '</changefreq>
		<priority>' . $topic['priority'] . '</priority>
	</url>';
	
	$context['xml_output'] .= '
</urlset>';
}

function seo_sitemap_download($sitemap_name, $sitemap_file)
{
	global $context;
	
	// Convert the file to UTF-8, cuz most browsers dig that.
	$utf8name = !$context['utf8'] && function_exists('iconv') ? iconv($context['character_set'], 'UTF-8', $sitemap_name) : (!$context['utf8'] && function_exists('mb_convert_encoding') ? mb_convert_encoding($sitemap_name, 'UTF-8', $context['character_set']) : $sitemap_name);
	
	// Send some headers first!
	ob_start();
	header('Content-Encoding: none');
	header('Pragma: ');
	if (!$context['browser']['is_gecko'])
		header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($sitemap_file));
	header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 60 * 60 * 6) . ' GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($sitemap_file)) . ' GMT');
	header('Cache-Control: max-age=' . (60 * 60 * 6) . ', private');
	header('Accept-Ranges: bytes');
	header('Connection: close');
	header('Content-Type: ' . ($context['browser']['is_ie'] || $context['browser']['is_opera'] ? 'application/octetstream' : 'application/octet-stream'));
	
	// Different browsers like different standards...
	if ($context['browser']['is_firefox'])
		header('Content-Disposition: attachment; filename*=UTF-8\'\'' . rawurlencode(preg_replace_callback('~&#(\d{3,8});~', 'fixchar__callback', $utf8name)));

	elseif ($context['browser']['is_opera'])
		header('Content-Disposition: attachment; filename="' . preg_replace_callback('~&#(\d{3,8});~', 'fixchar__callback', $utf8name) . '"');

	elseif ($context['browser']['is_ie'])
		header('Content-Disposition: attachment; filename="' . urlencode(preg_replace_callback('~&#(\d{3,8});~', 'fixchar__callback', $utf8name)) . '"');

	else
		header('Content-Disposition: attachment; filename="' . $utf8name . '"');
	
	// Try to buy some time...
	@set_time_limit(600);
	
	// Since we don't do output compression for files this large...
	if (filesize($sitemap_file) > 4194304)
	{
		// Forcibly end any output buffering going on.
		if (function_exists('ob_get_level'))
		{
			while (@ob_get_level() > 0)
				@ob_end_clean();
		}
		else
		{
			@ob_end_clean();
			@ob_end_clean();
			@ob_end_clean();
		}

		$fp = fopen($sitemap_file, 'rb');
		while (!feof($fp))
		{
			echo fread($fp, 8192);
			flush();
		}
		fclose($fp);
	}
	// On some of the less-bright hosts, readfile() is disabled.  It's just a faster, more byte safe, version of what's in the if.
	elseif (@readfile($sitemap_file) == null)
		echo file_get_contents($sitemap_file);

	obExit(false);
}

function seo_sitemap_style()
{
	global $context, $settings;
	
	$context['sub_template'] = 'sitemap_style';
	$context['template_layers'] = array();
}

function seo_sitemap_priority($timestamp)
{
	$diff = floor((time() - $timestamp) / 86400);
	
	if ($diff <= 30)
		return '1.0';
	else if ($diff <= 60)
		return '0.8';
	else if ($diff <= 90)
		return '0.6';
	else if ($diff <= 150)
		return '0.4';
	else if ($diff <= 200)
		return '0.2';
	
	return '0.1';
}

function seo_sitemap_frequency($timestamp, $replies)
{
	$freq = floor((time() - $timestamp)) / ($replies+1);
	if ($freq < (24*60*60))
		return 'hourly';
	elseif ($freq < (24*60*60*7))
		return 'daily';
	elseif ($freq < (24*60*60*7*(52/12)))
		return 'weekly';
	elseif ($freq < (24*60*60*365))
		return 'monthly';
	else
		return 'yearly';
}

function seo_external_redirect()
{
	global $context, $modSettings, $txt;
	
	// Nothing to be shown?
	if (!isset($_REQUEST['u']))
		die('Hacking attempt...');
		
	// Load the basics!
	loadtemplate('Seo');
	loadlanguage('Seo');
	loadLanguage('Packages');
	
	// Required!
	$context['page_title'] = $txt['package_installed_redirecting'];
	$context['plain_url'] = rawurldecode(base64_decode($_REQUEST['u']));
	$context['seconds'] = isset($modSettings['seo_redirect_delay']) ? $modSettings['seo_redirect_delay'] : 5;
	$context['sub_template'] = 'seo_redirect';
	$context['html_headers'] .= '<meta HTTP-EQUIV="REFRESH" content="' . $context['seconds'] . '; url=' . $context['plain_url'] . '">';
	$context['url'] = '<a href="' . $context['plain_url'] . '">' . $context['plain_url'] . '</a>';

	// It's there?
	if (isset($modSettings['seo_redirect_delay']) && $modSettings['seo_redirect_delay'] == 0) {
		header('Location: ' . $context['plain_url']);
	}
}

function seo_post()
{
	global $scripturl, $modSettings;
	
	seo_ping();
	seo_ping_sitemap();
}

// Thanks to: http://www.barattalo.it/2010/02/24/ping-pingomatic-com-services-with-php/
function seo_ping()
{
	global $modSettings, $mbname, $scripturl;
	
	// We don't want to kill the server!
	if (empty($modSettings['seo_ping']) || (!empty($modSettings['seo_last_ping']) && $modSettings['seo_last_ping'] > (time() - 86400)))
		return;
		
	$content = '<?xml version="1.0"?>'.
		'<methodCall>'.
		' <methodName>weblogUpdates.ping</methodName>'.
		'  <params>'.
		'	<param>'.
		'	 <value>'.$mbname.'</value>'.
		'	</param>'.
		'  <param>'.
		'	<value>'.$scripturl.'</value>'.
		'  </param>'.
		' </params>'.
		'</methodCall>';
 
	$headers = 'POST / HTTP/1.0\r\n' .
	'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1) Gecko/20090624 Firefox/3.5 (.NET CLR 3.5.30729)\r\n' .
	'Host: rpc.pingomatic.com\r\n' .
	'Content-Type: text/xml\r\n' .
	'Content-length: ' . strlen($content);
	
	$request = $headers . "\r\n\r\n" . $content;
	$response = '';
	$fs = fsockopen('rpc.pingomatic.com', 80, $errno, $errstr);
	
	if ($fs)
	{
		fwrite ($fs, $request);
		
		while (!feof($fs))
			$response .= fgets($fs);
		
		fclose ($fs);
		preg_match_all("/<(name|value|boolean|string)>(.*)<\/(name|value|boolean|string)>/U", $response, $ar, PREG_PATTERN_ORDER);
		
		for ($i = 0; $i < count($ar[2]); $i++)
			$ar[2][$i] = strip_tags($ar[2][$i]);
	}
	
	updateSettings(array('seo_last_ping' => time()));
}

// Thanks to: http://www.php-ease.com/functions/ping_search_engines.html
function seo_ping_sitemap()
{
	global $modSettings, $scripturl;
	
	// First check if a sitemap exists and we have a frequency
	if (empty($modSettings['seo_sitemap_xml']) || empty($modSettings['seo_ping_sitemap_frequency']))
		return;
		
	// Is the frequency good enough?
	if (!empty($modSettings['seo_last_sitemap_ping']) && !empty($modSettings['seo_ping_sitemap_frequency']) && $modSettings['seo_last_sitemap_ping'] > (time() - (86400 * $modSettings['seo_ping_sitemap_frequency'])))
		return;
		
	$engines = array();
	
	if (!empty($modSettings['seo_ping_sitemap_google']))
		$engines['www.google.com'] = '/webmasters/sitemaps/ping?sitemap=' . $scripturl . '?action=sitemap;xml';
	
	if (!empty($modSettings['seo_ping_sitemap_bing']))
		$engines['www.bing.com'] = '/webmaster/ping.aspx?sitemap=' . $scripturl . '?action=sitemap;xml';
		
	if (empty($engines))
		return;
	
	foreach ($engines as $host => $path)
	{
		$fp = fsockopen($host, 80);
		$send = "HEAD $path HTTP/1.1\r\n";
		$send .= "HOST: $host\r\n";
		$send .= "CONNECTION: Close\r\n\r\n";
		fwrite($fp, $send);
		$http_response = fgets($fp, 128);
		fclose($fp);
		list($response, $code) = explode (' ', $http_response);
		
		if ($code != 200) 
			seo_log_warn('ping_unsuccesful_' . rand(1, 1000), $host . ' ping was unsuccessful. Code: ' . $code . '. Response: ' .$response);
	}
	
	updateSettings(array('seo_last_sitemap_ping' => time()));
}

function seo_title_links($message)
{
	global $sourcedir, $modSettings, $boardurl, $smcFunc, $context;
	
	if (empty($modSettings['seo_add_title_urls']))
		return $message;
	
	$timeout = @ini_get('default_socket_timeout');
	@ini_set('default_socket_timeout', 3);
	
	preg_match_all("~\[code\](.+?)\[/code\]~smi", $message, $codes);
	$are_codes = false;
	if (!empty($codes[0]))
	{
		$are_codes = true;
		foreach($codes[1] as $code)
		{
			$new_code = strpos($code, 'http://') === false ? $code : str_replace('http://', 'htsmfpackstp://', $code);
			$message = str_replace($code, $new_code, $message);

			$new_code = strpos($code, 'https://') === false ? $code : str_replace('https://', 'htsmfpackstps://', $code);
			$message = str_replace($code, $new_code, $message);
		}
	}
	
	$message = preg_replace(array('~(?<=[\s>\.(;\'"]|^)(((?:http)|(?:https))://[\w\-_%@:|]+(?:\.[\w\-_%]+)*(?::\d+)?(?:/[\w\-_\~%\.@,\?&;=#+:\'\\\\]*|[\(\{][\w\-_\~%\.@,\?&;=#(){}+:\'\\\\]*)*[/\w\-_\~%@\?;=#}\\\\])~i', '~(?<=[\s>(\'<]|^)(www(?:\.[\w\-_]+)+(?::\d+)?(?:/[\w\-_\~%\.@,\?&;=#+:\'\\\\]*|[\(\{][\w\-_\~%\.@,\?&;=#(){}+:\'\\\\]*)*[/\w\-_\~%@\?;=#}\\\\])~i'), array('[url]$1[/url%]', '[url]$1[/url%]'), $message);
	
	if (!empty($modSettings['seo_add_title_urls_blacklist']))
		$sites = explode("\n", $modSettings['seo_add_title_urls_blacklist']);

	// Now we find the urls that we just changed, so we can run through them and get titles
	preg_match_all("~\[url\](.+?)\[/url%\]~smi", $message, $urls);
	
	$local = array();
	
	if (!empty($urls[0]))
	{
		$title_counter = 0;
		foreach($urls[1] as $uri)
		{
			$url_temp = str_replace(array('HTTP://', 'HTTPS://'), array('http://', 'https://'), $uri);
			$new_url = $url_modified = trim((strpos($url_temp, 'http://') === false && strpos($url_temp, 'https://') === false) ? 'http://' . $url_temp : $url_temp);

			// make sure there is a trailing '/' *when needed* so fetch_web_data does not blow a cogswell cog
			$urlinfo = parse_url($url_modified);
			if (!isset($urlinfo['path']))
				$url_modified .= '/';
			
			// Check our blacklist!
			if (!empty($modSettings['seo_add_title_urls_blacklist']))
			{
				foreach ($sites as $site)
					if (strpos($new_url, $site) !== false)
					{
						$message = preg_replace('~\[url\]' . $uri . '\[/url%\]~', $uri, $message);
						continue;
					}
			}
			
			if (strpos($new_url, $boardurl))
				continue;

			$title = seo_get_remote_title($url_modified, $urlinfo);
			
			if ($title === false)
				$message = str_replace('[url]' . $uri . '[/url%]', $uri, $message);
			else
				$message = preg_replace('`\[url\]' . preg_quote($uri) . '\[/url%\]`', '[url=' . $new_url . ']' . $title . '[/url]', $message);
		}
	}
	
	@ini_set('default_socket_timeout', $timeout);
	
	if ($are_codes)
	{
		preg_match_all("~\[code\](.+?)\[/code\]~smi", $message, $codes);
		if (!empty($codes[0]))
		{
			foreach($codes[1] as $code)
			{
				$new_code = strpos($code, 'htsmfpackstp://') === false ? $code : str_replace('htsmfpackstp://', 'http://', $code);
				$message = str_replace($code, $new_code, $message);

				$new_code = strpos($code, 'htsmfpackstps://') === false ? $code : str_replace('htsmfpackstps://', 'https://', $code);
				$message = str_replace($code, $new_code, $message);
			}
		}
	}
	return $message;
}

function seo_get_remote_title($url, $urlinfo)
{
	global $context, $smcFunc;
	
	if (!class_exists('DOMDocument'))
		return seo_get_remote_title_legacy($url, $urlinfo);
	
	$dom = new DOMDocument();
	$title = '';
	if(@$dom->loadHTMLFile($url))
	{
		$list = $dom->getElementsByTagName('title');
		if ($list->length > 0)
			$title = $list->item(0)->textContent;
	}
	
	return seo_format_remote_title($title);
}

function seo_get_remote_title_legacy($url, $urlinfo)
{
	global $sourcedir;
	
	require_once($sourcedir . '/Subs-Package.php');
	
	$check = isset($urlinfo['path']) ? pathinfo($urlinfo['path']) : array();
	if (isset($check['extension']) && (!in_array($check['extension'], array('htm', 'html', '', '//'))))
		$request = false;
	else
		$request = fetch_web_data(un_htmlspecialchars(un_htmlspecialchars($url)));

	if ($request !== false && preg_match('~<title>(.+?)</title>~smi', $request, $matches))
		return seo_format_remote_title($matches[1]);
	
	return false;
}

function seo_format_remote_title($title)
{
	global $smcFunc, $context;
	
	$title = trim(html_entity_decode(un_htmlspecialchars($title)));
	$title = str_replace(array('&mdash;', "\n", "\t"), array('-', ' ', ' '), $title);
	$title = preg_replace('~\s{2,30}~', ' ', $title);
	$title = (!$context['utf8'] && mb_detect_encoding($title, 'UTF-8', true)) ? utf8_decode($title) : $title;
		
	if (!empty($title)) 
		return $smcFunc['htmlspecialchars'](stripslashes($title), ENT_QUOTES);
		
	return false;
}

// SMFPacks SEO: Related Topics
function seo_related_topics($subject, $method = 'inline')
{
    global $context, $scripturl, $smcFunc, $modSettings, $txt, $settings, $topic, $options, $user_info;
    
    if (empty($modSettings['seo_related_topics']))
        return;
        
    if ($smcFunc['db_title'] == 'MySQL' && empty($modSettings['seo_disable_fulltext']))
    {
    	$order = 'MATCH(m.subject) AGAINST({string:subject}) DESC';
    	$search = 'MATCH(m.subject) AGAINST({string:subject})';
    }
    else
    {
    	$order = 't.id_topic DESC';
    	$search = 'm.subject ' . seo_related_like($subject);
    }

	$icon_sources = array();
	if (seo_is_smf_21())
		foreach ($context['stable_icons'] as $icon)
			$icon_sources[$icon] = 'images_url';
        
    $related_topics = cache_get_data('related-topics-' . $context['current_topic'] . '-' . $user_info['id'], 6000);
    if ($related_topics === null)
    {
	    $request = $smcFunc['db_query']('', '
            SELECT t.id_topic, m.subject, m.icon, m.id_member, IFNULL(mem.real_name, m.poster_name) AS real_name,
            t.num_views, t.num_replies, last_msg.poster_time, IFNULL(last_mem.real_name, last_msg.poster_name) AS last_name,
            last_mem.id_member AS last_member, last_msg.id_msg, b.name AS board_name, t.id_board
           	FROM {db_prefix}topics AS t
                LEFT JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_first_msg)
                LEFT JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
                LEFT JOIN {db_prefix}members AS mem ON (mem.id_member = m.id_member)
                LEFT JOIN {db_prefix}messages AS last_msg ON (last_msg.id_msg = t.id_last_msg)
                LEFT JOIN {db_prefix}members AS last_mem ON (last_mem.id_member = last_msg.id_member)
            WHERE t.approved = {int:approved}
                AND t.id_topic != {int:t}
                AND {query_see_board}
                AND ' . $search . (empty($modSettings['seo_related_topics_samecat']) ? '' : '
                AND t.id_board = {int:board}') . '
            ORDER BY ' . $order . '
            LIMIT {int:num}',
            array(
               't' => $context['current_topic'],
               'num' => !empty($modSettings['seo_related_topics']) ? (int) $modSettings['seo_related_topics'] : 5,
               'approved' => 1,
               'subject' => $subject,
               'board' => $context['current_board'],
            )
		 );
		
		$related_topics = array(); 
		while ($row = $smcFunc['db_fetch_assoc']($request))
		{
			// Check that this message icon is there...
			if (!empty($modSettings['messageIconChecks_enable']) && !isset($icon_sources[$row['icon']]))
				$icon_sources[$row['icon']] = file_exists($settings['theme_dir'] . '/images/post/' . $row['icon'] . '.png') ? 'images_url' : 'default_images_url';
			elseif (!isset($icon_sources[$row['icon']]))
				$icon_sources[$row['icon']] = 'images_url';

			if (seo_is_smf_21())
				$row['icon'] = $settings[$icon_sources[$row['icon']]] . '/post/' . $row['icon'] . '.png';
			else
				$row['icon'] = $settings['images_url'] . '/post/' . $row['icon'] . '.gif';

			$related_topics[] = $row;
		}
		$smcFunc['db_free_result']($request);
		cache_put_data('related-topics-' . $context['current_topic'] . '-' . $user_info['id'], $related_topics, 6000);
	}
	
	if ($method == 'return')
		return $related_topics;
            
    if (count($related_topics) == 0)
        return;
        
    echo'
	<br class="clear" />
		<div class="cat_bar">
			<h3 class="catbg">
				<a href="#" onclick="shrinkHeaderSEORelated(); return false;">';

				if (!seo_is_smf_21())
					echo '
					<img id="upshrink_seo_related" src="', $settings['images_url'], '/', empty($options['collapse_header_seo_related']) ? 'collapse.gif' : 'expand.gif', '" alt="*" title="', $txt['upshrink_description'], '" />';
				else
					echo '
					<span class="toggle_', (empty($options['collapse_header_seo_related']) ? 'down' : 'up'),'" id="upshrink_seo_related" style="cursor: pointer;"></span>';

			echo
					$txt['seo_similar_topics'], '
				</a>
			</h3>
		</div>
	<div id="upshrinkHeaderSEORelated"', empty($options['collapse_header_seo_related']) ? '' : ' style="display: none;"', 'class="tborder topic_table">
				<table cellspacing="0" class="table_grid">';											
          
    foreach ($related_topics as $row)
	{
	    echo'
	    			<tr>
						<td class="icon2 windowbg" width="4%">
							<img alt="', $row['icon'], '" src="', $row['icon'], '" />
						</td>
						<td class="subject windowbg">
							<h6 class="regular_text">
								<a href="', $scripturl, '?topic=', $row['id_topic'], '.0">
									', censorText($row['subject']), '
								</a>
							</h6>
							<p>
								', $txt['started_by'], ' ',($row['id_member'] != 0) ? '<a title="' . sprintf($txt['view_profile_of_username'], $row['real_name']) . '" href="' . $scripturl . '?action=profile;u=' . $row['id_member'] . '" rel="nofollow">' : '',' ' . $row['real_name'] . ' ',($row['id_member'] != 0) ? '</a>' : '','
								', $txt['on'], ' <a href="' . $scripturl . '?board=' . $row['id_board'] . '.0" >', $row['board_name'], '</a>
							</p>
						</td>
						<td class="stats windowbg" width="14%">
							', $row['num_replies'], ' ', $txt['replies'], '
							<br />
							', $row['num_views'],' ', $txt['views'],'
						</td>
						<td class="windowbg" width="22%">
							<a href="', $scripturl, '?topic=', $row['id_topic'], '.msg', $row['id_msg'], '#msg', $row['id_msg'], '" rel="nofollow">
								', $txt['last_post'], ': ', timeformat($row['poster_time']), '<br />
							', $txt['by'], ' ', ($row['last_member'] != 0) ? '<a href="' . $scripturl . '?action=profile;u=' . $row['last_member'] . '" rel="nofollow">' : '',' ', $row['last_name'], ' ',($row['last_member'] != 0) ? '</a>' : '','
						</td>
					</tr>';
	}
	
	echo'
				</table>
			</div>';
}

function seo_related_like($subject)
{
	$subject = str_replace(array('_', '%'), array("\_", "\%"), $subject);
	$subject = str_replace(array(chr(0) . "\_", chr(0) . "\%"), array('_', '%'), $subject);
	$subject = explode(' ', trim(preg_replace('`[\s]+`', ' ', $subject)));
	
	if ($subject != "")
		for ($i = 0; $i < 5; $i++)
		{
		    if (isset($subject[$i]))
		    {
			    if ($i == 0)
				   $result = " LIKE '%$subject[$i]%'";
				else
				   $result .= " OR  '%$subject[$i]%'";
		    }   
	    }
	
	return $result;
}

function seo_social_bookmarks($position = 'topic', $subject = '', $msg = '')
{
   global $modSettings, $context, $txt, $settings, $scripturl, $options, $sourcedir;
   
   $url = $scripturl . '?topic=' . $context['current_topic'];
   
   if ($msg != '')
      $url = $url . '.msg' . $msg . '#' . $msg;
   else
      $url = $url . '.0';   
   
   // Advanced Topic Prefix Integration!
   if ($position != 'topic')
   		$title = $subject;
   else if (isset($context['original_subject']) && !empty($context['original_subject']))
   		$title = $context['original_subject'];
   else
   		$title = $context['subject'];

	$title = urlencode($title);

   	// Compatibility with Pretty Urls mod!
	if ((file_exists($sourcedir . '/PrettyUrls.php') && !empty($modSettings['pretty_enable_filters'])) || isset($_REQUEST['seomod']))
   		$url = urlencode($url);
   
   $sites = '';
   $context['bookmarks'] = array(
      'facebook' 	=> 'https://www.facebook.com/share.php?u=' . $url . '&amp;t=' . $title,
      'linkedin' 	=> 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . $url . '&amp;title=' . $title . '&amp;summary=&amp;source=',
      'pinterest'	=> 'https://pinterest.com/pin/create/bookmarklet/?url=' . $url . '&description=' . $title,
      'reddit' 		=> 'http://reddit.com/submit?url=' . $url . '&amp;title=' . $title,
      'telegram'	=> 'https://telegram.me/share/url?url=' . $url . '&text=' . $title,
      'tumblr'		=> 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $url . '%2F&title=' . $title,
      'twitter' 	=> 'https://x.com/intent/post?text=' . $title . '&url=' .$url,
      'whatsapp' 	=> 'https://api.whatsapp.com/send?text=' . $title . '%20' . $url,
   );
   
   $i = 0;
   foreach ($context['bookmarks'] AS $site => $url)
   {
      	if (empty($modSettings['social_' . $position . '_' . $site]))
      		unset($site);
      	else
      	{
        	$sites .= '<a href="' . $url . '" title="'.$txt['seo_share_via'].' '.$site.'" rel="nofollow" style="padding: 3px;" target="_blank"><img src="'.$settings['default_images_url'].'/seo/'.$site.'.png" title="'.$txt['seo_share_via'].' '.$site.'" alt="'.$txt['seo_share_via'].' '.$site.'" /></a> '; 
        
        	$i++;
		}
	}
   
   $something = false;
   if ($sites != "" || ($position == 'topic' && !empty($modSettings['social_facebook'])))
   {
   		if ($position == 'topic') {
			echo'
				<br class="clear" />
				<div class="cat_bar">
					<h3 class="catbg">
						 <a href="#" onclick="shrinkHeaderSEO(); return false;">';

				if (!seo_is_smf_21())
					echo '
					<img id="upshrink_seo" src="', $settings['images_url'], '/', empty($options['collapse_header_seo']) ? 'collapse.gif' : 'expand.gif', '" alt="*" title="', $txt['upshrink_description'], '" />';
				else
					echo '
					<span class="toggle_', (empty($options['collapse_header_seo_related']) ? 'down' : 'up'),'" id="upshrink_seo" style="cursor: pointer;"></span>';

				echo
						 	$txt['seo_share_topic'], '
						 </a>
					</h3>
				</div>
				<div class="windowbg" id="upshrinkHeaderSEO"', empty($options['collapse_header_seo']) ? '' : ' style="display: none;"', '>
					<span class="topslice"><span></span></span>
						<div class="content">';
   		}
			
		if ($position == 'topic' && $sites != "")	
		    echo'<div style="margin-bottom: 10px;">' . $sites . '</div>';
		else if ($sites != "")
			return '<a href="#" onclick="share_post_seo(' . $msg . '); return false;" id="share_string_' . $msg . '" title="' . $txt['seo_share_post'] . '" rel="nofollow"><img src="' . $settings['default_images_url'] . '/seo/share.png" title="' . $txt['seo_share_post'] . '" alt="' . $txt['seo_share_post'] . '" /></a><div style="overflow: auto; display: none; position: absolute; z-index: 100; background-color: white; width: auto; text-align: center; padding: 5px; border: 1px solid black;" id="share_seo_' . $msg . '">' . $sites . '</div>';
		
		if ($position == 'topic')
		{ 
		    if (!empty($modSettings['social_facebook']))
			   echo '<iframe src="https://www.facebook.com/plugins/like.php?href='.$scripturl.'?topic='.$context['current_topic'].'.0;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=28" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; max-width: 100%; height:28px; margin: -2px 0 0 0;" allowTransparency="true"></iframe>';
			   
			echo'</div>
			<span class="botslice"><span></span></span>
			</div>';
	    }
	    $something = true;
   }
   
   if ($position !== 'topic')
   		return;
   
   if (empty($modSettings['seo_related_topics']) && $something === false)
   		return;
   		
   	$context['insert_after_template'] .= '
			<script type="text/javascript"><!-- // --><![CDATA[
				var current_header_seo = ' . (empty($options['collapse_header_seo']) ? 'false' : 'true') . ';
				var current_header_seo_related = ' . (empty($options['collapse_header_seo_related']) ? 'false' : 'true') . ';
				
				function share_post_seo(id_msg)
				{
					seo_share_box = document.getElementById(\'share_seo_\' + id_msg);
					
					if (seo_share_box.style.display == "none")
						seo_share_box.style.display = "";
					else
						seo_share_box.style.display = "none";
				}
				
				function getposOffset(what, offsettype)
				{
					var totaloffset = (offsettype=="left") ? what.offsetLeft : what.offsetTop;
					var parentEl = what.offsetParent;
				
					while (parentEl!=null)
					{
						totaloffset = (offsettype == "left") ? totaloffset + parentEl.offsetLeft : totaloffset + parentEl.offsetTop;
						parentEl = parentEl.offsetParent;
					}
				
					return totaloffset;
				}
				
				function shrinkHeaderSEO()
				{';
		
		if ($context['user']['is_guest'])
			$context['insert_after_template'] .= '
					document.cookie = "upshrinkSEO=" + (!current_header_seo ? 1 : 0);';
		else
			$context['insert_after_template'] .= '
					smf_setThemeOption("collapse_header_seo", !current_header_seo ? 1 : 0, null, "' . $context['session_id'] . '");';
	
		$context['insert_after_template'] .= '
					document.getElementById("upshrink_seo").src = smf_images_url + (!current_header_seo ? "/expand.gif" : "/collapse.gif");
					document.getElementById("upshrinkHeaderSEO").style.display = !current_header_seo ? "none" : "";
					
					current_header_seo = !current_header_seo;
				}
				
				function shrinkHeaderSEORelated()
				{';
		
		if ($context['user']['is_guest'])
			$context['insert_after_template'] .= '
					document.cookie = "upshrinkSEORelated=" + (!current_header_seo_related ? 1 : 0);';
		else
			$context['insert_after_template'] .= '
					smf_setThemeOption("collapse_header_seo_related", !current_header_seo_related ? 1 : 0, null, "' . $context['session_id'] . '");';
	
		$context['insert_after_template'] .= '
					document.getElementById("upshrink_seo_related").src = smf_images_url + (!current_header_seo_related ? "/expand.gif" : "/collapse.gif");
					document.getElementById("upshrinkHeaderSEORelated").style.display = !current_header_seo_related ? "none" : "";
					
					current_header_seo_related = !current_header_seo_related;
				}
			// ]]></script>';
}

function seo_previous_next()
{
	global $smcFunc, $modSettings, $board_info, $scripturl, $txt, $topic, $board, $user_info;
	
	if (!$modSettings['enablePreviousNext'])
		return;
	
	if ($board_info['num_topics'] == 1 || empty($modSettings['seo_replace_next_prev']))
		return '<a href="' . $scripturl . '?topic=' . $topic . '.0;prev_next=prev#new">' . $txt['previous_next_back'] . '</a> <a href="' . $scripturl . '?topic=' . $topic . '.0;prev_next=next#new">' . $txt['previous_next_forward'] . '</a>';
		
	// First super query
	$query = 'SELECT m.subject, m.id_topic
		FROM {db_prefix}topics AS t
			INNER JOIN {db_prefix}topics AS t2 ON (' . (empty($modSettings['enableStickyTopics']) ? '
			t2.id_last_msg {raw:way} t.id_last_msg' : '
			(t2.id_last_msg {raw:way} t.id_last_msg AND t2.is_sticky {raw:way}= t.is_sticky) OR t2.is_sticky {raw:way} t.is_sticky') . ')
			LEFT JOIN {db_prefix}messages AS m ON (t2.id_first_msg = m.id_msg)
		WHERE t.id_topic = {int:current_topic}
			AND t2.id_board = {int:current_board}' . (!$modSettings['postmod_active'] || allowedTo('approve_posts') ? '' : '
			AND (t2.approved = {int:is_approved} OR (t2.id_member_started != {int:id_member_started} AND t2.id_member_started = {int:current_member}))') . '
		ORDER BY' . (empty($modSettings['enableStickyTopics']) ? '' : ' t2.is_sticky{raw:order},') . ' t2.id_last_msg{raw:order}
		LIMIT 1';
		
	// No luck? try with this!
	$query2 = 'SELECT m.subject, m.id_topic
			FROM {db_prefix}topics AS t
				LEFT JOIN {db_prefix}messages AS m ON (m.id_topic = t.id_first_msg)
			WHERE t.id_board = {int:current_board}' . (!$modSettings['postmod_active'] || allowedTo('approve_posts') ? '' : '
				AND (t.approved = {int:is_approved} OR (t.id_member_started != {int:id_member_started} AND t.id_member_started = {int:current_member}))') . '
			ORDER BY' . (empty($modSettings['enableStickyTopics']) ? '' : ' t.is_sticky{raw:order},') . ' t.id_last_msg{raw:order}
			LIMIT 1';
		
	// Seek first title!
	$request = $smcFunc['db_query']('', $query,
		array(
			'current_board' => $board,
			'current_member' => $user_info['id'],
			'current_topic' => $topic,
			'is_approved' => 1,
			'id_member_started' => 0,
			'way' => '>',
			'order' => '',
		)
	);

	// Nothing? try simple!
	if ($smcFunc['db_num_rows']($request) == 0)
	{
		$smcFunc['db_free_result']($request);

		$request = $smcFunc['db_query']('', $query2,
			array(
				'current_board' => $board,
				'current_member' => $user_info['id'],
				'is_approved' => 1,
				'id_member_started' => 0,
				'order' => '',
			)
		);
	}

	// Finally!
	list ($prev_subject, $prev_id) = $smcFunc['db_fetch_row']($request);
	$smcFunc['db_free_result']($request);
			
	// First query for next topic
	$request = $smcFunc['db_query']('', $query,
		array(
			'current_board' => $board,
			'current_member' => $user_info['id'],
			'current_topic' => $topic,
			'is_approved' => 1,
			'id_member_started' => 0,
			'way' => '<',
			'order' => ' DESC',
		)
	);

	// If no luck, try with this!
	if ($smcFunc['db_num_rows']($request) == 0)
	{
		$smcFunc['db_free_result']($request);

		$request = $smcFunc['db_query']('', $query2,
			array(
				'current_board' => $board,
				'current_member' => $user_info['id'],
				'is_approved' => 1,
				'id_member_started' => 0,
				'order' => ' DESC',
			)
		);
	}

	// Gotcha!
	list ($next_subject, $next_id) = $smcFunc['db_fetch_row']($request);
	$smcFunc['db_free_result']($request);
	
	$final_text = '';
	$first = false;
	
	if (isset($prev_subject) && !empty($prev_subject) && trim($prev_subject) != '')
	{
		$first = true;
		$final_text .= '<a href="' . $scripturl . '?topic=' . $prev_id . '.new#new">&laquo; ' . $prev_subject . '</a>';
	}
		
	if (isset($next_subject) && !empty($next_subject) && trim($next_subject) != '')
	{
		if ($first)
			$final_text .= ' | ';
			
		$final_text .= '<a href="' . $scripturl . '?topic=' . $next_id . '.new#new">' . $next_subject . ' &raquo;</a>';
	}
	
	return $final_text;
}

function seo_view_tag_in_cloud()
{
	global $smcFunc, $modSettings, $context, $txt, $tag, $scripturl;
	
	loadTemplate('Seo');
	loadLanguage('Seo');
	
	// Not a tag?
	if (!isset($_GET['tag']) || empty($_GET['tag']) || $_GET['tag'] == '')
		fatal_lang_error('seo_tag_cloud_failed', false);
	
	$tag = urldecode($_GET['tag']);
	
	if (($context['results'] = cache_get_data('seo_view_tag_' . $tag, 3600)) == null)
	{
		// Security makes thing hard!
		$context['results'] = array();
		$query = $smcFunc['db_query']('', '
			SELECT hits
			FROM {db_prefix}seo_tags AS ta
			WHERE tag = {string:the_tag}
				AND id_topic = 0
				AND id_board = 0',
			array(
				'the_tag' => urldecode($_GET['tag']),
			)
		);
		while($row = $smcFunc['db_fetch_assoc']($query))
		{
			$context['results'][] = array(
				'hits' => $row['hits'],
				'area' => '<a href="' . $scripturl . '"><i>' . $txt['seo_index'] . '</i></a>',
			);
		}
		$smcFunc['db_free_result']($query);
		
		$query = $smcFunc['db_query']('', '
			SELECT ta.id_topic, ta.hits, m.subject
			FROM {db_prefix}seo_tags AS ta
				LEFT JOIN {db_prefix}topics AS t ON (ta.id_topic = t.id_topic)
				LEFT JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_first_msg)
				LEFT JOIN {db_prefix}boards AS b ON (t.id_board = b.id_board)
			WHERE ta.tag = {string:the_tag}
				AND ta.id_topic != 0
				AND ta.id_board = 0
				AND {query_see_board}',
			array(
				'the_tag' => urldecode($_GET['tag']),
			)
		);
		while($row = $smcFunc['db_fetch_assoc']($query))
		{
			$context['results'][] = array(
				'hits' => $row['hits'],
				'area' => '<i>' . $txt['topic'] . '</i>: <a href="' . $scripturl . '?topic=' . $row['id_topic'] . '.0">' . $row['subject'] . '</a>',
			);
		}
		$smcFunc['db_free_result']($query);
		
		$query = $smcFunc['db_query']('', '
			SELECT ta.id_board, ta.hits, b.name
			FROM {db_prefix}seo_tags AS ta
				LEFT JOIN {db_prefix}boards AS b ON (ta.id_board = b.id_board)
			WHERE ta.tag = {string:the_tag}
				AND ta.id_board != 0
				AND ta.id_topic = 0
				AND {query_see_board}',
			array(
				'the_tag' => urldecode($_GET['tag']),
			)
		);
		while($row = $smcFunc['db_fetch_assoc']($query))
		{
			$context['results'][] = array(
				'hits' => $row['hits'],
				'area' => '<i>' . $txt['board'] . '</i>: <a href="' . $scripturl . '?board=' . $row['id_board'] . '.0">' . $row['name'] . '</a>',
			);
		}
		$smcFunc['db_free_result']($query);
		
		cache_put_data('seo_view_tag_' . $tag, $context['results'], 3600);
	}
	
	// Some basic details!
	$context['page_title'] = sprintf($txt['seo_cloud_tag_title'], $tag);
	$context['sub_template'] = 'seo_view_tag';
}