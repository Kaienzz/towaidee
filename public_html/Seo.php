<?php
/**********************************************************************************
* Seo.php																   		  *	
***********************************************************************************
*																				  *
* SMFPacks SEO v2.4.11													 	  	  *
* Copyright (c) 2011-2025 by SMFPacks.com. All rights reserved.					  *
* Powered by www.smfpacks.com													  *
* Created by NIBOGO for SMFPacks.com											  *
*																				  *
***********************************************************************************
* You can't redistribute this program, this is a PAID Mod and only can be		  *
* downloaded from the SMFPacks site (http://www.smfpacks.com if you downloaded	  *
* this package from another website please report it to the SMFPacks Team.		  *
**********************************************************************************/
	
	// Handle redirect
	if (isset($_GET['seored']) && file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	{
		require_once(dirname(__FILE__) . '/SSI.php');
		seo_redirect();
	}
	// Not defined?
	elseif (!defined('SMF'))
		die('Hacking attempt...');
	// Load our language strings
	else if (loadLanguage('Seo') === false)
		loadLanguage('Seo', 'english');

/*
* This function takes care of parsing given URL and finding out what to show with it!
*/
function seo_parse_url()
{
	global $modSettings, $smcFunc, $scripturl, $boardurl, $boarddir, $sourcedir, $context;
	
	// Compatibility with Pretty Urls mod!
	if (file_exists($sourcedir . '/PrettyUrls.php') && !empty($modSettings['pretty_enable_filters']))
		return;
		
	// Just in case!
	$scripturl = $boardurl . '/index.php';
	
	// Thanks SMF for this piece of code!
	if (empty($_SERVER['REQUEST_URI']))
        $_SERVER['REQUEST_URL'] = $scripturl . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
    elseif (preg_match('~^([^/]+//[^/]+)~', $scripturl, $match) == 1)
        $_SERVER['REQUEST_URL'] = $match[1] . $_SERVER['REQUEST_URI'];
    else
        $_SERVER['REQUEST_URL'] = $_SERVER['REQUEST_URI'];

    // Disable default (poor) redirection
    if (!empty($modSettings['queryless_urls']))
        updateSettings(array('queryless_urls' => '0'));
	
	// The url path
	$path = array();
	
	// What about cleaning?
	#cleanRequest();
	
	// Process it!
	if (isset($_SERVER['REQUEST_URI']))
	{
		$request_path = explode('?', $_SERVER['REQUEST_URI']);
	
	    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
	    $path['call_utf8'] = $smcFunc['substr'](urldecode($_SERVER['REQUEST_URI']), $smcFunc['strlen']($path['base']) + 1);
	    $path['call'] = utf8_decode($path['call_utf8']);
	    $path['call_parts'] = explode('/', $path['call']);
	    
	    // Clean it!
	    for ($i = 0; $i < count($path['call_parts']); $i++)
	    {
		    if (empty($path['call_parts'][$i]))
		    	unset($path['call_parts'][$i]);
	    }
    }
    
    // No luck?
    if (empty($path))
    	return;
    
    // Old urls? And no redirection?
    if (empty($modSettings['seo_redirect_old']) && count($request_path) > 1)
    {
    	if (empty($path['base']))
    		$requested_file = $boarddir . $request_path[0];
    	else
    		$requested_file = str_replace($path['base'], $request_path[0], $boarddir);
    	
    	// Set the proper header if we have too!
    	if (file_exists($requested_file))
    		return;
    }
    	
    // Redirect them!
    $inside = false;
    if (!empty($modSettings['seo_redirect_old']) && count($request_path) > 1)
    {
    	$inside = true;
    	
    	// So it's an attachment?
		if (!empty($modSettings['enable_pretty_attachments']) && preg_match('~action=dlattach;topic=([^#";.]+).*;attach=([^#";.]+).*?~i', $request_path[1], $matches))
		{
			// Get the attachment information
			$request = $smcFunc['db_query']('', '
			SELECT filename, id_attach
			FROM {db_prefix}attachments
			WHERE id_attach = {int:attachment}
			LIMIT 1',
				array
				(
					'attachment' => $matches[2]
				)
			);
			
			// No luck?
			if ($smcFunc['db_num_rows']($request) == 0)
				die(show_error($matches[1], 0, 0, $matches[2]));
				
			list($filename, $id_attach) = $smcFunc['db_fetch_row']($request);
			$smcFunc['db_free_result']($request);
			
			// Redirect
			$new_url = $boardurl . '/' . $matches[1] . '.0/a' . $matches[2] . '/' . $filename;
			
			// Permanent redirect
			move_permanently($new_url);
		}
		// So it's an action? This is temporaly disabled while Ajax functions are included
		else if (!empty($modSettings['enable_pretty_actions']) && preg_match("~action=(.*)~i", $request_path[1], $matches))
		{
			/*
			// Explode it!
			$actions_path = explode(';', $matches[1]);

			// Verify
			if (!in_array($actions_path[0], array('jseditor', 'post2', 'post', 'xml')))
			{
				// Redirect
				$new_url = $boardurl . '/' . $actions_path[0];
				
				// Subactions
				if (count($actions_path) > 1)
				{
					$new_url .= '/';
					
					for ($i = 1; $i < count($actions_path); $i++)
					{
						$new_url .= $actions_path[$i];
						
						if (($i + 1) != count($actions_path))
						{
							$new_url .= ';';
						}
					}
				}
				
				// Permanent redirect
				move_permanently($new_url);
			}*/
		}
    	// So we have a topic!
    	elseif (!empty($modSettings['enable_pretty_topics']) && (!isset($_GET['action']) || (!empty($modSettings['enable_pretty_actions']) && isset($path['call_parts'][0]) && in_array($path['call_parts'][0], unserialize($modSettings['seo_actions'])))) && preg_match("~topic=([0-9]+)(.*)~i", $request_path[1], $matches))
    	{
    		// Which one is our topic!
    		$topic = (int) $matches[1];
    		
    		// Let's get the info of this topic
			$request = $smcFunc['db_query']('', '
				SELECT m.id_topic, b.id_board, m.subject, b.name 
				FROM {db_prefix}messages AS m
					LEFT JOIN {db_prefix}boards AS b ON (m.id_board = b.id_board)
				WHERE m.id_topic = {int:topic}
				LIMIT 1',
				array(
				   'topic' => $topic
				)
			);
			
			// Kill it!
			if ($smcFunc['db_num_rows']($request) == 0)
				die(show_error($topic));
			
			$row = $smcFunc['db_fetch_assoc']($request);
			$smcFunc['db_free_result']($request);
			
			// Get the format!
			if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
				$new_url = $boardurl . '/' . format_url($row['name']) .'/' . $row['id_board'];
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')	
				$new_url = $boardurl . '/b' . $row['id_board'];
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
				$new_url = $boardurl . '/b' . $row['id_board'] . '_' . format_url($row['name']);
			else
				$new_url = $boardurl . '/board' . $row['id_board'];
			
			// And the one from the topic
			if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'subject/id')
				$new_url .= '/' . format_url($row['subject']) . '/' . $row['id_topic'];
			else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'tid')
				$new_url .= '/t' . $row['id_topic'];
			else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'topicid')
				$new_url .= '/topic' . $row['id_topic'];
			else
				$new_url .= '/t' . $row['id_topic'] . '_' . format_url($row['subject']);
				
			// Let's take care of the rest!
			if (!empty($matches[2]))
			{
				$add = $smcFunc['substr']($matches[2], 1);
				
				if ($add != '0')
					$new_url .= '/' . $add;
			}
		
			// Permanent redirect
			move_permanently($new_url);
		}
		// Yes, a board from the old format
		else if (!empty($modSettings['enable_pretty_boards']) && (!isset($_GET['action']) || (!empty($modSettings['enable_pretty_actions']) && isset($path['call_parts'][0]) && in_array($path['call_parts'][0], unserialize($modSettings['seo_actions'])))) && preg_match("~board=([0-9]+)(.*)~i", $request_path[1], $matches))
		{
			// The board
			$board = (int) $matches[1];
			
			// Grab Board Info
			$request = $smcFunc['db_query']('', '
				SELECT name, id_board
				FROM {db_prefix}boards
				WHERE id_board = {int:board}
				LIMIT 1',
				array(
					  'board' => $board
				)
			);
			
			if ($smcFunc['db_num_rows']($request) == 0)
				 die(show_error(0, $board));
				 
			$row = $smcFunc['db_fetch_assoc']($request);
			$smcFunc['db_free_result']($request);
			
			if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
				$new_url = $boardurl . '/' . format_url($row['name']) .'/' . $row['id_board'];
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')	
				$new_url = $boardurl . '/b' . $row['id_board'];
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
				$new_url = $boardurl . '/b' . $row['id_board'] . '_' . format_url($row['name']);
			else
				$new_url = $boardurl . '/board' . $row['id_board'];
				
			// Let's take care of the rest!
			if (!empty($matches[2]))
			{
				$add = $smcFunc['substr']($matches[2], 1);
				
				if ($add != '0')
					$new_url .= '/' . $add;
			}
			
			// Permanent redirect	
			move_permanently($new_url);
		}
		// So it's a profile?
		else if (!empty($modSettings['enable_pretty_profiles']) && preg_match("~action=profile;u=([0-9]+)(.*)~i", $request_path[1], $matches))
		{
			// The profile
			$profile = (int) $matches[1];
			
			// Grab Board Info
			$request = $smcFunc['db_query']('', '
				SELECT id_member, real_name
				FROM {db_prefix}members
				WHERE id_member = {int:profile}
				LIMIT 1',
				array(
					  'profile' => $profile
				)
			);
			
			if ($smcFunc['db_num_rows']($request) == 0)
				 die(show_error(0, 0, $profile));
				 
			list($id, $name) = $smcFunc['db_fetch_row']($request);
			$smcFunc['db_free_result']($request);
			
			// Lower it!
			$name = strtolower($name);
			
			if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'mlist')
				$new_url = $boardurl . '/mlist/' . $name . '_' . $id;
			else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'user/id')
				$new_url = $boardurl . '/' . $name . '/p' . $id;
			else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'pid')
				$new_url = $boardurl . '/p' . $id;
			else
				$new_url = $boardurl . '/' . $name . '_p' . $id;
				
			// Let's take care of the rest!
			if (!empty($matches[2]))
				$new_url .= '/' . $matches[2];
				
			// Permanent redirect
			move_permanently($new_url);
		}
    }
			    
    // Tried but no luck?
    if ($inside || !isset($path['call_parts'][0]))
    	return;
    
    // What to do, what to do!
    $what_to_do = $path['call_parts'][0];
    
    // So Tapatalk?
    if (!empty($what_to_do) && $what_to_do == 'mobiquo.php')
    	return;
    
    // Check some default options
    if (isset($_GET['action']))
    {
    	$dismiss_error = true;
	    $url = explode(';', $_GET['action']);
	    $_GET['action'] = $url[0];
	    
	    for ($i = 1; $i < count($url); $i++)
	    {
	    	$part = $url[$i];
	    	
	    	if (strpos($part, '='))
		    	$parts = explode('=', $part);
	    	
	    	if (isset($parts))
	    	{
		    	$_GET[$parts[0]] = $parts[1];
		    }
		    else
		    	$_GET[$part] = true;
	    }
    }
   
    // First check if we have a profile?
    if (!empty($modSettings['enable_pretty_profiles']))
	{
		if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'mlist' && preg_match("~mlist/([-a-zA-Z0-9]*)_([0-9]+)~i", $path['call_utf8'], $matches))
		{
			$_GET['action'] = 'profile';
			$_GET['u'] = $matches[2];
			$parameters = 1;
		}
		else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'user/id' && preg_match("~([-a-zA-Z0-9]*)/p([0-9]+)~i", $path['call_utf8'], $matches))
		{
			$_GET['action'] = 'profile';
			$_GET['u'] = $matches[2];
			$parameters = 1;
		}
		else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'pid' && preg_match("~p([0-9]+)~i", $path['call_utf8'], $matches))
		{
			$_GET['action'] = 'profile';
			$_GET['u'] = $matches[1];
			$parameters = 0;
		}
		else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'name_pid' && preg_match("~([-a-zA-Z0-9]*)_p([0-9]+)~i", $path['call_utf8'], $matches))
		{
			$_GET['action'] = 'profile';
			$_GET['u'] = $matches[2];
			$parameters = 0;
		}
	}
	
	// Now let's try attachments!
	elseif (!empty($modSettings['enable_pretty_attachments']) && !isset($_GET['action']) && preg_match("~([0-9]+).([0-9]+)/a([0-9]+)/([-a-zA-Z0-9]+)~i", $path['call_utf8'], $matches))
	{
		$_GET['action'] = 'dlattach';
		$_GET['topic'] = $matches[1];
		$_GET['start'] = $matches[2];
		$_GET['attach'] = $matches[3];
		$parameters = false;
	}

	// Actions are lovely!
	if (!empty($modSettings['enable_pretty_actions']) && !isset($_GET['action']) && in_array($what_to_do, unserialize($modSettings['seo_actions'])))
    {
	    // Set the proper values!
	    $_GET['action'] = $path['call_parts'][0];
	    $parameters = 1;
    }
    
    // Topics or boards?
    if (!isset($_GET['action']) && (!empty($modSettings['enable_pretty_topics']) || !empty($modSettings['enable_pretty_boards'])))
    {
    	// Total of lines expected!
    	$totals = 1;
    	
    	// By default we cannot proove anything!
    	$is_topic = $is_board = false;
    
    	// Format!
    	$format = '^';
	    
	    // {name}/{id}
	    if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
		{	
			$format .= '([-a-zA-Z0-9]*)/([0-9]*)';
			$totals = 2;
		}
		// b{id}
		else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')
		{
			$format .= 'b([0-9]*)';
			$totals = 1;
		}
		// b{id}_{name}
		else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
		{
			$format .= 'b([0-9]*)_([-a-zA-Z0-9]*)';
			$totals = 1;
		}
		// board{id}
		else
		{
			$format .= 'board([0-9]*)';
			$totals = 1;
		}
	    
	    // {subject}/{id}
		if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'subject/id')
		{
			$topic_format = '([-a-zA-Z0-9]*)/([0-9]*)';
			$totals += 2;
		}
		// t{id}
		else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'tid')
		{
			$topic_format = 't([0-9]*)';
			$totals += 1;
		}
		// topic{id}
		else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'topicid')
		{
			$topic_format = 'topic([0-9]*)';
			$totals += 1;
		}
		// t{id}_{subject}
		else
		{
			$topic_format = 't([0-9]*)_([-a-zA-Z0-9]*)';
			$totals += 1;
		}
	    
	    // Do we have a topic?
	    if (!empty($modSettings['enable_pretty_topics']) && preg_match("~" . $format . "/" . $topic_format . "~i", $path['call_utf8'], $matches))
	    	$is_topic = true;
	    // mmm, maybe a board?
	    else if (!empty($modSettings['enable_pretty_boards']) && preg_match("~" . $format . "~i", $path['call_utf8'], $matches))
	    	$is_board = true;
	    	
	    // Topics are the worst thing possible!
	    if ($is_topic)
	    {
	    	$topic_id = 0;
	    	
	    	// We need to see how much we must skip from the board url structure!
	    	$skip = 1;
			if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
				$skip = 2;
				
			// Skip the board name and id
			$what_to_do = $path['call_parts'][$skip];
			
			// {subject}/{id}
	    	if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'subject/id')
			{
				++$skip;
				
				if (isset($path['call_parts'][$skip]) && is_numeric($path['call_parts'][$skip]))
				{
					$topic_id = (int) $path['call_parts'][$skip];
					$pagination = $skip + 1;
				}
			}
			// t{id}
			else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'tid')
			{
				if (strlen($what_to_do) > 1)
				{
					$bid = $smcFunc['substr']($what_to_do, 1);
					
					if (is_numeric($bid))
						$topic_id = (int) $bid;
						
					$pagination = $skip + 1;
				}
			}
			// t{id}_{subject}
			else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'tid_subject')
			{
				if (isset($matches[2]) && is_numeric($matches[2]))
				{
					$topic_id = $matches[2];
					$pagination = $skip + 1;
				}
			}
			// topic{id}
			else if (strlen($what_to_do) > 5 && $smcFunc['substr']($what_to_do, 0, 5) == 'topic')
			{
				$topic_id = (int) $smcFunc['substr']($what_to_do, 5);
				$pagination = $skip + 1;
			}
				
			// So what?
			if (!empty($topic_id))
			{
				// Set the board!
				$_GET['topic'] = $topic_id;
				
				// Pagination?
				$have_pages = false;
				if (isset($path['call_parts'][$pagination]) && is_numeric($path['call_parts'][$pagination]))
				{
					$have_pages = true;
					$_GET['start'] = $path['call_parts'][$pagination];
				}
				// If it's not a number, we need to figure it out!
				else if (isset($path['call_parts'][$pagination]))
				{
					$check_page = $path['call_parts'][$pagination];
					
					// Maybe it's a little bit more complex
					if (strpos($path['call_parts'][$pagination], ';') !== false)
						$check_page = explode(';', $path['call_parts'][$pagination])[0];
					
					if ($check_page == 'new' || $smcFunc['substr']($check_page, 0, 3) == 'msg')
					{
						$have_pages = true;
						$_GET['start'] = $check_page;
					}
					
					// tidy up
					unset($check_page);
				}
				
				// Parameters!
				$parameters = (!$have_pages) ? $pagination : $pagination + 1;
			}
	    }
	    // Boards are awful too!
	    else if ($is_board)
	    {
	    	$board_id = 0;
	    	
	    	// Get the ID!
	    	if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
			{
				if (isset($path['call_parts'][1]) && is_numeric($path['call_parts'][1]))
				{
					$board_id = (int) $path['call_parts'][1];
					$pagination = 2;
				}
			}
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')
			{
				if (strlen($what_to_do) > 1)
				{
					$bid = $smcFunc['substr']($what_to_do, 1);
					
					if (is_numeric($bid))
						$board_id = (int) $bid;
						
					$pagination = 1;
				}
			}
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
			{
				$temp = explode('_', $what_to_do);
				
				if (isset($temp[1]))
				{
					if (strlen($temp[0]) > 1)
					{
						$bid = $smcFunc['substr']($temp[0], 1);
						
						if (is_numeric($bid))
							$board_id = (int) $bid;
					}
					
					$pagination = 1;
				}
			}
			else if (strlen($what_to_do) > 5 && $smcFunc['substr']($what_to_do, 0, 5) == 'board')
			{
				$board_id = (int) $smcFunc['substr']($what_to_do, 5);
				$pagination = 1;
			}
		    		
			// So what?
			if (!empty($board_id))
			{
				// Set the board!
				$_GET['board'] = $board_id;
				
				// Pagination?
				$have_pages = false;
				if (isset($path['call_parts'][$pagination]) && is_numeric($path['call_parts'][$pagination]))
				{
					$have_pages = true;
					$_GET['start'] = (int) $path['call_parts'][$pagination];
				}
				
				// Parameters!
				$parameters = (!$have_pages) ? $pagination : $pagination + 1;
			}
	    }
    }
    
    // WAIIIIIT!!!! POSSIBLE 404 ERROR!
    if (!isset($parameters) && !isset($dismiss_error) && $what_to_do != 'index.php' && $what_to_do != 'SeoSitemapStyle.php' && !in_array($what_to_do, unserialize($modSettings['seo_actions'])) && !empty($modSettings['seo_apache_errors']))
    {
    	$_GET['action'] = 'httperror';
	    $_GET['c'] = '404';
	    
	    // Send the header!
	    header('HTTP/1.0 404 Not Found');
    }
    
    // Do we've parameters?
    if (isset($parameters) && $parameters !== false)
	{
		// Sometimes they go in the last part
		foreach (array($parameters - 1, $parameters) as $parameter_check)
		{
			// Are there any?
			if (isset($path['call_parts'][$parameter_check]) && strpos($path['call_parts'][$parameter_check], ';') !== false)
			{
				$params = explode(';', $path['call_parts'][$parameter_check]);
				foreach ($params as $param)
				{
					$temp = explode('=', $param);
			
					if (!isset($temp[1]))
						$temp[1] = true;
				
					// Fixing invalid numeric request!
					if (!isset($_GET['start']) && is_numeric($temp[0]))
						$_GET['start'] = $temp[0];
					else if (!is_numeric($temp[0]))
						$_GET[$temp[0]] = $temp[1];
				}
			}
			else if (isset($path['call_parts'][$parameter_check]))
			{
				$temp = explode('=', $path['call_parts'][$parameter_check]);
			
				if (!isset($temp[1]))
					$temp[1] = true;
				
				if (!is_numeric($temp[0]))
					$_GET[$temp[0]] = $temp[1];
			}
		}
    }
    
    // We need to do this because of the separator!
    $_SERVER['QUERY_STRING'] = http_build_query($_GET, '', ';');
}

