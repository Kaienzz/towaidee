<?php
/**
 * Simple Machines Forum (SMF)
 *
 * ウィジェット管理の言語ファイル (English)
 *
 * @package SMF
 * @author towaidee
 * @version 1.0
 */

if (!defined('SMF'))
	die('No direct access...');

// Main menu and navigation
$txt['widgets_management'] = 'Widget Management';
$txt['widgets_add'] = 'Add Widget';
$txt['widgets_edit'] = 'Edit Widget';
$txt['widgets_settings'] = 'Widget Settings';
$txt['widgets_back_to_list'] = 'Back to Widget List';

// Widget properties
$txt['widget_name'] = 'Widget Name';
$txt['widget_name_desc'] = 'Internal name for this widget (used for identification)';
$txt['widget_title'] = 'Widget Title';
$txt['widget_title_desc'] = 'Title displayed in the sidebar';
$txt['widget_type'] = 'Widget Type';
$txt['widget_content'] = 'Widget Content';
$txt['widget_content_desc'] = 'Enter HTML, PHP code, AdSense code, or other content';
$txt['widget_position'] = 'Position';
$txt['widget_position_left'] = 'Left Sidebar';
$txt['widget_position_right'] = 'Right Sidebar';
$txt['widget_order'] = 'Display Order';
$txt['widget_order_desc'] = 'Lower numbers appear first (0-999)';
$txt['widget_enabled'] = 'Enabled';
$txt['widget_enabled_yes'] = 'Widget is enabled';
$txt['widget_enabled_no'] = 'Widget is disabled';
$txt['widget_pages'] = 'Display Pages';
$txt['widget_pages_desc'] = 'JSON array of page types where this widget should appear. Example: ["index","messageindex","display"]';
$txt['widget_actions'] = 'Actions';

// Widget types
$txt['widget_type_html'] = 'HTML Content';
$txt['widget_type_php'] = 'PHP Code';
$txt['widget_type_recent_posts'] = 'Recent Posts';
$txt['widget_type_stats'] = 'Forum Statistics';
$txt['widget_type_adsense'] = 'AdSense Code';
$txt['widget_type_custom'] = 'Custom Content';

// Actions
$txt['widget_edit'] = 'Edit';
$txt['widget_delete'] = 'Delete';
$txt['widget_delete_confirm'] = 'Are you sure you want to delete this widget?';
$txt['widgets_add_submit'] = 'Add Widget';
$txt['widgets_edit_submit'] = 'Save Changes';

// Messages
$txt['no_widgets_found'] = 'No widgets have been created yet. Click "Add Widget" to create your first widget.';

// Settings
$txt['widget_enable_caching'] = 'Enable Widget Caching';
$txt['widget_enable_caching_desc'] = 'Cache widget content to improve performance';
$txt['widget_cache_time'] = 'Cache Time (seconds)';
$txt['widget_cache_time_desc'] = 'How long to cache widget content (60-3600 seconds)';
$txt['widget_allow_php'] = 'Allow PHP Code Execution';
$txt['widget_allow_php_desc'] = 'WARNING: Only enable if you trust all administrators. This allows execution of PHP code in widgets.';
$txt['widget_settings_desc'] = 'Configure global widget settings and behavior.';
$txt['widget_settings_info'] = 'These settings control the global behavior of the widget system. Use caution when enabling PHP execution.';

// Security warnings
$txt['widget_php_warning_title'] = 'Security Warning: PHP Code';
$txt['widget_php_warning_desc'] = 'PHP code execution is a powerful feature that can be dangerous. Only use this if you understand PHP programming and the security implications. Malicious code could compromise your forum.';

// General
$txt['save_settings'] = 'Save Settings';
$txt['cancel'] = 'Cancel';
$txt['no_recent_posts'] = 'No recent posts available.';

?>