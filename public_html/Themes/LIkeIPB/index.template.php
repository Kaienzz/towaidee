<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2021 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.3
 */

/**
 * Initialize the template... mainly little settings.
 */
function template_init()
{
	// Initialize theme customs
	// Could also use loadSubTemplate('customs_init') but... the template is already loaded so...
	template_customs_init();
}

/**
 * The main sub template above the content.
 */
function template_html_above()
{
	global $context, $scripturl, $txt, $modSettings, $settings;

	// Show right to left, the language code, and the character set for ease of translating.
	echo '<!DOCTYPE html>
<html', $context['right_to_left'] ? ' dir="rtl"' : '', !empty($txt['lang_locale']) ? ' lang="' . str_replace("_", "-", substr($txt['lang_locale'], 0, strcspn($txt['lang_locale'], "."))) . '"' : '', $settings['themecustoms_html_attributes'] ?? '', '>
<head>
	<meta charset="', $context['character_set'], '">';

	// load in any css from mods or themes so they can overwrite if wanted
	template_css();

	// load in any javascript files from mods and themes
	template_javascript();

	echo '
	<title>', $context['page_title_html_safe'], '</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">';

	// Content related meta tags, like description, keywords, Open Graph stuff, etc...
	foreach ($context['meta_tags'] as $meta_tag)
	{
		echo '
	<meta';
		foreach ($meta_tag as $meta_key => $meta_value)
			echo ' ', $meta_key, '="', $meta_value, '"';
		echo '>';
	}

	/*	What is your Lollipop's color?
		Theme Authors, you can change the color here to make sure your theme's main color gets visible on tab */
	echo '
	<meta name="theme-color" content="', !empty($settings['st_site_color']) ? $settings['st_site_color'] : '#567c8f', '">';

	// Please don't index these Mr Robot.
	if (!empty($context['robot_no_index']))
		echo '
	<meta name="robots" content="noindex">';

	// Present a canonical url for search engines to prevent duplicate content in their indices.
	if (!empty($context['canonical_url']))
		echo '
	<link rel="canonical" href="', $context['canonical_url'], '">';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help">
	<link rel="contents" href="', $scripturl, '">', ($context['allow_search'] ? '
	<link rel="search" href="' . $scripturl . '?action=search">' : '');

	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']) && (!empty($modSettings['allow_guestAccess']) || $context['user']['is_logged']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name_html_safe'], ' - ', $txt['rss'], '" href="', $scripturl, '?action=.xml;type=rss2', !empty($context['current_board']) ? ';board=' . $context['current_board'] : '', '">
	<link rel="alternate" type="application/atom+xml" title="', $context['forum_name_html_safe'], ' - ', $txt['atom'], '" href="', $scripturl, '?action=.xml;type=atom', !empty($context['current_board']) ? ';board=' . $context['current_board'] : '', '">';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['links']['next']))
		echo '
	<link rel="next" href="', $context['links']['next'], '">';

	if (!empty($context['links']['prev']))
		echo '
	<link rel="prev" href="', $context['links']['prev'], '">';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="', $scripturl, '?board=', $context['current_board'], '.0">';

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'];

	echo '
</head>
<body id="', $context['browser_body_id'], '" class="action_', !empty($context['current_action']) ? $context['current_action'] : (!empty($context['current_board']) ?
		'messageindex' : (!empty($context['current_topic']) ? 'display' : 'home')), !empty($context['current_board']) ? ' board_' . $context['current_board'] : '', '">
	<div id="footerfix">';
}

/**
 * The upper part of the main template layer. This is the stuff that shows above the main forum content.
 */
