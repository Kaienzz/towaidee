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