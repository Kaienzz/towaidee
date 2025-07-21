<?php
/**
 * Simple Machines Forum (SMF)
 *
 * サイドバー用のテンプレート - 2コラムレイアウト対応
 *
 * このテンプレートでは、右側にAdSense、最近の投稿、統計情報などのコンテンツを表示します。
 */

/**
 * メインのサイドバーコンテンツ（2コラムレイアウト用）
 */
function template_sidebar_content()
{
	global $context, $txt, $scripturl, $modSettings;

	// AdSense ウィジェット
	template_sidebar_adsense();
	
	// 最近の投稿ウィジェット
	template_sidebar_recent_posts();
	
	// フォーラム統計ウィジェット
	template_sidebar_stats();
	
	// オンラインユーザーウィジェット
	template_sidebar_online_users();
}

/**
 * AdSense ウィジェット
 */
function template_sidebar_adsense()
{
	echo '
	<div class="sidebar-widget adsense-widget">
		<h3>広告</h3>
		<div class="widget-content">
			<div class="adsense-placeholder">
				AdSense広告エリア<br>
				300x250px
			</div>
		</div>
	</div>';
}

/**
 * 最近の投稿ウィジェット
 */
function template_sidebar_recent_posts()
{
	global $context, $txt, $scripturl;
	
	// 最近の投稿データを取得（実際の実装では適切なデータを取得する必要があります）
	$recent_posts = array(
		array(
			'title' => 'サンプル投稿タイトル1',
			'href' => $scripturl . '?topic=1.0',
			'poster' => 'ユーザー1',
			'time' => '2時間前'
		),
		array(
			'title' => 'サンプル投稿タイトル2',
			'href' => $scripturl . '?topic=2.0',
			'poster' => 'ユーザー2',
			'time' => '4時間前'
		),
		array(
			'title' => 'サンプル投稿タイトル3',
			'href' => $scripturl . '?topic=3.0',
			'poster' => 'ユーザー3',
			'time' => '6時間前'
		),
	);

	echo '
	<div class="sidebar-widget">
		<h3>最近の投稿</h3>
		<div class="widget-content">
			<ul class="recent-posts-list">';
		
	foreach ($recent_posts as $post)
	{
		echo '
				<li>
					<a href="', $post['href'], '">', $post['title'], '</a>
					<div class="recent-posts-meta">
						by ', $post['poster'], ' - ', $post['time'], '
					</div>
				</li>';
	}
	
	echo '
			</ul>
		</div>
	</div>';
}

/**
 * フォーラム統計ウィジェット
 */
function template_sidebar_stats()
{
	global $context, $txt, $modSettings;
	
	// 基本的な統計情報を表示
	$stats = array(
		'総投稿数' => !empty($modSettings['totalMessages']) ? number_format($modSettings['totalMessages']) : '0',
		'総トピック数' => !empty($modSettings['totalTopics']) ? number_format($modSettings['totalTopics']) : '0',
		'総メンバー数' => !empty($modSettings['totalMembers']) ? number_format($modSettings['totalMembers']) : '0',
		'最新メンバー' => !empty($context['common_stats']['latest_member']['link']) ? $context['common_stats']['latest_member']['link'] : 'なし'
	);

	echo '
	<div class="sidebar-widget">
		<h3>フォーラム統計</h3>
		<div class="widget-content">
			<ul class="stats-list">';
		
	foreach ($stats as $label => $value)
	{
		echo '
				<li>
					<span class="stat-label">', $label, '</span>
					<span class="stat-value">', $value, '</span>
				</li>';
	}
	
	echo '
			</ul>
		</div>
	</div>';
}

/**
 * オンラインユーザーウィジェット
 */
function template_sidebar_online_users()
{
	global $context, $txt;
	
	// オンラインユーザー情報が利用可能な場合のみ表示
	if (!empty($context['show_who']))
	{
		echo '
		<div class="sidebar-widget">
			<h3>オンラインユーザー</h3>
			<div class="widget-content">';
			
		if (!empty($context['users_online']))
		{
			echo '
				<div class="online-users-count">
					現在 ', $context['num_users_online'], ' 人がオンライン
				</div>
				<ul class="online-users-list">';
			
			foreach ($context['users_online'] as $user)
			{
				echo '
					<li>', $user['link'], '</li>';
			}
			
			echo '
				</ul>';
		}
		else
		{
			echo '
				<p>現在オンラインのユーザーはいません。</p>';
		}
		
		echo '
			</div>
		</div>';
	}
}

/**
 * 従来のサイドバー関数（後方互換性のため）
 */
function template_sidebar()
{
	template_sidebar_content();
}

/**
 * Display left sidebar content（既存機能との統合）
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
 * Display right sidebar content（既存機能との統合）
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