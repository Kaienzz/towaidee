<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2022 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.3
 */

/**
 * This actually displays the board index
 */

/**
 * The top part of the outer layer of the boardindex
 */
function template_boardindex_outer_above()
{
	template_newsfader();
}
/**
 * This shows the newsfader
 */
function template_newsfader()
{
	global $context, $settings;

	// Show the news fader?  (assuming there are things to show...)
	if (!empty($settings['show_newsfader']) && !empty($context['news_lines']))
	{
		echo '
		<ul id="smf_slider" class="roundframe">';

		foreach ($context['news_lines'] as $news)
			echo '
			<li>', $news, '</li>';

		echo '
		</ul>
		<script>
			jQuery("#smf_slider").slippry({
				pause: ', $settings['newsfader_time'], ',
				adaptiveHeight: 0,
				captions: 0,
				controls: 0,
			});
		</script>';
	}
}
function template_main()
{
	global $context, $txt, $scripturl;
	echo '
	<div class="row">
		<div class="column _6">
			<div id="boardindex_table" class="boardindex_table">';
	/* Each category in categories is made up of:
	id, href, link, name, is_collapsed (is it collapsed?), can_collapse (is it okay if it is?),
	new (is it new?), collapse_href (href to collapse/expand), collapse_image (up/down image),
	and boards. (see below.) */
	foreach ($context['categories'] as $category)
	{
		// If theres no parent boards we can see, avoid showing an empty category (unless its collapsed)
		if (empty($category['boards']) && !$category['is_collapsed'])
			continue;

		echo '
		<div class="main_container">
			<div class="cat_bar ', $category['is_collapsed'] ? 'collapsed' : '', '" id="category_', $category['id'], '">
				<h3 class="catbg">';

		// If this category even can collapse, show a link to collapse it.
		if ($category['can_collapse'])
			echo '
					<span id="category_', $category['id'], '_upshrink" class="', $category['is_collapsed'] ? 'toggle_down' : 'toggle_up', ' floatright" data-collapsed="', (int) $category['is_collapsed'], '" title="', !$category['is_collapsed'] ? $txt['hide_category'] : $txt['show_category'], '" style="display: none;"></span>';

			echo '
					', $category['link'], '
				', !empty($category['description']) ? '
				<span class="desc catdesc">' . $category['description'] . '</span>' : '', '
			 </h3></div>';
		echo'
			<div id="category_', $category['id'], '_boards" ', (!empty($category['css_class']) ? ('class="' . $category['css_class'] . '"') : ''), $category['is_collapsed'] ? ' style="display: none;"' : '', '>';

		/* Each board in each category's boards has:
		new (is it new?), id, name, description, moderators (see below), link_moderators (just a list.),
		children (see below.), link_children (easier to use.), children_new (are they new?),
		topics (# of), posts (# of), link, href, and last_post. (see below.) */
		foreach ($category['boards'] as $board)
		{
			echo '
				<div id="board_', $board['id'], '" class="up_contain ', (!empty($board['css_class']) ? $board['css_class'] : ''), '">
					<div class="board_icon">
						', function_exists('template_bi_' . $board['type'] . '_icon') ? call_user_func('template_bi_' . $board['type'] . '_icon', $board) : template_bi_board_icon($board), '
					</div>
					<div class="info">
						', function_exists('template_bi_' . $board['type'] . '_info') ? call_user_func('template_bi_' . $board['type'] . '_info', $board) : template_bi_board_info($board), '
					</div><!-- .info -->';

			// Show some basic information about the number of posts, etc.
			echo '
					<div class="board_stats">
						', function_exists('template_bi_' . $board['type'] . '_stats') ? call_user_func('template_bi_' . $board['type'] . '_stats', $board) : template_bi_board_stats($board), '
					</div>';

			// Show the last post if there is one.
			echo'
					<div class="lastpost">
						', function_exists('template_bi_' . $board['type'] . '_lastpost') ? call_user_func('template_bi_' . $board['type'] . '_lastpost', $board) : template_bi_board_lastpost($board), '
					</div>';

			// Won't somebody think of the children!
			if (function_exists('template_bi_' . $board['type'] . '_children'))
				call_user_func('template_bi_' . $board['type'] . '_children', $board);
			else
				template_bi_board_children($board);

			echo '
				</div><!-- #board_[id] -->';
		}

		echo '
			</div><!-- #category_[id]_boards -->
		</div><!-- .main_container -->';
	}

	echo '
		</div>';
	// Show the mark all as read button?
		if ($context['user']['is_logged'] && !empty($context['categories']))
		echo '
	<div class="mark_read">
		', template_button_strip($context['mark_read_button'], 'right'), '
		<a class="button" href="', $scripturl, '?action=unread" title="', $txt['unread_since_visit'], '">', $txt['view_unread_category'], '</a>
		<a class="button" href="', $scripturl, '?action=unreadreplies" title="', $txt['show_unread_replies'], '">', $txt['unread_replies'], '</a>
	</div>';
	echo '
	</div><!-- #boardindex_table -->';
}



