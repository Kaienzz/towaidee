<?php
// Version: 2.1.3; Who

global $scripturl, $context;

$txt['who_hidden'] = 'ไม่เห็นหรือไม่มีอะไรเลย...';
$txt['who_admin'] = 'Viewing the Administration Center';
$txt['who_moderate'] = 'Viewing the Moderation Center';
$txt['who_generic'] = 'Viewing the';
$txt['who_unknown'] = 'ไม่ทราบการดำเนินการ';
$txt['who_user'] = 'ผู้ใช้';
$txt['who_time'] = 'เวลา';
$txt['who_action'] = 'ดำเนินการ';
$txt['who_show'] = 'Show ';
$txt['who_show_members_only'] = 'เฉพาะสมาชิก';
$txt['who_show_guests_only'] = 'เฉพาะบุคคลทั่วไป';
$txt['who_show_spiders_only'] = 'เฉพาะ Spiders';
$txt['who_show_all'] = 'ทุกคน';
$txt['who_no_online_spiders'] = 'There are currently no spiders online.';
$txt['who_no_online_guests'] = 'There are currently no guests online.';
$txt['who_no_online_members'] = 'There are currently no members online.';
$txt['who_guest_login'] = 'User has been taken to the login page.';

$txt['whospider_login'] = 'กำลังดูหน้าเข้าสู่ระบบ';
$txt['whospider_register'] = 'กำลังดูหน้าลงทะเบียน';
$txt['whospider_reminder'] = 'กำลังดูหน้าการแจ้งเตือน';

$txt['whoall_activate'] = 'กำลังดำเนินการชื่อผู้ใช้งาน';
$txt['whoall_buddy'] = 'Modifying their buddy list.';
$txt['whoall_agreement'] = 'Viewing the <a href="%1$s?action=agreement">Terms and Rules</a>.';
$txt['whoall_coppa'] = 'Filling out parent/guardian consent form.';
$txt['whoall_credits'] = 'Viewing credits page.';
$txt['whoall_emailuser'] = 'กำลังส่งอีเมลไปยังสมาชิกรายอื่น';
$txt['whoall_groups'] = 'กำลังดูหน้ากลุ่มสมาชิก';
// argument(s): $scripturl
$txt['whoall_help'] = 'Viewing the <a href="%1$s?action=help">help page</a>.';
$txt['whoall_helpadmin'] = 'กำลังดูหน้าช่วยเหลือของผู้ดูแลระบบ';
$txt['whoall_pm'] = 'กำลังดูข้อความ';
$txt['whoall_login'] = 'กำลังเข้าสู่ฟอรั่ม';
$txt['whoall_login2'] = 'กำลังเข้าสู่ฟอรั่ม';
$txt['whoall_logout'] = 'กำลังออกจากฟอรั่ม';
$txt['whoall_markasread'] = 'กำลังมาร์คหัวข้อที่อ่านแล้ว';
$txt['whoall_news'] = 'กำลังดูข่าว';
$txt['whoall_notify'] = 'กำลังเปลี่ยนค่าการเตือน';
$txt['whoall_notifyboard'] = 'กำลังเปลี่ยนค่าการเตือน';
$txt['whoall_quickmod'] = 'Moderating a board.';
// argument(s): $scripturl
$txt['whoall_recent'] = 'Viewing a <a href="%1$s?action=recent">list of recent topics</a>.';
$txt['whoall_reminder'] = 'กำลังเรียกดูคำเตือนรหัสผ่าน';
$txt['whoall_reporttm'] = 'รายงานหัวข้อนี้ไปยังผู้ดูแล';
$txt['whoall_restoretopic'] = 'Restoring a topic.';
$txt['whoall_signup'] = 'Registering for an account on the forum.';
$txt['whoall_signup2'] = 'Registering for an account on the forum.';
$txt['whoall_spellcheck'] = 'กำลังใช้ตัวตรวจสอบการสะกดคำ';
$txt['whoall_unread'] = 'กำลังดูหัวข้อที่ยังไม่ได้อ่านตั้งแต่ครั้งที่แล้ว';
$txt['whoall_unreadreplies'] = 'กำลังดูกระทู้ที่ยังไม่ได้อ่านตั้งแต่ครั้งที่แล้ว';
$txt['whoall_unwatchtopic'] = 'Unwatching a topic.';
// argument(s): $scripturl
$txt['whoall_who'] = 'Viewing <a href="%1$s?action=who">Who\'s Online</a>.';

$txt['whoall_collapse_collapse'] = 'กำลังย่อหมวดหมู่';
$txt['whoall_collapse_expand'] = 'กำลังขยายหมวดหมู่';
$txt['whoall_pm_removeall'] = 'กำลังลบข้อความทั้งหมด';
$txt['whoall_pm_send'] = 'กำลังส่งข้อความ';
$txt['whoall_pm_send2'] = 'กำลังส่งข้อความ';

// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_announce'] = 'Announcing the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
$txt['whotopic_attachapprove'] = 'Approving an attachment.';
$txt['whotopic_dlattach'] = 'กำลังดูไฟล์แนบ';
$txt['whotopic_deletemsg'] = 'Deleting a message.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_editpoll'] = 'Editing the poll in &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_editpoll2'] = 'Editing the poll in &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_jsmodify'] = 'Modifying a post in &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_lock'] = 'Locking the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_lockvoting'] = 'Locking the poll in &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_mergetopics'] = 'Merging the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot; with another topic.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_movetopic'] = 'Moving the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot; to another board.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_movetopic2'] = 'Moving the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot; to another board.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_post'] = 'Posting in <a href="%3$s?topic=%1$d.0">%2$s</a>.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_post2'] = 'Posting in <a href="%3$s?topic=%1$d.0">%2$s</a>.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_printpage'] = 'Printing the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_quickmod2'] = 'Moderating the topic <a href="%3$s?topic=%1$d.0">%2$s</a>.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_removepoll'] = 'Removing the poll in &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_removetopic2'] = 'Removing the topic <a href="%3$s?topic=%1$d.0">%2$s</a>.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_splittopics'] = 'Splitting the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot; into two topics.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_sticky'] = 'Setting the topic &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot; as sticky.';
// argument(s): $id_topic, $subject, $scripturl
$txt['whotopic_vote'] = 'Voting in <a href="%3$s?topic=%1$d.0">%2$s</a>.';

// argument(s): $id_topic, $subject, $scripturl
$txt['whopost_quotefast'] = 'Quoting a post from &quot;<a href="%3$s?topic=%1$d.0">%2$s</a>&quot;.';

$txt['whoadmin_editagreement'] = 'กำลังแก้ไขข้อตกลงในการสมัครสมาชิก';
$txt['whoadmin_featuresettings'] = 'กำลังแก้ไขความสามารถฟอรั่มและตัวเลือก';
$txt['whoadmin_modlog'] = 'กำลังดูบันทึกการเข้าของผู้ดูแล';
$txt['whoadmin_serversettings'] = 'กำลังแก้ไขค่าฟอรั่ม';
$txt['whoadmin_packageget'] = 'กำลังรับแพ็คเกจ';
$txt['whoadmin_packages'] = 'กำลังดูตัวจัดการแพ็คเกจ';
$txt['whoadmin_permissions'] = 'กำลังแก้ไขข้ออนุญาตของฟอรั่ม';
$txt['whoadmin_pgdownload'] = 'กำลังดาวน์โหลดแพ็คเกจ';
$txt['whoadmin_theme'] = 'กำลังแก้ไขค่าของธีม';
$txt['whoadmin_trackip'] = 'กำลังตามรอย IP address.';

$txt['whoallow_manageboards'] = 'กำลังแก้ไขบอร์ดและค่าของหมวดหมู่';
// argument(s): $scripturl
$txt['whoallow_admin'] = 'Viewing the <a href="%1$s?action=admin">administration center</a>.';
$txt['whoallow_ban'] = 'กำลังแก้ไขรายชื่อสมาชิกที่ถูกแบน';
$txt['whoallow_boardrecount'] = 'กำลังนับจำนวนรวมของฟอรั่มอีกครั้ง';
// argument(s): $scripturl
$txt['whoallow_calendar'] = 'Viewing the <a href="%1$s?action=calendar">calendar</a>.';
$txt['whoallow_editnews'] = 'กำลังแก้ไขข่าว';
$txt['whoallow_mailing'] = 'กำลังส่งอีเมล์ฟอรั่ม';
$txt['whoallow_maintain'] = 'กำลังตรวสอบฟอรั่มตามปกติ';
$txt['whoallow_manageattachments'] = 'กำลังจัดการไฟล์แนบ';
$txt['whoallow_modsettings'] = 'Editing mod settings';
$txt['whoallow_logs '] = 'Viewing the forum logs';
$txt['whoallow_languages'] = 'Managing the languages';
$txt['whoallow_sengines'] = 'Managing search engines';
$txt['whoallow_managesearch'] = 'Editing the search settings';
$txt['whoallow_managecalendar'] = 'Managing the calendar';
$txt['whoallow_postsettings'] = 'Editing the post settings';
$txt['whoallow_scheduledtasks'] = 'Managing the scheduled tasks';
$txt['whoallow_mailqueue'] = 'Viewing the mail queue';
$txt['whoallow_reports'] = 'Viewing administration reports';
$txt['whoallow_membergroups'] = 'Managing membergroups';
$txt['whoallow_regcenter'] = 'Viewing the registration center';
$txt['whoallow_paidsubscribe'] = 'Managing paid subscriptions';
// argument(s): $scripturl
$txt['whoallow_moderate'] = 'Viewing the <a href="%1$s?action=moderate">Moderation Center</a>.';
// argument(s): $scripturl
$txt['whoallow_mlist'] = 'Viewing the <a href="%1$s?action=mlist">memberlist</a>.';
$txt['whoallow_optimizetables'] = 'กำลังจัดระเบียบตาราง database';
$txt['whoallow_repairboards'] = 'กำลังซ่อมตาราง database';
// argument(s): $scripturl
$txt['whoallow_search'] = '<a href="%1$s?action=search">Searching</a> the forum.';
$txt['whoallow_search2'] = 'กำลังดูผลการค้นหา';
// argument(s): $scripturl
$txt['whoallow_stats'] = 'Viewing the <a href="%1$s?action=stats">forum stats</a>.';
$txt['whoallow_viewerrorlog'] = 'Viewing the error log.';
$txt['whoallow_viewmembers'] = 'กำลังดูรายชื่อสมาชิก';