function template_body_above()
{
	global $settings, $settings, $context;

	echo '
		<a id="site_index"></a>
		<div id="top_section">
			<div class="inner_wrap">
				', empty($settings['st_custom_links_enabled']) ? '<time datetime="'. smf_gmstrftime('%FT%TZ') . '">' . $context['current_time'] . '</time>' : themecustoms_customlinks();
				
				// Socials
				themecustoms_socials();

	echo '
			</div><!-- .inner_wrap -->
		</div><!-- #top_section -->';

		// Header
		template_theme_header();

		// Show the menu here
		template_menu();
        
        // ★ここから紹介BOXを表示するコードを追加 ★
        // サブテンプレートファイル introduction.template.php が既にテーマフォルダに置かれているなら…
        // SMF の loadSubTemplate() 関数を使って読み込むと、キャッシュ等も考慮できるのでおすすめです。
        // loadSubTemplate('Introduction');
        // または、直接関数が既に定義されていれば、下記のように呼び出しも可能です：
		
		// index.template.php の該当部分
		require_once($settings['theme_dir'] . '/Welcome.template.php');

		// ホーム（＝Boardindex）の場合
		if (empty($context['current_board']) && empty($context['current_topic']) &&
			(empty($context['current_action']) || strpos($context['current_action'], 'admin') === false))
		{
			template_welcome_box();
		}
		else
		{
			echo '';
		}


	echo '
		<div id="wrapper">
			<div id="upper_section">
				<div id="inner_section">';

					

	echo '
				</div><!-- #inner_section -->
			</div><!-- #upper_section -->
			<div id="content_section">';
			
			// Show left sidebar if enabled (default: true)
			if (empty($modSettings['disable_left_sidebar']))
			{
				echo '
				<div id="sidebar_left" class="sidebar">
					<div class="sidebar_content">';
					
					// Load sidebar template
					require_once($settings['theme_dir'] . '/Sidebar.template.php');
					template_left_sidebar();
					
					echo '
					</div>
				</div><!-- #sidebar_left -->';
			}
				<div id="main_content_section">';

					// Theme LInktree
					theme_linktree();
}

/**
 * The stuff shown immediately below the main content, including the footer
 */
function template_body_below()
{
	echo '
				</div><!-- #main_content_section -->';
				
				// Show right sidebar if enabled (default: true)
				if (empty($modSettings['disable_right_sidebar']))
				{
					echo '
				<div id="sidebar_right" class="sidebar">
					<div class="sidebar_content">';
					
					template_right_sidebar();
					
					echo '
					</div>
				</div><!-- #sidebar_right -->';
				}
			</div><!-- #content_section -->
		</div><!-- #wrapper -->
	</div><!-- #footerfix -->';

	// Show the footer with copyright, terms and help links.
	template_theme_footer();
}

/**
 * This shows any deferred JavaScript and closes out the HTML
 */
function template_html_below()
{
	// Load in any javascipt that could be deferred to the end of the page
	template_javascript(true);

	echo '
</body>
</html>';
}

/**
 * The theme header
 */
function template_theme_header()
{
	global $scripturl, $context, $settings;

	echo '
	<header>
		<div id="header">
			<h1 class="forumtitle">
				<a id="top" href="', $scripturl, '">
					<img src="', empty($context['header_logo_url_html_safe']) ? $settings['images_url'] .'/theme/logo.png' : $context['header_logo_url_html_safe'], '" alt="' . $context['forum_name_html_safe'] . '" />', '
				</a>
			</h1>';

			// Theme Variants
			themecustoms_search();

	echo '
		</div>
	</header>';
}

/**
 * The theme user area
 */