/**
 * Outputs the board icon for a standard board.
 *
 * @param array $board Current board information.
 */
function template_bi_board_icon($board)
{
	global $context, $scripturl;

	echo '
		<a href="', ($context['user']['is_guest'] ? $board['href'] : $scripturl . '?action=unread;board=' . $board['id'] . '.0;children'), '" class="board_', $board['board_class'], '"', !empty($board['board_tooltip']) ? ' title="' . $board['board_tooltip'] . '"' : '', '></a>';
}

/**
 * Outputs the board icon for a redirect.
 *
 * @param array $board Current board information.
 */
function template_bi_redirect_icon($board)
{
	global $context, $scripturl;

	echo '
		<a href="', $board['href'], '" class="board_', $board['board_class'], '"', !empty($board['board_tooltip']) ? ' title="' . $board['board_tooltip'] . '"' : '', '></a>';
}

/**
 * Outputs the board info for a standard board or redirect.
 *
 * @param array $board Current board information.
 */
function template_bi_board_info($board)
{
	global $context, $scripturl, $txt;

	echo '
		<a class="subject mobile_subject" href="', $board['href'], '" id="b', $board['id'], '">
			', $board['name'], '
		</a>';

	// Has it outstanding posts for approval?
	if ($board['can_approve_posts'] && ($board['unapproved_posts'] || $board['unapproved_topics']))
		echo '
		<a href="', $scripturl, '?action=moderate;area=postmod;sa=', ($board['unapproved_topics'] > 0 ? 'topics' : 'posts'), ';brd=', $board['id'], ';', $context['session_var'], '=', $context['session_id'], '" title="', sprintf($txt['unapproved_posts'], $board['unapproved_topics'], $board['unapproved_posts']), '" class="moderation_link amt">!</a>';

	echo '
		<div class="board_description">', $board['description'], '</div>';

	// Show the "Moderators: ". Each has name, href, link, and id. (but we're gonna use link_moderators.)
	if (!empty($board['link_moderators']))
		echo '
		<p class="moderators">', count($board['link_moderators']) == 1 ? $txt['moderator'] : $txt['moderators'], ': ', implode(', ', $board['link_moderators']), '</p>';
}

/**
 * Outputs the board stats for a standard board.
 *
 * @param array $board Current board information.
 */
function template_bi_board_stats($board)
{
	global $txt;

	echo '
		<p><span class="board_stats_post_txt">', $txt['posts'], '</span><br><span class="board_stats_post_numbers"> ', comma_format($board['posts']), '</span></p>
		<p><span class="board_stats_post_txt">', $txt['board_topics'], '</span><br><span class="board_stats_post_numbers"> ', comma_format($board['topics']), '</span></p>
		';
}

/**
 * Outputs the board stats for a redirect.
 *
 * @param array $board Current board information.
 */
function template_bi_redirect_stats($board)
{
	global $txt;

	echo '
		<p><span class="board_stats_post_txt">', $txt['redirects'], '</span><br><span class="board_stats_post_numbers">', comma_format($board['posts']), '</span></p>';
}

/**
 * Outputs the board lastposts for a standard board or a redirect.
 * When on a mobile device, this may be hidden if no last post exists.
 *
 * @param array $board Current board information.
 */
function template_bi_board_lastpost($board)
{
	global $context, $txt, $scripturl, $settings;	
	
	if (!empty($board['last_post']['id']))
	{
		if (!empty($board['last_post']['member']['avatar']) && !empty($settings['board_avatar_enable']))
		echo '
					<span class="board_avatar"><a href="', $board['last_post']['member']['href'], '"><img class="avatar" src="', $board['last_post']['member']['avatar']['href'], '" alt=""></a></span>';
		else
		echo '
					<span class="board_avatar"><a href="#"></a></span>';

		echo '
					<p class="board_lastpost">';
		echo '
		<span>
		', $board['last_post']['last_post_message'], '
		</span>';
		echo ' </p>';
	}
}


