<?php
/**
 * Simple Machines Forum (SMF)
 *
 * サイドバー用のテンプレート - 2コラムレイアウト対応
 *
 * このテンプレートでは、右側にAdSense、最近の投稿、統計情報などのコンテンツを表示します。
 */

/**
 * メインのサイドバーコンテンツ（2コラムレイアウト用）- 動的ウィジェット対応
 */
function template_sidebar_content()
{
	global $context, $txt, $scripturl, $modSettings;

	// 動的ウィジェットを取得して表示
	$widgets = getSidebarWidgets('right');
	
	if (!empty($widgets))
	{
		foreach ($widgets as $widget)
		{
			template_display_widget($widget);
		}
	}
	else
	{
		// フォールバック：デフォルトウィジェットを表示
		template_sidebar_adsense();
		template_sidebar_recent_posts();
		template_sidebar_stats();
		template_sidebar_online_users();
	}
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
 * 最近の投稿ウィジェット（フォールバック用）
 */
function template_sidebar_recent_posts()
{
	global $context, $txt, $scripturl;
	
	// 実際のデータを取得
	$recent_posts = getRecentPosts(5);

	echo '
	<div class="sidebar-widget">
		<h3>最近の投稿</h3>
		<div class="widget-content">';
	
	if (!empty($recent_posts))
	{
		echo '<ul class="recent-posts-list" style="list-style-type: disc; padding-left: 20px; margin: 0;">';
		foreach ($recent_posts as $post)
		{
			echo '
				<li style="margin-bottom: 8px;">
					<a href="', $scripturl, '?topic=', $post['id_topic'], '.0">', htmlspecialchars($post['subject']), '</a>
				</li>';
		}
		echo '</ul>';
	}
	else
	{
		echo '<p>最新の投稿はありません。</p>';
	}
	
	echo '
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
			<p><strong>', $txt['date_registered'], ':</strong> ', !empty($context['user']['registered_raw']) ? timeformat($context['user']['registered_raw']) : $txt['not_applicable'], '</p>';
		
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
			AND t.id_board != 8
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

/**
 * 動的ウィジェット表示機能
 */
function template_display_widget($widget)
{
	global $context, $txt, $scripturl, $modSettings;

	echo '
	<div class="sidebar-widget widget-', $widget['type'], '" data-widget-id="', $widget['id'], '">
		<h3>', $widget['title'], '</h3>
		<div class="widget-content">';

	switch ($widget['type'])
	{
		case 'html':
			echo $widget['content'];
			break;

		case 'php':
			// セキュリティ考慮：管理者のみPHPコード実行可能
			if (!empty($modSettings['widget_allow_php']) && allowedTo('admin_forum'))
			{
				try {
					eval('?>' . $widget['content']);
				} catch (Exception $e) {
					echo '<div class="errorbox">Widget Error: ', $e->getMessage(), '</div>';
				}
			}
			else
			{
				echo '<div class="infobox">PHP execution is disabled for security reasons.</div>';
			}
			break;

		case 'recent_posts':
			template_widget_recent_posts_dynamic();
			break;

		case 'stats':
			template_widget_stats_dynamic();
			break;

		case 'japanese_jobs':
			template_widget_japanese_jobs_dynamic();
			break;

		case 'adsense':
			echo $widget['content'];
			break;

		case 'custom':
		default:
			echo $widget['content'];
			break;
	}

	echo '
		</div>
	</div>';
}

/**
 * データベースから動的ウィジェットを取得
 */
function getSidebarWidgets($position = 'right')
{
	global $smcFunc, $context;

	$current_page = getCurrentPageType();

	$request = $smcFunc['db_query']('', '
		SELECT id_widget, widget_name, widget_title, widget_content, widget_type
		FROM {db_prefix}sidebar_widgets
		WHERE position = {string:position}
			AND is_enabled = 1
			AND (display_pages IS NULL OR display_pages = {string:empty} OR display_pages LIKE {string:current_page})
		ORDER BY display_order',
		array(
			'position' => $position,
			'empty' => '',
			'current_page' => '%"' . $current_page . '"%'
		)
	);

	$widgets = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$widgets[] = array(
			'id' => $row['id_widget'],
			'name' => $row['widget_name'],
			'title' => $row['widget_title'],
			'content' => $row['widget_content'],
			'type' => $row['widget_type']
		);
	}
	$smcFunc['db_free_result']($request);

	return $widgets;
}

/**
 * 現在のページタイプを取得
 */
function getCurrentPageType()
{
	global $context;

	// Board index (forum homepage)
	if (empty($context['current_action']) && empty($context['current_board']) && empty($context['current_topic']))
		return 'index';

	// Message index (topic list)
	if (!empty($context['current_board']) && empty($context['current_topic']) && (empty($context['current_action']) || $context['current_action'] == 'messageindex'))
		return 'messageindex';

	// Topic display (individual topic/posts)
	if (!empty($context['current_topic']) && (empty($context['current_action']) || $context['current_action'] == 'display'))
		return 'display';

	// Other actions
	if (!empty($context['current_action']))
		return $context['current_action'];

	return 'unknown';
}

/**
 * 動的最新投稿ウィジェット（データベースから実際のデータを取得）
 */
function template_widget_recent_posts_dynamic()
{
	global $context, $txt, $scripturl;

	$recent_posts = getRecentPosts(5);

	if (!empty($recent_posts))
	{
		echo '<ul class="recent-posts-list" style="list-style-type: disc; padding-left: 20px; margin: 0;">';
		foreach ($recent_posts as $post)
		{
			echo '
				<li style="margin-bottom: 8px;">
					<a href="', $scripturl, '?topic=', $post['id_topic'], '.0">', htmlspecialchars($post['subject']), '</a>
				</li>';
		}
		echo '</ul>';
	}
	else
	{
		echo '<p>最新の投稿はありません。</p>';
	}
}

/**
 * 動的統計ウィジェット（リアルタイムデータ）
 */
function template_widget_stats_dynamic()
{
	global $context, $txt, $modSettings;

	$stats = array(
		$txt['total_posts'] => !empty($modSettings['totalMessages']) ? comma_format($modSettings['totalMessages']) : '0',
		$txt['total_topics'] => !empty($modSettings['totalTopics']) ? comma_format($modSettings['totalTopics']) : '0',
		$txt['total_members'] => !empty($modSettings['totalMembers']) ? comma_format($modSettings['totalMembers']) : '0',
		$txt['latest_member'] => !empty($context['common_stats']['latest_member']['link']) ? $context['common_stats']['latest_member']['link'] : $txt['not_applicable']
	);

	echo '<ul class="stats-list">';
	foreach ($stats as $label => $value)
	{
		echo '
			<li>
				<span class="stat-label">', $label, '</span>
				<span class="stat-value">', $value, '</span>
			</li>';
	}
	echo '</ul>';
}

/**
 * 最新投稿データを取得（ウィジェット用）
 */
function getRecentPosts($limit = 5)
{
	global $smcFunc;

	$request = $smcFunc['db_query']('', '
		SELECT m.id_msg, m.id_topic, m.subject, m.poster_name, m.poster_time,
		       t.id_board
		FROM {db_prefix}messages AS m
		INNER JOIN {db_prefix}topics AS t ON (t.id_topic = m.id_topic)
		INNER JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
		WHERE {query_see_board}
			AND t.id_board != 8
		ORDER BY m.id_msg DESC
		LIMIT {int:limit}',
		array(
			'limit' => $limit,
		)
	);

	$posts = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$posts[] = array(
			'id_msg' => $row['id_msg'],
			'id_topic' => $row['id_topic'],
			'subject' => $row['subject'],
			'poster_name' => $row['poster_name'],
			'poster_time' => $row['poster_time'],
		);
	}
	$smcFunc['db_free_result']($request);

	return $posts;
}

