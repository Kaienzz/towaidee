<?php
/**
 * Simple Machines Forum (SMF)
 *
 * ウィジェット管理の言語ファイル (Japanese)
 *
 * @package SMF
 * @author towaidee
 * @version 1.0
 */

if (!defined('SMF'))
	die('No direct access...');

// Main menu and navigation
$txt['widgets_management'] = 'ウィジェット管理';
$txt['widgets_add'] = 'ウィジェット追加';
$txt['widgets_edit'] = 'ウィジェット編集';
$txt['widgets_settings'] = 'ウィジェット設定';
$txt['widgets_back_to_list'] = 'ウィジェット一覧に戻る';

// Widget properties
$txt['widget_name'] = 'ウィジェット名';
$txt['widget_name_desc'] = 'このウィジェットの内部名（識別用）';
$txt['widget_title'] = 'ウィジェットタイトル';
$txt['widget_title_desc'] = 'サイドバーに表示されるタイトル';
$txt['widget_type'] = 'ウィジェットタイプ';
$txt['widget_content'] = 'ウィジェットコンテンツ';
$txt['widget_content_desc'] = 'HTML、PHPコード、AdSenseコード、その他のコンテンツを入力';
$txt['widget_position'] = '表示位置';
$txt['widget_position_left'] = '左サイドバー';
$txt['widget_position_right'] = '右サイドバー';
$txt['widget_order'] = '表示順序';
$txt['widget_order_desc'] = '小さい数字が先に表示されます（0-999）';
$txt['widget_enabled'] = '有効';
$txt['widget_enabled_yes'] = 'ウィジェットは有効です';
$txt['widget_enabled_no'] = 'ウィジェットは無効です';
$txt['widget_pages'] = '表示ページ';
$txt['widget_pages_desc'] = 'このウィジェットを表示するページタイプのJSON配列。例: ["index","messageindex","display"]';
$txt['widget_actions'] = 'アクション';

// Widget types
$txt['widget_type_html'] = 'HTMLコンテンツ';
$txt['widget_type_php'] = 'PHPコード';
$txt['widget_type_recent_posts'] = '最新の投稿';
$txt['widget_type_stats'] = 'フォーラム統計';
$txt['widget_type_adsense'] = 'AdSenseコード';
$txt['widget_type_custom'] = 'カスタムコンテンツ';

// Actions
$txt['widget_edit'] = '編集';
$txt['widget_delete'] = '削除';
$txt['widget_delete_confirm'] = 'このウィジェットを削除してもよろしいですか？';
$txt['widgets_add_submit'] = 'ウィジェット追加';
$txt['widgets_edit_submit'] = '変更を保存';

// Messages
$txt['no_widgets_found'] = 'まだウィジェットが作成されていません。「ウィジェット追加」をクリックして最初のウィジェットを作成してください。';

// Settings
$txt['widget_enable_caching'] = 'ウィジェットキャッシュを有効にする';
$txt['widget_enable_caching_desc'] = 'パフォーマンス向上のためウィジェットコンテンツをキャッシュします';
$txt['widget_cache_time'] = 'キャッシュ時間（秒）';
$txt['widget_cache_time_desc'] = 'ウィジェットコンテンツをキャッシュする時間（60-3600秒）';
$txt['widget_allow_php'] = 'PHPコード実行を許可';
$txt['widget_allow_php_desc'] = '警告: すべての管理者を信頼できる場合のみ有効にしてください。これによりウィジェットでPHPコードの実行が可能になります。';
$txt['widget_settings_desc'] = 'ウィジェットシステムのグローバル設定と動作を設定します。';
$txt['widget_settings_info'] = 'これらの設定はウィジェットシステムのグローバル動作を制御します。PHP実行を有効にする際は注意してください。';

// Security warnings
$txt['widget_php_warning_title'] = 'セキュリティ警告: PHPコード';
$txt['widget_php_warning_desc'] = 'PHPコード実行は強力な機能ですが危険を伴う可能性があります。PHPプログラミングとセキュリティへの影響を理解している場合のみ使用してください。悪意のあるコードはフォーラムを危険にさらす可能性があります。';

// General
$txt['save_settings'] = '設定を保存';
$txt['cancel'] = 'キャンセル';
$txt['no_recent_posts'] = '最新の投稿はありません。';

?>