function template_theme_userarea()
{
	global $context, $scripturl, $maintenance, $txt, $settings;

	// Firstly, the user's menu
	echo '
	<ul id="top_info">';

	// If the user is logged in, display some things that might be useful.
	if ($context['user']['is_logged'])
	{
		echo '
			<li>
				<a href="', $scripturl, '?action=profile"', !empty($context['self_profile']) || $context['current_action'] == 'unread'  || $context['current_action'] == 'unreadreplies' ? ' class="active"' : '', ' id="profile_menu_top">
					', $context['user']['avatar']['image'], '
				</a>
				<div id="profile_menu" class="top_menu"></div>
			</li>';

		// Secondly, PMs if we're doing them
		if ($context['allow_pm'])
			echo '
			<li>
				<a href="', $scripturl, '?action=pm"', !empty($context['self_pm']) ? ' class="active"' : '', ' id="pm_menu_top" aria-label="', $txt['pm_short'], '" title="', $txt['pm_short'], '">
					', themecustoms_icon('fa fa-inbox'), !empty($context['user']['unread_messages']) ? ' <span class="amt">' . $context['user']['unread_messages'] . '</span>' : '', '
				</a>
				<div id="pm_menu" class="top_menu scrollable"></div>
			</li>';

		// Thirdly, alerts
		echo '
			<li>
				<a href="', $scripturl, '?action=profile;area=showalerts;u=', $context['user']['id'], '"', !empty($context['self_alerts']) ? ' class="active"' : '', ' id="alerts_menu_top" aria-label="', $txt['alerts'], '" title="', $txt['alerts'], '">
					', themecustoms_icon('fa fa-bell'), !empty($context['user']['alerts']) ? ' <span class="amt">' . $context['user']['alerts'] . '</span>' : '', '
				</a>
				<div id="alerts_menu" class="top_menu scrollable"></div>
			</li>';

		// A logout button for people without JavaScript.
		echo '
			<li id="nojs_logout">
				<a href="', $scripturl, '?action=logout;', $context['session_var'], '=', $context['session_id'], '" aria-label="', $txt['logout'], '" title="', $txt['logout'], '">
					', themecustoms_icon('fa fa-sign-out-alt'), '
				</a>
				<script>document.getElementById("nojs_logout").style.display = "none";</script>
			</li>';
	}
	// Otherwise they're a guest. Ask them to either register or login.
	elseif (empty($maintenance) && empty($settings['login_main_menu']))
	{
		echo '
			<li class="button_login">
				<a href="', $scripturl, '?action=login" class="', $context['current_action'] == 'login' ? 'active' : 'open','" onclick="return reqOverlayDiv(this.href, ' . JavaScriptEscape($txt['login']) . ', \'login\');">
					<span class="main_icons login"></span>
					<span class="textmenu">', $txt['login'], '</span>
				</a>
			</li>';

		if ($context['can_register'])
			echo '
			<li class="button_signup">
				<a href="', $scripturl, '?action=signup" class="', $context['current_action'] == 'signup' ? 'active' : '','">
					<span class="main_icons regcenter"></span>
					<span class="textmenu">', $txt['register'], '</span>
				</a>
			</li>';
	}

			// Add the mode selector
			// template_theme_darkmode();

			// Add the color selection
			// template_theme_colorpicker();

		// And now we're done.
		echo '
		</ul>';
}

/**
 * The theme footer
 */
function template_theme_footer()
{
	global $context, $txt, $scripturl, $modSettings;

	echo '
	<footer>
		<div class="inner_wrap">
			<div class="footer_links">
				<ul class="forum_copy">
					<li class="copyright">
						<a href="', $scripturl, '">
							', $context['forum_name'], ' &copy; ', date('Y'), '
						</a>
					</li>
				</ul>
				<ul class="copyright">
					<li class="smf_copyright">', theme_copyright(), '</li>
				</ul>
			</div>';

	// Show the load time?
	if ($context['show_load_time'])
		echo '
			<p>
				', sprintf($txt['page_created_full'], $context['load_time'], $context['load_queries']), '
			</p>';

	echo '
		</div>
	</footer>';
}

/**
 * Show a colorpicker
 */
function template_theme_colorpicker()
{
	global $settings, $txt, $scripturl, $context;

	if (!empty($settings['theme_variants']) && count($settings['theme_variants']) > 1 && empty($settings['disable_user_variant']))
	{
		echo '
		<li id="user_colorpicker">
			<a href="javascript:void(0);">', themecustoms_icon('fa fa-palette'), '</a>
			<ul id="colorpicker_menu" class="top_menu dropmenu">';
		
		// Theme variants
		foreach ($settings['theme_variants'] as $variant)
		{
			echo '
				<li>
					<a href="', $scripturl, '?variant=' . $variant . '" class="theme-variant-toggle', ($context['theme_variant'] == $variant ? ' active' : '') , '" data-color="', $variant, '">
						', $txt['variant_'. $variant], '
					</a>
				</li>';
		}

		echo '
			</ul>
		</li>';
	}
}

/**
 * Show the dark mode button
 */
function template_theme_darkmode()
{
	global $settings;
	
	if (!empty($settings['st_enable_dark_mode']) && !empty($settings['customtheme_darkmode']))
	{
		echo '
		<li id="user_thememode">
			<a href="javascript:void(0);" class="theme-mode-toggle">
				<span></span>
			</a>
		</li>';
	}
}

