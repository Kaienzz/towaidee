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
 * The top part of the outer layer of the boardindex
 */
function template_boardindex_outer_above()
{
	global $context;

	if (empty($context['info_center']))
	{
		// Newsfader
		template_newsfader();

		return;
	}

	echo '
	<!-- st_theme_container -->
	<div id="st_theme_container">
		<!-- boardindex_container -->
		<div id="st_theme_boardindex_container">';

			// Newsfader
			template_newsfader();
}

/**
 * This shows the newsfader
 */
function template_newsfader()
{
	global $context, $settings, $txt;

	// Show the news fader?  (assuming there are things to show...)
	if (!empty($settings['show_newsfader']) && !empty($context['news_lines']))
	{
		echo '
		<div class="forum_news">
			<h2>
				<span class="news_icon"><i class="news_icon fa fa-newspaper"></i></span>
				', $txt['news'], ':
			</h2>
			<ul id="smf_slider">';

		foreach ($context['news_lines'] as $news)
			echo '
				<li>', $news, '</li>';

		echo '
			</ul>
		</div>';

		addInlineJavaScript('
			jQuery("#smf_slider").slippry({
				pause: smf_newsfader_time,
				adaptiveHeight: 0,
				captions: 0,
				controls: 0,
			});
		', true);
	}
}

/**
 * This actually displays the board index
 */
function template_main()
{
	global $context, $txt;

	echo '
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
				</h3>
			</div>
			', !empty($category['description']) ? '
			<div class="desc">' . $category['description'] . '</div>' : '', '
			<div id="category_', $category['id'], '_boards" ', (!empty($category['css_class']) ? ('class="' . $category['css_class'] . '"') : ''), $category['is_collapsed'] ? ' style="display: none;"' : '', '>';

		/* Each board in each category's boards has:
		new (is it new?), id, name, description, moderators (see below), link_moderators (just a list.),
		children (see below.), link_children (easier to use.), children_new (are they new?),
		topics (# of), posts (# of), link, href, and last_post. (see below.) */
		foreach ($category['boards'] as $board)
		{
			echo '
				<div id="board_', $board['id'], '" class="up_contain b_', $board['type'], (!empty($board['css_class']) ? ' ' . $board['css_class'] : ''), '">
				
					<div class="board_icon">
						', function_exists('template_bi_' . $board['type'] . '_icon') ? call_user_func('template_bi_' . $board['type'] . '_icon', $board) : template_bi_board_icon($board), '
					</div>

					<div class="info">
						<div class="info">
							', function_exists('template_bi_' . $board['type'] . '_info') ? call_user_func('template_bi_' . $board['type'] . '_info', $board) : template_bi_board_info($board), '
						</div>

						', function_exists('template_bi_' . $board['type'] . '_children') ? call_user_func('template_bi_' . $board['type'] . '_children', $board) : template_bi_board_children($board) , '
					</div>

					<div class="board_stats">
						', function_exists('template_bi_' . $board['type'] . '_stats') ? call_user_func('template_bi_' . $board['type'] . '_stats', $board) : template_bi_board_stats($board), '
					</div>

					<div class="lastpost">
						', function_exists('template_bi_' . $board['type'] . '_lastpost') ? call_user_func('template_bi_' . $board['type'] . '_lastpost', $board) : template_bi_board_lastpost($board), '
					</div>

				</div><!-- #board_[id] -->';
		}

		echo '
			</div><!-- #category_[id]_boards -->
		</div><!-- .main_container -->';
	}

	echo '
	</div><!-- #boardindex_table -->';

	// Show the mark all as read button?
	if ($context['user']['is_logged'] && !empty($context['categories']))
		echo '
	<div class="mark_read">
		', template_button_strip($context['mark_read_button'], 'right'), '
	</div>';
}

/**
 * The lower part of the outer layer of the board index
 */
function template_boardindex_outer_below()
{
	global $context;

	if (empty($context['info_center']))
		return;

	echo '
		</div><!-- boardindex_container -->
		', template_info_center(), '
	</div><!-- st_theme_container -->';
}

/**
 * Displays the info center
 */
function template_info_center()
{
	global $context;

	// Here's where the "Info Center" starts...
	echo '
	<div id="info_center">';

		// Newsfader
		// template_newsfader();

	foreach ($context['info_center'] as $block)
	{
		$func = 'template_ic_block_' . $block['tpl'];
		echo '
		<div class="roundframe ic_' . $block['tpl'] . '">
			', $func(), '
		</div>';
	}

	echo '
	</div><!-- #info_center -->';
}