/**
 * Japanese Jobs専用最新投稿ウィジェット表示
 */
function template_widget_japanese_jobs_dynamic()
{
	global $context, $txt, $scripturl;

	$japanese_jobs = getJapaneseJobsPosts(5);

	if (!empty($japanese_jobs))
	{
		echo '<ul class="recent-posts-list" style="list-style-type: disc; padding-left: 20px; margin: 0;">';
		foreach ($japanese_jobs as $job)
		{
			echo '
				<li style="margin-bottom: 8px;">
					<a href="', $scripturl, '?topic=', $job['id_topic'], '.0">', htmlspecialchars($job['subject']), '</a>
				</li>';
		}
		echo '</ul>';
	}
	else
	{
		echo '<p>最新の求人情報はありません。</p>';
	}
}

/**
 * Japanese Jobs（カテゴリー8）の最新投稿データを取得
 */
function getJapaneseJobsPosts($limit = 5)
{
	global $smcFunc;

	$request = $smcFunc['db_query']('', '
		SELECT m.id_msg, m.id_topic, m.subject, m.poster_name, m.poster_time,
		       t.id_board
		FROM {db_prefix}messages AS m
		INNER JOIN {db_prefix}topics AS t ON (t.id_topic = m.id_topic)
		INNER JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
		WHERE {query_see_board}
			AND t.id_board = 8
		ORDER BY m.id_msg DESC
		LIMIT {int:limit}',
		array(
			'limit' => $limit,
		)
	);

	$posts = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		$posts[] = array(
			'id_msg' => $row['id_msg'],
			'id_topic' => $row['id_topic'],
			'subject' => $row['subject'],
			'poster_name' => $row['poster_name'],
			'poster_time' => $row['poster_time'],
		);
	}
	$smcFunc['db_free_result']($request);

	return $posts;
}

?>