/**
 * Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
 *
 * @param bool $force_show Whether to force showing it even if settings say otherwise
 */
function theme_linktree($force_show = false)
{
	global $context, $shown_linktree;

	// If linktree is empty, just return - also allow an override.
	// Additionally, don't show the linktree if we are at home.
	if (empty($context['linktree']) || (!empty($context['dont_default_linktree']) && !$force_show) || (empty($context['current_action']) && empty($context['current_board']) && empty($context['current_topic'])))
		return;

	echo '
				<div class="navigate_section_alternative">
					<ul>';

	// Each tree item has a URL and name. Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		echo '
						<li', ($link_num == count($context['linktree']) - 1) ? ' class="last"' : '', '>';

		// Don't show a separator for the first one.
		// Better here. Always points to the next level when the linktree breaks to a second line.
		// Picked a better looking HTML entity, and added support for RTL plus a span for styling.
		if ($link_num != 0)
			echo '
							<span class="dividers">', $context['right_to_left'] ? ' &#9668; ' : ' &#9658; ', '</span>';
		

		// Show something before the link?
		if (isset($tree['extra_before']))
			echo $tree['extra_before'], ' ';

		// Show the link, including a URL if it should have one.
		if (isset($tree['url']))
			echo '
							<a href="' . $tree['url'] . '"><span>' . $tree['name'] . '</span></a>';
		else
			echo '
							<span>' . $tree['name'] . '</span>';

		// Show something after the link...?
		if (isset($tree['extra_after']))
			echo ' ', $tree['extra_after'];

		echo '
						</li>';
	}

	echo '
					</ul>
				</div><!-- .navigate_section -->';

	$shown_linktree = true;
}

/**
 * Show the menu up top. Something like [home] [help] [profile] [logout]...
 */
function template_menu()
{
	global $context, $scripturl;

	echo '
	<nav class="navbar navbar-expand-lg bg-theme main_navbar">
		<div id="nav_wrapper" class="container-fluid">
			<a class="navbar-brand d-lg-none d-xl-none d-xxl-none" href="', $scripturl, '">', $context['forum_name'], '</a>';

			// User Area and Login button
			template_theme_userarea();

		echo '
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar_mainMenu" aria-controls="navbar_mainMenu" aria-expanded="false" aria-label="Toggle navigation">
				', themecustoms_icon('fa fa-bars'), '
			</button>
			<div class="collapse navbar-collapse" id="navbar_mainMenu">
				<ul class="navbar-nav">';

	// Note: Menu markup has been cleaned up to remove unnecessary spans and classes.
	foreach ($context['menu_buttons'] as $act => $button)
	{
		echo '
					<li class="nav-item button_', $act, '', !empty($button['sub_buttons']) ? ' dropdown' : '', '">
						<a class="nav-link', $button['active_button'] ? ' active' : '', !empty($button['sub_buttons']) ? ' dropdown-toggle" id="mainMenu_' . $act . '_dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false' : '', '" href="', $button['href'], '"', isset($button['target']) ? ' target="' . $button['target'] . '"' : '', '>
							', $button['icon'], '<span class="textmenu">', $button['title'], !empty($button['amt']) ? ' <span class="amt">' . $button['amt'] . '</span>' : '', '</span>
						</a>';

		// 2nd level menus
		if (!empty($button['sub_buttons']))
		{
			echo '
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mainMenu_' . $act . '_dropdown">
							<li>
								<a class="dropdown-item" href="', $button['href'], '"', isset($button['target']) ? ' target="' . $button['target'] . '"' : '', '>
									', $button['title'], !empty($button['amt']) ? ' <span class="amt">' . $button['amt'] . '</span>' : '', '
								</a>
							</li>';

			foreach ($button['sub_buttons'] as $childbutton)
			{
				echo '
							<li', !empty($childbutton['sub_buttons']) ? ' class="subsections"' : '', '>
								<a href="', $childbutton['href'], '"', isset($childbutton['target']) ? ' target="' . $childbutton['target'] . '"' : '', ' class="dropdown-item">
									', $childbutton['title'], !empty($childbutton['amt']) ? ' <span class="amt">' . $childbutton['amt'] . '</span>' : '', '
								</a>';
				// 3rd level menus :)
				if (!empty($childbutton['sub_buttons']))
				{
					echo '
								<ul>';

					foreach ($childbutton['sub_buttons'] as $grandchildbutton)
						echo '
									<li>
										<a href="', $grandchildbutton['href'], '"', isset($grandchildbutton['target']) ? ' target="' . $grandchildbutton['target'] . '"' : '', '>
											', $grandchildbutton['title'], !empty($grandchildbutton['amt']) ? ' <span class="amt">' . $grandchildbutton['amt'] . '</span>' : '', '
										</a>
									</li>';

					echo '
								</ul>';
				}

				echo '
							</li>';
			}
			echo '
						</ul>';
		}
		echo '
					</li>';
	}

	echo '
				</ul>
			</div>
		</div>
	</nav><!-- .menu_nav -->';
}