/*
* This function takes care of a lot of things:
*	- 301 Redirects
*	- Adds the Google Analytics code
*	- Adds the SEO Cloud of tags.
*	- Adds page numbers to page titles.
*	- Adds some default keywords and descriptions for certain pages.
*	- Adds noindex to help and view posts in profiles
*	- Changes next and preview links in topics.
*	- Adds some javascript for counter of meta tags.
*	- Adds open graph meta tags
*	- Verification tags for google, alexa, and bing.
*	- Some additional rel tags (first, last, up, author).
*/
function init_seo()
{
	global $modSettings, $context, $txt, $boardurl, $settings, $seo_disable_301, $topic, $sourcedir, $scripturl, $boarddir;

	// Wireless?
	if (defined('WIRELESS') && WIRELESS)
		$context['robot_no_index'] = true;
	
	// Let me check if we should do a 301 redirect!
	if (!isset($seo_disable_301) && !empty($modSettings['seo_301_from']) && !empty($modSettings['seo_301_to']))
	{
		$from = explode("\n", $modSettings['seo_301_from']);
		$to = explode("\n", $modSettings['seo_301_to']);

		// Are we on https?
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on')
			$pageURL = 'https://';
		else
			$pageURL = 'http://';
		
		// Handle localhost
		if ($_SERVER["SERVER_PORT"] != '80')
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		else
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		
		$original_search = !empty($modSettings['enable_pretty_urls']) ? $boardurl . '/' : $scripturl;
		$pageURL_shorten = str_replace($original_search, '', $pageURL);
		
		for ($i = 0; $i < count($from); $i++)
		{
			$from[$i] = '#' . trim($from[$i]) . '#';
			if (@preg_match($from[$i], $pageURL_shorten) == 1 || @preg_match($from[$i], $pageURL) == 1)
			{
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: " . preg_replace($from[$i], $to[$i], $pageURL));
			}
		}
	}
	
	// Some Async Google Analytics!
	if (!empty($modSettings['seo_g4a_code']))
	{
		$context['html_headers'] .= '
	    <!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=' . $modSettings['seo_g4a_code'] . '"></script>
		<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag(\'js\', new Date());
		gtag(\'config\', \'' . $modSettings['seo_g4a_code'] . '\');
		</script>';
	} else if (!empty($modSettings['seo_ga_code'])) {
		$context['html_headers'] .= '
	    <script type="text/javascript">
	    	var _gaq = _gaq || [];
	    	_gaq.push([\'_setAccount\', \''.$modSettings['seo_ga_code'].'\']);';
	    	
	    // Anonymize!
	    if (!empty($modSettings['seo_ga_anonymize']))
	    	$context['html_headers'] .= '
	    	_gaq.push([\'_gat._anonymizeIp\']);';
	    
	    // Set track page view!
	    $context['html_headers'] .= '
		    _gaq.push([\'_trackPageview\']);
		    (function() {
		     	var ga = document . createElement(\'script\');
		        ga.type = \'text/javascript\';
		        ga.async = true;
		        ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
		        var s = document.getElementsByTagName(\'script\')[0];
		        s . parentNode . insertBefore(ga, s);
		    })()';
	    
	    // Track outbound links?
	    if (!empty($modSettings['seo_ga_outbound']))
	    	$context['html_headers'] .= '
	    	function recordOutboundLink(link, category, action) {
		    	try {
			    	_gaq.push([\'_trackEvent\', category, action]);
			    	if (link.target == "_blank" || link.target == "_new") {
			        	window.open(link.href);
			        } else { 
			        	setTimeout(\'document.location = "\' + link.href + \'"\', 100)
			        }
		        }
		        catch(err)
		        {
		        }
		    }';
	    
	    
	    $context['html_headers'] .= '
	    </script>';
	}
	
	// Adding Crazyegg
	if (!empty($modSettings['seo_crazyegg_account']))
	{
		$account_path = str_pad($modSettings['seo_crazyegg_account'], 8, "0", STR_PAD_LEFT);
	    $account_path = substr($account_path,0,4).'/'.substr($account_path,4,8);
	    $account_path = "pages/scripts/".$account_path.".js";
	    
	    $script_host = "dnn506yrbagrg.cloudfront.net";
	
	    $context['insert_after_template'] .= '<script type="text/javascript">
	    setTimeout(function(){var a=document.createElement("script");
	    var b=document.getElementsByTagName(\'script\')[0];
	    a.src=document.location.protocol+"//'.$script_host.'/'.$account_path.'";
	    a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
	    </script>';
	}
	
	// Adding StatsCounter
	if (!empty($modSettings['seo_statcounter_project']) && !empty($modSettings['seo_statcounter_security']))
	$context['insert_after_template'] .= '
	<!-- Start of StatCounter Code for Default Guide -->
	<script type="text/javascript">
	var sc_project=' . $modSettings['seo_statcounter_project'] . '; 
	var sc_invisible=0; 
	var sc_security="' . $modSettings['seo_statcounter_security'] . '"; 
	var scJsHost = (("https:" == document.location.protocol) ?
	"https://secure." : "http://www.");
		document.write("<sc"+"ript type=\'text/javascript\' src=\'" +
	scJsHost+
	"statcounter.com/counter/counter.js\'></"+"script>");
	</script>
	<noscript><div class="statcounter"><a title="web statistics"
	href="http://statcounter.com/" target="_blank"><img
	class="statcounter"
	src="http://c.statcounter.com/' . $modSettings['seo_statcounter_project'] . '/0/' . $modSettings['seo_statcounter_security'] . '/0/"
	alt="web statistics"></a></div></noscript>
	<!-- End of StatCounter Code for Default Guide -->';
	
	// Adding OneStat.com
	if (!empty($modSettings['seo_onestat']))
	$context['insert_after_template'] .= '
	<!--ONESTAT SCRIPTCODE START-->
	<!--
	// Modification of this code is not allowed and will permanently disable your account!
	// Account ID : ' . $modSettings['seo_onestat'] . '
	// Website URL: http://www.ssss.com
	// Copyright (C) 2002-2007 OneStat.com All Rights Reserved
	-->
	<div id="OneStatTag"><table border=\'0\' cellpadding=\'0\' cellspacing=\'0\'><tr><td align=\'center\'>
	<script type="text/javascript">
	<!--
	function OneStat_Pageview()
	{
	    var d=document;
	    var sid="' . $modSettings['seo_onestat'] . '";
	    var CONTENTSECTION="";
	    var osp_URL=d.URL;
	    var osp_Title=d.title;
	    var t=new Date();
	    var p="http"+(d.URL.indexOf(\'https:\')==0?\'s\':\'\')+"://stat.onestat.com/stat.aspx?tagver=2&sid="+sid;
	    p+="&url="+escape(osp_URL);
	    p+="&ti="+escape(osp_Title);
	    p+="&section="+escape(CONTENTSECTION);
	    p+="&rf="+escape(parent==self?document.referrer:top.document.referrer);
	    p+="&tz="+escape(t.getTimezoneOffset());
	    p+="&ch="+escape(t.getHours());
	    p+="&js=1";
	    p+="&ul="+escape(navigator.appName=="Netscape"?navigator.language:navigator.userLanguage);
	    if(typeof(screen)=="object"){
	       p+="&sr="+screen.width+"x"+screen.height;p+="&cd="+screen.colorDepth;
	       p+="&jo="+(navigator.javaEnabled()?"Yes":"No");
	    }
	    d.write(\'<a href="http://www.onestatfree.com/aspx/login.aspx?sid=\'+sid+\'" target=_blank><img id="ONESTAT_TAG" border="0" src="\'+p+\'" alt="This site tracked by OneStatFree.com. Get your own free site counter."></\'+\'a>\');
	}
	
	OneStat_Pageview();
	//-->
	</script>
	<noscript>
	<a href="http://www.onestatfree.com"><img border="0" src="http://stat.onestat.com/stat.aspx?tagver=2&amp;sid=605340&amp;js=No&amp;" ALT="site uptime monitor"></a>
	</noscript>
	</td></tr><tr><td align=\'center\'><div style="COLOR:black;display:none;FONT-FAMILY:\'Verdana\';"><a href="http://www.onestat.com/uptrends/uptrends_website_server_monitoring.html" style="text-decoration:none;">site uptime monitor</a><br></div></td></tr></table></div>
	<!--ONESTAT SCRIPTCODE END-->';

		
	// Change some meta tags in board index
	if (isset($settings['display_recent_bar']) && !isset($context['seo_description']))
	{
		$context['seo_keywords'] = isset($modSettings['seo_site_description']) ? seo_meta_keywords($modSettings['seo_site_description'], true) : seo_meta_keywords($context['page_title'], true);
		$context['seo_description'] = seo_meta_description($context['forum_name'], false, true);
	}
	
	// Now modify boards meta tags
	if (isset($_REQUEST['board']) && isset($context['name']) && isset($context['description']) && !isset($context['seo_description']))
	{
		$context['seo_keywords'] = seo_meta_keywords($context['name']).','.seo_meta_keywords($context['description']);
		$context['seo_description'] = seo_meta_description($context['name'] . ' - ' . $context['description'], false, false, true);
	}
	
	// Meta description for profiles
	if (!empty($modSettings['seo_meta_desc_profile']) && !isset($context['seo_description']) && isset($context['member']['name']) && isset($context['member']['group']) && (!isset($_GET['area']) || $_GET['area'] == 'summary'))
	{
		$context['seo_description'] = seo_meta_description(str_replace(array('{MEMBER_NAME}', '{MEMBER_GROUP}', '{FORUM_NAME}'), array($context['member']['name'], $context['member']['group'], $context['forum_name']), $modSettings['seo_meta_desc_profile']));
	}
	
	// Help shouldn't be indexed
	if (isset($_GET['action']) && $_GET['action'] == 'help')
		$context['robot_no_index'] = true;
		
	// Nor view posts in profile!
	if (isset($_GET['action']) && $_GET['action'] == 'profile' && isset($_GET['area']) && $_GET['area'] == 'showposts')
		$context['robot_no_index'] = true;
		
	// Meta Tags!
	foreach (array('copyright', 'author', 'language', 'publisher', 'audience') as $metatag)
	{
		if (!empty($modSettings['seo_meta_tag_' . $metatag . '_text']))
			$context['html_headers'] .= "\n\t" . '<meta name="' . $metatag . '" content="'. $modSettings['seo_meta_tag_' . $metatag . '_text'] .'" />';
	}
	
	foreach (array('noydir', 'noodp', 'noarchive', 'nosnippet') as $metatag)
	{
		if (!empty($modSettings['seo_meta_tag_noydir' . $metatag]))
			$context['html_headers'] .= "\n\t" . '<meta name="robots" content="'. $metatag .'" />';
	}
	
	// What about custom meta tags?
	if (!empty($modSettings['seo_custom_meta_name']) && !empty($modSettings['seo_custom_meta_content']))
	{
		// Load them!
		$meta_names = empty($modSettings['seo_custom_meta_name']) ? array() : explode("\n", $modSettings['seo_custom_meta_name']);
		$meta_content = empty($modSettings['seo_custom_meta_content']) ? array() : explode("\n", $modSettings['seo_custom_meta_content']);
		
		// Organize them!
		for ($i = 0, $n = count($meta_names); $i < $n; $i++)
		{
			if (empty($meta_names[$i]))
				continue;
	
			// Skip it, it's either spaces or stars only.
			if (trim(strtr($meta_names[$i], '*', ' ')) == '')
				continue;
				
			// What is our content?
			$content = isset($meta_content[$i]) ? htmlspecialchars($meta_content[$i]) : '';
			$meta_val = 'content';
			
			// Any?
			if (strlen($content) > 2 && substr($content, 0, 2) == 'p:')
			{
				$content = substr($content, 2);
				$meta_val = 'property';
			}
				
			// Add it!
			$context['html_headers'] .= "\n\t" . '<meta name="' . htmlspecialchars(trim($meta_names[$i])) . '" ' . $meta_val . '="' .  $content . '" />';
		}
		
		// Tidy up!
		unset($meta_val, $content, $meta_names, $meta_content);
	}
		
	// Some veritifation search engines
	if (!empty($modSettings['seo_meta_verification_google']))
		$context['html_headers'] .= "\n\t" . '<meta name="google-site-verification" content="' . $modSettings['seo_meta_verification_google'] . '" />';
		
	if (!empty($modSettings['seo_meta_verification_bing_name']) && !empty($modSettings['seo_meta_verification_bing_content']))
		$context['html_headers'] .= "\n\t" . '<meta name="' . $modSettings['seo_meta_verification_bing_name'] . '" content="' . $modSettings['seo_meta_verification_bing_content'] . '" />';
		
	if (!empty($modSettings['seo_meta_verification_alexa']))
		$context['html_headers'] .= "\n\t" . '<meta name="alexaVerifyID" content="' . $modSettings['seo_meta_verification_alexa'] . '" />';
		
	// Let's add some facebook open graph meta, start with the image url
	if (file_exists($settings['theme_dir'] . '/images/logo.png'))
		$og_image = $settings['theme_url'] . '/images/logo.png';
	else if (file_exists($settings['default_theme_dir'] . '/images/logo.png'))
		$og_image = $settings['default_theme_url'] . '/images/logo.png';
	else if (file_exists($settings['theme_dir'] . '/images/favicon.ico'))
		$og_image = $settings['theme_url'] . '/images/favicon.ico';
	else if (file_exists($boarddir . '/favicon.ico'))
		$og_image = $boardurl . '/favicon.ico';
	else if (file_exists($settings['default_theme_dir'] . '/images/favicon.ico'))
		$og_image = $settings['default_theme_url'] . '/images/favicon.ico';
		
	// First go with open graph
	$context['html_headers'] .= "\n\t" . '<meta charset="' . $context['character_set'] . '" />
	<meta property="og:title" content="' . $context['page_title_html_safe'] . '" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="' . $context['forum_name'] . '" />';
	
	// Maybe we have one from the posts?
	if (!empty($modSettings['seo_open_graph_images']) && isset($context['og_image']))
		$context['html_headers'] .= "\n\t" . '<meta property="og:image" content="' . $context['og_image'] . '" />';
	// Otherwise one of the above!
	else if (isset($og_image))
		$context['html_headers'] .= "\n\t" . '<meta property="og:image" content="' . $og_image . '" />';
		
	// Add the proper url!
	if (!empty($context['canonical_url']))
		$context['html_headers'] .= "\n\t" . '<meta property="og:url" content="' . $context['canonical_url'] . '" />';
	
	// Now let's go with Google+
	$context['html_headers'] .= "\n\t" . '<meta itemprop="name" content="' . $context['page_title_html_safe'] . '" />';
	
	// Finally Google+!
	if (!empty($modSettings['seo_google_plus_tags_images']) && isset($context['og_image']))
		$context['html_headers'] .= "\n\t" . '<meta itemprop="image" content="' . $context['og_image'] . '" />';
	// Otherwise one of the above!
	else if (isset($og_image))
		$context['html_headers'] .= "\n\t" . '<meta itemprop="image" content="' . $og_image . '" />';
		
	// Now handle Twitter!
	if (!empty($modSettings['seo_twitter_card']))
	{
		// Now the twitter card data!
		$context['html_headers'] .= "\n\t" . '<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@' . str_replace('@', '', $modSettings['seo_twitter_card']) . '">
	<meta name="twitter:title" content="' . $context['forum_name'] . '">';
		
		// Any image to add?
		if (!empty($modSettings['seo_twitter_card_images']) && isset($context['og_image']))
			$context['html_headers'] .= "\n\t" . '<meta name="twitter:image" content="' . $context['og_image'] . '" />';
		// Otherwise one of the above!
		else if (isset($og_image))
			$context['html_headers'] .= "\n\t" . '<meta name="twitter:image" content="' . $og_image . '" />';
	}
		
	// Get the author!
	if (!empty($context['topic_author']))
		$context['html_headers'] .= "\n\t" . '<link rel="author" href="' . $scripturl . '?action=profile;u=' . $context['topic_author'] . '" />';
		
	// What about first and last?
	foreach (array('first', 'last', 'up') as $rel)
	{
		if (!empty($context['links'][$rel]))
			$context['html_headers'] .= "\n\t" . '<link rel="' . $rel . '" href="' . $context['links'][$rel] . '" />';
	}
	
	// Page title with page number!
	if (!empty($context['page_info']['current_page']) && ((!empty($modSettings['seo_topics_board_pagination']) && isset($_REQUEST['board'])) || (!empty($modSettings['seo_topics_title_pagination']) && isset($_REQUEST['topic']))))
	{
		$context['page_title_html_safe'] .= ' - ' . $txt['seo_page'] . ' ' . $context['page_info']['current_page'] . ' ' . $txt['of'] . ' ' . $context['page_info']['num_pages'];
		
		if (!empty($context['seo_description']))
			$context['seo_description'] = $txt['seo_page'] . ' ' . $context['page_info']['current_page'] . ' ' . $txt['of'] . ' ' . $context['page_info']['num_pages'] . ': ' . $context['seo_description'];
	}
		
	// Add SEO Tag Cloud Everywhere!!
	seo_tag_cloud();
	
	// Add counters for meta tags
	if (isset($_GET['action']) && in_array($_GET['action'], array('post', 'post2')) && !empty($context['is_first_post']) && !empty($modSettings['seo_custom_meta']) && allowedTo('post_custom_meta'))
		$context['insert_after_template'] .= '
	<script type="text/javascript">	
		function seo_count_it(el)
		{
			var element = document.getElementById(el);
			if (typeof element === \'undefined\')
				return;

			var longitud = document.getElementById(el).value.length;
			if (longitud < 150)
				document.getElementById(el + \'_counter\').style.color = \'inherit\';
			else
				document.getElementById(el + \'_counter\').style.color = \'red\';
			
			document.getElementById(el + \'_counter\').innerHTML = longitud;
		}

		seo_count_it(\'meta_keywords\');
		seo_count_it(\'meta_desc\');

		if (typeof document.getElementById(\'meta_keywords\') !== "undefined") {
			document.getElementById(\'meta_keywords\').setAttribute(\'onkeyup\', \'seo_count_it("meta_keywords");\');
		}

		if (typeof document.getElementById(\'meta_desc\') !== "undefined") {
			document.getElementById(\'meta_desc\').setAttribute(\'onkeyup\', \'seo_count_it("meta_desc");\');
		}
	</script>';
	
	// And now next and previous links
	if (!empty($topic))
	{
		require_once($sourcedir . '/Subs-Seo.php');
		$context['previous_next'] = seo_previous_next();
	}

	if (function_exists('loadCSSFile'))
		loadCSSFile('seo.css', array('minimize' => true, 'default_theme' => true));

	// Remove existing meta desc
	if (!empty($context['meta_tags']) && !empty($context['seo_description'])) {
		$new_meta_tags = array();

		foreach ($context['meta_tags'] as $meta_tag) {
			$has_meta_desc = isset($meta_tag['name']) && $meta_tag['name'] === 'description';
			$has_meta_property = isset($meta_tag['property']) && $meta_tag['property'] === 'og:description';

			if (!$has_meta_desc && !$has_meta_property) {
				$new_meta_tags[] = $meta_tag;
			}
		}

		$context['meta_tags'] = $new_meta_tags;
	}
}
		
function seo_redirect()
{	
	global $boardurl, $smcFunc, $modSettings, $sourcedir;
	
	$topic = isset($_REQUEST['t']) ? (int) $_REQUEST['t'] : 0;
	$board = isset($_REQUEST['b']) ? (int) $_REQUEST['b'] : 0;
	$startbit = (isset($_REQUEST['s'])) ? $_REQUEST['s'] : 0;
	
	if (!empty($topic))
	{
		// Grab info from Database
		$request = $smcFunc['db_query']('', '
			SELECT m.id_topic, b.id_board, m.subject, b.name 
			FROM {db_prefix}messages AS m
				LEFT JOIN {db_prefix}boards AS b ON (m.id_board = b.id_board)
			WHERE m.id_topic = {int:topic}
			LIMIT 1',
			array(
			   'topic' => $topic
			)
		);
		
		if ($smcFunc['db_num_rows']($request) == 0)
			die(show_error($topic));
		
		$row = $smcFunc['db_fetch_assoc']($request);
		$smcFunc['db_free_result']($request);
		
		if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
			$new_url = $boardurl . '/' . format_url($row['name']) .'/' . $row['id_board'];
		else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')	
			$new_url = $boardurl . '/b' . $row['id_board'];
		else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
			$new_url = $boardurl . '/b' . $row['id_board'] . '_' . format_url($row['name']);
		else
			$new_url = $boardurl . '/board' . $row['id_board'];
		
		if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'subject/id')
			$new_url .= '/' . format_url($row['subject']) . '/' . $row['id_topic'];
		else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'tid')
			$new_url .= '/t' . $row['id_topic'];
		else if (!empty($modSettings['seo_topic_redirect']) && $modSettings['seo_topic_redirect'] == 'topicid')
			$new_url .= '/topic' . $row['id_topic'];
		else
			$new_url .= '/t' . $row['id_topic'] . '_' . format_url($row['subject']);
			
		if (isset($_REQUEST['wap2']) && empty($startbit)) 
			$new_url .= ';wap2';
			
		if (!empty($startbit) && strpos($startbit, 'new') !== false && !isset($_REQUEST['topicseen']))
			$new_url .= '/' . $startbit . '#new';
		else if (!empty($startbit) && strpos($startbit, 'new') !== false && isset($_REQUEST['topicseen']))
			$new_url .= '/' . $startbit . ';topicseen#new';
		else if (!empty($startbit))
			$new_url .= '/' . $startbit;
		elseif (!isset($_REQUEST['wap2']))
			$new_url .= '/';
			
		if (isset($_REQUEST['wap2']) && !empty($startbit)) 
			$new_url .= ';wap2';
			
		if (isset($_REQUEST['boardseen'])) 
			$new_url .= ';boardseen';
	
		move_permanently($new_url);
	}
	
	if (!empty($board))
	{
		// Grab Board Info
		$request = $smcFunc['db_query']('', '
			SELECT name, id_board
			FROM {db_prefix}boards
			WHERE id_board = {int:board}
			LIMIT 1',
			array(
				  'board' => $board
			)
		);
		
		if ($smcFunc['db_num_rows']($request) == 0)
			 die(show_error(0, $board));
			 
		$row = $smcFunc['db_fetch_assoc']($request);
		$smcFunc['db_free_result']($request);
		
		if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
			$new_url = $boardurl . '/' . format_url($row['name']) .'/' . $row['id_board'];
		else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')	
			$new_url = $boardurl . '/b' . $row['id_board'];
		else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
			$new_url = $boardurl . '/b' . $row['id_board'] . '_' . format_url($row['name']);
		else
			$new_url = $boardurl . '/board' . $row['id_board'];
			
		if (!empty($startbit))
			$new_url .= '/' . $startbit;
			
		if (isset($_REQUEST['wap2'])) 
			$new_url .= '/wap2';
			
		move_permanently($new_url);
	}
	
	// Still here well you must be doing something wrong...
	show_error();
}

function seo_meta_keywords($text, $site_keywords = false)
{
	global $modSettings;
	
	$lenght = !empty($modSettings['seo_meta_lenght']) ? $modSettings['seo_meta_lenght'] : 150;
	
	if ($site_keywords && !empty($modSettings['seo_meta_keywords']))
		$text = $modSettings['seo_meta_keywords'];
		
	// Here we generate some keywords but deleting common words and converting some html values
	$stop_words = array('i', 'a', 'about', 'an', 'are', 'as', 'at', 'be', 'by', 'for', 'from', 'how', 'in', 'is', 'it', 'la', 'of', 'on', 'or', 'that', 'the', 'thi ', 'to', 'was', 'what', 'when', 'where', 'who', 'will', 'with', 'and', 'und', 'www', 'dont', 'find', 'your', 'you', 'but', 'hi', 'if', 'don', 't', 'we', 'don\'t', 'do', '-', 'won\'t');	
	$text = str_replace('"', '&quot;', strip_tags(html_entity_decode($text, ENT_QUOTES)));
	$text = explode(' ', trim($text), $lenght);
	$text = array_diff($text, $stop_words);
	$text = array_count_values($text);
	arsort($text);
	$keywords = '';
	foreach ($text as $word => $count)
		$keywords .= ', ' . $word;					
	
	return str_replace(',,', ',', trim($keywords, ', '));
}

function seo_meta_description($text, $parse_bbc = false, $site_description = false, $html_decode = false)
{
	global $modSettings, $smcFunc;
	
	$lenght = !empty($modSettings['seo_meta_lenght']) ? $modSettings['seo_meta_lenght'] : 150;
	
	if ($site_description && !empty($modSettings['seo_site_description']))
		$text = $modSettings['seo_site_description'];
		
	$text = str_replace('<br />', '&nbsp;', $text);
	
	if ($parse_bbc)
		$text = parse_bbc($text);
		
	if ($html_decode)
		$text = html_entity_decode($text, ENT_QUOTES, "UTF-8");
	
	// Remove HTML Tags
	$text = strip_tags($text);
	
	// Replace some values in order to prevent stupid descriptions!
	$text = str_replace(array('"' , '<br />', '&nbsp;'), array('&quot;' , ' ', ' '), $text);
	
	// Just make this short!
	return $smcFunc['substr']($text, 0, $lenght);
}

function seo_get_body($id_first_msg)
{
	global $smcFunc, $context;
	
	// Nothing to show?
	if ($id_first_msg == 0)
		return '';
	
	// Have we cached this?
	if (($body = cache_get_data('seo_first_post_' . $id_first_msg, 3600)) == null)
	{
		$request = $smcFunc['db_query']('', '
			SELECT body
			FROM {db_prefix}messages
			WHERE id_msg = {int:id_msg}
			LIMIT 1',
			array(
				  'id_msg' => $id_first_msg
			)
		);
		list($body) = $smcFunc['db_fetch_row']($request);
		$smcFunc['db_free_result']($request);
	
		cache_put_data('seo_first_post_' . $id_first_msg, $body, 3600);
	}
	
	return $body;
}

// Based on censorText of SMF
function parse_acronyms($text)
{
	global $modSettings, $txt;
	static $acronym_seek = null, $acronym_destroy;
	
	// SMFPacks SEO: First find acronyms!
	if ($acronym_seek == null)
	{
		$acronym_seek = empty($modSettings['acronym_parser_seek']) ? array() : explode("\n", $modSettings['acronym_parser_seek']);
		$acronym_destroy = empty($modSettings['acronym_parser_destroy']) ? array() : explode("\n", $modSettings['acronym_parser_destroy']);

		// Quote them for use in regular expressions.
		for ($i = 0, $n = count($acronym_seek); $i < $n; $i++)
		{
			$acronym_destroy[$i] = '[acronym=' . $acronym_destroy[$i] . ']' . $acronym_seek[$i] . '[/acronym]';
			$acronym_seek[$i] = strtr(preg_quote($acronym_seek[$i], '/'), array('\\\\\\*' => '[*]', '\\*' => '[^\s]*?', '&' => '&amp;'));
			$acronym_seek[$i] = (empty($modSettings['acronymWholeWord']) ? '/' . $acronym_seek[$i] . '/' : '/(?<=^|\W)' . $acronym_seek[$i] . '(?=$|\W)/') . (empty($modSettings['acronymIgnoreCase']) ? '' : 'i') . ((empty($modSettings['global_character_set']) ? $txt['lang_character_set'] : $modSettings['global_character_set']) === 'UTF-8' ? 'u' : '');

			if (strpos($acronym_seek[$i], '\'') !== false)
			{
				$acronym_destroy[count($acronym_seek)] = $acronym_destroy[$i];
				$acronym_seek[count($acronym_seek)] = strtr($acronym_seek[$i], array('\'' => '&#039;'));
			}
		}
	}

	$text = preg_replace($acronym_seek, $acronym_destroy, $text);
	// Dirty fix for cases when acronym has been parsed
	$text = preg_replace('~\[acronym=(.+?)\]\[acronym=(.+?)\](.+?)\[/acronym\]\[/acronym\]~i', '[acronym=$1]$3[/acronym]', $text);
	return $text;
}

// Move the url
function move_permanently($url)
{
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' . $url);
	exit;
}

// So no page found? show an error!
function show_error( $topic = 0, $board = 0, $profile = 0, $attach = 0)
{
	global $scripturl, $txt;
	
	// We need this
	loadLanguage('Seo');
	
	$msg = $txt['seo_url_not_specified'];
	
	if ($profile != 0)
		$msg = $scripturl . '?action=profile;u=' . $profile;
	else if ($attach != 0 && $topic != 0)
		$msg = $scripturl . '?action=dlattach;topic=' . $topic . ';attach=' . $attach;
	else if ($topic != 0 && $board == 0)
		$msg = $scripturl . '?topic=' . $topic . '.0';
	else if ($board != 0 && $topic != 0)
		$msg = $scripturl . '?board=' . $board . '.0';
	
	seo_log_warn('404_not_found_' . rand(1, 20000), $txt['seo_404_not_found_url'] . $msg);
	header('HTTP/1.0 404 Not Found');
	
	echo'
	<html>
		<head><title>', $txt['seo_not_found'], '</title></head>
		<body>
			<div align="center">
				', $txt['seo_content_not_found'], '
			</div>
		</body>
	</html>';
}

// Manage some chars in URLs
function format_url($text, $avoid_point = false)
{
	global $smcFunc, $modSettings, $txt;
	
	$separator = isset($modSettings['seo_url_separator']) ? $modSettings['seo_url_separator'] : '-';
	$stopped_words = array();
	
	if ($avoid_point)
		return str_replace(' ', $separator, $text);

	if (!empty($modSettings['seo_url_enable_stopwords']) && !empty($modSettings['seo_url_stopwords']))
	{
		$custom_words = explode("\n", $modSettings['seo_url_stopwords']);
		foreach ($custom_words as $word)
		{
			$word = strtolower(trim($word));
			$stopped_words[$word] = '';
		}
	}
	
	if ($avoid_point)
		$stopped_words = array_merge($stopped_words, array('.' => 'SMFPACKS_HACK_POINT_SEO', '&amp' => ' and ', '/' => '-'));
	else
		$stopped_words = array_merge($stopped_words, array('.' => '-', '&amp' => ' and ', '/' => '-'));
			
	// Acronym Parser!
	if (!empty($modSettings['seo_url_parse_acronyms']) && !empty($modSettings['acronym_parser_seek']))
	{
		$acronym_seek = explode("\n", $modSettings['acronym_parser_seek']);
		$acronym_destroy = explode("\n", $modSettings['acronym_parser_destroy']);

		// Quote them for use in regular expressions.
		for ($i = 0, $n = count($acronym_seek); $i < $n; $i++)
		{
			$acronym_seek[$i] = strtr(preg_quote($acronym_seek[$i], '/'), array('\\\\\\*' => '[*]', '\\*' => '[^\s]*?', '&' => '&amp;'));
			$acronym_seek[$i] = (empty($modSettings['acronymWholeWord']) ? '/' . $acronym_seek[$i] . '/' : '/(?<=^|\W)' . $acronym_seek[$i] . '(?=$|\W)/') . (empty($modSettings['acronymIgnoreCase']) ? '' : 'i') . ((empty($modSettings['global_character_set']) ? $txt['lang_character_set'] : $modSettings['global_character_set']) === 'UTF-8' ? 'u' : '');

			if (strpos($acronym_seek[$i], '\'') !== false)
			{
				$acronym_destroy[count($acronym_seek)] = $acronym_destroy[$i];
				$acronym_seek[count($acronym_seek)] = strtr($acronym_seek[$i], array('\'' => '&#039;'));
			}
		}

		$text = preg_replace($acronym_seek, $acronym_destroy, $text);
	}
	
	if (!empty($modSettings['seo_url_censor']))
		$text = censorText($text);
		
	$characterHash = array(
		'a'	=>	array ('a', 'A', 'à', 'À', 'á', 'Á', 'â', 'Â', 'ã', 'Ã', 'ä', 'Ä', 'å', 'Å', 'ª', 'ą', 'Ą', 'а', 'А', 'ạ', 'Ạ', 'ả', 'Ả', 'Ầ', 'ầ', 'Ấ', 'ấ', 'Ậ', 'ậ', 'Ẩ', 'ẩ', 'Ẫ', 'ẫ', 'Ă', 'ă', 'Ắ', 'ắ', 'Ẵ', 'ẵ', 'Ặ', 'ặ', 'Ằ', 'ằ', 'Ẳ', 'ẳ', 'あ', 'ア', 'Α', 'Ά', 'Ἀ', 'Ἁ', 'Ἂ', 'Ἃ', 'Ἄ', 'Ἅ', 'Ἆ', 'Ἇ', 'ᾈ', 'ᾉ', 'ᾊ', 'ᾋ', 'ᾌ', 'ᾍ', 'ᾎ', 'ᾏ', 'Ᾰ', 'Ᾱ', 'Ὰ', 'Ά', 'ᾼ', 'α', 'ά', 'ἀ', 'ἁ', 'ἂ', 'ἃ', 'ἄ', 'ἅ', 'ἆ', 'ἇ', 'ᾀ', 'ᾁ', 'ᾂ', 'ᾃ', 'ᾄ', 'ᾅ', 'ᾆ', 'ᾇ', 'ὰ', 'ά', 'ᾰ', 'ᾱ', 'ᾲ', 'ᾳ', 'ᾴ', 'ᾶ', 'ᾷ', 'ᾱ', 'ἀ̄', 'ἄ̄', 'ᾰ̓̀', 'ᾱ́', 'ᾰ', 'ά̆', 'ᾰ̓', 'ᾰ̔', 'ἀ̆', 'ά̆', 'ἄ̆', 'ἀ', 'ᾱ́', 'ἄ', 'ᾱͅ'),
		'aa'	=>	array ('ا'),
		'ae'	=>	array ('æ', 'Æ', 'ﻯ'),
		'and'	=>	array ('&'),
		'at'	=>	array ('@'),
		'b'	=>	array ('b', 'B', 'б', 'Б', 'ب', 'ь'),
		'ba'	=>	array ('ば', 'バ'),
		'be'	=>	array ('べ', 'ベ'),
		'bi'	=>	array ('び', 'ビ'),
		'bo'	=>	array ('ぼ', 'ボ'),
		'bu'	=>	array ('ぶ', 'ブ'),
		'c'	=>	array ('c', 'C', 'ç', 'Ç', 'ć', 'Ć', 'č', 'Č'),
		'cent'	=>	array ('¢'),
		'ch'	=>	array ('ч', 'Ч', 'χ', 'Χ'),
		'chi'	=>	array ('ち', 'チ'),
		'copyright'	=>	array ('©'),
		'd'	=>	array ('d', 'D', 'Ð', 'д', 'Д', 'د', 'ض', 'đ', 'Đ', 'δ', 'Δ'),
		'da'	=>	array ('だ', 'ダ'),
		'de'	=>	array ('で', 'デ'),
		'degrees'	=>	array ('°'),
		'dh'	=>	array ('ذ'),
		'do'	=>	array ('ど', 'ド'),
		'dollar' => array('$'),
		'e'	=>	array ('e', 'E', 'è', 'È', 'é', 'É', 'ê', 'Ê', 'ë', 'Ë', 'ę', 'Ę', 'е', 'Е', 'ё', 'Ё', 'э', 'Э', 'Ẹ', 'ẹ', 'Ẻ', 'ẻ', 'Ẽ', 'ẽ', 'Ề', 'ề', 'Ế', 'ế', 'Ệ', 'ệ', 'Ể', 'ể', 'Ễ', 'ễ', 'え', 'エ', 'Ε', 'Έ', 'Ἐ', 'Ἑ', 'Ἒ', 'Ἓ', 'Ἔ', 'Ἕ', 'Έ', 'Ὲ', 'ε', 'έ', 'ἐ', 'ἑ', 'ἒ', 'ἓ', 'ἔ', 'ἕ', 'ὲ', 'έ'),
		'eur' => array('€'),
		'f'	=>	array ('f', 'F', 'ф', 'Ф', 'ﻑ', 'φ', 'Φ', 'ϝ', 'Ϝ'),
		'fu'	=>	array ('ふ', 'フ'),
		'g'	=>	array ('g', 'G', 'ğ', 'Ğ', 'г', 'Г', 'γ', 'Γ'),
		'ga'	=>	array ('が', 'ガ'),
		'ge'	=>	array ('げ', 'ゲ'),
		'gh'	=>	array ('غ'),
		'gi'	=>	array ('ぎ', 'ギ'),
		'go'	=>	array ('ご', 'ゴ'),
		'gu'	=>	array ('ぐ', 'グ'),
		'h'	=>	array ('h', 'H', 'ح', 'ه'),
		'ha'	=>	array ('は', 'ハ'),
		'half'	=>	array ('½'),
		'he'	=>	array ('へ', 'ヘ'),
		'hi'	=>	array ('ひ', 'ヒ'),
		'ho'	=>	array ('ほ', 'ホ'),
		'i'	=>	array ('i', 'I', 'ì', 'Ì', 'í', 'Í', 'î', 'Î', 'ï', 'Ï', 'ı', 'İ', 'и', 'И', 'Ị', 'ị', 'Ỉ', 'ỉ', 'Ĩ', 'ĩ', 'い', 'イ', 'Η', 'Ή', 'Ἠ', 'Ἡ', 'Ἢ', 'Ἣ', 'Ἤ', 'Ἥ', 'Ἦ', 'Ἧ', 'ᾘ', 'ᾙ', 'ᾚ', 'ᾛ', 'ᾜ', 'ᾝ', 'ᾞ', 'ᾟ', 'Ὴ', 'Ή', 'ῌ', 'Ι', 'Ί', 'Ϊ', 'Ἰ', 'Ἱ', 'Ἲ', 'Ἳ', 'Ἴ', 'Ἵ', 'Ἶ', 'Ἷ', 'Ῐ', 'Ῑ', 'Ὶ', 'Ί', 'η', 'ή', 'ἠ', 'ἡ', 'ἢ', 'ἣ', 'ἤ', 'ἥ', 'ἦ', 'ἧ', 'ᾐ', 'ᾑ', 'ᾒ', 'ᾓ', 'ᾔ', 'ᾕ', 'ᾖ', 'ᾗ', 'ὴ', 'ή', 'ῂ', 'ῃ', 'ῄ', 'ῆ', 'ῇ', 'ι', 'ί', 'ϊ', 'ΐ', 'ἰ', 'ἱ', 'ἲ', 'ἳ', 'ἴ', 'ἵ', 'ἶ', 'ἷ', 'ὶ', 'ί', 'ῐ', 'ῑ', 'ῒ', 'ΐ', 'ῖ', 'ῗ', 'ί̆', 'ῐ', 'ῑ', 'ί̄'),
		'j'	=>	array ('j', 'J', 'ج'),
		'ji'	=>	array ('じ', 'ぢ', 'ジ', 'ヂ'),
		'k'	=>	array ('k', 'K', 'к', 'К', 'ك', 'κ', 'Κ'),
		'ka'	=>	array ('か', 'カ'),
		'ke'	=>	array ('け', 'ケ'),
		'kh'	=>	array ('х', 'Х', 'خ'),
		'ki'	=>	array ('き', 'キ'),
		'ko'	=>	array ('こ', 'コ'),
		'ku'	=>	array ('く', 'ク'),
		'l'	=>	array ('l', 'L', 'ł', 'Ł', 'л', 'Л', 'ل', 'λ', 'Λ'),
		'la'	=>	array ('ﻻ'),
		'm'	=>	array ('m', 'M', 'м', 'М', 'م', 'μ', 'Μ'),
		'ma'	=>	array ('ま', 'マ'),
		'me'	=>	array ('め', 'メ'),
		'mi'	=>	array ('み', 'ミ'),
		'mo'	=>	array ('も', 'モ'),
		'mu'	=>	array ('む', 'ム'),
		'n'	=>	array ('n', 'N', 'ñ', 'Ñ', 'ń', 'Ń', 'н', 'Н', 'ن', 'ん', 'ン', 'ν', 'Ν'),
		'na'	=>	array ('な', 'ナ'),
		'ne'	=>	array ('ね', 'ネ'),
		'ni'	=>	array ('に', 'ニ'),
		'no'	=>	array ('の', 'ノ'),
		'nu'	=>	array ('ぬ', 'ヌ'),
		'o'	=>	array ('o', 'O', 'ò', 'Ò', 'ó', 'Ó', 'ô', 'Ô', 'õ', 'Õ', 'ö', 'Ö', 'ø', 'Ø', 'º', 'о', 'О', 'Ọ', 'ọ', 'Ỏ', 'ỏ', 'Ộ', 'ộ', 'Ố', 'ố', 'Ỗ', 'ỗ', 'Ồ', 'ồ', 'Ổ', 'ổ', 'Ơ', 'ơ', 'Ờ', 'ờ', 'Ớ', 'ớ', 'Ợ', 'ợ', 'Ở', 'ở', 'Ỡ', 'ỡ', 'お', 'オ', 'Ο', 'Ό', 'Ὀ', 'Ὁ', 'Ὂ', 'Ὃ', 'Ὄ', 'Ὅ', 'Ὸ', 'Ό', 'Ω', 'Ώ', 'Ὠ', 'Ὡ', 'Ὢ', 'Ὣ', 'Ὤ', 'Ὥ', 'Ὦ', 'Ὧ', 'ᾨ', 'ᾩ', 'ᾪ', 'ᾫ', 'ᾬ', 'ᾭ', 'ᾮ', 'ᾯ', 'Ὼ', 'Ώ', 'ῼ', 'ο', 'ό', 'ὀ', 'ὁ', 'ὂ', 'ὃ', 'ὄ', 'ὅ', 'ὸ', 'ό', 'ω', 'ώ', 'ὠ', 'ὡ', 'ὢ', 'ὣ', 'ὤ', 'ὥ', 'ὦ', 'ὧ', 'ᾠ', 'ᾡ', 'ᾢ', 'ᾣ', 'ᾤ', 'ᾥ', 'ᾦ', 'ᾧ', 'ὼ', 'ώ', 'ῲ', 'ῳ', 'ῴ', 'ῶ', 'ῷ'),
		'p'	=>	array ('p', 'P', 'п', 'П', 'π', 'Π'),
		'pa'	=>	array ('ぱ', 'パ'),
		'pe'	=>	array ('ぺ', 'ペ'),
		'percent'	=>	array ('%'),
		'pi'	=>	array ('ぴ', 'ピ'),
		'plus'	=>	array ('+'),
		'plusminus'	=>	array ('±'),
		'po'	=>	array ('ぽ', 'ポ'),
		'pound'	=>	array ('£'),
		'ps'	=>	array ('ψ', 'Ψ'),
		'pu'	=>	array ('ぷ', 'プ'),
		'q'	=>	array ('q', 'Q', 'ق'),
		'quarter'	=>	array ('¼'),
		'r'	=>	array ('r', 'R', '®', 'р', 'Р', 'ر', 'ρ'),
		'ra'	=>	array ('ら', 'ラ'),
		're'	=>	array ('れ', 'レ'),
		'ri'	=>	array ('り', 'リ'),
		'ro'	=>	array ('ろ', 'ロ'),
		'ru'	=>	array ('る', 'ル'),
		's'	=>	array ('s', 'S', 'ş', 'Ş', 'ś', 'Ś', 'с', 'С', 'س', 'ص', 'š', 'Š', 'σ', 'ς', 'Σ'),
		'sa'	=>	array ('さ', 'サ'),
		'se'	=>	array ('せ', 'セ'),
		'section'	=>	array ('§'),
		'sh'	=>	array ('ш', 'Ш', 'ش'),
		'shi'	=>	array ('し', 'シ'),
		'shch'	=>	array ('щ', 'Щ'),
		'so'	=>	array ('そ', 'ソ'),
		'ss'	=>	array ('ß'),
		'su'	=>	array ('す', 'ス'),
		't'	=>	array ('t', 'T', 'т', 'Т', 'ت', 'ط', 'τ', 'Τ', 'ţ', 'Ţ'),
		'ta'	=>	array ('た', 'タ'),
		'te'	=>	array ('て', 'テ'),
		'th'	=>	array ('ث', 'θ', 'Θ'),
		'three-quarters'	=>	array ('¾'),
		'to'	=>	array ('と', 'ト'),
		'ts'	=>	array ('ц', 'Ц'),
		'tsu'	=>	array ('つ', 'ツ'),
		'u'	=>	array ('u', 'U', 'ù', 'Ù', 'ú', 'Ú', 'û', 'Û', 'ü', 'Ü', 'у', 'У', 'Ụ', 'ụ', 'Ủ', 'ủ', 'Ũ', 'ũ', 'Ư', 'ư', 'Ừ', 'ừ', 'Ứ', 'ứ', 'Ự', 'ự', 'Ử', 'ử', 'Ữ', 'ữ', 'う', 'ウ', 'Υ', 'Ύ', 'Ϋ', 'Ὑ', 'Ὓ', 'Ὕ', 'Ὗ', 'Ῠ', 'Ῡ', 'Ὺ', 'Ύ', 'υ', 'ύ', 'ϋ', 'ΰ', 'ὐ', 'ὑ', 'ὒ', 'ὓ', 'ὔ', 'ὕ', 'ὖ', 'ὗ', 'ὺ', 'ύ', 'ῠ', 'ῡ', 'ῢ', 'ΰ', 'ῦ', 'ῧ'),
		'v'	=>	array ('v', 'V', 'в', 'В', 'β', 'Β'),
		'w'	=>	array ('w', 'W', 'و'),
		'wa'	=>	array ('わ', 'ワ'),
		'wo'	=>	array ('を', 'ヲ'),
		'x'	=>	array ('x', 'X', '×', 'ξ', 'Ξ'),
		'y'	=>	array ('y', 'Y', 'ý', 'Ý', 'ÿ', 'й', 'Й', 'ы', 'Ы', 'ي', 'Ỳ', 'ỳ', 'Ỵ', 'ỵ', 'Ỷ', 'ỷ', 'Ỹ', 'ỹ'),
		'ya'	=>	array ('я', 'Я', 'や'),
		'yen'	=>	array ('¥'),
		'yo'	=>	array ('よ'),
		'yu'	=>	array ('ю', 'Ю', 'ゆ'),
		'z'	=>	array ('z', 'Z', 'ż', 'Ż', 'ź', 'Ź', 'з', 'З', 'ز', 'ظ', 'ž', 'Ž', 'ζ', 'Ζ'),
		'za'	=>	array ('ざ', 'ザ'),
		'ze'	=>	array ('ぜ', 'ゼ'),
		'zh'	=>	array ('ж', 'Ж'),
		'zo'	=>	array ('ぞ', 'ゾ'),
		'zu'	=>	array ('ず', 'づ', 'ズ', 'ヅ'),
		'-'	=>	array ('-', ' ', '.', ','),
		'_'	=>	array ('_'),
		'!'	=>	array ('!'),
		'~'	=>	array ('~'),
		'*'	=>	array ('*'),
		chr(18)	=>	array ("'", '"', 'ﺀ', 'ع'),
		'('	=>	array ('(', '{', '['),
		')'	=>	array (')', '}', ']'),
		'$'	=>	array ('$'),
		'0'	=>	array ('0'),
		'1'	=>	array ('1', '¹'),
		'2'	=>	array ('2', '²'),
		'3'	=>	array ('3', '³'),
		'4'	=>	array ('4'),
		'5'	=>	array ('5'),
		'6'	=>	array ('6'),
		'7'	=>	array ('7'),
		'8'	=>	array ('8'),
		'9'	=>	array ('9'),
	);
	
	$text = str_replace(array('&amp;', '&quot;'), array('&', '"'), $text);
	$prettytext = '';

	//	Split up $text into UTF-8 letters
	preg_match_all("~.~su", $text, $characters);
	foreach ($characters[0] as $aLetter)
	{
		foreach ($characterHash as $replace => $search)
		{
			//	Found a character? Replace it!
			if (in_array($aLetter, $search))
			{
				$prettytext .= $replace;
				break;
			}
		}
	}
		
	$text = $smcFunc['htmlspecialchars'](html_entity_decode($prettytext));
	$text = trim(preg_replace('/[^a-z \d\-]/i', '', $text));
	$text = str_replace(' ', $separator, strtolower($text));
	$text = preg_replace('/[\-]{2,}/', '-', $text);
	$text = rtrim($text, '-');
	
	// Stopped Words!
	$textArray = explode($separator, $text);
	$arr = array();
	
	foreach ($textArray as $word)
		if (!isset($stopped_words[$word]))
			$arr[] = $word;
	
	$text = seo_limit_url_lenght(implode($separator, $arr));
	
	if (is_numeric($text))
		 $text = 'n' . $text;
	
	$text = $text;
	return trim($text) == '' ? 'seo' : $text;
}

function seo_limit_url_lenght($url)
{
	global $context, $modSettings, $boardurl;
	
	if (empty($modSettings['seo_url_lenght']) || strlen($url) <= $modSettings['seo_url_lenght'])
		return $url;
		
	$url_parts = explode('/', str_replace($boardurl . '/', '', $url));
	$url_after = "";
	$max_lenght = ($modSettings['seo_url_lenght'] - strlen($url)) / count($url_parts);
	
	foreach ($url_parts as $part)
	{
		if (strlen($part) > $max_lenght || is_numeric(str_replace('n', '', $part)))
			$part = substr($part, 0, $max_lenght);
			
		$url_after .= '/' . $part;
	}
	
	return $url_after;
}

function seo_external_url($content, $data, $before = false, $is_iurl = false, $force_nofollow = false, $return_url = false)
{
	global $modSettings, $scripturl, $boardurl, $context;
	
	// Empty?
	if (trim($content) == '' && $return_url)
		return '';
	
	// Set the target!
	$target = $is_iurl ? '' : ' target="_blank"';
	
	// What we need to look for?
	$original_search = !empty($modSettings['enable_pretty_urls']) ? $boardurl : $scripturl;
	$search_for = array($original_search);
	
	// Add the domain too
	if (defined('PHP_URL_HOST'))
		$search_for[] = parse_url($original_search, PHP_URL_HOST);
	
	// Is https? Look for http aswell
	if (substr($original_search, 0, 8) == 'https://')
		$search_for[] = str_replace('https://', 'http://', $original_search);
	
	// Find them!
	foreach ($search_for as $search_string)
	{
		// strpos didn't work always
		if (str_replace($search_string, '', $data) !== $data)
		{
			// Just the url?
			if ($return_url)
				return $content;
			
			$target = !empty($modSettings['seo_internal_same_window']) ? '' : $target;
		
			if ($force_nofollow)
				$target .= ' rel="nofollow"';
		
			return !$before ? '<a href="' . $data . '" class="bbc_link" rel="noopener"' . $target . '>' . $data . '</a>' : '<a href="' . $data . '" class="bbc_link" target="_blank" rel="noopener"' . $target . '>';
		}
	}
	
	// Just the url?
	if ($return_url && !empty($modSettings['seo_redirect_external']))
		return $scripturl . '?action=seored;u=' . base64_encode(rawurlencode($content));
	else if ($return_url)
		return $content;
		
	if (!empty($modSettings['seo_redirect_external']))
		$content = '<a href="' . $scripturl . '?action=seored;u=' . base64_encode(rawurlencode($data)) . '" class="bbc_link" target="_blank" rel="noopener"' . $target . '>';
		
	if (!empty($modSettings['seo_redirect_external']) && !$before)
		$content .= $data . '</a>';
		
	if (empty($modSettings['seo_redirect_external']))
		$content = !$before ? '<a href="' . $data . '" class="bbc_link" target="_blank" rel="noopener">' . $data . '</a>' : '<a href="' . $data . '" class="bbc_link" target="_blank" rel="noopener"' . $target . '>';
							
	$replace = 'class=';
	$nofollow = !empty($modSettings['seo_nofollow']) ? true : false;
	
	// Record outbound for google analytics?
	if (!empty($modSettings['seo_ga_outbound']))
		$replace = 'onClick="recordOutboundLink(this, \'Outbound Links\', \'' . $data . '\'); return false;" class=';
			
	// Check blacklists and whilelists!
	if (!$nofollow && !empty($modSettings['seo_nofollow_blacklist']))
	{
		$sites = explode("\n", $modSettings['seo_nofollow_blacklist']);
		
		foreach ($sites as $site)
			if (strpos($data, $site) !== false)
				$nofollow = true;
	}
		
	if ($nofollow && !empty($modSettings['seo_nofollow_whitelist']))
	{
		$sites = explode("\n", $modSettings['seo_nofollow_whitelist']);
		
		foreach ($sites as $site)
			if (strpos($data, $site) !== false)
				$nofollow = false;
	}
	
	if ($nofollow || $force_nofollow)
		$replace = 'rel="nofollow" ' . $replace;
		
	$txt = str_replace('class=', $replace, $content);
	return $txt;
}

function seo_log_warn($id, $entry = '')
{
	global $smcFunc, $modSettings;
	
	// Disabled?
	if (!empty($modSettings['seo_disable_warnings']))
		return;
	
	// Log it!
	$smcFunc['db_insert']('',
		'{db_prefix}log_seo_warning',
		array(
			'log_time' => 'int', 'id_warn' => 'string', 'entry' => 'string', 'dismiss' => 'int',
		),
		array(
			time(), $id, $entry, 0,
		),
		array('')
	);
}

function seo_save_actions($actions)
{
	global $modSettings;

	// Verify last update!
	if (cache_get_data('smfpacks_seo_fixactions', 3600) !== null)
		return;
	
	// Serialize the actions!
	$serial = serialize(array_keys($actions));

	// Check if they are different!
	if (empty($modSettings['seo_actions']) || ($modSettings['seo_actions'] != $serial && !empty($modSettings['enable_pretty_actions'])))
		updateSettings(array('seo_actions' => $serial));
	
	// Prevent doing this on each page load.
	cache_put_data('smfpacks_seo_fixactions', true, 3600);
}

/**** INTEGRATION HOOKS ****/
function seo_add_actions(&$actions)
{
	global $modSettings, $sourcedir;
	
	$actions += array(
		'httperror' => array('Subs-Seo.php', 'seo_error_pages'),
		'sitemap' => array('Subs-Seo.php', 'seo_sitemap'),
		'seored' => array('Subs-Seo.php', 'seo_external_redirect'),
		'seocloud' => array('Subs-Seo.php', 'seo_view_tag_in_cloud'),
	);
	
	// Now verify actions nicely!
	if (!empty($modSettings['integrate_actions']))
	{
		$current_functions = explode(',', $modSettings['integrate_actions']);
		
		if (end($current_functions) != 'seo_add_actions')
		{
			remove_integration_function('integrate_actions', 'seo_add_actions');
			add_integration_function('integrate_actions', 'seo_add_actions');
		}
	}
	else
		add_integration_function('integrate_actions', 'seo_add_actions');
	
	// Save actions!
	seo_save_actions($actions);
}

// SMFPacks SEO Related Topics and Social Bookmarks
function seo_add_related_topics()
{
	global $context, $sourcedir;

	// Not in SMF 2.1!
	if (seo_is_smf_21())
		return;

	if (!function_exists('seo_social_bookmarks'))
		require_once($sourcedir . '/Subs-Seo.php');
	
	echo seo_social_bookmarks();
	echo seo_related_topics($context['subject']);
}

function seo_add_menu(&$menu_buttons)
{
	global $modSettings, $txt, $scripturl, $user_info;
	
	// Not loaded?
	loadLanguage('Seo');
	
	// Add the sitemap button
	if (!empty($modSettings['seo_sitemap_show']) && in_array($modSettings['seo_sitemap_show'], array(1, 2)))
	{
		$menu_buttons['sitemap'] = array(
			'title' => $txt['seo_sitemap'],
			'href' => $scripturl . '?action=sitemap',
			'icon' => 'www',
			'show' => true,
		);
	}
	
	// Add nofollow when we should have it!
	if (isset($menu_buttons['help']))
		$menu_buttons['help']['href'] .= '" rel="nofollow';
		
	if (isset($menu_buttons['search']))
		$menu_buttons['search']['href'] .= '" rel="nofollow';
		
	if (isset($menu_buttons['register']))
		$menu_buttons['register']['href'] .= '" rel="nofollow';
		
	if (isset($menu_buttons['login']))
		$menu_buttons['login']['href'] .= '" rel="nofollow';
		
	// Add a link to easily access SEO Admin Panel from the main menu
	if (isset($menu_buttons['admin']))
	{
		if (isset($menu_buttons['admin']['sub_buttons']['permissions']))
			$menu_buttons['admin']['sub_buttons']['permissions']['is_last'] = false;
			
		$menu_buttons['admin']['sub_buttons']['seo_admin'] = array(
			'title' => $txt['seo_admin'],
			'href' => $scripturl . '?action=admin;area=seo_admin',
			'show' => allowedTo('admin_forum'),
			'is_last' => true,
		);
	}
}

function seo_admin_areas(&$admin_areas)
{
	global $txt, $scripturl, $context, $modSettings;
	
	$admin_areas['seo'] = array(
		'title' => $txt['seo_admin_panel'],
		'permission' => array('admin_forum'),
		'areas' => array( 
			 'seo_admin' => array(
				'label' => $txt['seo_admin'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_admin',
				'icon' => 'seo_home.png',
				'permission' => array('admin_forum'),
				'subsections' => array(),
		   ),
		   'seo_settings' => array(
				'label' => $txt['seo_settings'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_settings',
				'icon' => 'seo_settings.png',
				'permission' => array('admin_forum'),
				'subsections' => array(
					 'seo_settings' => array($txt['seo_urls_settings']),
					 'seo_ga' => array($txt['seo_ga']),
					 'seo_sitemap' => array($txt['seo_sitemap_settings']),
					 'seo_linkbacks' => array($txt['seo_linkbacks']),
					 'seo_related' => array($txt['manageposts_topic_settings']),
					 'seo_posted' => array($txt['seo_posted']),
					 'seo_guests_theme' => array($txt['seo_guests_theme_menu']),
					 'seo_optimize' => array($txt['seo_optimize']),
					 'seo_misc' => array($txt['seo_misc']),
				),
		   ),
		   'htaccess' => array(
				'label' => $txt['seo_htaccess'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_htaccess',
				'icon' => 'seo_htaccess.png',
				'enabled' => !$context['server']['is_iis'] && !$context['server']['is_nginx'],
				'permission' => array('admin_forum'),
				'subsections' => array(),
		   ),
		   'seo_robots' => array(
				'label' => $txt['seo_robots'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_robots',
				'icon' => 'seo_robots.png',
				'permission' => array('admin_forum'),
				'subsections' => array(),
		   ),
		   'seo_redirects' => array(
				'label' => $txt['seo_redirects'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_redirects',
				'icon' => 'seo_redirect.png',
				'permission' => array('admin_forum'),
		   ),
		   'seo_cloud' => array(
				'label' => $txt['seo_cloud'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_tags_cloud',
				'icon' => 'seo_cloud.png',
				'permission' => array('admin_forum'),
				'subsections' => array(
					  'seo_cloud' => array($txt['seo_cloud']),
					  'seo_cloud_popular_tags' => array($txt['seo_cloud_popular_tags']),
				),
		   ),
		   'seo_meta' => array(
				'label' => $txt['seo_meta'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_meta_tags',
				'icon' => 'seo_meta_tags.png',
				'permission' => array('admin_forum'),
				'subsections' => array(
					 'settings' => array($txt['settings']),
					 'custom' => array($txt['seo_custom_meta_tags']),
					 'social' => array($txt['seo_social_meta_tags']),
				),
		   ),
		   'seo_errors' => array(
				'label' => $txt['seo_errorpages'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_admin_error_pages',
				'icon' => 'seo_404.png',
				'permission' => array('admin_forum'),
				'subsections' => array(),
		   ),
		   'seo_acronym' => array(
				'label' => $txt['seo_acronym'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_acronym_parser',
				'icon' => 'seo_acronyms.png',
				'permission' => array('admin_forum'),
				'subsections' => array(),
		   ),
		   'seo_bookmarks' => array(
				'label' => $txt['seo_admin_bookmarks'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_admin_bookmarks',
				'icon' => 'seo_social_bookmarks.png',
				'permission' => array('admin_forum'),
				'subsections' => array(
					  'seo_topic' => array($txt['manageposts_topic_settings']),
					  'seo_posts' => array($txt['manageposts_settings']),
				),
		   ),
		   'seo_warning' => array(
				'label' => $txt['seo_admin_warning'],
				'file' => 'SeoAdmin.php',
				'function' => 'seo_admin_warning',
				'icon' => 'seo_warnings.png',
				'enabled' => empty($modSettings['seo_disable_warnings']),
				'permission' => array('admin_forum'),
				'subsections' => array(),
		   ),
		 ),
	);

	$installed_version = '2.4.11';
	$context['html_headers'] .= '
	<script language="javascript" type="text/javascript" src="https://www.smfpacks.com/versions/index.php?mod=seomod&prefix=seo"></script>
	<script type="text/javascript">
	function seo_version_compare(v1, v2)
    {
        var v1parts = v1.split(\'.\');
        var v2parts = v2.split(\'.\');
        
        for (var i = 0; i < v1parts.length; ++i)
        {
            if (v2parts.length == i)
                return true;
            
            if (v1parts[i] == v2parts[i])
                continue;
            else if (parseInt(v1parts[i]) > parseInt(v2parts[i]))
                return true;
            else
                return false;
        }
        
        return false;
    }

	function seo_ignore_version() {
		// Add to local storage
		localStorage.setItem("seo_ignore_" + seo_latest, "true");
		document.getElementById("seo_outdated").outerHTML = "";
	}
    
    var seo_current = \'' . $installed_version . '\';
    window.addEventListener("load", (event) => {
		const ignoringByLocalStorage = typeof(Storage) !== "undefined" && localStorage.getItem("seo_ignore_" + seo_latest) === "true";

		if (ignoringByLocalStorage) {
			return;
		}

        if (seo_version_compare(seo_latest, seo_current)) {
            document.getElementById(\'admin_content\').outerHTML = \'<div id="seo_outdated" style="text-align: center; color: white; background: red; padding: 1rem; border-radius: 1rem;">SMFPacks SEO Pro Outdated! Visit <a href="https://www.smfpacks.com" style="color: white;">SMFPacks.com</a> to upgrade! <a href="javascript:void(0);" style="color: white;" onclick="seo_ignore_version();">Click here to ignore this message.</a></div><br />\' + document.getElementById(\'admin_content\').outerHTML;
		}
    });
	</script>';
}

function seo_add_bbcode(&$codes)
{
	global $user_info, $modSettings, $txt, $scripturl;

	$temp_codes = array();

	foreach ($codes as $code) {
		switch ($code['tag']) {
			case 'iurl':

				if ($code['type'] === 'unparsed_content') {
					$code['validate'] = function(&$tag, &$data, $disabled)
					{
						$data = strtr($data, array('<br>' => ''));
						$scheme = parse_url($data, PHP_URL_SCHEME);
						if (empty($scheme))
							$data = '//' . ltrim($data, ':/');

						$tag['content'] = seo_external_url($tag['content'], $data, false, true);
					};
				} else if ($code['type'] === 'unparsed_equals') {
					$code['validate'] = function(&$tag, &$data, $disabled)
					{
						if (substr($data, 0, 1) == '#')
							$data = '#post_' . substr($data, 1);
						else
						{
							$scheme = parse_url($data, PHP_URL_SCHEME);
							if (empty($scheme))
								$data = '//' . ltrim($data, ':/');
						}

						$tag['before'] = seo_external_url($data, $data, true, true);
					};
				}
				break;
			
			case 'url':

				if ($code['type'] === 'unparsed_content') {
					$code['validate'] = function(&$tag, &$data, $disabled)
					{
						$data = strtr($data, array('<br>' => ''));
						$scheme = parse_url($data, PHP_URL_SCHEME);
						if (empty($scheme))
							$data = '//' . ltrim($data, ':/');

						$tag['content'] = seo_external_url($tag['content'], $data, false);
					};
				} else if ($code['type'] === 'unparsed_equals') {
					$code['validate'] = function(&$tag, &$data, $disabled)
					{
						$scheme = parse_url($data, PHP_URL_SCHEME);
						if (empty($scheme))
							$data = '//' . ltrim($data, ':/');

						$tag['before'] = seo_external_url($data, $data, true);
					};
				}
				break;

			case 'quote':
				// Disable quotes for guests
				if (isset($code['parameters']) && count($code['parameters']) === 3 && !empty($modSettings['seo_disable_quotes_for_guests']) && $user_info['is_guest']) {
					$code['type'] =  'unparsed_content';
					$code['before'] = '';
					$code['after'] = '';
					$code['content'] = ''; 
				}

			default:
				// Nothing to do
				break;
		}

		$temp_codes[] = $code;
	}

	$seo_codes = array(
		array(
			'tag' => 'h1',
			'before' => '<h1>',
			'after' => '</h1>',
			'block_level' => true,
		),
		array(
			'tag' => 'h2',
			'before' => '<h2>',
			'after' => '</h2>',
			'block_level' => true,
		),
		array(
			'tag' => 'h3',
			'before' => '<h3>',
			'after' => '</h3>',
			'block_level' => true,
		),
		array(
			'tag' => 'h4',
			'before' => '<h4>',
			'after' => '</h4>',
			'block_level' => true,
		),
		array(
			'tag' => 'h5',
			'before' => '<h5>',
			'after' => '</h5>',
			'block_level' => true,
		),
		array(
			'tag' => 'h6',
			'before' => '<h6>',
			'after' => '</h6>',
			'block_level' => true,
		),
		array(
			'tag' => 'nofollow',
			'type' => 'unparsed_content',
			'content' => '<a href="$1" target="_blank" class="bbc_link" rel="nofollow">$1</a>',
			'validate' => function (&$tag, &$data, $disabled)
			{
				$data = strtr($data, array('<br />' => ''));
				if (strpos($data, 'http://') !== 0 && strpos($data, 'https://') !== 0)
					$data = 'http://' . $data;
						
				$tag['content'] = seo_external_url($tag['content'], $data, false, false, true);
			},
		),
		array(
			'tag' => 'nofollow',
			'type' => 'unparsed_equals',
			'before' => '<a href="$1" target="_blank" class="bbc_link" rel="nofollow">',
			'after' => '</a>',
			'disallow_children' => array('email', 'ftp', 'url', 'iurl'),
			'disabled_after' => ' ($1)',
			'validate' => function (&$tag, &$data, $disabled)
			{
				if (substr($data, 0, 1) == '#')
					$data = '#post_' . substr($data, 1);
				elseif (strpos($data, 'http://') !== 0 && strpos($data, 'https://') !== 0)
					$data = 'http://' . $data;
					
				$tag['before'] = seo_external_url($data, $data, true, false, true);
			},
		)
	);
	
	$codes = array_merge($temp_codes, $seo_codes);
}

function seo_add_guests_theme()
{
	global $modSettings, $user_info;
	
	// SMFPacks SEO: Select a theme for guests
	if ($user_info['is_guest'] && !empty($modSettings['seo_enable_guest_theme']) && isset($modSettings['seo_guests_theme']))
		$_REQUEST['theme'] = (int) $modSettings['seo_guests_theme'];
}

// This function is a big one!
function seo_rewrite_buffer($buffer)
{	
	global $modSettings, $smcFunc, $scripturl, $boardurl, $context, $topicinfo, $seo_disable_buffer, $txt, $boarddir, $sourcedir;
	
	// Prevent errors
	if (!file_exists($boarddir . '/.htaccess') && !file_exists('web.config'))
		$seo_disable_buffer = true;
	
	// We have to disable everything here, we cannot return the buffer here because we must do some really vital
	// modifications to it to not break it!
	if (isset($seo_disable_buffer) && $seo_disable_buffer === true)
	{
		$modSettings['enable_pretty_actions'] = false;
		$context['seo_description'] = '';
		$context['seo_keywords'] = '';
		$modSettings['seo_optimize_images_alt'] = false;
		$modSettings['seo_optimize_images_title'] = false;
		$modSettings['enable_pretty_urls'] = false;
		$modSettings['seo_cleanup_html'] = false;
	}
	
	// Compatibility with Pretty Urls mod!
	if (file_exists($sourcedir . '/PrettyUrls.php') && !empty($modSettings['pretty_enable_filters']))
		$modSettings['enable_pretty_urls'] = false;
	
	// Testing?
	if (isset($_SESSION['confirm_pretty']))
		$modSettings['enable_pretty_urls'] = true;
	
	// This section is done if we are not redirecting!
	if (!isset($context['seo_redirecting']))
	{
		$what_to_search = array(
			'"' . preg_quote($scripturl, '/') . '\?board=([0-9]*);action=post2"'
		);
		$what_to_replace = array(
			$scripturl . '?action=post2;board=$1'
		);

		// If wireless, disable indexing!
		if (defined('WIRELESS') && WIRELESS)
		{
			$buffer = str_replace('</head>', '	<meta name="robots" content="noindex" />
	</head>', $buffer);
		}
		
		// Meta Description!
		if (isset($context['seo_description']) && trim($context['seo_description']) !== '')
		{
			// Add meta desc
			if (preg_match('/<meta name="description" content="([^#";.]+)" \/>/', $buffer))
			{
				$what_to_search[] = '<meta name="description" content="([^#";.]+)" />';
				$what_to_replace[] = 'meta name="description" content="' . trim($context['seo_description']) . '" /';
			}
			else
				$buffer = str_replace('</head>', '	<meta name="description" content="' . trim($context['seo_description']) . '" />
	</head>', $buffer);

			// Don't forget Open Graph!
			if (preg_match('/<meta name="og:description" content="([^#";.]+)" \/>/', $buffer))
			{
				$what_to_search[] = '<meta name="og:description" content="([^#";.]+)" />';
				$what_to_replace[] = 'meta name="og:description" content="' . trim($context['seo_description']) . '" /';
			}
			else
				$buffer = str_replace('</head>', '	<meta name="og:description" content="' . trim($context['seo_description']) . '" />
	</head>', $buffer);
	
			// Add the description for Google+
			if (preg_match('/<meta itemprop="description" content="([^#";.]+)" \/>/', $buffer))
			{
				$what_to_search[] = '<meta itemprop="description" content="([^#";.]+)" />';
				$what_to_replace[] = 'meta itemprop="description" content="' . trim($context['seo_description']) . '" /';
			}
			else
				$buffer = str_replace('</head>', '<meta itemprop="description" content="' . trim($context['seo_description']) . '" />
	</head>', $buffer);
	
			// Something for Twitter?
			if (!empty($modSettings['seo_twitter_card']))
			{
				if (preg_match('/<meta name="twitter:description" content="([^#";.]+)" \/>/', $buffer))
				{
					$what_to_search[] = '<meta name="twitter:description" content="([^#";.]+)" />';
					$what_to_replace[] = 'meta name="twitter:description" content="' . trim($context['seo_description']) . '" /';
				}
				else
					$buffer = str_replace('</head>', '<meta name="twitter:description" content="' . trim($context['seo_description']) . '" />
	</head>', $buffer);
			}
		}
	
		// Meta Keywords!
		if (isset($context['seo_keywords']) && trim($context['seo_keywords']) !== '')
		{
			if (preg_match('/<meta name="keywords" content="([^#";.]+)" \/>/', $buffer))
			{
				$what_to_search[] = '<meta name="keywords" content="([^#";.]+)" />';
				$what_to_replace[] = 'meta name="keywords" content="' . trim($context['seo_keywords']) . '" /';
			}
			else
				$buffer = str_replace('</head>', '<meta name="keywords" content="' . trim($context['seo_keywords']) . '" />
</head>', $buffer);
		}
	
		// OG:Image
		if (isset($context['og_image']) && trim($context['og_image']) !== '')
		{
			// Open graph image
			if (!empty($modSettings['seo_open_graph_images']))
			{
				if (preg_match('/<meta property="og:image" content="(.*)" \/>/', $buffer))
				{
					$what_to_search[] = '<meta property="og:image" content="(.*)" />';
					$what_to_replace[] = 'meta property="og:image" content="' . $context['og_image'] . '" /';
				}
				else
					$buffer = str_replace('</head>', '	<meta property="og:image" content="' . $context['og_image'] . '" />
		</head>', $buffer);
			}
	
			// Now google+ image
			if (!empty($modSettings['seo_google_plus_tags_images']))
			{
				if (preg_match('/<meta itemprop="image" content="(.*)" \/>/', $buffer))
				{
					$what_to_search[] = '<meta itemprop="image" content="(.*)" />';
					$what_to_replace[] = 'meta itemprop="image" content="' . $context['og_image'] . '" /';
				}
				else
					$buffer = str_replace('</head>', '	<meta itemprop="image" content="' . $context['og_image'] . '" />
		</head>', $buffer);
			}
			
			// Now handle Twitter!
			if (!empty($modSettings['seo_twitter_card']) && !empty($modSettings['seo_twitter_card_images']))
			{
				if (preg_match('/<meta name="twitter:image" content="(.*)" \/>/', $buffer))
				{
					$what_to_search[] = '<meta name="twitter:image" content="(.*)" />';
					$what_to_replace[] = 'meta name="twitter:image" content="' . $context['og_image'] . '" /';
				}
				else
					$buffer = str_replace('</head>', '	<meta name="twitter:image" content="' . $context['og_image'] . '" />
		</head>', $buffer);
			}
			
		}
		
		// Time to optimize images, this one is quite an interesting piece of **** :)
		if (!empty($modSettings['seo_optimize_images_alt']) && !empty($modSettings['seo_optimize_alt_format']))
		{
			preg_match_all('/<img (.*?)\/>/', $buffer, $images);
		
			if (!is_null($images) && !empty($images) && isset($images[1]))
			{
				foreach($images[1] as $index => $value)
				{
					preg_match('/src="([^"]*)"/i', $value, $array) ;

					if (empty($array[1]))
						continue;

					$alt_image = str_replace(array('{title}', '{filename}'), array($context['page_title'], current(explode(".", basename($array[1])))), $modSettings['seo_optimize_alt_format']);
				
					if (in_array($modSettings['seo_optimize_images_alt'], array(1, 3)) && !preg_match('/alt=/', $value))
					{
						$new_img = str_replace('<img', '<img alt="' . $alt_image .'"', $images[0][$index]);
						$buffer = str_replace($images[0][$index], $new_img, $buffer);
					}
					else if (in_array($modSettings['seo_optimize_images_alt'], array(1, 2)) && preg_match('/alt=""/', $value))
						$buffer = str_replace($value, str_replace('alt=""', 'alt="' . $alt_image . '"', $value), $buffer);
				}
			}
		}
	
		if (!empty($modSettings['seo_optimize_images_title']) && !empty($modSettings['seo_optimize_title_format']))
		{
			preg_match_all('/<img (.*?)\/>/', $buffer, $images);
		
			if (!is_null($images) && !empty($images) && isset($images[1]))
			{
				foreach($images[1] as $index => $value)
				{
					preg_match('/src="([^"]*)"/i', $value, $array);

					if (empty($array[1]))
						continue;

					$title_image = str_replace(array('{title}', '{filename}'), array($context['page_title'], current(explode(".", basename($array[1])))), $modSettings['seo_optimize_title_format']);
			
					if(in_array($modSettings['seo_optimize_images_title'], array(1, 3)) && !preg_match('/title=/', $value))
					{
						$new_img = str_replace('<img', '<img title="' . $title_image .'"', $images[0][$index]);
						$buffer = str_replace($images[0][$index], $new_img, $buffer);
					}
					else if(in_array($modSettings['seo_optimize_images_title'], array(1, 2)) && preg_match('/title=""/', $value))
						$buffer = str_replace($value, str_replace('title=""', 'title="' . $title_image . '"', $value), $buffer);
				}
			}
		}
	}
	// If we are we need to define our arrays
	else
		$what_to_search = $what_to_replace = array();
		
	// Boards first, they are quick as we've them in cache ;)
	if (!empty($modSettings['enable_pretty_boards']) && !empty($modSettings['enable_pretty_urls']) && (!defined('WIRELESS') || !WIRELESS))
	{
		// Use some cache
		if (($boards_index = cache_get_data('seo_boards_index', 3600)) == null)
		{
			$request = $smcFunc['db_query']('', '
				SELECT id_board, name
				FROM {db_prefix}boards');
			
			while ($row = $smcFunc['db_fetch_assoc']($request))
				$boards_index[$row['id_board']] = format_url($row['name']);
			
			$smcFunc['db_free_result']($request);
			cache_put_data('seo_boards_index', serialize($boards_index));
		}
		else
			$boards_index = unserialize($boards_index);
		
		$board_search = array();
		$board_replace = array();
		foreach ($boards_index as $id => $name)
		{
			$board_search[] = '"' . preg_quote($scripturl, '/') . '\?board=(' . preg_quote($id, '/') . ')\.0"';
			$board_search[] = '"' . preg_quote($scripturl, '/') . '\?board=(' . preg_quote($id, '/') . ')\.([0-9]*).*?"';
			
			if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'name/id')
				$pattern = $boardurl . '/' . $name . '/' . $id;
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid')	
				$pattern = $boardurl . '/b' . $id;
			else if (!empty($modSettings['seo_board_redirect']) && $modSettings['seo_board_redirect'] == 'bid_name')
				$pattern = $boardurl . '/b' . $id . '_' . $name;
			else
				$pattern = $boardurl . '/board' . $id;
			
			$board_replace[] = $pattern . '/';
			$board_replace[] = $pattern . '/$2';
		}
		
		if (!empty($board_search) && !empty($board_replace))
			$buffer = preg_replace($board_search, $board_replace, $buffer);
	}

	// The biggest work goes here, every single topic is converted here
	if (!empty($modSettings['enable_pretty_topics']) && !empty($modSettings['enable_pretty_urls']) && (!defined('WIRELESS') || !WIRELESS))
	{
		preg_match_all('/' . preg_quote($scripturl, '/') . '\?topic=([0-9]*).*?/', $buffer, $temp_topics);
		
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
		
		if (isset($temp_topics))
		{
			$temp_topics = array_unique($temp_topics[1]);
			$cached_topics = cache_get_data('seo_cached_topics', 5000);
			$cached_topics = $cached_topics == null ? array() : $cached_topics;
			$topics = array();
			
			foreach ($temp_topics as $index => $value)
			{
				$temp_topics[$index] = (int) $value;
				
				if ($value == 0)
					unset($temp_topics[$index]);
					
				if ($cached_topics != null && isset($cached_topics[$value]))
				{
					$topics[] = $value;
					unset($temp_topics[$index]);
				}
			}
			
			$find_topics = array();
			$replaces_topics = array();
			
			foreach ($topics as $val)
			{
				$board_name = str_replace(array('{BOARD_ID}', '{BOARD_NAME}'), array($cached_topics[$val]['board_id'], $cached_topics[$val]['board']), $pattern);
				$topic_name = str_replace(array('{TOPIC_SUBJECT}', '{TOPIC_ID}'), array($cached_topics[$val]['subject'], $val), $topic_pattern);
				
				if ($smcFunc['substr']($topic_name, 0, 1) == '/')
					$topic_name = $smcFunc['substr']($topic_name, 1);
				
				$find_topics[] = '"' . preg_quote($scripturl, '/') . '\?topic=(' . preg_quote($val, '/') . ')\.0"';
				$replaces_topics[] = $board_name . '/' . $topic_name . '/';
				
				$find_topics[] = '"' . preg_quote($scripturl, '/') . '\?topic=(' . preg_quote($val, '/') . ')\.((?:from|msg|new|)[0-9]*).*?"';
				$replaces_topics[] = $board_name . '/' . $topic_name . '/$2';
			}
			
			if (!empty($find_topics) && !empty($replaces_topics))
				$buffer = preg_replace($find_topics, $replaces_topics, $buffer);
		}
		 
		if (!empty($temp_topics))
		{	
			$request = $smcFunc['db_query']('', '
			SELECT m.id_topic, m.id_board, m.subject' . ((!empty($modSettings['seo_board_redirect']) && ($modSettings['seo_board_redirect'] == 'name/id' || $modSettings['seo_board_redirect'] == 'bid_name')) ? ',b.name' : '') . '
			FROM {db_prefix}topics as t
				LEFT JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_first_msg)' . ((!empty($modSettings['seo_board_redirect']) && ($modSettings['seo_board_redirect'] == 'name/id' || $modSettings['seo_board_redirect'] == 'bid_name')) ? 'LEFT JOIN {db_prefix}boards AS b ON (t.id_board = b.id_board)' : '') . '
			WHERE t.id_topic IN ({array_int:topics_array})
			ORDER BY id_topic DESC
			LIMIT {int:limit}',
				array
				(
					'topics_array' 	=> $temp_topics,
					'limit'			=> count($temp_topics),
				)
			);
		
			if ($smcFunc['db_num_rows']($request) != 0)
			{
				$topic_array = array();
				while ($row = $smcFunc['db_fetch_assoc']($request))
				{
					$topic_array[$row['id_topic']] = array(
						'subject' => format_url($row['subject']),
						'board' => (isset($row['name'])) ? format_url($row['name']) : '',
						'board_id' => $row['id_board'],
						'topic' => $row['id_topic'],
					);
				}
				$smcFunc['db_free_result']($request);
				
				$find_topics = array();
				$replaces_topics = array();
					
				foreach ($topic_array as $id => $values)
				{	
					$board_name = str_replace(array('{BOARD_ID}', '{BOARD_NAME}'), array($values['board_id'], $values['board']), $pattern);
					$topic_name = str_replace(array('{TOPIC_SUBJECT}', '{TOPIC_ID}'), array($values['subject'], $id), $topic_pattern);
					
					if ($smcFunc['substr']($topic_name, 0, 1) == '/')
						$topic_name = $smcFunc['substr']($topic_name, 1);
				
					$find_topics[] = '"' . preg_quote($scripturl, '/') . '\?topic=(' . preg_quote($id, '/') . ')\.0"';
					$replaces_topics[] = $board_name . '/' . $topic_name . '/';
					
					$find_topics[] = '"' . preg_quote($scripturl, '/') . '\?topic=(' . preg_quote($id, '/') . ')\.((?:from|msg|new|)[0-9]*).*?"';
					$replaces_topics[] = $board_name. '/' . $topic_name . '/$2';
				}
				
				if (!empty($find_topics) && !empty($replaces_topics))
					$buffer = preg_replace($find_topics, $replaces_topics, $buffer);
					
				// Store in Cache!
				cache_put_data('seo_cached_topics', $topic_array + $cached_topics);
			}
			else
				$smcFunc['db_free_result']($request);
		}
	}
	
	// Process Profiles!
	if (!empty($modSettings['enable_pretty_profiles']) && !empty($modSettings['enable_pretty_urls']) && (!defined('WIRELESS') || !WIRELESS))
	{
		preg_match_all('/' . preg_quote($scripturl, '/') . '\?action=profile;u=([0-9]+)/', $buffer, $temp_profiles, PREG_PATTERN_ORDER);
			  
		if (isset($temp_profiles))
		{
			// Process cached profiles!
			$temp_profiles = array_unique($temp_profiles[1]);
			$temp_profiles = !empty($temp_profiles) ? $temp_profiles : array();
			$profile_key = 'spseo_cached_profiles_' . implode(',', $temp_profiles);
			$cached_profiles = cache_get_data($profile_key, 1000);
			$cached_profiles = $cached_profiles == null ? array() : $cached_profiles;
			$profiles = $find_profile = $replace_profile = array();
			
			// Check cached profiles
			foreach ($temp_profiles as $index => $value)
			{	
				$temp_profiles[$index] = (int) $value;
				
				if ($value == 0)
					unset($temp_profiles[$index]);
					
				if ($cached_profiles != null && isset($cached_profiles[$value]))
				{
					$profiles[] = $value;
					unset($temp_profiles[$index]);
				}
			}
			
			// Guarantee proper order and then process
			if (!empty($profiles))
			{
				// Proper order
				rsort($profiles);
				
				// Replace
				foreach ($profiles as $val)
				{
					$find_profile[] = $scripturl . '?action=profile;u=' . $val;
					
					if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'mlist')
						$replace_profile[] = $boardurl . '/mlist/' . $cached_profiles[$val] . '_' . $val;
					else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'user/id')
						$replace_profile[] = $boardurl . '/' . $cached_profiles[$val] . '/p' . $val;
					else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'pid')
						$replace_profile[] = $boardurl . '/p' . $val;
					else
						$replace_profile[] = $boardurl . '/' . $cached_profiles[$val] . '_p' . $val;
				}
			
				if (!empty($find_profile) && !empty($replace_profile))
					$buffer = str_replace($find_profile, $replace_profile, $buffer);
			}
		}
		
		if (!empty($temp_profiles))
		{
			$request = $smcFunc['db_query']('', '
			SELECT member_name, id_member
			FROM {db_prefix}members
			WHERE id_member IN ({array_int:profiles_array})
			ORDER BY id_member DESC
			LIMIT {int:limit}',
				array
				(
					'profiles_array' 	=> $temp_profiles,
					'limit'				=> count($temp_profiles)
				)
			);
			
			if ($smcFunc['db_num_rows']($request) != 0)
			{
				$profiles = $find_profile = $replace_profile = array();
				while ($row = $smcFunc['db_fetch_assoc']($request))
				{
					$profiles[$row['id_member']] = format_url($row['member_name']);
				}
				$smcFunc['db_free_result']($request);
				
				foreach ($profiles as $id => $name)
				{
					$find_profile[] = $scripturl . '?action=profile;u=' . $id;
					
					if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'mlist')
						$replace_profile[] = $boardurl . '/mlist/' . $profiles[$id] . '_' . $id;
					else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'user/id')
						$replace_profile[] = $boardurl . '/' . $profiles[$id] . '/p' . $id;
					else if (!empty($modSettings['seo_profile_redirect']) && $modSettings['seo_profile_redirect'] == 'pid')
						$replace_profile[] = $boardurl . '/p' . $id;
					else
						$replace_profile[] = $boardurl . '/' . $profiles[$id] . '_p' . $id;
				}
				
				if (!empty($find_profile) && !empty($replace_profile))
					$buffer = str_replace($find_profile, $replace_profile, $buffer);
					
				// Store in Cache!
				cache_put_data('seo_cached_profiles', $profiles + $cached_profiles);
			}
			else
				$smcFunc['db_free_result']($request);
		}
	}
	
	// Process Attachments
	if (!empty($modSettings['enable_pretty_attachments']) && !empty($modSettings['enable_pretty_urls']) && (!defined('WIRELESS') || !WIRELESS)
)
	{
		preg_match_all('/' . preg_quote($scripturl, '/') . '\?action=dlattach;topic=([^#";.]+).*;attach=([^#";.]+).*?/', $buffer, $temp_attachments, PREG_PATTERN_ORDER);
			  
		if (isset($temp_attachments))
		{
			  $temp_attachments = array_unique($temp_attachments[2]);
			  
			  foreach ($temp_attachments as $index => $value)
				   $temp_attachments[$index] = (int) $value;
		}
		
		if (!empty($temp_attachments))
		{
			$request = $smcFunc['db_query']('', '
			SELECT filename, id_attach
			FROM {db_prefix}attachments
			WHERE id_attach IN ({array_int:attachments_array})',
				array
				(
					'attachments_array' => $temp_attachments
				)
			);
			
			if ($smcFunc['db_num_rows']($request) != 0) 
			{
				$attachments = array();
				while ($row = $smcFunc['db_fetch_assoc']($request))
				{
					$attachments[$row['id_attach']] = format_url($row['filename'], true);
				}
				$smcFunc['db_free_result']($request);
				
				$find_attachments = array();
				$replace_attachments = array();
				foreach ($attachments as $id => $filename)
				{
					$find_attachments[] = '"' . preg_quote($scripturl, '/') . '\?action=dlattach;topic=([0-9]*)\.([0-9]*);attach=(' . preg_quote($id, '/') . ').*?"';
					$replace_attachments[] = $boardurl . '/$1.$2/a$3/' . $filename;
				}
				
				if (!empty($find_attachments) && !empty($replace_attachments))
					$buffer = preg_replace($find_attachments, $replace_attachments, $buffer);
			}
			else
				$smcFunc['db_free_result']($request);
		}
	}
	
	// Actions are easy, quick and painless!
	if (!empty($modSettings['enable_pretty_actions']) && !empty($modSettings['enable_pretty_urls']))
	{
		$what_to_search[] = '"' . preg_quote($scripturl, '/') . '\?action=([\-a-zA-Z0-9.]*);(.*)"';
		$what_to_search[] = '"' . preg_quote($scripturl, '/') . '\?action=([\-a-zA-Z0-9.]*)"';
		
		$what_to_replace[] = $boardurl . '/$1/$2';
		$what_to_replace[] = $boardurl . '/$1/';
	}
	
	// It's time to purify some code, and even minimize it!
	if (!empty($modSettings['seo_cleanup_html']) && !isset($context['seo_redirecting']))
	{
		$what_to_search[] = '~>\s+<~';
		$what_to_replace[] = '> <';
	}
	
	// Not for redirects either!
	if (!isset($context['seo_redirecting']))
	{
		$code = '';
		if (!empty($modSettings['seo_enable_sitemap']) && !empty($modSettings['seo_sitemap_show']) && $modSettings['seo_sitemap_show'] != 2)
			$code = '<a href="' . $scripturl . '?action=sitemap" title="' . $txt['seo_sitemap'] . '">' . $txt['seo_sitemap'] . '</a>';
	
		if (!empty($code)) {
			if (!seo_is_smf_21()) {
				$buffer = preg_replace('~(, Simple Machines LLC</a>)~', ', Simple Machines LLC</a> | ' . $code, $buffer);
				$buffer = preg_replace('~(class="new_win">Simple Machines</a>)~', 'class="new_win">Simple Machines</a> | ' . $code, $buffer);
			} else {
				$buffer = preg_replace('~(, Simple Machines</a>)~', ', Simple Machines</a> | ' . $code, $buffer);
				$buffer = preg_replace('~(rel="noopener">Simple Machines</a>)~', 'rel="noopener">Simple Machines</a> | ' . $code, $buffer);
			}
		}
	
		if ($code !== '' && strpos($buffer, $code) === false)
		{
			$buffer = preg_replace('~</body>\s*</html>~', '<div style="text-align: center; width: 100%; font-size: x-small; margin-bottom: 5px;">' . $code . '</div></body></html>', $buffer);
		}
	}
	
	// Replace them already!
	if (!empty($what_to_search))
		$buffer = preg_replace($what_to_search, $what_to_replace, $buffer);
		
	// Done testing?
	if (isset($_SESSION['confirm_pretty']))
		$modSettings['enable_pretty_urls'] = false;
	
	// Return buffer! If above code is changed you'd break everything. I do think you'd leave it alone
	return $buffer;
}

function seo_tag_cloud()
{
	global $smcFunc, $context, $modSettings, $topic, $scripturl, $txt, $user_info;
	
	// We aren't in a board, topic or forum index so just return
	if (!isset($context['current_topic']) && !isset($context['current_board']) && !empty($context['current_action']))
		return;
		
	if (!empty($context['current_topic']) && empty($modSettings['seo_cloud_topics']))
		return;
		
	if (empty($context['current_action']) && empty($modSettings['seo_cloud_index']))
		return;
		
	if (!empty($context['current_board']) && empty($context['current_topic']) && empty($modSettings['seo_cloud_boards']))
		return;
		
	$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	$temp_topic = isset($context['current_topic']) ? $context['current_topic'] : 0;
	$temp_board = isset($context['current_board']) && empty($context['current_topic']) ? $context['current_board'] : 0;
	$banned_tags = empty($modSettings['seo_banned_tags']) ? array() : explode("\n", $modSettings['seo_banned_tags']);
	$min = !empty($modSettings['seo_tag_min']) ? (int) $modSettings['seo_tag_min'] : 0;
	$max = !empty($modSettings['seo_tag_max']) ? (int) $modSettings['seo_tag_max'] : 0;
	if (!empty($referer))
	{
		$spider = '';
		if (preg_match('/www\.google.*/i',$referer))
			$spider = 'google';
		elseif (preg_match('/search\.yahoo.*/i',$referer))
			$spider = 'yahoo';
		elseif (preg_match('/search\.lycos\.com/i', $referer))
			$spider = 'lycos';
		elseif (preg_match('/www\.bing\.com/i', $referer))
			$spider = 'bing';
		elseif (preg_match('/search\.aol\.com/i', $referer))
			$spider = 'aol';
		elseif (preg_match('/ask\.*/i', $referer))
			$spider = 'ask';
		
		if ($spider != '')
		{
			// Only yahoo uses p so check if it's Yahoo!
			if ($spider === 'yahoo')
				$delimiter = "p";
			else
				$delimiter = "q";
	
			// now use the delimiter
			$pattern = "/^.*" . $delimiter . "=([^&]+)&?.*\$/i";
			$query = preg_replace($pattern, '$1', $referer);
			
			// remove our quotes
			$query = preg_replace('/\'|"/','',$query);
	
			// common ignore/bad words/unwanted bits
			$ignorewords = array(
					'a', 'am', 'an', 'and', 'are', 'be', 'been', 'because', 'by', 'for', 'from', 'he', 'her', 'his', 'i', 'in', 'is', 
					'isnt', 'its', 'it', 'of', 'on', 'or', 'over', 'off', 'that', 'the', 'there', 'their', 'this', 'was', 'with',
					'fuck', 'dick', 'wanker', 'bastard', 'fucking', 'whore', 'cunt', 'bitch', 'fucker', 'http://www', 'www', 'www.', 
					'http://', 'com', 'co.uk', 'v1agra', 'viagra', '<script', 'javascript', 'google'
			);
			$search_terms = preg_split ("/[\s,\+\.]+/",$query);
			// re-case each search term and remove ignore words
			foreach($search_terms as $key => $term)
			{
				$term = strtolower($term);
				$term = preg_match('~^[-0-9a-z]{3,24}$~', $term) ? $term : '' ;
				
				// Set a maximun, minimun and see if it'd be ignored
				if (strlen($term) < $min || (!empty($max) && strlen($term) > $max) || in_array($term, $ignorewords))
					unset($search_terms[$key]);
				
				// replaces any spaces with plus
				$search_terms[$key] = str_replace(" ", "+", $term);
			}
			
			// implode our array back to a string
			$search_terms = implode("+", $search_terms);
			$tags = htmlspecialchars(urldecode($search_terms));
			
			if (!empty($tags))
			{
				$tags = str_replace(" ", "+", $tags);
				
				// Tags must go together?
				if(!empty($modSettings['seo_tag_together']))
					$tags = array($tags);
				else
					$tags = strpos($tags, '+') ? explode('+', $tags) : array($tags);
				
				// Banned tags must be avoided!
				$real_tags = array();
				foreach ($tags as $tag)
				{
					if (!in_array($tag, $banned_tags))
						$real_tags[] = $tag;
				}
				$tags = $real_tags;
			}
		}
	}
	
	if (!empty($tags))
	{	
		$query = $smcFunc['db_query']('', '
			SELECT id_tag, tag
			FROM {db_prefix}seo_tags
			WHERE id_topic = {int:id_topic}
				AND id_board = {int:id_board}
				AND tag IN ({array_string:tag})',
			array(
				'tag' => $tags,
				'id_topic' => $temp_topic,
				'id_board' => $temp_board,
			)
		);
		
		// Exists!
		$id_existing_tags = array();
		$existing_tags = array();
		while($row = $smcFunc['db_fetch_assoc']($query))
		{
			$id_existing_tags[] = $row['id_tag'];	
			$existing_tags[] = $row['tag'];
		}
		$smcFunc['db_free_result']($query);
		
		if (!empty($id_existing_tags))
			$smcFunc['db_query']('', '
				UPDATE {db_prefix}seo_tags
				SET hits = hits + 1
				WHERE id_tag IN ({array_int:existing_tags})',
				array(
					'existing_tags' => $id_existing_tags,
				)
			);
			
		if (!empty($existing_tags))
			$tags = array_diff($existing_tags, $tags);
			
		if (!empty($tags))
		{
			$add_tags = array();
			foreach($tags as $tagg)
				$add_tags[] = array($temp_topic, $temp_board, $tagg, 1);
			
			if (!empty($add_tags))
			{
				$smcFunc['db_insert']('normal',
					'{db_prefix}seo_tags',
					array(
						'id_topic' => 'int', 'id_board' => 'int', 'tag' => 'string-65534', 'hits' => 'int',
					),
					$add_tags,
					array('id_tag')
				);
				cache_put_data('seo_tags_' . $temp_topic . '_' . $temp_board, null, 0);
			}
		}
	}
	
	if (!empty($modSettings['seo_tag_only_guests']) && !$user_info['is_guest'])
		return;
	
	if (($context['tags'] = cache_get_data('seo_tags_' . $temp_topic . '_' . $temp_board, 600)) == null)
	{
		// now prepare the tags for this topic
		$query = $smcFunc['db_query']('', '
			SELECT id_tag, hits, tag
			FROM {db_prefix}seo_tags
			WHERE id_topic = {int:id_topic}
				AND id_board = {int:id_board}
				AND tag != "google"
				' . (!empty($banned_tags) ? 'AND tag NOT IN ({array_string:banned_tags})' : '') . '
				' . (!empty($min) ? 'AND LENGTH(tag) >= {int:min}' : '') . '
				' . (!empty($max) ? 'AND LENGTH(tag) <= {int:max}' : '') . '
			ORDER BY hits DESC
			LIMIT 20',
			array(
				'id_topic' => $temp_topic,
				'id_board' => $temp_board,
				'banned_tags' => $banned_tags,
				'min' => $min,
				'max' => $max,
			)
		);
		while($row = $smcFunc['db_fetch_assoc']($query))
		{
			$context['tags'][$row['id_tag']] = $row;
		}
		$smcFunc['db_free_result']($query);
		cache_put_data('seo_tags_' . $temp_topic . '_' . $temp_board, $context['tags'], 600);
	}
	
	if (!empty($context['tags']))
	{
		$context['insert_after_template'] .= '
			<br class="clear" />
			<div class="cat_bar">
				<h3 class="catbg">
					' . $txt['seo_cloud_title'] . '
				</h3>
			</div>
			<div class="windowbg2">
				<span class="topslice"><span></span></span>
					<div class="content" style="text-align: center;">';
						
		$highest = 1;
		$lowest = 999999999999;
		foreach ($context['tags'] as $id => $row)
		{
			$highest = ($row['hits'] > $highest) ? $row['hits'] : $highest;
			$lowest = ($row['hits'] < $lowest) ? $row['hits'] : $lowest;
		}
		$maxsize = 200;
		$minsize = 100;
		$diff = ($highest - $lowest == 0) ? 1 : ($highest - $lowest);
		$steps = ($maxsize - $minsize)/$diff;
	
		// cycle through our tags
		$i = 1;
		foreach ($context['tags'] as $key => $row)
		{
			$context['insert_after_template'] .= '<span style="font-size: ' . ceil($minsize + ($steps * ($row['hits'] - $lowest))) . '%;"><a href="' . $scripturl . '?action=seocloud;tag=' . urlencode(str_replace("+", " ", $row['tag'])) . '">' . str_replace("+", " ", $row['tag']) . '</a></span> ';
		
			if ($i == 10)
			{
				$i = '0';
				$context['insert_after_template'] .= '<br />';
			}
				
			++$i;
		}
		
		$context['insert_after_template'] .= '
				</div>
			<span class="botslice"><span></span></span>
		</div>';
	}
}

function seo_add_permissions(&$permissionGroups, &$permissionList, &$leftPermissionGroups, &$hiddenPermissions, &$relabelPermissions)
{
	$permissionList['membergroup']['post_custom_meta'] = array(false, 'topic', 'moderate');
}

function seo_format_redirect(&$setLocation, &$refresh)
{
	global $context;
	
	$context['seo_redirecting'] = true;
	$setLocation = seo_rewrite_buffer($setLocation);
	unset($context['seo_redirecting']);
}

function seo_display_topic(&$topic_selects, &$topic_tables, &$topic_parameters) {

	$topic_selects += array(
		'mem.member_name',
		't.meta_desc',
		't.meta_keyword',
		't.meta_noindex',
		'ms.id_member AS topic_author',
	);
}

function seo_display_buttons(&$normal_buttons) {

	global $context, $modSettings, $board_info, $txt;

	// Some SEO stuff!
	if (!empty($modSettings['seo_custom_meta']) && isset($context['topicinfo']) && isset($context['topicinfo']['meta_desc']) && $context['topicinfo']['meta_desc'] !== '')
		$context['seo_description'] = $context['topicinfo']['meta_desc'];
	else if (isset($context['first_message']))
		$context['seo_description'] = seo_meta_description(seo_get_body($context['first_message']), true);
		
	if (!empty($modSettings['seo_custom_meta']) && isset($context['topicinfo']) && isset($context['topicinfo']['meta_keyword']) && $context['topicinfo']['meta_keyword'] !== '')
		$context['seo_keywords'] = $context['topicinfo']['meta_keyword'];
	else if (isset($context['first_message']))
		$context['seo_keywords'] = seo_meta_keywords($context['topicinfo']['subject'] . ', ' . strip_tags(parse_bbc(seo_get_body($context['first_message']))));
	
	if (!empty($modSettings['seo_custom_meta']) && isset($context['topicinfo']) && isset($context['topicinfo']['meta_noindex']) && !empty($context['topicinfo']['meta_noindex']))
		$context['robot_no_index'] = true;
	
	$context['page_title'] = !empty($modSettings['seo_topics_title_format']) ? str_replace(array('{TOPIC_TITLE}', '{AUTHOR_NAME}', '{BOARD_NAME}', '{CATEGORY_NAME}'), array(strip_tags($context['topicinfo']['subject']), trim($context['topicinfo']['topic_started_name']) != '' ? $context['topicinfo']['topic_started_name'] : $txt['guest'], $board_info['name'], $board_info['cat']['name']), $modSettings['seo_topics_title_format']) : strip_tags($context['topicinfo']['subject']);
	$context['topic_author'] = isset($context['topicinfo']) && !empty($context['topicinfo']['topic_author']) ? $context['topicinfo']['topic_author'] : 0;
}

function seo_prepare_display_context(&$output, &$message, $counter) {

	global $context, $modSettings, $user_info, $memberContext, $txt, $topic, $scripturl;

	// Run BBC interpreter on the message.
	$output['body'] = '<!-- google_ad_section_start -->' . parse_acronyms($output['body']) . '<!-- google_ad_section_end -->';
	
	// There is an image?
	if (!isset($context['og_image']) && strpos($output['body'], '<img src="') !== false)
	{
		preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $output['body'], $img);
		
		if (!empty($img) && count($img) > 1 && substr($img[1], 0, strlen($modSettings['smileys_url'])) != $modSettings['smileys_url'])
    		$context['og_image'] = $img[1];
    		
		unset($img);
	}
	
	$context['signatures_array'] = isset($context['signatures_array']) ? $context['signatures_array'] : array();
	if (!empty($modSettings['seo_signature_once']) && $user_info['is_guest'] && in_array($message['id_member'], $context['signatures_array']))
	   $memberContext[$message['id_member']]['signature'] = '';
	$context['signatures_array'][] = $message['id_member'];
	
	// Add Linkback!
	if (!empty($modSettings['seo_enable_linkback']) && $context['topicinfo']['id_first_msg'] == $message['id_msg'] && (($modSettings['seo_enable_linkback'] == 2) || ($modSettings['seo_enable_linkback'] == 1 && $user_info['is_guest'])))
		$message['body'] .= '<br /><br /><span class="smalltext">' . $txt['seo_linkback'] . ': ' . $scripturl . '?topic=' . $topic . '.0</span>';
		
	// Add the share post part
	$social_content = seo_social_bookmarks('post', $message['subject'], $message['id_msg']);
	if ($social_content !== '' && seo_is_smf_21()) {
		$output['custom_fields']['icons'][] = array('title' => '', 'col_name' => '', 'value' => $social_content, 'placement' => 1);
	} else if ($social_content !== '') {
		$memberContext[$message['id_member']]['custom_fields'][-5] = array('title' => '', 'col_name' => '', 'value' => $social_content, 'placement' => 1);
	}
}

function seo_pre_load_theme(&$id_theme) {
	
	global $user_info, $modSettings, $maintenance;

	// SMFPacks SEO: Select a theme for guests
	if ($user_info['is_guest'] && !empty($modSettings['seo_enable_guest_theme']) && isset($modSettings['seo_guests_theme']))
		$id_theme = (int) $modSettings['seo_guests_theme'];

	// SMFPacks SEO: Fix an issue with SMF and redirect in login to non-HTTPS
	if (!empty($modSettings['force_ssl']) && empty($maintenance) && function_exists('httpsOn') && !httpsOn() && SMF != 'SSI') {
		redirectexit(strtr($_SERVER['REQUEST_URL'], array('http://' => 'https://')));
	}
}

function seo_member_context(&$memberContextUser, $user, $display_custom_fields) {

	global $user_profile;

	if (isset($memberContextUser['website'])) {
		$profile = $user_profile[$user];
		$memberContextUser['website'] = array(
			'title' => $profile['website_title'],
			'url' => seo_external_url($profile['website_url'], $profile['website_url'], false, false, false, true),
		);
	}
}

function seo_before_create_topic(&$msgOptions, &$topicOptions, &$posterOptions, &$topic_columns, &$topic_parameters) {

	$topic_columns = array_merge($topic_columns, array(
		'meta_desc' => 'string',
		'meta_keyword' => 'string',
		'meta_noindex' => 'int',
	));

	$topic_parameters = array_merge($topic_parameters, array(
		isset($msgOptions['meta_desc']) ? $msgOptions['meta_desc'] : '',
		isset($msgOptions['meta_keywords']) ? $msgOptions['meta_keywords'] : '',
		!empty($msgOptions['meta_noindex']) ? 1 : 0,
	));
}

function seo_modify_topic(&$topics_columns, &$update_parameters, &$msgOptions, &$topicOptions, &$posterOptions) {

	global $modSettings;

	if (empty($modSettings['seo_custom_meta']) || !allowedTo('post_custom_meta'))
		return;

	if (isset($msgOptions['meta_desc']))
		$topic_columns[] = 'meta_desc = {string:meta_desc}';

	if (isset($msgOptions['meta_keywords']))
		$topic_columns[] = 'meta_keyword = {string:meta_keywords}';

	if (isset($msgOptions['meta_noindex']))
		$topic_columns[] = 'meta_noindex = {int:meta_noindex}';

	$update_parameters += array(
		'meta_keywords' => isset($msgOptions['meta_keywords']) ? $msgOptions['meta_keywords'] : '',
		'meta_desc' => isset($msgOptions['meta_desc']) ? $msgOptions['meta_desc'] : '',
		'meta_noindex' => !empty($msgOptions['meta_noindex']) ? 1 : 0,
	);
}

function seo_modify_post(&$messages_columns, &$update_parameters, &$msgOptions, &$topicOptions, &$posterOptions, &$messageInts) {

	global $modSettings, $smcFunc;

	// Update meta data (if we are not doing javascript modification).
	if (!empty($modSettings['seo_custom_meta']) && allowedTo('post_custom_meta') && (!isset($_GET['action']) || $_GET['action'] != 'jsmodify'))
	{
		// We also need to check if this is the first message!
		$smcFunc['db_query']('', '
			UPDATE {db_prefix}topics
			SET meta_keyword = {string:meta_keywords}, meta_desc = {string:meta_desc}, meta_noindex = {int:meta_noindex}
			WHERE id_topic = {int:id_topic}
				AND id_first_msg = {int:id_msg}
			LIMIT 1',
			array(
				'id_msg' => $msgOptions['id'],
				'id_topic' => $topicOptions['id'],
				'meta_desc' => isset($msgOptions['meta_desc']) ? $msgOptions['meta_desc'] : '',
				'meta_keywords' => isset($msgOptions['meta_keywords']) ? $msgOptions['meta_keywords'] : '',
				'meta_noindex' => !empty($msgOptions['meta_noindex']) ? 1 : 0,
			)
		);
	}
}

function seo_post_end() {

	global $context, $modSettings, $txt;

	if ($context['is_first_post'] && !empty($modSettings['seo_custom_meta']) && allowedTo('post_custom_meta')) {

		$context['posting_fields']['meta_keywords'] = array(
			'label' => array(
				'text' => $txt['seo_meta_keywords'],
				'class' => isset($context['post_error']['meta_keywords']) ? 'error' : '',
			),
			'input' => array(
				'type' => 'text',
				'attributes' => array(
					'id' => 'meta_keywords',
					'name' => 'meta_keywords',
					'value' => (isset($context['meta_keywords']) ? $context['meta_keywords'] : ''),
					'size' => '60',
				),
				'after' => '(<span id="meta_keywords_counter" style="color: inherit; ">0</span>)',
			),
		);

		$context['posting_fields']['meta_desc'] = array(
			'label' => array(
				'text' => $txt['seo_meta_desc'],
				'class' => isset($context['post_error']['meta_desc']) ? 'error' : '',
			),
			'input' => array(
				'type' => 'text',
				'attributes' => array(
					'id' => 'meta_desc',
					'name' => 'meta_desc',
					'value' => (isset($context['meta_desc']) ? $context['meta_desc'] : ''),
					'size' => '60',
				),
				'after' => '(<span id="meta_desc_counter" style="color: inherit; ">0</span>)',
			),
		);

		$context['posting_fields']['meta_noindex'] = array(
			'label' => array(
				'text' => $txt['seo_meta_noindex'],
				'class' => isset($context['post_error']['meta_noindex']) ? 'error' : '',
			),
			'input' => array(
				'type' => 'checkbox',
				'attributes' => array(
					'id' => 'meta_noindex',
					'name' => 'meta_noindex',
					'checked' => !empty($context['meta_noindex']),
				),
			),
		);
	}
}

function seo_message_index() {

	global $context;

	$temp_topic_headers = array();

	foreach ($context['topics_headers'] as $key => $val)
		$temp_topic_headers[$key] = str_replace('<a href=', '<a rel="nofollow" href=', $val);

	$context['topics_headers'] = $temp_topic_headers;
}

function seo_is_smf_21() {
	return defined('SMF_VERSION') && strpos(SMF_VERSION, '2.1') !== false;
}