<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2022 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.2
 */

/**
 * This template handles displaying a topic with 2-column layout
 */
function template_main()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	echo '
	<div class="two-column-layout topic-display-layout">
		<div class="main-content">';

	// Let them know, if their report was a success!
	if ($context['report_sent'])
		echo '
		<div class="infobox">
			', $txt['report_sent'], '
		</div>';

	// Let them know why their message became unapproved.
	if ($context['becomesUnapproved'])
		echo '
		<div class="noticebox">
			', $txt['post_becomes_unapproved'], '
		</div>';

	// Show new topic info here?
	echo '
		<div id="display_head" class="information">
			<h2 class="display_title">
				<span id="top_subject">', $context['subject'], '</span>', ($context['is_locked']) ? ' <span class="main_icons lock"></span>' : '', ($context['is_sticky']) ? ' <span class="main_icons sticky"></span>' : '', '
			</h2>
			<p>', $txt['started_by'], ' ', $context['topic_poster_name'], ', ', $context['topic_started_time'], '</p>';

	// Next - Prev
	echo '
			<span class="nextlinks floatright">', $context['previous_next'], '</span>';

	if (!empty($settings['display_who_viewing']))
	{
		echo '
			<p>';

		// Show just numbers...?
		if ($settings['display_who_viewing'] == 1)
			echo count($context['view_members']), ' ', count($context['view_members']) == 1 ? $txt['who_member'] : $txt['members'];
		// Or show the actual people viewing the topic?
		else
			echo empty($context['view_members_list']) ? '0 ' . $txt['members'] : implode(', ', $context['view_members_list']) . ((empty($context['view_num_hidden']) || $context['can_moderate_forum']) ? '' : ' (+ ' . $context['view_num_hidden'] . ' ' . $txt['hidden'] . ')');

		// Now show how many guests are here too.
		echo $txt['who_and'], $context['view_num_guests'], ' ', $context['view_num_guests'] == 1 ? $txt['guest'] : $txt['guests'], $txt['who_viewing_topic'], '
			</p>';
	}

	// Show the anchor for the top and for the first message. If the first message is new, say so.
	echo '
		</div><!-- #display_head -->
		', $context['first_new_message'] ? '<a id="new"></a>' : '';

	// Is this topic also a poll?
	if ($context['is_poll'])
	{
		echo '
		<div id="poll">
			<div class="cat_bar">
				<h3 class="catbg">
					<span class="main_icons poll"></span>', $context['poll']['is_locked'] ? '<span class="main_icons lock"></span>' : '', ' ', $context['poll']['question'], '
				</h3>
			</div>
			<div class="windowbg">
				<div id="poll_options">';

		// Are they not allowed to vote but allowed to view the options?
		if ($context['poll']['show_results'] || !$context['allow_vote'])
		{
			echo '
					<dl class="options">';

			// Show each option with its corresponding percentage bar.
			foreach ($context['poll']['options'] as $option)
			{
				echo '
						<dt class="', $option['voted_this'] ? ' voted' : '', '">', $option['option'], '</dt>
						<dd class="statsbar generic_bar', $option['voted_this'] ? ' voted' : '', '">';

				if ($context['allow_results_view'])
					echo '
							', $option['bar_ndt'], '
							<span class="percentage">', $option['votes'], ' (', $option['percent'], '%)</span>';

				echo '
						</dd>';
			}

			if ($context['allow_results_view'])
				echo '
					</dl>
					<p><strong>', $txt['poll_total_voters'], ':</strong> ', $context['poll']['total_votes'], '</p>';
		}
		// They are allowed to vote! Go to it!
		else
		{
			echo '
					<form action="', $scripturl, '?action=vote;topic=', $context['current_topic'], '.', $context['start'], ';poll=', $context['poll']['id'], '" method="post" accept-charset="', $context['character_set'], '">';

			// Show a warning if they are allowed more than one option.
			if ($context['poll']['allowed_warning'])
				echo '
						<p class="smalltext">', $context['poll']['allowed_warning'], '</p>';

			echo '
						<ul class="reset options">';

			// Show each option with its button - a radio likely.
			foreach ($context['poll']['options'] as $option)
				echo '
							<li>
								<label for="', $option['id'], '"><input type="', ($context['poll']['max_votes'] == 1 ? 'radio' : 'checkbox'), '" name="options[]" id="', $option['id'], '" value="', $option['id'], '"', $option['voted_this'] ? ' checked="checked"' : '', '> ', $option['option'], '</label>
							</li>';

			echo '
						</ul>
						<div class="submitbutton">
							<input type="submit" value="', $txt['poll_vote'], '" class="button">
							<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">
						</div>
					</form>';
		}

		echo '
				</div>
			</div>
		</div>
		<div id="pollmoderation">
			', template_button_strip($context['poll_buttons'], 'right'), '
		</div>';
	}

	// Does this topic have some events linked to it?
	if (!empty($context['linked_calendar_events']))
	{
		echo '
		<div class="linked_events">
			<div class="title_bar">
				<h3 class="titlebg">', $txt['calendar_linked_events'], '</h3>
			</div>
			<div class="windowbg">
				<ul class="reset">';

		foreach ($context['linked_calendar_events'] as $event)
			echo '
					<li>
						', ($event['can_edit'] ? '<a href="' . $event['modify_href'] . '"> <span class="main_icons calendar_modify"></span></a>' : ''), ' <strong>', $event['title'], '</strong>: ', $event['start_date'], ($event['start_date'] != $event['end_date'] ? ' - ' . $event['end_date'] : ''), '
					</li>';

		echo '
				</ul>
			</div>
		</div>';
	}

	// Show the page index... "Pages: [1]".
	echo '
		<div class="pagesection">
			', template_button_strip($context['normal_buttons'], 'right'), '
			', $context['menu_separator'], '
			<div class="pagelinks floatleft">
				<a href="#bot" class="button">', $txt['go_down'], '</a>
				', $context['page_index'], '
			</div>
		</div>';

	// Show the topic information - icon, subject, etc.
	echo '
		<div id="forumposts">
			<div class="cat_bar">
				<h3 class="catbg">
					', $context['subject'], '
				</h3>
			</div>';

	if (!empty($settings['display_who_viewing']))
	{
		$can_show = !empty($context['view_members']) || ($context['view_num_hidden'] == 0 && !empty($context['view_members_list'])) || !empty($context['view_num_guests']);
		echo '
			<div id="whoisviewing" class="smalltext">',
				$can_show ? $txt['who_viewing_topic'] : '', '
				', $can_show && !empty($context['view_members_list']) ? implode(', ', $context['view_members_list']) . ((empty($context['view_num_hidden']) || $context['can_moderate_forum']) ? '' : ' (+ ' . $context['view_num_hidden'] . ' ' . $txt['hidden'] . ')') : '', '
				', $context['view_num_guests'] > 0 ? ($can_show && !empty($context['view_members_list']) ? ', ' : '') . ($context['view_num_guests'] == 1 ? $txt['one_guest'] : sprintf($txt['many_guests'], $context['view_num_guests'])) : '', $can_show ? '.' : '', '
			</div>';
	}

	// Get all the messages...
	while ($message = $context['get_message']())
		template_single_post($message);

	echo '
		</div><!-- #forumposts -->';

	// Show the page index... "Pages: [1]".
	echo '
		<div class="pagesection">
			', template_button_strip($context['normal_buttons'], 'right'), '
			', $context['menu_separator'], '
			<div class="pagelinks floatleft">
				<a href="#main_content_section" class="button" id="bot">', $txt['go_up'], '</a>
				', $context['page_index'], '
			</div>
		</div>';

	// Show the lower breadcrumbs.
	theme_linktree();

	$mod_buttons = array(
		// The remove sticky button.
		'sticky' => array('text' => 'set_sticky', 'image' => 'sticky.png', 'lang' => true, 'url' => $scripturl . '?action=sticky;topic=' . $context['current_topic'] . '.' . $context['start'] . ';' . $context['session_var'] . '=' . $context['session_id'], 'active' => true),
		// The lock button
		'lock' => array('text' => 'set_lock', 'image' => 'lock.png', 'lang' => true, 'url' => $scripturl . '?action=lock;topic=' . $context['current_topic'] . '.' . $context['start'] . ';' . $context['session_var'] . '=' . $context['session_id'], 'active' => true),
	);

	echo '
		</div><!-- .main-content -->
		<div class="sidebar">';
		
	// サイドバーコンテンツを読み込み
	template_sidebar_content();
	
	echo '
		</div><!-- .sidebar -->
	</div><!-- .two-column-layout -->';

	// Show the jumpto box, or actually...let me not for now.  Where would it go?!
	echo '
	<div id="moderationbuttons">', template_button_strip($context['mod_buttons'], 'bottom', array('id' => 'moderationbuttons_strip')), '</div>';

	// Show a login box or a "you're logged in" message.
	echo '
	<div class="tborder" id="postbuttons">
		<div class="buttonlist floatright">
			', template_button_strip($context['normal_buttons']), '
		</div>
	</div>';

	// Javascript for deciding which handling we want.
	echo '