/**
 * The recent posts section of the info center
 */
function template_ic_block_recent()
{
	global $context, $scripturl, $txt;

	// This is the "Recent Posts" bar.
	echo '
			<div class="title_bar">
				<h4 class="titlebg">
					<a href="', $scripturl, '?action=recent"><span class="main_icons recent_posts"></span> ', $txt['recent_posts'], '</a>
				</h4>
			</div>
			<div id="recent_posts_content">';

		foreach ($context['latest_posts'] as $post)
			echo '
					<div class="lastpost-block">
						', (!empty($post['poster']['avatar']) && !empty($post['poster']['avatar']) ? themecustoms_avatar($post['poster']['avatar']['href'], $post['poster']['id']) : ''), '
						<p>
							<span class="post-link">', $post['link'], ' ', $txt['by'] , '</span>
							<span class="post-user">', $post['poster']['link'], '</span><br>
							<span class="post-time">', $post['time'], '</span><span class="post-board"> ', $txt['in'], ' ', $post['board']['link'], '</span>
						</p>
					</div>';
	echo '
			</div>
			<a class="see-more" href="', $scripturl, '?action=recent">', $txt['see_more'], themecustoms_icon('fa fa-plus'), '</a><!-- #recent_posts_content -->';
}

/**
 * The calendar section of the info center
 */
function template_ic_block_calendar()
{
	global $context, $scripturl, $txt;

	// Show information about events, birthdays, and holidays on the calendar.
	echo '
			<div class="title_bar">
				<h4 class="titlebg">
					<a href="', $scripturl, '?action=calendar' . '"><span class="main_icons calendar"></span> ', $context['calendar_only_today'] ? $txt['calendar_today'] : $txt['calendar_upcoming'], '</a>
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
	global $scripturl, $txt, $context, $settings, $modSettings;

	// Show statistical style information...
	echo '
			<div class="title_bar">
				<h4 class="titlebg">
					<a href="', $scripturl, '?action=stats" title="', $txt['more_stats'], '"><span class="main_icons stats"></span> ', $txt['forum_stats'], '</a>
				</h4>
			</div>
			<p class="inline">
				', $context['common_stats']['boardindex_total_posts'], '', !empty($settings['show_latest_member']) ? ' - ' . $txt['latest_member'] . ': <strong> ' . $context['common_stats']['latest_member']['link'] . '</strong>' : '', '<br>
				', (!empty($context['latest_post']) ? $txt['latest_post'] . ': <strong>&quot;' . $context['latest_post']['link'] . '&quot;</strong>  (' . $context['latest_post']['time'] . ')<br>' : ''), '
				<a href="', $scripturl, '?action=recent">', $txt['recent_view'], '</a>
			</p>';
}

/**
 * The who's online section of the info center
 */
function template_ic_block_online()
{
	global $context, $scripturl, $txt, $settings, $modSettings;
	// "Users online" - in order of activity.
	echo '
			<div class="title_bar">
				<h4 class="titlebg">
					', $context['show_who'] ? '<a href="' . $scripturl . '?action=who">' : '', '<span class="main_icons people"></span> ', $txt['online_users'], '', $context['show_who'] ? '</a>' : '', '
				</h4>
			</div>
			<p class="inline">
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

	echo $context['show_who'] ? '</a>' : '';

	// Assuming there ARE users online... each user in users_online has an id, username, name, group, href, and link.
	if (!empty($context['users_online']))
	{
		echo '
				', sprintf($txt['users_active'], $modSettings['lastActive']), ': <br>
				<span class="users_online_list' . (empty($settings['st_enable_avatars_online']) ? ' only-name' : '') . '">';

			// Show the regular list
			if (empty($settings['st_enable_avatars_online']))
				echo implode(',&nbsp;', $context['list_users_online']);
			// Avatars
			else
				foreach ($context['list_users_online'] as $user)
					echo '
						<span class="show_member">' . $user, '</span>';
			
			echo '
				</span>';

		// Showing membergroups?
		if (!empty($settings['show_group_key']) && !empty($context['membergroups']))
			echo '
				<span class="membergroups">' . implode(', ', $context['membergroups']) . '</span>';
	}

	echo '
			</p>';
}