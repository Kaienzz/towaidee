<?php
//	Version: 1.0RC; PrettyUrls

if (!defined('SMF'))
	die('Hacking attempt...');

//	Shell for all the Pretty URL interfaces
function PrettyInterface()
{
	global $context, $scripturl, $settings, $txt;

	//	Keep the critters out
	isAllowedTo('admin_forum');

	//	Default templating stuff
	loadTemplate('PrettyUrls');
	if (loadLanguage('PrettyUrls') == false)
		loadLanguage('PrettyUrls', 'english');

	//	Shiny chrome interface
	$context['template_layers']['pretty_chrome'] = 'pretty_chrome';
	/*
	$context['html_headers'] .= '
	<link rel="stylesheet" type="text/css" href="' . $settings['default_theme_url'] . '/pretty/chrome.css" media="screen,projection" />';
	*/
	$context['pretty']['chrome'] = array(
		'admin' => true,
		'menu' => array(
			'settings' => array(
				'href' => $scripturl . '?action=admin;area=pretty;sa=settings',
				'title' => $txt['pretty_chrome_menu_settings'],
			),
			'nginx' => array(
				'href' => $scripturl . '?action=admin;area=pretty;sa=nginix',
				'title' => $txt['pretty_chrome_menu_nginx'],
			),
			'maintenance' => array(
				'href' => $scripturl . '?action=admin;area=pretty;sa=maintenance',
				'title' => $txt['pretty_chrome_menu_maintenance'],
			),

		),
		'title' => $txt['pretty_chrome_title'],
	);

	//	What can we do today?
	$subActions = array(
		'filters' => 'pretty_edit_filters',
		'nginx' => 'pretty_nginx',
		'maintenance' => 'pretty_maintenance',
		'settings' => 'pretty_manage_settings',
		'test' => 'pretty_test_rewrites',
	);
	if (isset($_REQUEST['sa']) && isset($subActions[$_REQUEST['sa']]))
		call_user_func($subActions[$_REQUEST['sa']]);
	else
		pretty_manage_settings();
}

//	News and mod information
function pretty_news()
{
	global $context, $scripturl, $settings, $txt;
	pretty_AdminTabs();

	//	This page needs some extra javascript :)
	$context['html_headers'] .= '
	<script type="text/javascript">var chrome = {
		downloadTxt: "' . $txt['pretty_download'] . '",
		pmUrl: "' . $scripturl . '?action=admin;area=packages;sa=download;get;sesc=' . $context['session_id'] . ';package=",
		upgradeTxt: "' . $txt['pretty_upgrade'] . '"
	};</script>
	<script type="text/javascript" src="' . $settings['default_theme_url'] . '/pretty/chrome.js"></script>
	<script type="text/javascript" src="https://createaforum.com/prettyurlsnews.js"></script>';

	$context['page_title'] = $txt['pretty_chrome_page_title_news'];
	$context['sub_template'] = 'pretty_news';
	$context['pretty']['chrome']['page_title'] = $txt['pretty_chrome_title_news'];
	$context['pretty']['chrome']['caption'] = $txt['pretty_chrome_caption_news'];
}

//	An interface to manage the settings and filters
function pretty_manage_settings()
{
	global $context, $modSettings, $sourcedir, $txt;
	pretty_AdminTabs();


/*
	//	Core settings
	$context['pretty']['settings']['core'] = array(
		array(
			'id' => 'pretty_enable_filters',
			'label' => $txt['pretty_enable'],
			'type' => 'text',
			'value' => $modSettings['pretty_enable_filters'],
		),
	);
*/

	//	Load the filters data
	$context['pretty']['filters'] = unserialize($modSettings['pretty_filters']);

	//	Are we saving settings now?
	if (isset($_REQUEST['save']))
	{
		
		$pretty_root_url = $_REQUEST['pretty_root_url'];
		updateSettings(array('pretty_root_url' => $pretty_root_url));
		
		
		//	Get each filter from the form and save them
		foreach ($context['pretty']['filters'] as $id => $filter)
			$context['pretty']['filters'][$id]['enabled'] = isset($_POST['pretty_filter_' . $id]) ? 1 : 0;

		updateSettings(array('pretty_filters' => serialize($context['pretty']['filters'])));

		//	Update the filters too, but don't force pretty_enable_filters off
		require_once($sourcedir . '/Subs-PrettyUrls.php');
		$enabled = !empty($modSettings['pretty_enable_filters']);
		pretty_update_filters();
		$modSettings['pretty_enable_filters'] = $enabled;

		pretty_run_maintenance(false,true);

		$_POST['pretty_skipactions'] = strtolower($_POST['pretty_skipactions']);
		$_POST['pretty_skipactions'] = trim($_POST['pretty_skipactions']);


		$pretty_bufferusecache = isset($_REQUEST['pretty_bufferusecache']) ? 1 : 0;
		updateSettings(
		array(
		'pretty_skipactions' => $_POST['pretty_skipactions'],
		'pretty_bufferusecache' => $pretty_bufferusecache,
		));

		// If you want to turn rewriting on you must test that it will work first!
		if (!$enabled && $_POST['pretty_enable'])
			redirectexit('action=admin;area=pretty;sa=test');


		// Update the enabled setting
		updateSettings(array('pretty_enable_filters' => $_POST['pretty_enable']));

		//	All finished now!
		$_SESSION['pretty']['notice'] = 'Settings saved';
		redirectexit('action=admin;area=pretty;sa=settings');
	}

	//	Action-specific chrome
	$context['page_title'] = $txt['pretty_chrome_page_title_settings'];
	$context['sub_template'] = 'pretty_settings';
	$context['pretty']['chrome']['page_title'] = $txt['pretty_chrome_menu_settings'];
	$context['pretty']['chrome']['caption'] = $txt['pretty_chrome_caption_settings'];

	//	Load the settings up
	$context['pretty']['settings']['enable'] = !empty($modSettings['pretty_enable_filters']);

	//	Any notices?
	if (isset($_SESSION['pretty']['notice']))
	{
		$context['pretty']['chrome']['notice'] = $_SESSION['pretty']['notice'];
		unset($_SESSION['pretty']['notice']);
	}
}

