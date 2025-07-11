<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines https://www.simplemachines.org
 * @copyright 2025 Simple Machines and individual contributors
 * @license https://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.1.5
 */

/**
 * This pseudo-template defines all the theme options
 */
function template_options()
{
	global $context, $txt, $modSettings;

	$context['theme_options'] = array(
		$txt['theme_opt_display'],
		array(
			'id' => 'show_children',
			'label' => $txt['show_children'],
			'default' => true,
		),
		array(
			'id' => 'topics_per_page',
			'label' => $txt['topics_per_page'],
			'options' => array(
				0 => $txt['per_page_default'],
				5 => 5,
				10 => 10,
				25 => 25,
				50 => 50,
			),
			'default' => true,
			'enabled' => empty($modSettings['disableCustomPerPage']),
		),
		array(
			'id' => 'messages_per_page',
			'label' => $txt['messages_per_page'],
			'options' => array(
				0 => $txt['per_page_default'],
				5 => 5,
				10 => 10,
				25 => 25,
				50 => 50,
			),
			'default' => true,
			'enabled' => empty($modSettings['disableCustomPerPage']),
		),
		array(
			'id' => 'view_newest_first',
			'label' => $txt['recent_posts_at_top'],
			'default' => true,
		),
		array(
			'id' => 'show_no_avatars',
			'label' => $txt['show_no_avatars'],
			'default' => true,
		),
		array(
			'id' => 'show_no_signatures',
			'label' => $txt['show_no_signatures'],
			'default' => true,
		),
		array(
			'id' => 'posts_apply_ignore_list',
			'label' => $txt['posts_apply_ignore_list'],
			'default' => false,
			'enabled' => !empty($modSettings['enable_buddylist'])
		),
		$txt['theme_opt_posting'],
		array(
			'id' => 'return_to_post',
			'label' => $txt['return_to_post'],
			'default' => true,
		),
		array(
			'id' => 'no_new_reply_warning',
			'label' => $txt['no_new_reply_warning'],
			'default' => true,
		),
		array(
			'id' => 'wysiwyg_default',
			'label' => $txt['wysiwyg_default'],
			'default' => false,
			'enabled' => empty($modSettings['disable_wysiwyg']),
		),
		array(
			'id' => 'drafts_autosave_enabled',
			'label' => $txt['drafts_autosave_enabled'],
			'default' => true,
			'enabled' => !empty($modSettings['drafts_autosave_enabled']) && (!empty($modSettings['drafts_post_enabled']) || !empty($modSettings['drafts_pm_enabled'])),
		),
		array(
			'id' => 'drafts_show_saved_enabled',
			'label' => $txt['drafts_show_saved_enabled'],
			'default' => true,
			'enabled' => !empty($modSettings['drafts_show_saved_enabled']) && (!empty($modSettings['drafts_post_enabled']) || !empty($modSettings['drafts_pm_enabled'])),
		),
		$txt['theme_opt_moderation'],
		array(
			'id' => 'display_quick_mod',
			'label' => $txt['display_quick_mod'],
			'options' => array(
				0 => $txt['display_quick_mod_none'],
				1 => $txt['display_quick_mod_check'],
				2 => $txt['display_quick_mod_image'],
			),
			'default' => true,
		),
		$txt['theme_opt_personal_messages'],
		array(
			'id' => 'popup_messages',
			'label' => $txt['popup_messages'],
			'default' => true,
		),
		array(
			'id' => 'view_newest_pm_first',
			'label' => $txt['recent_pms_at_top'],
			'default' => true,
		),
		array(
			'id' => 'pm_remove_inbox_label',
			'label' => $txt['pm_remove_inbox_label'],
			'default' => true,
		),
		!empty($modSettings['cal_enabled']) ? $txt['theme_opt_calendar'] : '',
		array(
			'id' => 'calendar_default_view',
			'label' => $txt['calendar_default_view'],
			'options' => array(
				'viewlist' => $txt['calendar_viewlist'],
				'viewmonth' => $txt['calendar_viewmonth'],
				'viewweek' => $txt['calendar_viewweek']
			),
			'default' => true,
			'enabled' => !empty($modSettings['cal_enabled']),
		),
		array(
			'id' => 'calendar_start_day',
			'label' => $txt['calendar_start_day'],
			'options' => array(
				0 => $txt['days'][0],
				1 => $txt['days'][1],
				6 => $txt['days'][6],
			),
			'default' => true,
			'enabled' => !empty($modSettings['cal_enabled']),
		),
	);
}