<script>
	var oQuickReply = new QuickReply({
		bDefaultCollapsed: ', !empty($options['display_quick_reply']) && $options['display_quick_reply'] > 2 ? 'false' : 'true', ',
		iTopicId: ', $context['current_topic'], ',
		iStart: ', $context['start'], ',
		sScriptUrl: smf_scripturl,
		sImagesUrl: smf_images_url,
		sContainerId: "quickReplyOptions",
		sImageId: "quickReplyExpand",
		sImageCollapsed: "collapse.png",
		sImageExpanded: "expand.png",
		sJumpAnchor: "quickreply",
		bIsFull: ', $context['can_reply'] && !empty($options['display_quick_reply']) && $options['display_quick_reply'] == 1 ? 'true' : 'false', '
	});

	if (typeof(dragDropAttachments) !== "undefined")
		dragDropAttachments.update();
</script>';
}

/**
 * Display a single post
 */
function template_single_post($message)
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	$ignoring = false;

	if ($message['can_remove'])
		$context['removableMessageIDs'][] = $message['id'];

	// Are we ignoring this message?
	if (!empty($message['is_ignored']))
	{
		$ignoring = true;
		$context['ignoredMsgs'][] = $message['id'];
	}

	// Show the message anchor and a "new" anchor if this message is new.
	echo '
				<div class="', $message['css_class'], '" id="msg' . $message['id'] . '">
					', $message['id'] != $context['first_message'] ? '
					' . ($message['first_new'] ? '<a id="new"></a>' : '') : '', '
					<div class="post_wrapper">';

	// Show information about the poster of this message.
	echo '
						<div class="poster">';

	// Are there any custom fields above the member name?
	if (!empty($message['custom_fields']['above_member']))
	{
		echo '
							<div class="custom_fields_above_member">
								<ul class="nolist">';

		foreach ($message['custom_fields']['above_member'] as $custom)
			echo '
									<li class="custom ', $custom['col_name'], '">', $custom['value'], '</li>';

		echo '
								</ul>
							</div>';
	}

	echo '
							<h4>';

	// Show online and offline buttons?
	if (!empty($modSettings['onlineEnable']) && !$message['member']['is_guest'])
		echo '
								', $context['can_send_pm'] ? '<a href="' . $message['member']['online']['href'] . '" title="' . $message['member']['online']['label'] . '">' : '', '<span class="' . ($message['member']['online']['is_online'] == 1 ? 'on' : 'off') . '" title="' . $message['member']['online']['text'] . '"></span>', $context['can_send_pm'] ? '</a>' : '';

	// Custom fields BEFORE the username?
	if (!empty($message['custom_fields']['before_member']))
		foreach ($message['custom_fields']['before_member'] as $custom)
			echo '
								<span class="custom ', $custom['col_name'], '">', $custom['value'], '</span>';

	// Show a link to the member's profile.
	echo '
								', $message['member']['link'];

	// Custom fields AFTER the username?
	if (!empty($message['custom_fields']['after_member']))
		foreach ($message['custom_fields']['after_member'] as $custom)
			echo '
								<span class="custom ', $custom['col_name'], '">', $custom['value'], '</span>';

	// Begin display of user info
	echo '
							</h4>
							<ul class="user_info">';

	// Show the member's custom title, if they have one.
	if (!empty($message['member']['title']))
		echo '
								<li class="title">', $message['member']['title'], '</li>';

	// Show the member's primary group (like 'Administrator') if they have one.
	if (!empty($message['member']['group']))
		echo '
								<li class="membergroup">', $message['member']['group'], '</li>';

	// Show the user's avatar.
	if (!empty($modSettings['show_user_images']) && empty($options['show_no_avatars']) && !empty($message['member']['avatar']['image']))
		echo '
								<li class="avatar">
									<a href="', $message['member']['href'], '" rel="nofollow">', $message['member']['avatar']['image'], '</a>
								</li>';

	// Are there any custom fields below the avatar?
	if (!empty($message['custom_fields']['below_avatar']))
		foreach ($message['custom_fields']['below_avatar'] as $custom)
			echo '
								<li class="custom ', $custom['col_name'], '">', $custom['value'], '</li>';

	// Don't show these things for guests.
	if (!$message['member']['is_guest'])
	{
		// Show the post group icons
		echo '
								<li class="icons">', $message['member']['group_icons'], '</li>';

		// Show the post group if and only if they have no other group or the option is on, and they are in a post group.
		if ((empty($modSettings['hide_post_group']) || empty($message['member']['group'])) && !empty($message['member']['post_group']))
			echo '
								<li class="postgroup">', $message['member']['post_group'], '</li>';

		// Show how many posts they have made.
		if (!isset($context['disabled_fields']['posts']))
			echo '
								<li class="postcount">', $txt['member_postcount'], ': ', $message['member']['posts'], '</li>';

		// Show their personal text?
		if (!empty($modSettings['show_blurb']) && !empty($message['member']['blurb']))
			echo '
								<li class="blurb">', $message['member']['blurb'], '</li>';

		// Any custom fields to show as icons?
		if (!empty($message['custom_fields']['icons']))
		{
			echo '
								<li class="im_icons">
									<ol>';

			foreach ($message['custom_fields']['icons'] as $custom)
				echo '
										<li class="custom ', $custom['col_name'], '">', $custom['value'], '</li>';

			echo '
									</ol>
								</li>';
		}

		// Show the website and email address buttons.
		if ($message['member']['show_profile_buttons'])
		{
			echo '
								<li class="profile">
									<ol class="profile_icons">';

			// Don't show an icon if they haven't specified a website.
			if (!empty($message['member']['website']['url']) && !isset($context['disabled_fields']['website']))
				echo '
										<li><a href="', $message['member']['website']['url'], '" title="' . $message['member']['website']['title'] . '" target="_blank" rel="noopener">', ($settings['use_image_buttons'] ? '<span class="main_icons www centericon" title="' . $message['member']['website']['title'] . '"></span>' : $txt['www']), '</a></li>';

			// Since we know this person isn't a guest, you *can* message them.
			if ($context['can_send_pm'])
				echo '
										<li><a href="', $scripturl, '?action=pm;sa=send;u=', $message['member']['id'], '" title="', $message['member']['online']['is_online'] ? $txt['pm_online'] : $txt['pm_offline'], '">', $settings['use_image_buttons'] ? '<span class="main_icons im_' . ($message['member']['online']['is_online'] ? 'on' : 'off') . ' centericon" title="' . ($message['member']['online']['is_online'] ? $txt['pm_online'] : $txt['pm_offline']) . '"></span> ' : ($message['member']['online']['is_online'] ? $txt['pm_online'] : $txt['pm_offline']), '</a></li>';

			// Show the email if necessary
			if (!empty($message['member']['email']) && $message['member']['show_email'])
				echo '
										<li class="email"><a href="mailto:' . $message['member']['email'] . '" rel="nofollow">', ($settings['use_image_buttons'] ? '<span class="main_icons mail centericon" title="' . $txt['email'] . '"></span>' : $txt['email']), '</a></li>';

			echo '
									</ol>
								</li><!-- .profile -->';
		}

		// Any custom fields for standard placement?
		if (!empty($message['custom_fields']['standard']))
			foreach ($message['custom_fields']['standard'] as $custom)
				echo '
								<li class="custom ', $custom['col_name'], '">', $custom['title'], ': ', $custom['value'], '</li>';
	}
	// Otherwise, show the guest's email.
	elseif (!empty($message['member']['email']) && $message['member']['show_email'])
		echo '
								<li class="email">
									<a href="mailto:' . $message['member']['email'] . '" rel="nofollow">', ($settings['use_image_buttons'] ? '<span class="main_icons mail centericon" title="' . $txt['email'] . '"></span>' : $txt['email']), '</a>
								</li>';

	// Show the IP to this user for this post - because you can moderate?
	if (!empty($context['can_moderate_forum']) && !empty($message['member']['ip']))
		echo '
								<li class="poster_ip">
									<a href="', $scripturl, '?action=', !empty($message['member']['is_guest']) ? 'trackip' : 'profile;area=tracking;sa=ip;u=' . $message['member']['id'], ';searchip=', $message['member']['ip'], '" data-hover="', $message['member']['ip'], '" class="show_on_hover"><span>', $txt['show_ip'], '</span></a> <a href="', $scripturl, '?action=helpadmin;help=see_admin_ip" onclick="return reqOverlayDiv(this.href);" class="help">(?)</a>
								</li>';

	// Or, should we show it because this is you?
	elseif ($message['can_see_ip'])
		echo '
								<li class="poster_ip">
									<a href="', $scripturl, '?action=helpadmin;help=see_member_ip" onclick="return reqOverlayDiv(this.href);" class="help show_on_hover" data-hover="', $message['member']['ip'], '"><span>', $txt['show_ip'], '</span></a>
								</li>';

	// Okay, are you at least logged in? Then we can show something about why IPs are logged...
	elseif (!$context['user']['is_guest'])
		echo '
								<li class="poster_ip">
									<a href="', $scripturl, '?action=helpadmin;help=see_member_ip" onclick="return reqOverlayDiv(this.href);" class="help">', $txt['logged'], '</a>
								</li>';

	// Otherwise, you see NOTHING!
	else
		echo '
								<li class="poster_ip">', $txt['logged'], '</li>';

	// Show the post itself, finally!
	echo '
							</ul>
						</div><!-- .poster -->
						<div class="postarea">
							<div class="keyinfo">
								<div id="subject_', $message['id'], '" class="subject_title">
									', $message['link'], '
								</div>
								<div class="postinfo">
									<span class="messageicon">
										<img src="', $message['icon_url'] . '" alt="">
									</span>
									<a href="', $message['href'], '" rel="nofollow" title="', $message['subject'], '" class="smalltext">', $message['time'], '</a>
								</div>
								<div id="msg_', $message['id'], '_quick_mod"', $ignoring ? ' style="display:none;"' : '', '></div>
							</div><!-- .keyinfo -->
							<div class="post">
								<div class="inner" data-msgid="', $message['id'], '" id="msg_', $message['id'], '"', $ignoring ? ' style="display:none;"' : '', '>
									', $message['body'], '
								</div>
							</div><!-- .post -->
						</div><!-- .postarea -->
					</div><!-- .post_wrapper -->
				</div><!-- msg -->';
}