/**
 * Outputs the board children for a standard board.
 *
 * @param array $board Current board information.
 */
function template_bi_board_children($board)
{
	global $txt, $scripturl, $context;

	// Show the "Child Boards: ". (there's a link_children but we're going to bold the new ones...)
	if (!empty($board['children']))
	{
		// Sort the links into an array with new boards bold so it can be imploded.
		$children = array();
		/* Each child in each board's children has:
			id, name, description, new (is it new?), topics (#), posts (#), href, link, and last_post. */
		foreach ($board['children'] as $child)
		{
			if (!$child['is_redirect'])
				$child['link'] = '' . ($child['new'] ? '<a href="' . $scripturl . '?action=unread;board=' . $child['id'] . '" title="' . $txt['new_posts'] . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')" class="new_posts">' . $txt['new'] . '</a> ' : '') . '<a href="' . $child['href'] . '" ' . ($child['new'] ? 'class="board_new_posts" ' : '') . 'title="' . ($child['new'] ? $txt['new_posts'] : $txt['old_posts']) . ' (' . $txt['board_topics'] . ': ' . comma_format($child['topics']) . ', ' . $txt['posts'] . ': ' . comma_format($child['posts']) . ')">' . $child['name'] . '</a>';
			else
				$child['link'] = '<a href="' . $child['href'] . '" title="' . comma_format($child['posts']) . ' ' . $txt['redirects'] . ' - ' . $child['short_description'] . '">' . $child['name'] . '</a>';

			// Has it posts awaiting approval?
			if ($child['can_approve_posts'] && ($child['unapproved_posts'] || $child['unapproved_topics']))
				$child['link'] .= ' <a href="' . $scripturl . '?action=moderate;area=postmod;sa=' . ($child['unapproved_topics'] > 0 ? 'topics' : 'posts') . ';brd=' . $child['id'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . sprintf($txt['unapproved_posts'], $child['unapproved_topics'], $child['unapproved_posts']) . '" class="moderation_link amt">!</a>';

			$children[] = $child['new'] ? '<span class="strong">' . $child['link'] . '</span>' : '<span>' . $child['link'] . '</span>';
		}

		echo '
			<div id="board_', $board['id'], '_children" class="children">
				<p><strong id="child_list_', $board['id'], '">', $txt['sub_boards'], '</strong>', implode(' ', $children), '</p>
			</div>';
	}
}

/**
 * The lower part of the outer layer of the board index
 */
function template_boardindex_outer_below()
{
	template_info_center();
}

/**
 * Displays the info center
 */
function template_info_center()
{
	global $context, $options, $settings, $txt;

	if (empty($context['info_center']))
		return;

	// Here's where the "Info Center" starts...
	echo  (empty ($settings['side_panel_enable'])) ? '<div class="column" style="flex-basis: 100%;">' : '<div class="column">';
	echo'
	<div class="info_center_roundframe" id="info_center">
		<div id="upshrink_stats"', empty($options['collapse_header_ic']) ? '' : ' style="display: none;"', '>';
		$context['info_center'][] = ['tpl' => 'customsearch'];
		socialicons();
	foreach ($context['info_center'] as $block)
	{
		$func = 'template_ic_block_' . $block['tpl'];
		$func();
	}

	echo '
				</div><!-- #upshrink_stats -->
			</div>
		</div>
	</div><!-- #info_center -->';

	// Info center collapse object.
	echo '
	<script>
		var oInfoCenterToggle = new smc_Toggle({
			bToggleEnabled: true,
			bCurrentlyCollapsed: ', empty($options['collapse_header_ic']) ? 'false' : 'true', ',
			aSwappableContainers: [
				\'upshrink_stats\'
			],
			aSwapImages: [
				{
					sId: \'upshrink_ic\',
					altExpanded: ', JavaScriptEscape($txt['hide_infocenter']), ',
					altCollapsed: ', JavaScriptEscape($txt['show_infocenter']), '
				}
			],
			aSwapLinks: [
				{
					sId: \'upshrink_link\',
					msgExpanded: ', JavaScriptEscape(sprintf($txt['info_center_title'], $context['forum_name_html_safe'])), ',
					msgCollapsed: ', JavaScriptEscape(sprintf($txt['info_center_title'], $context['forum_name_html_safe'])), '
				}
			],
			oThemeOptions: {
				bUseThemeSettings: ', $context['user']['is_guest'] ? 'false' : 'true', ',
				sOptionName: \'collapse_header_ic\',
				sSessionId: smf_session_id,
				sSessionVar: smf_session_var,
			},
			oCookieOptions: {
				bUseCookie: ', $context['user']['is_guest'] ? 'true' : 'false', ',
				sCookieName: \'upshrinkIC\'
			}
		});
	</script>';
}

/**
 * The recent posts section of the info center
 */
function template_ic_block_recent()
{
	global $context, $scripturl, $settings, $txt;
						

	// This is the "Recent Posts" bar.
	echo '
			<div class="sub_bar">
                <h4 class="subbg">
					<a href="', $scripturl, '?action=recent"><i class="fa-solid fa-comments"></i> ', $txt['recent_posts'], '</a>
				</h4>
			</div>
			<div id="recent_posts_content">';

	// Only show one post.
	if ($settings['number_recent_posts'] == 1)
	{
		// latest_post has link, href, time, subject, short_subject (shortened with...), and topic. (its id.)
		echo '
				<p id="infocenter_onepost" class="inline">
					<a href="', $scripturl, '?action=recent">', $txt['recent_view'], '</a> ', sprintf($txt['is_recent_updated'], '&quot;' . $context['latest_post']['link'] . '&quot;'), ' (', $context['latest_post']['time'], ')<br>
				</p>';
	}
	// Show lots of posts.
	elseif (!empty($context['latest_posts']))
	{
		/* Each post in latest_posts has:
			board (with an id, name, and link.), topic (the topic's id.), poster (with id, name, and link.),
			subject, short_subject (shortened with...), time, link, and href. */
		foreach ($context['latest_posts'] as $post)
			

			echo '
			<div class="recent_grid_row"> 
				<div class="recent_grid_column recentpost"><i class="fa-solid fa-message"></i>&nbsp;', $post['link'], '<br> ', $post['poster']['link'], ' ', $post['time'], '</div>
			</div>';	
	}
	echo '
			</div><!-- #recent_posts_content -->';
}

/* Search Box */
function template_ic_block_customsearch()
{
	global $context, $settings, $txt, $scripturl, $modSettings;

	//Show the search
	if (!empty($settings['info_center_search_enabled']))
	{
	echo '
			<div class="sub_bar">
				<h4 class="subbg">
				<i class="fa-solid fa-magnifying-glass"></i><a href="'. $scripturl. '?action=search"> '. $txt['search'] .'</a>
				</h4>
			</div>';

			if ($context['allow_search'])
			{
				echo '
				<div class="windowbg boardstats_grid_row">
					<form id="search_form" action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '">
						<input type="search" size="30" name="search" value="">&nbsp;';
		
		
				// Search within current topic?
				if (!empty($context['current_topic']))
					echo '
						<input type="hidden" name="sd_topic" value="', $context['current_topic'], '">';
		
				// If we're on a certain board, limit it to this board ;).
				elseif (!empty($context['current_board']))
					echo '
						<input type="hidden" name="sd_brd" value="', $context['current_board'], '">';
		
				echo '
						<input type="submit" name="search2" value="', $txt['search'], '" class="button">
						<input type="hidden" name="advanced" value="0">
					</form>
				</div>';
			}
	}	
}

/* Social Icons */
function socialicons()
{
	global $context, $settings, $txt, $scripturl, $modSettings;

	// Show the Social Icons

	if (!empty($settings['social_icons_menu_enabled']))
	{
		echo '
				<div class="sub_bar">
					<h4 class="subbg">
					<a href="#"><i class="fa-solid fa-bell"></i>&nbsp;', $txt['social_icons'], '</a>
					</h4>
				</div>';
		echo '
		
			<div class="social-icons boardstats_grid_row">';
				if(!empty($settings['facebook_url']))
					echo '
					<div class="social-icons-block"><a href="'. $settings['facebook_url'] , '" title="' . $txt['facebook_title']  . '"> <i class="fab fa-facebook"></i></a></div>';
	
				if(!empty($settings['twitter_url']))
					echo '
					<div class="social-icons-block"><a href="', $settings['twitter_url'] , '" title="' , $txt['twitter_title']  , '"><i class="fab fa-twitter"></i></a></div>';
	
				if(!empty($settings['youtube_url']))
					echo '
					<div class="social-icons-block"><a href="', $settings['youtube_url'] , '" title="' , $txt['youtube_title']  , '"><i class="fab fa-youtube"></i></a></div>';
								 
				if(!empty($settings['twitch_url']))
					echo '
					<div class="social-icons-block"><a href="', $settings['twitch_url'] , '" title="' , $txt['twitch_title']  , '"><i class="fab fa-twitch"></i></a></div>';	
								 
				if(!empty($settings['discord_url']))
					echo '
					<div class="social-icons-block"><a href="', $settings['discord_url'] , '" title="' , $txt['discord_title']  , '"><i class="fab fa-discord"></i></a></div>';	
	
				if(!empty($settings['linkedin_url']))
					echo '
					<div class="social-icons-block"><a href="', $settings['linkedin_url'] , '" title="' , $txt['linkedin_title']  , '"><i class="fab fa-linkedin"></i></a></div>';
								 
				if(!empty($settings['github_url']))
					echo '
					<div class="social-icons-block"><a href="', $settings['github_url'] , '" title="' , $txt['github_title']  , '"><i class="fab fa-github"></i></a></div>';						 
								 
				if(!empty($settings['rss_url']))
					echo '
					<div class="social-icons-block"><a href="', $settings['rss_url'] , '" title="' , $txt['rss_title']  , '"><i class="fas fa-rss"></i></a></div>';
					echo '
			</div>';
	}
}

/**
 * The calendar section of the info center
 */
function template_ic_block_calendar()
{
	global $context, $scripturl, $txt;

	// Show information about events, birthdays, and holidays on the calendar.
	echo '
			<div class="sub_bar">
				<h4 class="subbg">
					<a href="', $scripturl, '?action=calendar' . '"><i class="fa-solid fa-calendar"></i> ', $context['calendar_only_today'] ? $txt['calendar_today'] : $txt['calendar_upcoming'], '</a>
				</h4>
			</div>';

	// Holidays like "Christmas", "Chanukah", and "We Love [Unknown] Day" :P
	if (!empty($context['calendar_holidays']))
		echo '
			<p class="inline holiday">
				<span>', $txt['calendar_prompt'], '</span> ', implode(', ', $context['calendar_holidays']), '
			</p>';

	// People's birthdays. Like mine. And yours, I guess. Kidding.
	if (!empty($context['calendar_birthdays']))
	{
		echo '
			<p class="inline">
				<span class="birthday">', $context['calendar_only_today'] ? $txt['birthdays'] : $txt['birthdays_upcoming'], '</span>';

		// Each member in calendar_birthdays has: id, name (person), age (if they have one set?), is_last. (last in list?), and is_today (birthday is today?)
		foreach ($context['calendar_birthdays'] as $member)
			echo '
				<a href="', $scripturl, '?action=profile;u=', $member['id'], '">', $member['is_today'] ? '<strong class="fix_rtl_names">' : '', $member['name'], $member['is_today'] ? '</strong>' : '', isset($member['age']) ? ' (' . $member['age'] . ')' : '', '</a>', $member['is_last'] ? '' : ', ';

		echo '
			</p>';
	}

	// Events like community get-togethers.
	if (!empty($context['calendar_events']))
	{
		echo '
			<p class="inline">
				<span class="event">', $context['calendar_only_today'] ? $txt['events'] : $txt['events_upcoming'], '</span> ';

		// Each event in calendar_events should have:
		//		title, href, is_last, can_edit (are they allowed?), modify_href, and is_today.
		foreach ($context['calendar_events'] as $event)
			echo '
				', $event['can_edit'] ? '<a href="' . $event['modify_href'] . '" title="' . $txt['calendar_edit'] . '"><span class="main_icons calendar_modify"></span></a> ' : '', $event['href'] == '' ? '' : '<a href="' . $event['href'] . '">', $event['is_today'] ? '<strong>' . $event['title'] . '</strong>' : $event['title'], $event['href'] == '' ? '' : '</a>', $event['is_last'] ? '<br>' : ', ';
		echo '
			</p>';
	}
}

/**
 * The stats section of the info center
 */
function template_ic_block_stats()
{
	global $scripturl, $txt, $context, $settings;

	// Show statistical style information...
	echo '
			<div class="sub_bar">
				<h4 class="subbg">
					<a href="', $scripturl, '?action=stats" title="', $txt['more_stats'], '"><i class="fa-solid fa-chart-column"></i> ', $txt['forum_stats'], '</a>
				</h4>
			</div>

			  <div class="boardstats_grid_column">               
				<div class="boardstats_grid_row">  ', $context['common_stats']['total_topics'] ,' ', $txt['topics'], ' </div>
				<div class="boardstats_grid_row">  ', $context['common_stats']['total_posts'] ,' ', $txt['posts'], '</div>
				<div class="boardstats_grid_row">  ', $context['common_stats']['total_members'] ,' ', $txt['members'], '</div>
				<div class="boardstats_grid_row">  ', !empty($settings['show_latest_member']) ? ' ' . $txt['latest_member'] . ': <strong> ' . $context['common_stats']['latest_member']['link'] . '</strong>' : '', '</div>
				<div class="boardstats_grid_row">  ', (!empty($context['latest_post']) ? $txt['latest_post'] . ': <strong>&quot;' . $context['latest_post']['link'] . '&quot;</strong>  (' . $context['latest_post']['time'] . ')</div>' : ''), '
			  </div>';
}

/**
 * The who's online section of the info center
 */
function template_ic_block_online()
{
	global $context, $scripturl, $txt, $modSettings, $settings;
	// "Users online" - in order of activity.
	echo '
			<div class="sub_bar">
				<h4 class="subbg">
					', $context['show_who'] ? '<a href="' . $scripturl . '?action=who">' : '', '<i class="fa-solid fa-users"></i> ', $txt['online_users'], '', $context['show_who'] ? '</a>' : '', '
				</h4>
			</div>
						<div class="boardstats_grid_column">
			<div class="boardstats_grid_row bold">
				', $context['show_who'] ? '<a href="' . $scripturl . '?action=who">' : '', '<strong>', $txt['online'], ': </strong>', comma_format($context['num_guests']), ' ', $context['num_guests'] == 1 ? $txt['guest'] : $txt['guests'], ', ', comma_format($context['num_users_online']), ' ', $context['num_users_online'] == 1 ? $txt['user'] : $txt['users'];

	// Handle hidden users and buddies.
	$bracketList = array();

	if ($context['show_buddies'])
		$bracketList[] = comma_format($context['num_buddies']) . ' ' . ($context['num_buddies'] == 1 ? $txt['buddy'] : $txt['buddies']);

	if (!empty($context['num_spiders']))
		$bracketList[] = comma_format($context['num_spiders']) . ' ' . ($context['num_spiders'] == 1 ? $txt['spider'] : $txt['spiders']);

	if (!empty($context['num_users_hidden']))
		$bracketList[] = comma_format($context['num_users_hidden']) . ' ' . ($context['num_spiders'] == 1 ? $txt['hidden'] : $txt['hidden_s']);

	if (!empty($bracketList))
		echo ' (' . implode(', ', $bracketList) . ')';

	echo $context['show_who'] ? '</a>' : '', ' 
	';
	echo ' </div>

				<div class="boardstats_grid_row">', $txt['most_online_today'], ': <strong>', comma_format($modSettings['mostOnlineToday']), '</strong></div>
				<div class="boardstats_grid_row">', $txt['most_online_ever'], ': ', comma_format($modSettings['mostOnline']), ' (', timeformat($modSettings['mostDate']), ')</div>';

	// Assuming there ARE users online... each user in users_online has an id, username, name, group, href, and link.
	if (!empty($context['users_online']))
	{
		echo '
		<div class="boardstats_grid_row">', sprintf($txt['users_active'], $modSettings['lastActive']), ': ', implode(', ', $context['list_users_online']);
		echo ' </div> ';
		// Showing membergroups?
		if (!empty($settings['show_group_key']) && !empty($context['membergroups']))
			echo '
				<div class="boardstats_grid_row"><span class="membergroups">' . implode(', ', $context['membergroups']) . '</span></div>';
	}
	echo ' </div> ';
}
?>