/**
 * Generate a strip of buttons.
 *
 * @param array $button_strip An array with info for displaying the strip
 * @param string $direction The direction
 * @param array $strip_options Options for the button strip
 */
function template_button_strip($button_strip, $direction = '', $strip_options = array())
{
	global $context, $txt;

	static $_buttonlist_strip = 0;


	if (!is_array($strip_options))
		$strip_options = array();

	// Create the buttons...
	$buttons = array();
	foreach ($button_strip as $key => $value)
	{
		// As of 2.1, the 'test' for each button happens while the array is being generated. The extra 'test' check here is deprecated but kept for backward compatibility (update your mods, folks!)
		if (!isset($value['test']) || !empty($context[$value['test']]))
		{
			if (!isset($value['id']))
				$value['id'] = $key;

			$button = '
					<a class="button normal_button_strip_' . $key . (!empty($value['active']) ? ' active' : '') . (isset($value['class']) ? ' ' . $value['class'] : '') . (!empty($value['sub_buttons']) ? ' dropdown-toggle" id="b'. $_buttonlist_strip. '_buttonlist_dropdown_' . $value['id'] . '" data-bs-toggle="dropdown" aria-expanded="false' : '') . '" ' . (!empty($value['url']) ? 'href="' . $value['url'] . '"' : 'href="javascript:void(0);"') . ' ' . (isset($value['custom']) ? ' ' . $value['custom'] : '') . '>
						<span class="main_icons ' . (!empty($value['icon']) ? $value['icon'] : $value['text']) . '"></span>
						<span>' . $txt[$value['text']] . '</span>
					</a>';

			if (!empty($value['sub_buttons']))
			{
				$button .= '
					<div class="dropdown-menu dropdown-menu-end ' . $key . '_dropdown_buttonlist" aria-labelledby="b'. $_buttonlist_strip. '_buttonlist_dropdown_' . $value['id'] . '">
						<div class="viewport">
							<div class="overview">';
				foreach ($value['sub_buttons'] as $element)
				{
					if (isset($element['test']) && empty($context[$element['test']]))
						continue;

					$button .= '
								<a href="' . $element['url'] . '" class="dropdown-item' . (!empty($element['active']) ? ' active' : '') . '">';

						// Text
						$button .= '
									<span '. (empty($element['not_strong']) ? 'class="strong"' : '') . '>'
										 . $txt[$element['text']] . '
									</span>';

					// Icon
					if (!empty($element['icon']))
						$button .= $element['icon'];

					// Description
					if (isset($txt[$element['text'] . '_desc']))
						$button .= '
									<span class="button-description">' . $txt[$element['text'] . '_desc'] . '</span>';

					// Status
					if (isset($element['button_status']))
						$button .= '
									<em style="display:none;">' . $element['button_status'] . '</em>';
					$button .= '
								</a>';
				}
				$button .= '
							</div><!-- .overview -->
						</div><!-- .viewport -->
					</div><!-- .top_menu -->';
			}

			$buttons[] = $button;
		}
	}

	// No buttons? No button strip either.
	if (empty($buttons))
		return;

	echo '
		<div class="buttonlist', !empty($direction) ? ' float' . $direction : '', '"', (empty($buttons) ? ' style="display: none;"' : ''), (!empty($strip_options['id']) ? ' id="' . $strip_options['id'] . '"' : ''), '>
			', implode('', $buttons), '
		</div>';

		// This will avoid dups.
		$_buttonlist_strip++;
}