/**
 * This pseudo-template defines all the available theme settings (but not their actual values)
 */
function template_settings()
{
	global $context, $txt;

	$context['theme_settings'] = array(
		array(
			'id' => 'header_logo_url',
			'label' => $txt['header_logo_url'],
			'description' => $txt['header_logo_url_desc'],
			'type' => 'text',
		),
		array(
			'id' => 'site_slogan',
			'label' => $txt['site_slogan'],
			'description' => $txt['site_slogan_desc'],
			'type' => 'text',
		),
		array(
			'id' => 'og_image',
			'label' => $txt['og_image'],
			'description' => $txt['og_image_desc'],
			'type' => 'url',
		),
		'',
		array(
			'id' => 'smiley_sets_default',
			'label' => $txt['smileys_default_set_for_theme'],
			'options' => $context['smiley_sets'],
			'type' => 'text',
		),
		'',
		array(
			'id' => 'custom_forum_width',
			'label' => $txt['custom_forum_width'],
			'description' => $txt['custom_forum_width_desc'],
			'type' => 'text',
		),
		'',
		array(
			'id' => 'info_center_search_enabled',
			'label' => $txt['info_center_search_enable'],
			'description' => $txt['info_center_search_desc'],
		),
        '',	
	    array(
			'id' => 'social_icons_menu_enabled',
			'label' => $txt['social_icons_menu_enabled'],
			'description' => $txt['social_icons_desc'],
        ),
		array(
			'id' => 'facebook_url',
			'label' => $txt['facebook_url'],
			'type' => 'text',
		),
		array(
			'id' => 'twitter_url',
			'label' => $txt['twitter_url'],
			'type' => 'text',
		),
		array(
			'id' => 'youtube_url',
			'label' => $txt['youtube_url'],
			'type' => 'text',
		),
		array(
			'id' => 'twitch_url',
			'label' => $txt['twitch_url'],
			'type' => 'text',
		),
		array(
			'id' => 'discord_url',
			'label' => $txt['discord_url'],
			'type' => 'text',
		),
		array(
			'id' => 'linkedin_url',
			'label' => $txt['linkedin_url'],
			'type' => 'text',
		),
		array(
			'id' => 'github_url',
			'label' => $txt['github_url'],
			'type' => 'text',
		),
		array(
			'id' => 'rss_url',
			'label' => $txt['rss_url'],
			'type' => 'text',
		),
		'',
		array(
			'id' => 'board_avatar_enable',
			'label' => $txt['board_avatar_enable'],
			'description' => $txt['board_avatar_enable_description'],
		),
		array(
			'id' => 'topiclist_avatar_enable',
			'label' => $txt['topiclist_avatar_enable'],
			'description' => $txt['topiclist_avatar_enable_description'],
		),
		'',
        array(
			'id' => 'sep_sticky_enabled',
			'label' => $txt['sep_sticky_enabled'],
			'description' => $txt['sep_sticky_enabled_desc'],
        ),		
		'',
        array(
			'id' => 'footer_menu_enabled',
			'label' => $txt['footer_menu_enabled'],
			'description' => $txt['footer_menu_enabled_desc'],
        ),
		array(
			'id' => 'footer_menu_heading1',
			'label' => $txt['footer_menu_heading1'],
			'type' => 'text',
		),
		array(
			'id' => 'footer_image_url',
			'label' => $txt['footer_image_url'],
			'description' => $txt['footer_image_description'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title1',
			'label' => $txt['footer_menu_title1'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url1',
			'label' => $txt['footer_menu_url1'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title2',
			'label' => $txt['footer_menu_title2'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url2',
			'label' => $txt['footer_menu_url2'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title3',
			'label' => $txt['footer_menu_title3'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url3',
			'label' => $txt['footer_menu_url3'],
			'type' => 'text',
		),
		'',
        array(
			'id' => 'footer_menu_heading2',
			'label' => $txt['footer_menu_heading2'],
			'type' => 'text',
		),
		array(
			'id' => 'footer_image_url2',
			'label' => $txt['footer_image_url2'],
			'description' => $txt['footer_image_description'],
			'type' => 'text',
		),
		 array(
			'id' => 'footer_menu_title4',
			'label' => $txt['footer_menu_title4'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url4',
			'label' => $txt['footer_menu_url4'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title5',
			'label' => $txt['footer_menu_title5'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url5',
			'label' => $txt['footer_menu_url5'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title6',
			'label' => $txt['footer_menu_title6'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url6',
			'label' => $txt['footer_menu_url6'],
			'type' => 'text',
		),
		
		'',
        array(
			'id' => 'footer_menu_heading3',
			'label' => $txt['footer_menu_heading3'],
			'type' => 'text',
		),
		array(
			'id' => 'footer_image_url3',
			'label' => $txt['footer_image_url3'],
			'description' => $txt['footer_image_description'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title7',
			'label' => $txt['footer_menu_title7'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url7',
			'label' => $txt['footer_menu_url7'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title8',
			'label' => $txt['footer_menu_title8'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url8',
			'label' => $txt['footer_menu_url8'],
			'type' => 'text',
		),
		
		array(
			'id' => 'footer_menu_title9',
			'label' => $txt['footer_menu_title9'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url9',
			'label' => $txt['footer_menu_url9'],
			'type' => 'text',
		),
		'',
        array(
			'id' => 'footer_menu_heading4',
			'label' => $txt['footer_menu_heading4'],
			'type' => 'text',
		),
		array(
			'id' => 'footer_image_url4',
			'label' => $txt['footer_image_url4'],
			'description' => $txt['footer_image_description'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title10',
			'label' => $txt['footer_menu_title10'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url10',
			'label' => $txt['footer_menu_url10'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_title11',
			'label' => $txt['footer_menu_title11'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url11',
			'label' => $txt['footer_menu_url11'],
			'type' => 'text',
		),
		array(
			'id' => 'footer_menu_title12',
			'label' => $txt['footer_menu_title12'],
			'type' => 'text',
		),
        array(
			'id' => 'footer_menu_url12',
			'label' => $txt['footer_menu_url12'],
			'type' => 'text',
		),
		'',
		array(
			'id' => 'side_panel_enable',
			'label' => $txt['side_panel_enable'],
			'description' => $txt['side_panel_enable_desc'],
		),
		'',
		array(
			'id' => 'enable_news',
			'label' => $txt['enable_random_news'],
		),
		array(
			'id' => 'show_newsfader',
			'label' => $txt['news_fader'],
		),
		array(
			'id' => 'newsfader_time',
			'label' => $txt['admin_fader_delay'],
			'type' => 'number',
		),
		'',
		array(
			'id' => 'number_recent_posts',
			'label' => $txt['number_recent_posts'],
			'description' => $txt['zero_to_disable'],
			'type' => 'number',
		),
		array(
			'id' => 'show_stats_index',
			'label' => $txt['show_stats_index'],
		),
		array(
			'id' => 'show_latest_member',
			'label' => $txt['latest_members'],
		),
		array(
			'id' => 'show_group_key',
			'label' => $txt['show_group_key'],
		),
		array(
			'id' => 'display_who_viewing',
			'label' => $txt['who_display_viewing'],
			'options' => array(
				0 => $txt['who_display_viewing_off'],
				1 => $txt['who_display_viewing_numbers'],
				2 => $txt['who_display_viewing_names'],
			),
			'type' => 'list',
		),
	);
}

?>