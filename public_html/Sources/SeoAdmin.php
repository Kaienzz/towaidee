<?php
/**********************************************************************************
* SeoAdmin.php																      *
***********************************************************************************
*																				  *
* SMFPacks SEO v2.4.10														 	  *
* Copyright (c) 2011-2023 by SMFPacks.com. All rights reserved.					  *
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
	
	// Load the seos language
	if (loadlanguage('Seo') == false)
		loadLanguage('Seo','english');
		
	// Load the seos Template
	loadtemplate('Seo');

    // You aren't admin?? Please you can`t be here
	isAllowedTo('seo_manage');
	
// Function to confirm changes
function ConfirmPrettyChanges()
{
	global $context, $modSettings, $sourcedir, $txt, $boarddir, $tests, $scripturl;
	
	// In case...
	require_once($boarddir . '/SSI.php');

	// Final confirmation?
	if (isset($_POST['save']))
	{
		updateSettings(array('enable_pretty_urls' => '1'));
		$modSettings['enable_pretty_urls'] = 1;
		redirectexit('action=admin;area=seo_settings;sa=seo_settings');
	}
	else if (isset($_POST['cancel']))
	{
		redirectexit('action=admin;area=seo_settings;sa=seo_settings');
	}

	// Now change only these links
	$tests = array(
		'<h2>' . $txt['actions'] . ':</h2>',
		'<a href="' . $scripturl . '?action=who">' . $txt['who_title'] . '</a>',
		'<a href="' . $scripturl . '?action=mlist;sa=search">' . $txt['mlist_search'] . '</a>',
		'<h2>' . $txt['boards'] . ':</h2>',
	);
	
	// Some boards
	$boards = ssi_topBoards(2, 'array');
	foreach ($boards as $board)
		$tests[] = $board['link'];
		
	// Some topics!
	$tests[] = '<h2>' . $txt['topics'] . ':</h2>';
	$topics = ssi_topTopicsReplies(3, 'array');
	foreach ($topics as $topic)
		$tests[] = $topic['link'];
		
	// Some users
	$tests[] = '<h2>' . $txt['members'] . ':</h2>';
	$posters = ssi_topPoster(2, 'array');
	foreach ($posters as $poster)
		$tests[] = $poster['link'];
		
	// Pass them
	$_SESSION['confirm_pretty'] = true;
	$test_content = seo_rewrite_buffer( implode('%%%%NITROBBSEPARATOR%%%%', $tests) );
	$tests = explode('%%%%NITROBBSEPARATOR%%%%', $test_content);
	unset($_SESSION['confirm_pretty']);

	//	Action-specific chrome
	$context['page_title'] = $txt['confirm_pretty_changes'];
	$context['sub_template'] = 'pretty_test_changes';
}
	
function seo_settings($return_config = false)
{
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	// Manage!
	if (isset($_REQUEST['sa']) && $_REQUEST['sa'] != 'seo_settings')
		return $_REQUEST['sa']();
	
	// Give some header!
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_admin_settings'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_settings_description'];
	
	// Confirming?
	if (isset($_GET['confirmpretty']))
		return ConfirmPrettyChanges();
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
        array('check', 'enable_pretty_urls', 'subtext' => $txt['enable_pretty_urls_desc']),
        array('check', 'seo_redirect_old', 'subtext' => $txt['seo_redirect_old_desc']),
        '',
        array('check', 'enable_pretty_boards'),
        array('select', 'seo_board_redirect', array('name/id' => '{boardname}/{boardid}', 'bid' => 'b{boardid}', 'bid_name' => 'b{boardid}_{boardname}', 'boardid' => 'board{boardid}')),
        array('check', 'enable_pretty_topics'),
        array('select', 'seo_topic_redirect', array('subject/id' => '{subject}/{topicid}', 'tid' => 't{topicid}', 'topicid' => 'topic{topicid}', 'tid_subject' => 't{topicid}_{subject}')),
        array('check', 'enable_pretty_profiles'),
        array('select', 'seo_profile_redirect', array('mlist' => 'mlist/{name}_{profileid}', 'user/id' => '{name}/p{profileid}', 'pid' => 'p{profileid}', 'name_pid' => '{name}_p{profileid}')),
        array('check', 'enable_pretty_actions'),
        array('check', 'enable_pretty_attachments', 'subtext' => $txt['enable_pretty_attachments_desc']),        
        '',
	    array('select', 'seo_url_separator', array('-' => '-', '_' => '_', '.' => '.')),
		array('check', 'seo_url_censor', 'subtext' => $txt['seo_url_censor_desc']),
		array('check', 'seo_url_parse_acronyms', 'subtext' => $txt['seo_url_parse_acronyms_desc']),
		array('int', 'seo_url_lenght', 'subtext' => $txt['seo_url_lenght_desc']),
		'',
		array('check', 'seo_url_enable_stopwords', 'subtext' => $txt['seo_url_enable_stopwords_desc']),
		array('large_text', 'seo_url_stopwords', '10', 'subtext' => $txt['seo_url_stopwords_desc']),
	);
	
	// Warning about pretty urls installed
	if (isset($_GET['prettyinstalled']))	
		array_unshift($config_vars, array('warning', 'seo_pretty_urls_installed'));
	
	// Saving?
	if (isset($_GET['save']))
	{
		// Do the test before enabling thing...
		$is_new_pretty = empty($modSettings['enable_pretty_urls']) && !empty($_POST['enable_pretty_urls']);
		
		if ($is_new_pretty)
			$_POST['enable_pretty_urls'] = 0;
		
		// Save remaining vars!
		saveDBSettings($config_vars);
		
		// Enabling pretty urls? Add the htaccess file!
		if ($is_new_pretty)
		{
			// Pretty Urls mod installed?
			if (file_exists($sourcedir . '/PrettyUrls.php') && !empty($modSettings['pretty_enable_filters']))
			{
				redirectexit('action=admin;area=seo_settings;sa=seo_settings;prettyinstalled');
			}
			else
			{
				// Do the htaccess thing!
				if (!$context['server']['is_nginx'] && !$context['server']['is_iis'])
					create_htaccess(true);
				else if (!$context['server']['is_iis'])
					create_webconfig(true);
				
				// Now redirect to a page where this can be confirmed!
				redirectexit('action=admin;area=seo_settings;sa=seo_settings;confirmpretty');
			}
		}
		else
			redirectexit('action=admin;area=seo_settings;sa=seo_settings');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_settings;save';	
	prepareDBSettingContext($config_vars);
}

function seo_sitemap($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_admin_settings'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_settings_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
	    array('check', 'seo_enable_sitemap'),
	    array('check', 'seo_sitemap_xml'),
	    array('check', 'seo_enable_compressed_xml', 'subtext' => $txt['seo_enable_compressed_xml_desc']),
	    array('check', 'seo_sitemap_disable_style', 'subtext' => $txt['seo_sitemap_disable_style_desc']),
        array('int', 'seo_sitemap_topics'),
        array('select', 'seo_sitemap_show', array($txt['seo_none'], $txt['seo_both'], $txt['seo_menu'], $txt['seo_bottom'])),
        array('int', 'sitemap_url_limit', 'subtext' => $txt['sitemap_url_limit_desc']),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_sitemap');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_sitemap;save';	
	prepareDBSettingContext($config_vars);		
}

function seo_related($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $smcFunc;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_admin_settings'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_settings_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
        array('int', 'seo_related_topics', 'subtext' => $txt['seo_related_topics_desc']),
        array('check', 'seo_related_topics_samecat'),
        array('check', 'seo_disable_fulltext', 'subtext' => $txt['seo_disable_fulltext_desc']),
        '',
        array('check', 'seo_signature_once'),
        array('check', 'seo_replace_next_prev'),
        array('check', 'seo_disable_quotes_for_guests', 'subtext' => $txt['seo_disable_quotes_for_guests_desc']),
        '',
        array('check', 'seo_topics_board_pagination'),
        '',
        array('check', 'seo_topics_title_pagination'),
        array('text', 'seo_topics_title_format', 'size' => 65, 'subtext' => $txt['seo_topics_title_format_desc']),
	);
		
	if (isset($_GET['save']))
	{
		// They have an index defined?
		if (!empty($_POST['seo_related_topics']) && empty($_POST['seo_disable_fulltext']) && $smcFunc['db_title'] == 'MySQL')
		{
			$dbresponse = $smcFunc['db_query']('', '
			SHOW INDEX
			FROM {db_prefix}messages
			WHERE Index_type = {string:fulltext}
				AND Column_name = {string:subject}',
				array(
					'fulltext' => 'FULLTEXT',
					'subject' => 'subject'
				)
			);
			
			if ($smcFunc['db_num_rows']($dbresponse) == 0)
			{
				$smcFunc['db_query']('',
					'ALTER TABLE {db_prefix}messages ADD FULLTEXT(subject)',
					array(
					)
				);
			}
		}
		
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_related');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_related;save';	
	prepareDBSettingContext($config_vars);		
}

function seo_posted($return_config = false)
{
	global $txt, $scripturl, $context, $sourcedir, $modSettings;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_admin_settings'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_settings_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');
    
    $config_vars = array(
    	array('check', 'seo_internal_same_window', 'subtext' => $txt['seo_internal_same_window_desc']),
    	'',
    	array('check', 'seo_redirect_external', 'subtext' => $txt['seo_redirect_external_desc']),
    	array('int', 'seo_redirect_delay', 'postinput' => $txt['seo_seconds']),
    	'',
    	array('check', 'seo_add_title_urls', 'subtext' => $txt['seo_add_title_urls_desc']),
    	array('large_text', 'seo_add_title_urls_blacklist', '10', 'subtext' => $txt['seo_add_title_urls_blacklist_desc']),
    	'',
		array('check', 'seo_nofollow', 'subtext' => $txt['seo_nofollow2']),
        array('large_text', 'seo_nofollow_whitelist', '10', 'subtext' => $txt['seo_nofollow_whitelist_desc']),
        array('large_text', 'seo_nofollow_blacklist', '10', 'subtext' => $txt['seo_nofollow_blacklist_desc']),
    );
    
     // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];
    
    if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_posted');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_posted;save';	
	prepareDBSettingContext($config_vars);
}

function seo_guests_theme($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_admin_settings'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_settings_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');
    require_once($sourcedir . '/Themes.php');

    if (file_exists($sourcedir . '/Subs-Themes.php'))
    	require_once($sourcedir . '/Subs-Themes.php');

    ThemeList();

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
	    array('check', 'seo_enable_guest_theme'),
	);
	
	$themes = array();
	foreach ($context['themes'] as $i => $theme)
		$themes[$theme['id']] = $theme['name'];
	
	$config_vars[] = array('select', 'seo_guests_theme', $themes);
	
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_guests_theme');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_guests_theme;save';	
	prepareDBSettingContext($config_vars);		
}

function seo_linkbacks($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_linkbacks'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_linkbacks_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_linkbacks'];	
	
	$config_vars = array(
		array('select', 'seo_enable_linkback', array($txt['seo_linkback_off'], $txt['seo_linkback_onguests'], $txt['seo_linkback_on']), 'subtext' => $txt['seo_enable_linkback_desc']),
		'',
        array('check', 'seo_ping', 'subtext' => $txt['seo_ping_desc']),
        '',
        array('int', 'seo_ping_sitemap_frequency', 'subtext' => $txt['seo_ping_sitemap_frequency_desc'], 'postinput' => $txt['seo_days']),
        array('check', 'seo_ping_sitemap_bing'),
        array('check', 'seo_ping_sitemap_google'),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_linkbacks');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_linkbacks;save';	
	prepareDBSettingContext($config_vars);		
}

function seo_ga($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_ga'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_ga_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
		array('text', 'seo_g4a_code', 'subtext' => $txt['seo_g4a_code_desc']),
		'',
    	array('text', 'seo_ga_code', 'subtext' => $txt['seo_ga_code_desc']),
    	array('check', 'seo_ga_outbound', 'subtext' => $txt['seo_ga_outbound_desc']),
    	array('check', 'seo_ga_anonymize', 'subtext' => $txt['seo_ga_anonymize_desc']),
    	array('text', 'seo_ga_api', 'subtext' => $txt['seo_ga_api_desc']),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_ga');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_ga;save';	
	prepareDBSettingContext($config_vars);
}

function seo_misc($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_misc'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_misc'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_misc'];	
	
	$config_vars = array(
		array('check', 'seo_disable_warnings', 'subtext' => $txt['seo_disable_warnings_desc']),
		'',
		'<a href="http://crazyegg.com/">' . $txt['seo_crazyegg'] . '</a>',
		array('text', 'seo_crazyegg_account'),
		'',
		'<a href="http://statcounter.com/">' . $txt['seo_statcounter'] . '</a>',
		array('text', 'seo_statcounter_project'),
        array('text', 'seo_statcounter_security'),
        '',
        '<a href="http://www.onestat.com/">' . $txt['seo_onestat_page'] . '</a>',
		array('text', 'seo_onestat'),		
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_misc');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_misc;save';	
	prepareDBSettingContext($config_vars);
}

function seo_optimize()
{
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_optimize'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_optimize_description'];
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
		array('select', 'seo_optimize_images_alt', array($txt['seo_none'], $txt['seo_optimize_alt_both'], $txt['seo_optimize_alt_empty'], $txt['seo_optimize_alt_without']), 'subtext' => $txt['seo_images_description']),
		array('text', 'seo_optimize_alt_format', 'subtext' => $txt['seo_optimize_title_format_suggestion']),
		array('select', 'seo_optimize_images_title', array($txt['seo_none'], $txt['seo_optimize_title_both'], $txt['seo_optimize_title_empty'], $txt['seo_optimize_title_without']), 'subtext' => $txt['seo_images_description']),
		array('text', 'seo_optimize_title_format', 'subtext' => $txt['seo_optimize_title_format_suggestion']),
		'',
		array('check', 'seo_cleanup_html', 'subtext' => $txt['seo_cleanup_html_description'], 'javascript' => 'onchange="check_checkbox(\'seo_cleanup_html\');"'),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_settings;sa=seo_optimize');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_settings;sa=seo_optimize;save';	
	prepareDBSettingContext($config_vars);

	$context['insert_after_template'] .= '
	<script type="text/javascript">
		function check_checkbox(el)
		{
			if (document.getElementById(el).checked == true) {
		    	document.getElementById(el).checked = confirm(' . JavascriptEscape($txt['quickmod_confirm']) . ');
		    }
		}
	</script>';
}

function seo_custom_meta_tags()
{
	global $txt, $modSettings, $context, $smcFunc;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_custom_meta_tags'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_custom_meta_tags_desc'];
	
	if (!empty($_POST['save_censor']))
	{
		// Make sure censoring is something they can do.
		checkSession();

		$censored_vulgar = array();
		$censored_proper = array();

		// Rip it apart, then split it into two arrays.
		if (isset($_POST['censortext']))
		{
			$_POST['censortext'] = explode("\n", strtr($_POST['censortext'], array("\r" => '')));

			foreach ($_POST['censortext'] as $c)
				list ($censored_vulgar[], $censored_proper[]) = array_pad(explode('=', trim($c)), 2, '');
		}
		elseif (isset($_POST['censor_vulgar'], $_POST['censor_proper']))
		{
			if (is_array($_POST['censor_vulgar']))
			{
				foreach ($_POST['censor_vulgar'] as $i => $value)
					if ($value == '')
						unset($_POST['censor_vulgar'][$i], $_POST['censor_proper'][$i]);

				$censored_vulgar = $_POST['censor_vulgar'];
				$censored_proper = $_POST['censor_proper'];
			}
			else
			{
				$censored_vulgar = explode("\n", strtr($_POST['censor_vulgar'], array("\r" => '')));
				$censored_proper = explode("\n", strtr($_POST['censor_proper'], array("\r" => '')));
			}
		}

		// Set the new arrays and settings in the database.
		$updates = array(
			'seo_custom_meta_name' => implode("\n", $censored_vulgar),
			'seo_custom_meta_content' => implode("\n", $censored_proper),
		);

		updateSettings($updates);
	}
	
	// Set everything up for the template to do its thang.
	$censor_vulgar = empty($modSettings['seo_custom_meta_name']) ? array() : explode("\n", $modSettings['seo_custom_meta_name']);
	$censor_proper = empty($modSettings['seo_custom_meta_content']) ? array() : explode("\n", $modSettings['seo_custom_meta_content']);

	$context['censored_words'] = array();
	for ($i = 0, $n = count($censor_vulgar); $i < $n; $i++)
	{
		if (empty($censor_vulgar[$i]))
			continue;

		// Skip it, it's either spaces or stars only.
		if (trim(strtr($censor_vulgar[$i], '*', ' ')) == '')
			continue;

		$context['censored_words'][htmlspecialchars(trim($censor_vulgar[$i]))] = isset($censor_proper[$i]) ? htmlspecialchars($censor_proper[$i]) : '';
	}

	$context['sub_template'] = 'seo_custom_meta_tags';
	$context['page_title'] = $txt['seo_custom_meta_tags'];
}

function seo_redirects()
{
	global $txt, $modSettings, $context, $smcFunc;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_redirects'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_acronym_parser_desc'];
	
	if (!empty($_POST['save_censor']))
	{
		// Make sure censoring is something they can do.
		checkSession();

		$censored_vulgar = array();
		$censored_proper = array();

		// Rip it apart, then split it into two arrays.
		if (isset($_POST['censortext']))
		{
			$_POST['censortext'] = explode("\n", strtr($_POST['censortext'], array("\r" => '')));

			foreach ($_POST['censortext'] as $c)
				list ($censored_vulgar[], $censored_proper[]) = array_pad(explode('=', trim($c)), 2, '');
		}
		elseif (isset($_POST['censor_vulgar'], $_POST['censor_proper']))
		{
			if (is_array($_POST['censor_vulgar']))
			{
				foreach ($_POST['censor_vulgar'] as $i => $value)
					if ($value == '')
						unset($_POST['censor_vulgar'][$i], $_POST['censor_proper'][$i]);

				$censored_vulgar = $_POST['censor_vulgar'];
				$censored_proper = $_POST['censor_proper'];
			}
			else
			{
				$censored_vulgar = explode("\n", strtr($_POST['censor_vulgar'], array("\r" => '')));
				$censored_proper = explode("\n", strtr($_POST['censor_proper'], array("\r" => '')));
			}
		}

		// Set the new arrays and settings in the database.
		$updates = array(
			'seo_301_from' => implode("\n", $censored_vulgar),
			'seo_301_to' => implode("\n", $censored_proper),
		);

		updateSettings($updates);
	}
	
	// Set everything up for the template to do its thang.
	$censor_vulgar = empty($modSettings['seo_301_from']) ? array() : explode("\n", $modSettings['seo_301_from']);
	$censor_proper = empty($modSettings['seo_301_to']) ? array() : explode("\n", $modSettings['seo_301_to']);

	$context['censored_words'] = array();
	for ($i = 0, $n = count($censor_vulgar); $i < $n; $i++)
	{
		if (empty($censor_vulgar[$i]))
			continue;

		// Skip it, it's either spaces or stars only.
		if (trim(strtr($censor_vulgar[$i], '*', ' ')) == '')
			continue;

		$context['censored_words'][htmlspecialchars(trim($censor_vulgar[$i]))] = isset($censor_proper[$i]) ? htmlspecialchars($censor_proper[$i]) : '';
	}

	$context['sub_template'] = 'seo_redirects';
	$context['page_title'] = $txt['seo_redirects'];
}

// Based on SMF Censor
function seo_acronym_parser()
{
	global $txt, $modSettings, $context, $smcFunc;

	if (!empty($_POST['save_censor']))
	{
		// Make sure censoring is something they can do.
		checkSession();

		$censored_vulgar = array();
		$censored_proper = array();

		// Rip it apart, then split it into two arrays.
		if (isset($_POST['censortext']))
		{
			$_POST['censortext'] = explode("\n", strtr($_POST['censortext'], array("\r" => '')));

			foreach ($_POST['censortext'] as $c)
				list ($censored_vulgar[], $censored_proper[]) = array_pad(explode('=', trim($c)), 2, '');
		}
		elseif (isset($_POST['censor_vulgar'], $_POST['censor_proper']))
		{
			if (is_array($_POST['censor_vulgar']))
			{
				foreach ($_POST['censor_vulgar'] as $i => $value)
					if ($value == '')
						unset($_POST['censor_vulgar'][$i], $_POST['censor_proper'][$i]);

				$censored_vulgar = $_POST['censor_vulgar'];
				$censored_proper = $_POST['censor_proper'];
			}
			else
			{
				$censored_vulgar = explode("\n", strtr($_POST['censor_vulgar'], array("\r" => '')));
				$censored_proper = explode("\n", strtr($_POST['censor_proper'], array("\r" => '')));
			}
		}

		// Set the new arrays and settings in the database.
		$updates = array(
			'acronym_parser_seek' => implode("\n", $censored_vulgar),
			'acronym_parser_destroy' => implode("\n", $censored_proper),
			'acronymWholeWord' => empty($_POST['acronymWholeWord']) ? '0' : '1',
			'acronymIgnoreCase' => empty($_POST['acronymIgnoreCase']) ? '0' : '1',
		);

		updateSettings($updates);
	}
	
	// Set everything up for the template to do its thang.
	$censor_vulgar = empty($modSettings['acronym_parser_seek']) ? array() : explode("\n", $modSettings['acronym_parser_seek']);
	$censor_proper = empty($modSettings['acronym_parser_destroy']) ? array() : explode("\n", $modSettings['acronym_parser_destroy']);

	$context['censored_words'] = array();
	for ($i = 0, $n = count($censor_vulgar); $i < $n; $i++)
	{
		if (empty($censor_vulgar[$i]))
			continue;

		// Skip it, it's either spaces or stars only.
		if (trim(strtr($censor_vulgar[$i], '*', ' ')) == '')
			continue;

		$context['censored_words'][htmlspecialchars(trim($censor_vulgar[$i]))] = isset($censor_proper[$i]) ? htmlspecialchars($censor_proper[$i]) : '';
	}

	$context['sub_template'] = 'edit_acronym_parser';
	$context['page_title'] = $txt['seo_acronym'];
}

function seo_htaccess($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_htaccess'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_htaccess_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');
	$modSettings['seo_htaccess'] = file_exists($boarddir . '/.htaccess') ? file_get_contents($boarddir . '/.htaccess') : '';
	
	if (!empty($modSettings['seo_htaccess_default']) && trim($modSettings['seo_htaccess_default']) != '')
		$modSettings['seo_htaccess'] = str_replace('

' . $modSettings['seo_htaccess_default'], '', $modSettings['seo_htaccess']);

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
	    array('large_text', 'seo_htaccess', '30', 'subtext' => $txt['seo_htaccess_2']),
	    '',
	    array('large_text', 'seo_htaccess_default', '20', 'subtext' => $txt['seo_htaccess_default_2']),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		if (file_exists($boarddir . '/.htaccess'))
		{
			$htaccess = stripslashes($modSettings['seo_htaccess']);
			
			if (!empty($modSettings['seo_htaccess_default']) && trim($modSettings['seo_htaccess_default']) != '')
				$htaccess .= '

' . $modSettings['seo_htaccess_default'];
			
	    	file_put_contents($boarddir . '/.htaccess', $htaccess);
		}
		redirectexit('action=admin;area=htaccess;sa=htaccess');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=htaccess;sa=htaccess;save';	
	prepareDBSettingContext($config_vars);		
}

function seo_robots($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_robots'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_robots_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');
	$modSettings['seo_robots'] = file_exists($boarddir . '/robots.txt') ? file_get_contents($boarddir . '/robots.txt') : '';
	
	// Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_settings'];	
	
	$config_vars = array(
	    array('large_text', 'seo_robots', '30', 'subtext' => $txt['seo_robots_description']),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		if (file_exists($boarddir . '/robots.txt'))
		{
			$robots = stripslashes($modSettings['seo_robots']);
			file_put_contents($boarddir . '/robots.txt', $robots);
		}
		redirectexit('action=admin;area=seo_robots;sa=seo_robots');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_robots;sa=seo_robots;save';	
	prepareDBSettingContext($config_vars);		
}

function seo_meta_tags($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	// Looking for the other tab?
	if (isset($_GET['sa']) && $_GET['sa'] == 'custom')
		return seo_custom_meta_tags();
	else if (isset($_GET['sa']) && $_GET['sa'] == 'social')
		return seo_social_meta_tags();
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_meta'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_meta_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_meta'];	
	
	$config_vars = array(
		array('check', 'seo_custom_meta', 'subtext' => $txt['seo_custom_meta_desc']),
		array('int', 'seo_meta_lenght', 'subtext' => $txt['seo_meta_lenght_desc']),
	    array('text', 'seo_site_description', 'postinput' => ' (<span id="seo_site_description_counter">' . 0 . '</span>)', '60', 'subtext' => $txt['seo_site_description_desc']),		
		array('text', 'seo_meta_keywords', 'postinput' => ' (<span id="seo_meta_keywords_counter">' . 0 . '</span>)', '60', 'subtext' => $txt['seo_meta_keywords_desc']),
		array('text', 'seo_meta_desc_profile', 'postinput' => ' (<span id="seo_meta_desc_profile_counter">' . 0 . '</span>)', '60', 'subtext' => $txt['seo_meta_desc_profile_desc']),
		'',
        array('text', 'seo_meta_verification_google', '60', 'subtext' => '<a href="https://www.google.com/webmasters/tools/home" rel="_blank">Google Webmaster Tools</a>'),
        array('text', 'seo_meta_verification_bing_name', '60', 'subtext' => '<a href="https://www.bing.com/webmaster" rel="_blank">Bing Webmaster Tools</a>'),
        array('text', 'seo_meta_verification_bing_content', '60'),
        array('text', 'seo_meta_verification_alexa', '60', 'subtext' => '<a href="https://www.alexa.com/siteowners" rel="_blank">Alexa Site Tools</a>'),
		'',
        array('text', 'seo_meta_tag_copyright_text', 'subtext' => $txt['seo_meta_tag_copyright_2']),
		array('text', 'seo_meta_tag_author_text', 'subtext' => $txt['seo_meta_tag_author_2']),
        array('text', 'seo_meta_tag_language_text', 'subtext' => $txt['seo_meta_tag_language_2']),
		array('text', 'seo_meta_tag_publisher_text', 'subtext' => $txt['seo_meta_tag_publisher_2']),
        array('text', 'seo_meta_tag_audience_text', 'subtext' => $txt['seo_meta_tag_audience_2']),
        '',
        array('check', 'seo_meta_tag_noydir'),
        array('check', 'seo_meta_tag_noodp'),
        array('check', 'seo_meta_tag_noarchive'),
        array('check', 'seo_meta_tag_nosnippet'),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);		
		redirectexit('action=admin;area=seo_meta;sa=metadata');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_meta;sa=metadata;save';	
	prepareDBSettingContext($config_vars);
	
	$context['insert_after_template'] .= '
	<script type="text/javascript">
		seo_count_it(\'seo_site_description\');
		seo_count_it(\'seo_meta_keywords\');
		seo_count_it(\'seo_meta_desc_profile\');
		document.getElementById(\'seo_site_description\').setAttribute(\'onkeyup\', \'seo_count_it("seo_site_description");\');
		document.getElementById(\'seo_meta_keywords\').setAttribute(\'onkeyup\', \'seo_count_it("seo_meta_keywords");\');
		document.getElementById(\'seo_meta_desc_profile\').setAttribute(\'onkeyup\', \'seo_count_it("seo_meta_desc_profile");\');
		
		function seo_count_it(el)
		{
			var longitud = document.getElementById(el).value.length;
			if (longitud < 150)
				document.getElementById(el + \'_counter\').style.color = \'inherit\';
			else
				document.getElementById(el + \'_counter\').style.color = \'red\';
			
			document.getElementById(el + \'_counter\').innerHTML = longitud;
		}
	</script>';
}

function seo_social_meta_tags($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings, $boarddir;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $context['page_title'] = $txt['seo_social_meta_tags'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_social_meta_tags_desc'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	
    require_once($sourcedir . '/ManageServer.php');

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';	
	
	$config_vars = array(
		array('check', 'seo_open_graph_images', 'subtext' => $txt['seo_open_graph_images_desc']),
		'',
		array('text', 'seo_twitter_card', 'subtext' => $txt['seo_twitter_card_desc']),
		array('check', 'seo_twitter_card_images', 'subtext' => $txt['seo_twitter_card_images_desc']),
		'',
        array('check', 'seo_google_plus_tags_images', 'subtext' => $txt['seo_google_plus_tags_images_desc']),
	);
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);		
		redirectexit('action=admin;area=seo_meta;sa=social');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_meta;sa=social;save';	
	prepareDBSettingContext($config_vars);
}

function seo_admin_bookmarks($return_config = false)
{    
	global $txt, $scripturl, $context, $sourcedir, $modSettings;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_admin_bookmarks'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_bookmarks_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_bookmarks'];	

	// We need this 
	require_once($sourcedir.'/ManageServer.php');
	
	$bookmarks = array(
      'facebook',
      'linkedin',
      'pinterest',
      'reddit',
      'telegram',
      'tumblr',
      'twitter',
      'whatsapp',
   );	
	
	if (isset($_REQUEST['sa']) && ($_REQUEST['sa'] == 'seo_posts'))
	    $config_vars = array();
	else
	{   
		$config_vars = array(
	        array('check', 'social_facebook'),
		);
	}
	
	foreach ($bookmarks AS $site)
	{
	    if (isset($_REQUEST['sa']) && ($_REQUEST['sa'] == 'seo_posts'))
	    {
	        $txt['social_post_'.$site] = sprintf($txt['social_posts'], $site);
	        $config_vars[] = array('check', 'social_post_'.$site);
	    }
	    else
	    {    
		    $txt['social_topic_'.$site] = sprintf($txt['social_topics'], $site);
		    $config_vars[] = array('check', 'social_topic_'.$site);
	    }
	}
	
	if (isset($_REQUEST['sa']) && ($_REQUEST['sa'] == 'seo_posts'))
	   $sa = ';sa='.$_REQUEST['sa'];
	else
	   $sa = '';   
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_bookmarks'.$sa);
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_bookmarks'.$sa.';save';	
	prepareDBSettingContext($config_vars);		
}

function seo_admin()
{
	global $context, $txt, $scripturl, $smcFunc, $settings, $modSettings;

	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_version'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_version_description'];
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);
	    
	// Load stats language
	loadLanguage('Stats');
	
	// Enabling tracking?
	if (isset($_GET['enableTracking']) && empty($modSettings['hitStats']))
	{
		updateSettings(array('hitStats' => 1));
		$modSettings['hitStats'] = 1;
	}
		
	// Get data for graph!
	if (!empty($modSettings['hitStats']))
	{
		// Define wanted month and year
		$month = isset($_REQUEST['month']) ? $_REQUEST['month'] : date('n');
		$year = isset($_REQUEST['year']) ? $_REQUEST['year'] : date('Y');
		$yearly_view = isset($_REQUEST['nomonth']) && $_REQUEST['nomonth'] == 1 ? true : false;
		
		// Cached?
		if (($context['seo_log_activity'] = cache_get_data('seo_log_activity_all' . ($yearly_view ? 1 : 0) . '_' . $year . '_' . $month, 720)) === null)
		{
			// Include month?
			$where = 'WHERE YEAR(date) = {raw:year}';
			$add_select = '';
			if (!$yearly_view)
			{
				$where .= ' AND MONTH(date) = {raw:month}';
				$date_index = 'j';
			}
			else
			{
				$where .= "\n\t" . "GROUP BY YEAR(date), MONTH(date)";
				$date_index = 'm';
				$add_select = ', MONTH(date) AS month_number';
			}
			
			// Retrieve data!
			$request = $smcFunc['db_query']('', '
				SELECT date, registers, hits' . $add_select . '
				FROM {db_prefix}log_activity
				' . $where,
				array(
					'month' => isset($_REQUEST['month']) ? $_REQUEST['month'] : 'MONTH(NOW())',
					'year' => isset($_REQUEST['year']) ? $_REQUEST['year'] : 'YEAR(NOW())'
				)
			);
			$context['seo_log_activity'] = array();
			while ($row = $smcFunc['db_fetch_assoc']($request))
			{
				if ($yearly_view && isset($context['seo_log_activity'][$row['month_number']]))
				{
					$context['seo_log_activity'][$row['month_number']]['registers'] += $row['registers'];
					$context['seo_log_activity'][$row['month_number']]['hits'] += $row['hits'];
				}
				else if ($yearly_view)
					$context['seo_log_activity'][$row['month_number']] = $row;
				else
					$context['seo_log_activity'][date($date_index, strtotime($row['date']))] = $row;
			}
			$smcFunc['db_free_result']($request);
			
			cache_put_data('seo_log_activity_all' . ($yearly_view ? 1 : 0) . '_' . $year . '_' . $month, $context['seo_log_activity'], 720);
		}
		
		// Include Javascript
		$context['html_headers'] .= '
	<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/seo/jquery.js"></script>
	<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/seo/jquery.flot.js"></script>
	<script type="text/javascript"><!-- // --><![CDATA[
		var $jnoconflict = jQuery.noConflict();
		$jnoconflict(document).ready(function() {';
		
		// Prepare vars
		$flot_datas_views = $flot_datas_register = array();
		
		// How many days?
		$max = $yearly_view ? 12 : cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
		
		// Look for it!
		for ($i = 1; $i <= $max; ++$i)
		{
			// We do have an entry!
			if (isset($context['seo_log_activity'][$i]))
			{
				$flot_datas_views[] = '[' . $i . ',' . $context['seo_log_activity'][$i]['hits'] . ']';
				$flot_datas_register[] = '[' . $i . ',' . $context['seo_log_activity'][$i]['registers'] . ']';
			}
			// Nothing?
			else
			{
				$flot_datas_views[] = '[' . $i . ',0]';
				$flot_datas_register[] = '[' . $i . ',0]';
			}
		}
			  
		$context['html_headers'] .= '
			  $jnoconflict(\'#placeholder\').css({
			    height: \'400px\',
			    width: \'750px\'
			  });
			  $jnoconflict.plot($jnoconflict(\'#placeholder\'),[
			      { label: ' . JavascriptEscape($txt['num_hits']) . ', data: [' . implode(',', $flot_datas_views) . '] },
			      { label: ' . JavascriptEscape($txt['stats_new_members']) . ', data: [' . implode(',', $flot_datas_register) . '] }
			    ],{
			          lines: { show: true },
			          points: { show: true },
			          grid: { backgroundColor: \'#fffaff\' }
			  });
			}
		);
	// ]]></script>';
	}
	
	// Configure a few things
	$context['page_title'] = $txt['seo_version'];
	$context['sub_template'] = 'seo_admin_panel';
	
	// Log of Spiders
	if (($context['seo_spiders_log'] = cache_get_data('seo_latest_spiders', 300)) === null)
	{
		$request = $smcFunc['db_query']('', '
			SELECT sl.id_spider, sl.url, sl.log_time, s.spider_name
			FROM {db_prefix}log_spider_hits AS sl
				INNER JOIN {db_prefix}spiders AS s ON (s.id_spider = sl.id_spider)
			ORDER BY sl.log_time DESC
			LIMIT 5',
			array(
			)
		);
		$context['seo_spiders_log'] = array();
		while ($row = $smcFunc['db_fetch_assoc']($request))
			$context['seo_spiders_log'][] = $row;
		$smcFunc['db_free_result']($request);
		cache_put_data('seo_latest_spiders', $context['seo_spiders_log'], 300);
	}
	
	// Warnings
	if (empty($modSettings['seo_disable_warnings']) && ($context['seo_warnings_portal'] = cache_get_data('seo_warnings_portal', 300)) === null)
	{
		$request = $smcFunc['db_query']('', '
			SELECT id_warn, entry
			FROM {db_prefix}log_seo_warning
			WHERE dismiss = 0
			ORDER BY log_time DESC
			LIMIT 5',
			array(
			)
		);
		$context['seo_warnings_portal'] = array();
		while ($row = $smcFunc['db_fetch_assoc']($request))
		{
			if ($row['entry'] == '')
				$context['seo_warnings_portal'][] = $txt['seo_warn_' . $row['id_warn']];
			else
				$context['seo_warnings_portal'][] = $txt['seo_warn_error'];	
		}
		$smcFunc['db_free_result']($request);
		cache_put_data('seo_warnings_portal', $context['seo_warnings_portal'], 600);
	}
	
	// Footer Menu
	$context['seo_menu'] = array(
		'settings' => array( $scripturl . '?action=admin;area=seo_settings;sa=seo_settings', 'settings.png'),
		'sitemap' => array( $scripturl . '?action=admin;area=seo_settings;sa=seo_sitemap', 'sitemap.png'),
		'meta' => array( $scripturl . '?action=admin;area=seo_meta', 'meta.png'),
		'404' => array( $scripturl . '?action=admin;area=seo_errors', '404.png'),
		'bookmarks' => array( $scripturl . '?action=admin;area=seo_bookmarks;sa=seo_topic', 'bookmarks.png'),
		'acronym' => array( $scripturl . '?action=admin;area=seo_acronym', 'acronym.png'),
		'tags' => array( $scripturl . '?action=admin;area=seo_cloud', 'tags.png'),
		'ticket' => array( 'http://www.smfpacks.com/index.php?action=helpdesk;sa=newticket', 'ticket.png'),
	);
}

function seo_admin_error_pages()
{
    global $txt, $scripturl, $context, $sourcedir, $modSettings;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_admin_errorpages'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_admin_errorpages_description'];	
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage'))
	    fatal_lang_error('seo_no_permission', false);

    // Set title and default sub-action.
    $context['sub_template'] = 'show_settings';
    $context['page_title'] = $txt['seo_admin_errorpages'];	

	// We need this 
	require_once($sourcedir.'/ManageServer.php');
	
	$config_vars = array(
		array('check', 'seo_apache_errors', 'subtext' => $txt['seo_apache_errors_desc']),
	    array('check', 'seo_nofollow_error', 'subtext' => $txt['seo_nofollow_error2']),
		array('select', 'seo_error404', array('smf' => &$txt['seo_error404_smf'], 'custom' => &$txt['seo_error404_custom'],), ''),
        array('large_text', 'seo_error404_custompage', '25', 'subtext' => $txt['seo_error404_custompage2']),		
	);	
		
	if (isset($_GET['save']))
	{
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=seo_errors');
	}
	$context['post_url'] = $scripturl .'?action=admin;area=seo_errors;save';	
	prepareDBSettingContext($config_vars);
}

function seo_tags_cloud()
{
	global $smcFunc, $context, $txt, $modSettings, $settings;
	
	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_cloud'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_cloud_desc'];
	
	if (isset($_GET['sa']) && $_GET['sa'] === 'seo_cloud_popular_tags')
	{
		$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_cloud_popular_tags'];
		$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_cloud_popular_tags_desc'];
	
		$context['html_headers'] .= '<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/seo/jquery.js"></script>
		<script type="text/javascript">
			var $jnoconflict = jQuery.noConflict();
		</script>
	<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/seo/jqBarGraph.1.1.min.js"></script>
	<script type="text/javascript" src="' . $settings['default_theme_url'] . '/scripts/seo/jquery.flot.js"></script>';
	
		$context['popular_tags'] = array();
		$query = $smcFunc['db_query']('', '
			SELECT hits, tag
			FROM {db_prefix}seo_tags
			ORDER BY hits ASC');
			
		while($row = $smcFunc['db_fetch_assoc']($query))
		{
			$context['popular_tags'][$row['tag']] = $row['hits'];
		}
		$smcFunc['db_free_result']($query);
		$context['sub_template'] = 'seo_cloud_popular_tags';
	}
	else
	{
		if (isset($_GET['save']))
		{
			$settings = array();
			$final = '';
			if (!empty($_POST['seo_cloud_reset']))
			{
				$smcFunc['db_query']('', '
					UPDATE {db_prefix}seo_tags
					SET hits = {int:zero}',
					array(
						'zero' => 0,
					)
				);
				$final = ';hits';
			}
			
			if (!empty($_POST['seo_cloud_clean']))
			{
				$smcFunc['db_query']('', 'TRUNCATE {db_prefix}seo_tags');
				$final = ';clean';
			}
		
			if (isset($_POST['bannedtags']) && is_array($_POST['bannedtags']))
			{
				$tags = array();
				foreach ($_POST['bannedtags'] as $i => $value)
					if ($value != '')
						$tags[] = str_replace(' ', '+', $value);
				
				$settings['seo_banned_tags'] = !empty($tags) ? implode("\n", $tags) : '';
			}
		
			$settings['seo_cloud_index'] = empty($_POST['seo_cloud_index']) ? '0' : '1';
			$settings['seo_cloud_boards'] = empty($_POST['seo_cloud_boards']) ? '0' : '1';
			$settings['seo_cloud_topics'] = empty($_POST['seo_cloud_topics']) ? '0' : '1';
			$settings['seo_tag_together'] = empty($_POST['seo_tag_together']) ? '0' : '1';
			$settings['seo_tag_only_guests'] = empty($_POST['seo_tag_only_guests']) ? '0' : '1';
			$settings['seo_tag_min'] = !empty($_POST['seo_tag_min']) && is_numeric($_POST['seo_tag_min']) ? $_POST['seo_tag_min'] : 0;
			$settings['seo_tag_max'] = !empty($_POST['seo_tag_max']) && is_numeric($_POST['seo_tag_max']) ? $_POST['seo_tag_max'] : 0;
			updateSettings($settings);
			redirectexit('action=admin;area=seo_cloud' . $final);
		}
		
		$banned_tags = empty($modSettings['seo_banned_tags']) ? array() : explode("\n", $modSettings['seo_banned_tags']);
		$context['banned_tags'] = array();
		
		foreach ($banned_tags as $tag)
		{
			$tag = str_replace('+', ' ', $tag);
			
			if (empty($tag))
				continue;
	
			// Skip it, it's either spaces or stars only.
			if (trim(strtr($tag, '*', ' ')) == '')
				continue;
	
			$context['banned_tags'][] = $tag;
		}
		
		$context['sub_template'] = 'seo_cloud';
	}
	
	$context['page_title'] = $context[$context['admin_menu_name']]['tab_data']['title'];
}

function seo_admin_warning()
{
	global $context, $txt, $scripturl, $modSettings, $smcFunc;

	$context[$context['admin_menu_name']]['tab_data']['title'] = $txt['seo_warning'];
	$context[$context['admin_menu_name']]['tab_data']['description'] = $txt['seo_warning_description'];
	
	// You aren't admin?? Please you can`t be here
	if (!allowedTo('seo_manage') || !empty($modSettings['seo_disable_warnings']))
	    fatal_lang_error('seo_no_permission', false);
	
	$context['page_title'] = $txt['seo_warning'];
	$context['sub_template'] = 'seo_warning';
	
	if (isset($_REQUEST['w']))
	{
		$smcFunc['db_query']('', '
			UPDATE {db_prefix}log_seo_warning
			SET dismiss = 1
			WHERE id_warn = {string:warn}',
			array(
				'warn' => $_REQUEST['w'],
			)
		);
	}
	else if (isset($_REQUEST['killemall']))
		$smcFunc['db_query']('', '
			TRUNCATE {db_prefix}log_seo_warning');
	
	$request = $smcFunc['db_query']('', '
		SELECT COUNT(1) AS total
		FROM {db_prefix}log_seo_warning
		WHERE dismiss = 0');
	list ($total) = $smcFunc['db_fetch_row']($request);
	$smcFunc['db_free_result']($request);
	
	$context['start'] = $_REQUEST['start'];
	$context['page_index'] = constructPageIndex($scripturl . '?action=admin;area=seo_warning', $context['start'], $total, 20);
	
	// Warning!
	$request = $smcFunc['db_query']('', '
		SELECT id_warn, entry, log_time
		FROM {db_prefix}log_seo_warning
		WHERE dismiss = 0
		ORDER BY log_time DESC
		LIMIT {int:start}, 20',
		array(
     		'start' => $context['start'],
   		)
	);
	$context['seo_warnings'] = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		if ($row['entry'] == '')
			$context['seo_warnings'][$row['id_warn']] = timeformat($row['log_time']) . ': ' . $txt['seo_warn_' . $row['id_warn']];
		else
			$context['seo_warnings'][$row['id_warn']] = timeformat($row['log_time']) . ': ' . $row['entry'];	
	}
	$smcFunc['db_free_result']($request);
	cache_put_data('seo_warnings', $context['seo_warnings']);
}

function create_htaccess($testing = false)
{
	global $modSettings, $boarddir, $boardurl, $context;
	
	// Here we start the .htaccess file
	$file_name = $boarddir . '/.htaccess';
	$x = parse_url($boardurl);
	$boardpath = array_key_exists('path', $x) ? $x['path'] : '/';
	$contents = '';
	
	if (!empty($modSettings['enable_pretty_urls']) || $testing)
	{
	
	if ($context['server']['is_apache'])
	$contents .= '
<IfModule mod_rewrite.c>';

	$contents .= '
RewriteEngine on
# If the mod is not working property then remove the \'#\' from the next line.
# RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?seomod=$1 [L,QSA]';
			
	if ($context['server']['is_apache'])
	$contents .= '
</IfModule>';

	}
	
	// Errors are only available for Apache and LiteSpeed!
	if (isset($_SERVER['SERVER_SOFTWARE']) && (strpos($_SERVER['SERVER_SOFTWARE'], 'LiteSpeed') !== false || strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false) && !empty($modSettings['seo_apache_errors']))
		$contents .= '

# Errors!
ErrorDocument 400 ' . $boardpath . '/index.php?action=httperror;c=400
ErrorDocument 401 ' . $boardpath . '/index.php?action=httperror;c=401
ErrorDocument 402 ' . $boardpath . '/index.php?action=httperror;c=402
ErrorDocument 403 ' . $boardpath . '/index.php?action=httperror;c=403
ErrorDocument 404 ' . $boardpath . '/index.php?action=httperror;c=404
ErrorDocument 405 ' . $boardpath . '/index.php?action=httperror;c=405
ErrorDocument 406 ' . $boardpath . '/index.php?action=httperror;c=406
ErrorDocument 407 ' . $boardpath . '/index.php?action=httperror;c=407
ErrorDocument 408 ' . $boardpath . '/index.php?action=httperror;c=408
ErrorDocument 409 ' . $boardpath . '/index.php?action=httperror;c=409
ErrorDocument 410 ' . $boardpath . '/index.php?action=httperror;c=410
ErrorDocument 411 ' . $boardpath . '/index.php?action=httperror;c=411
ErrorDocument 412 ' . $boardpath . '/index.php?action=httperror;c=412
ErrorDocument 413 ' . $boardpath . '/index.php?action=httperror;c=413
ErrorDocument 414 ' . $boardpath . '/index.php?action=httperror;c=414
ErrorDocument 415 ' . $boardpath . '/index.php?action=httperror;c=415
ErrorDocument 416 ' . $boardpath . '/index.php?action=httperror;c=416
ErrorDocument 417 ' . $boardpath . '/index.php?action=httperror;c=417
ErrorDocument 500 ' . $boardpath . '/index.php?action=httperror;c=500
ErrorDocument 501 ' . $boardpath . '/index.php?action=httperror;c=501
ErrorDocument 502 ' . $boardpath . '/index.php?action=httperror;c=502
ErrorDocument 503 ' . $boardpath . '/index.php?action=httperror;c=503
ErrorDocument 504 ' . $boardpath . '/index.php?action=httperror;c=504
ErrorDocument 505 ' . $boardpath . '/index.php?action=httperror;c=505';

if (!empty($modSettings['seo_htaccess_default']) && trim($modSettings['seo_htaccess_default']) != '')
				$contents .= '

' . $modSettings['seo_htaccess_default'];
			
	if (file_exists($file_name))
	{
		if (file_exists($file_name . '~'))
		{
			if (file_exists($file_name . '~~'))
				@unlink($file_name . '~~');
			
			@rename($file_name . '~', $file_name . '~~');
		}
		@rename($file_name, $file_name . '~');
	}

	if ($handle = fopen($file_name, 'w'))
	{
		fwrite($handle, $contents);
		fclose($handle);
	}
}

function create_webconfig($testing = false)
{
	global $modSettings, $boarddir, $boardurl, $context;
	
	// Don't do it!
	if (empty($modSettings['enable_pretty_urls']) || $testing === false)
		return;
	
	// Here we start the .htaccess file
	$file_name = $boarddir . '/web.config';
	$contents = '<?xml version="1.0" encoding="UTF-8"?>
<configuration>
	<system.webServer>
		<rewrite>
			<rules>
				<rule name="SMFPacksSEO" stopProcessing="true">
					<match url="^(.*)$" ignoreCase="false" />
					<conditions logicalGrouping="MatchAll">
						<add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" pattern="" ignoreCase="false" />
						<add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" pattern="" ignoreCase="false" />
					</conditions>
					<action type="Rewrite" url="index.php?{R:1}" appendQueryString="true" />
				</rule>
			</rules>
		</rewrite>
	</system.webServer>
</configuration>';
	
	// Place the new config file
	if (file_exists($file_name))
	{
		if (file_exists($file_name . '~'))
		{
			if (file_exists($file_name . '~~'))
				@unlink($file_name . '~~');
			
			@rename($file_name . '~', $file_name . '~~');
		}
		@rename($file_name, $file_name . '~');
	}

	if ($handle = fopen($file_name, 'w'))
	{
		fwrite($handle, $contents);
		fclose($handle);
	}
}