// argument(s): $id_topic, $subject, $scripturl
$txt['who_topic'] = 'Viewing the topic <a href="%3$s?topic=%1$d.0">%2$s</a>.';
// argument(s): board id, board name, $scripturl
$txt['who_board'] = 'Viewing the board <a href="%3$s?board=%1$d.0">%2$s</a>.';
// argument(s): $scripturl, $context['forum_name_html_safe']
$txt['who_index'] = 'Viewing the board index of <a href="%1$s">%2$s</a>.';
// argument(s): member id, real name, $scripturl
$txt['who_viewprofile'] = 'Viewing <a href="%3$s?action=profile;u=%1$d">%2$s</a>\'s profile.';
// argument(s): member id, real name, $scripturl
$txt['who_viewownprofile'] = 'Viewing <a href="%3$s?action=profile;u=%1$d">their own profile</a>.';
// argument(s): member id, real name, $scripturl
$txt['who_profile'] = 'Editing the profile of <a href="%3$s?action=profile;u=%1$d">%2$s</a>.';
// argument(s): board id, board name, $scripturl
$txt['who_post'] = 'Posting a new topic in <a href="%3$s?board=%1$d.0">%2$s</a>.';
// argument(s): board id, board name, $scripturl
$txt['who_poll'] = 'Posting a new poll in <a href="%3$s?board=%1$d.0">%2$s</a>.';

// Credits text
$txt['credits'] = 'Credits';
$txt['credits_intro'] = 'Simple Machines wants to thank everyone who helped make SMF 2.1 what it is today; shaping and directing our project, all through the thick and the thin. It wouldn\'t have been possible without you. This includes our users and especially Charter Members - thanks for installing and using our software as well as providing valuable feedback, bug reports, and opinions.';
$txt['credits_team'] = 'The Team';
$txt['credits_special'] = 'Special Thanks';
$txt['credits_list'] = '%1$s.';
$txt['credits_anyone'] = 'And for anyone we may have missed, thank you!';
$txt['credits_copyright'] = 'Copyright';
$txt['credits_forum'] = 'Forum';
$txt['credits_modifications'] = 'Modifications';
$txt['credits_software_graphics'] = 'Software/Graphics';
$txt['credits_software'] = 'Software';
$txt['credits_graphics'] = 'Graphics';
$txt['credits_fonts'] = 'Fonts';
$txt['credits_groups_pm'] = 'Project Management';
$txt['credits_groups_dev'] = 'Developers';
$txt['credits_groups_support'] = 'Support Specialists';
$txt['credits_groups_customize'] = 'Customizers';
$txt['credits_groups_docs'] = 'Documentation Writers';
$txt['credits_groups_marketing'] = 'Marketing';
$txt['credits_groups_internationalizers'] = 'Localizers';
$txt['credits_groups_servers'] = 'Servers Administrators';
$txt['credits_groups_site'] = 'Site Administrators';
$txt['credits_license'] = 'License';
$txt['credits_version'] = 'Version';
// Replace "English" with the name of this language pack in the string below.
$txt['credits_groups_translation'] = 'Thai Translation';
$txt['credits_groups_translators'] = 'Language Translators';
$txt['credits_translators_message'] = 'Thank you for your efforts which make it possible for people all around the world to use SMF';
$txt['credits_groups_consultants'] = 'Consulting Developers';
$txt['credits_code_contributors'] = 'everyone who <a href="https://github.com/SimpleMachines/SMF/graphs/contributors">contributed on GitHub</a>';
$txt['credits_groups_beta'] = 'Beta Testers';
$txt['credits_beta_message'] = 'The invaluable few who tirelessly find bugs, provide feedback, and drive the developers crazier';
$txt['credits_groups_founder'] = 'Founding Father of SMF';
$txt['credits_groups_orignal_pm'] = 'Original Project Managers';
$txt['credits_in_memoriam'] = 'In loving memory of';

// Comma separated list of people who have made more than a token contribution to this translation. Example: 'Alice "The Hammer" Smith, Bob Cratchit, Gandalf the Grey'. (Note: English version contains a single comma so that the string will be shown in CrowdIn.)
$txt['translation_credits'] = ',';

?>