// Test whether the rewrites will work
function pretty_test_rewrites()
{
	global $context, $modSettings, $sourcedir, $txt;
	pretty_AdminTabs();

	//	Yes they work, so turn them on!
	if (isset($_REQUEST['save']))
	{
		updateSettings(array('pretty_enable_filters' => '1'));

		//	All finished now!
		$_SESSION['pretty']['notice'] = 'Settings saved';
		redirectexit('action=admin;area=pretty;sa=settings');
	}

	require_once($sourcedir . '/PrettyUrls-Filters.php');
	require_once($sourcedir . '/PrettyUrls-Tests.php');

	//	Load the filters and get their test links
	$filters = unserialize($modSettings['pretty_filters']);
	$linklist = '';
	foreach ($filters as $id => $filter)
		if ($filter['enabled'] && isset($filter['test_callback']))
			$linklist .= '<h3>' . $filter['title'] . '</h3><p>' . implode('</p><p>', call_user_func($filter['test_callback'])) . '</p>';

	// Rewrite just these few test links
	$context['pretty']['chrome']['linklist'] = pretty_rewrite_buffer($linklist);

	//	Action-specific chrome
	$context['page_title'] = $txt['pretty_chrome_page_title_settings'];
	$context['sub_template'] = 'pretty_test_rewrites';
	$context['pretty']['chrome']['page_title'] = $txt['pretty_chrome_menu_settings'];
	$context['pretty']['chrome']['caption'] = $txt['pretty_chrome_caption_tests'];
}

//	Interface for URL maintenance
function pretty_maintenance()
{
	global $context, $sourcedir, $txt;

	pretty_AdminTabs();

	//	Run the maintenance tasks
	if (isset($_REQUEST['run']))
	{
		require_once($sourcedir . '/Subs-PrettyUrls.php');
		pretty_run_maintenance();
	}

	//	Action-specific chrome
	$context['page_title'] = $txt['pretty_chrome_page_title_maintenance'];
	$context['sub_template'] = 'pretty_maintenance';
	$context['pretty']['chrome']['page_title'] = $txt['pretty_chrome_menu_maintenance'];
	$context['pretty']['chrome']['caption'] = $txt['pretty_chrome_caption_maintenance'];
}

//	Interface to edit the filters array
function pretty_edit_filters()
{
	global $context, $modSettings, $sourcedir, $txt;
	pretty_AdminTabs();

	//	Check the JSON extension is installed
	if (!function_exists('json_encode'))
	{
		unset($context['template_layers']['pretty_chrome']);
		fatal_lang_error('pretty_no_json', false);
	}

	//	Save the filters array
	if (isset($_REQUEST['save']))
	{
		//	Try to process the edited JSON array
		$json_filters = (isset($_POST['pretty_json_filters'])) ? $_POST['pretty_json_filters'] : '';
		$json_filters = stripslashes($json_filters);
		$filters_array = json_decode($json_filters, true);

		//	Was that successful or not?
		if ($filters_array == NULL)
		{
			$_SESSION['pretty']['notice'] = 'There was an error with the JSON array you submitted';
			$_SESSION['pretty']['json_filters'] = $json_filters;
		}
		else
		{
			require_once($sourcedir . '/Subs-PrettyUrls.php');
			updateSettings(array('pretty_filters' => serialize($filters_array)));
			pretty_update_filters();
			$_SESSION['pretty']['notice'] = 'Filters saved and updated';
		}

		redirectexit('action=admin;area=pretty;sa=filters');
	}

	//	Action-specific chrome
	$context['page_title'] = $txt['pretty_chrome_page_title_filters'];
	$context['sub_template'] = 'pretty_filters';
	$context['pretty']['chrome']['page_title'] = $txt['pretty_chrome_title_filters'];
	$context['pretty']['chrome']['caption'] = $txt['pretty_chrome_caption_filters'];

	if (isset($_SESSION['pretty']['json_filters']))
	{
		//	We're working on something already
		$context['pretty']['json_filters'] = $_SESSION['pretty']['json_filters'];
		unset($_SESSION['pretty']['json_filters']);
	}
	else
	{
		//	Convert the filters array to JSON and format it nicely
		require_once($sourcedir . '/Subs-PrettyUrls.php');
		$context['pretty']['json_filters'] = json_encode(unserialize($modSettings['pretty_filters']));
		$context['pretty']['json_filters'] = pretty_json($context['pretty']['json_filters']);
		$context['pretty']['json_filters'] = str_replace('\/', '/', $context['pretty']['json_filters']);
	}

	//	Any new notices?
	if (isset($_SESSION['pretty']['notice']))
	{
		$context['pretty']['chrome']['notice'] = $_SESSION['pretty']['notice'];
		unset($_SESSION['pretty']['notice']);
	}
}

