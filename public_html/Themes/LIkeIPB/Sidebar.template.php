<?php
/**
 * Sidebar template functions for LikeIPB theme
 */

/**
 * Display left sidebar content
 */
function template_left_sidebar()
{
	global $context, $scripturl, $txt, $modSettings;
	
	echo '
	<div class="sidebar_block">
		<h4 class="sidebar_title">', $txt['quick_navigation'], '</h4>
		<div class="sidebar_content_inner">
			<ul>
				<li><a href="', $scripturl, '">', $txt['home'], '</a></li>
				<li><a href="', $scripturl, '?action=unread">', $txt['unread_topics_visit'], '</a></li>
				<li><a href="', $scripturl, '?action=unreadreplies">', $txt['unread_replies'], '</a></li>';
	
	if ($context['allow_search'])
		echo '
				<li><a href="', $scripturl, '?action=search">', $txt['search'], '</a></li>';
	
	echo '
				<li><a href="', $scripturl, '?action=stats">', $txt['forum_stats'], '</a></li>
				<li><a href="', $scripturl, '?action=mlist">', $txt['member_list'], '</a></li>
			</ul>
		</div>
	</div>';
	
	// Recent topics
	if (!empty($modSettings['enableRecentPosts']))
	{
		echo '
	<div class="sidebar_block">
		<h4 class="sidebar_title">', $txt['recent_posts'], '</h4>
		<div class="sidebar_content_inner">';
		
		// Get recent topics
		$recent_topics = getRecentTopics(5);
		if (!empty($recent_topics))
		{
			echo '<ul>';
			foreach ($recent_topics as $topic)
			{
				echo '
				<li><a href="', $scripturl, '?topic=', $topic['id_topic'], '.0">', $topic['subject'], '</a></li>';
			}
			echo '</ul>';
		}
		else
		{
			echo '<p>', $txt['no_recent_topics'], '</p>';
		}
		
		echo '
		</div>
	</div>';
	}
}

/**
 * Display right sidebar content
 */
function template_right_sidebar()
{
	global $context, $scripturl, $txt, $modSettings, $user_info;
	
	// Forum statistics
	echo '
	<div class="sidebar_block">
		<h4 class="sidebar_title">', $txt['forum_stats'], '</h4>
		<div class="sidebar_content_inner">
			<p><strong>', $txt['total_members'], ':</strong> ', comma_format($modSettings['totalMembers']), '</p>
			<p><strong>', $txt['total_posts'], ':</strong> ', comma_format($modSettings['totalMessages']), '</p>
			<p><strong>', $txt['total_topics'], ':</strong> ', comma_format($modSettings['totalTopics']), '</p>';
	
	if (!empty($modSettings['latestMember']))
		echo '
			<p><strong>', $txt['latest_member'], ':</strong> <a href="', $scripturl, '?action=profile;u=', $modSettings['latestMember'], '">', $modSettings['latestRealName'], '</a></p>';
	
	echo '
		</div>
	</div>';
	
	// Online users
	if (!empty($modSettings['showOnlineIndex']))
	{
		echo '
	<div class="sidebar_block">
		<h4 class="sidebar_title">', $txt['online_users'], '</h4>
		<div class="sidebar_content_inner">';
		
		if (!empty($context['users_online']))
		{
			echo '<p><strong>', $txt['online'], ':</strong> ', count($context['users_online']), '</p>';
			echo '<ul>';
			$count = 0;
			foreach ($context['users_online'] as $user)
			{
				if ($count >= 10) break; // Limit to 10 users
				echo '
				<li><a href="', $scripturl, '?action=profile;u=', $user['id'], '">', $user['name'], '</a></li>';
				$count++;
			}
			echo '</ul>';
		}
		else
		{
			echo '<p>', $txt['no_users_online'], '</p>';
		}
		
		echo '
		</div>
	</div>';
	}
	
	// User info (if logged in)
	if ($context['user']['is_logged'])
	{
		echo '
	<div class="sidebar_block">
		<h4 class="sidebar_title">', $txt['hello_member_ndt'], ' ', $context['user']['name'], '</h4>
		<div class="sidebar_content_inner">
			<p><strong>', $txt['posts'], ':</strong> ', comma_format($user_info['posts']), '</p>
			<p><strong>', $txt['date_registered'], ':</strong> ', $context['user']['registered'], '</p>';
		
		if (!empty($context['user']['unread_messages']))
			echo '
			<p><strong>', $txt['unread_messages'], ':</strong> <a href="', $scripturl, '?action=pm">', $context['user']['unread_messages'], '</a></p>';
		
		echo '
		</div>
	</div>';
	}
}

/**
 * Get recent topics (helper function)
 */
function getRecentTopics($limit = 5)
{
	global $smcFunc, $modSettings;
	
	$request = $smcFunc['db_query']('', '
		SELECT t.id_topic, t.subject, t.num_replies, t.num_views, t.id_board
		FROM {db_prefix}topics AS t
		INNER JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
		WHERE {query_see_board}
		ORDER BY t.id_topic DESC
		LIMIT {int:limit}',
		array(
			'limit' => $limit,
		)
	);
	
	$topics = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$topics[] = array(
			'id_topic' => $row['id_topic'],
			'subject' => $row['subject'],
			'num_replies' => $row['num_replies'],
			'num_views' => $row['num_views'],
		);
	}
	$smcFunc['db_free_result']($request);
	
	return $topics;
}
?>