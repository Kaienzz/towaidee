<?php
/**
 * Simple Machines Forum (SMF)
 *
 * サイドバー用のテンプレート - 2コラムレイアウト対応
 *
 * このテンプレートでは、右側にAdSense、最近の投稿、統計情報などのコンテンツを表示します。
 */

/**
 * メインのサイドバーコンテンツ
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
		<div class="adsense-placeholder">
			AdSense広告エリア<br>
			300x250px
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
			<h3>オンラインユーザー</h3>';
			
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
?>