function pretty_AdminTabs($overrideSelected = '')
{
	global $context, $txt;

	if (!empty($overrideSelected))
		$_REQUEST['sa'] = $overrideSelected;

	$context[$context['admin_menu_name']]['tab_data'] = array(
			'title' => $txt['pretty_chrome_title'],
			'description' => '',
			'tabs' => array(
				'settings' => array(
					'description' => $txt['pretty_chrome_menu_settings_description'],
					'label' => $txt['pretty_chrome_menu_settings'],
				),
				'nginx' => array(
					'description' => $txt['pretty_chrome_menu_nginx_description'],
					'label' => $txt['pretty_chrome_menu_nginx'],
				),
				'maintenance' => array(
					'description' => $txt['pretty_chrome_menu_maintenance_description'],
					'label' => $txt['pretty_chrome_menu_maintenance'],
				),
			),
		);

}

function pretty_nginx()
{
	global $txt;
	global $boarddir, $boardurl, $context, $modSettings, $smcFunc;

	pretty_AdminTabs();

	//	Get the settings
	$prettyFilters = unserialize($modSettings['pretty_filters']);
	$filterSettings = array();
	$rewrites = array();
	foreach ($prettyFilters as $id => $filter)
		//	Get the important data from enabled filters
		if ($filter['enabled'])
		{
			if (!isset($filter['rewrite']['nginx']))
				$filter['rewrite']['nginx'] = '';

			if (isset($filter['filter']))
				$filterSettings[$filter['filter']['priority']] = $filter['filter']['callback'];
			if (isset($filter['rewrite']))
				$rewrites[$filter['rewrite']['priority']] = array(
					'id' => $id,
					'rule' => $filter['rewrite']['rule'],
					'nginx' => $filter['rewrite']['nginx'],
				);
		}


	$htaccess = '';

	$base = dirname($_SERVER['SCRIPT_NAME']);
	if (defined('DIRECTORY_SEPARATOR'))
		$base = str_replace(DIRECTORY_SEPARATOR, '/', $base);
	else
		$base = str_replace("\\", '/', $base);
	//if ($base != '.')
	//	$htaccess .= "\nRewriteBase " . $base;

	//	Actions
	$htaccess = str_replace("# Rules for: actions","",$htaccess);
	$htaccess = trim($htaccess);

		//	Put them in groups of 8
		$action_array = str_replace('.', '\\.', $context['pretty']['action_array']);
		$groups = array_chunk($action_array, 8);
		//	Construct the rewrite rules
		$lines = array();
		foreach ($groups as $group)
			$lines[] = 'rewrite ^('. implode('|', $group) .')/?$ "/index.php?pretty&action=$1" last;';
		$actions_rewrite = implode("\n", $lines);
		$htaccess .= "\n\n# Rules for: actions\n" . $actions_rewrite;



	//	Output the rules
	ksort($rewrites);
	foreach ($rewrites as $rule)
	{
		if (!empty($rule['nginx']))
		{
			$htaccess .= "\n\n# Rules for: " . $rule['id'] . "\n";
			if (is_array($rule['nginx']))
				$htaccess .= implode("\n", $rule['nginx']);
			else
				$htaccess .= $rule['nginx'];
		}
	}

	//	Fix the Root URL
	if (preg_match('`' . $boardurl . '/(.*)`', $modSettings['pretty_root_url'], $match))
		$htaccess = str_replace('ROOTURL', $match[1] . '/', $htaccess);
	else
		$htaccess = str_replace('ROOTURL', '', $htaccess);


	$context['pretty_nginx_rules'] = $htaccess;

	//	Action-specific chrome
	$context['page_title'] = $txt['pretty_chrome_menu_nginx'];
	$context['sub_template'] = 'pretty_nginx';
	$context['pretty']['chrome']['page_title'] = $txt['pretty_chrome_menu_nginx'];
	$context['pretty']['chrome']['caption'] = $txt['pretty_chrome_menu_nginx_description'];
}

?>