/**
 * Generate a list of quickbuttons.
 *
 * @param array $list_items An array with info for displaying the strip
 * @param string $list_class Used for integration hooks and as a class name
 * @param string $output_method The output method. If 'echo', simply displays the buttons, otherwise returns the HTML for them
 * @return void|string Returns nothing unless output_method is something other than 'echo'
 */
function template_quickbuttons($list_items, $list_class = null, $output_method = 'echo')
{
	global $txt;

	static $more_button;

	// Enable manipulation with hooks
	if (!empty($list_class))
		call_integration_hook('integrate_' . $list_class . '_quickbuttons', array(&$list_items));

	// Make sure the list has at least one shown item
	foreach ($list_items as $key => $li)
	{
		// Is there a sublist, and does it have any shown items
		if ($key == 'more')
		{
			foreach ($li as $subkey => $subli)
				if (isset($subli['show']) && !$subli['show'])
					unset($list_items[$key][$subkey]);

			if (empty($list_items[$key]))
				unset($list_items[$key]);
		}
		// A normal list item
		elseif (isset($li['show']) && !$li['show'])
			unset($list_items[$key]);
	}

	// Now check if there are any items left
	if (empty($list_items))
		return;

	// Print the quickbuttons
	$output = '
		<ul class="custom_quickbuttons' . (!empty($list_class) ? ' custom_quickbuttons_' . $list_class : '') . '">';

	// This is used for a list item or a sublist item
	$list_item_format = function($li, $more = false)
	{
		$html = '
			<li' . (!empty($li['class']) ? ' class="' . $li['class'] . '"' : '') . (!empty($li['id']) ? ' id="' . $li['id'] . '"' : '') . (!empty($li['custom']) ? ' ' . $li['custom'] : '') . '>';

		if (isset($li['content']))
			$html .= $li['content'];
		else
			$html .= '
				<a' . (empty($more) ? '' : ' class="dropdown-item"') . ' href="' . (!empty($li['href']) ? $li['href'] : 'javascript:void(0);') . '"' . (!empty($li['javascript']) ? ' ' . $li['javascript'] : '') . '>
					' . (!empty($li['icon']) ? '<span class="main_icons ' . $li['icon'] . '"></span>' : '') .  '
					<span>' . (!empty($li['label']) ? $li['label'] : '') . '</span>
				</a>
				' . (!empty($li['extra_content']) ? $li['extra_content'] : '');

		$html .= '
			</li>';

		return $html;
	};

	foreach ($list_items as $key => $li)
	{
		// Handle the sublist
		if ($key == 'more')
		{
			$output .= '
			<li>
				<a href="javascript:void(0);" class="button" id="quickbutton_more_' . $more_button . '" data-bs-toggle="dropdown" aria-expanded="false">
					' . themecustoms_icon('fas fa-ellipsis-v') . '
					<span>' . $txt['post_options'] . '</span>
				</a>
				<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="quickbutton_more_' . $more_button . '">';

			foreach ($li as $subli)
				$output .= $list_item_format($subli, true);

			$output .= '
				</ul>
			</li>';

			$more_button++;
		}
		// Ordinary list item
		else
			$output .= $list_item_format($li);
	}

	$output .= '
		</ul><!-- .quickbuttons -->';

	// There are a few spots where the result needs to be returned
	if ($output_method == 'echo')
		echo $output;
	else
		return $output;
}

/**
 * The upper part of the maintenance warning box
 */
function template_maint_warning_above()
{
	global $txt, $context, $scripturl;

	echo '
	<div class="errorbox" id="errors">
		<dl>
			<dt>
				<strong id="error_serious">', $txt['forum_in_maintenance'], '</strong>
			</dt>
			<dd class="error" id="error_list">
				', sprintf($txt['maintenance_page'], $scripturl . '?action=admin;area=serversettings;' . $context['session_var'] . '=' . $context['session_id']), '
			</dd>
		</dl>
	</div>';
}

/**
 * The lower part of the maintenance warning box.
 */
function template_maint_warning_below() {}