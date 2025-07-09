<?php
// Version: 2.1.5; index

global $forum_copyright, $webmaster_email, $scripturl, $context, $boardurl;

// Native name, please use full HTML entities to write your language's name.
$txt['native_name'] = 'ไทย';

// Locale (strftime, basename). For more information see:
//   - https://php.net/function.setlocale
$txt['lang_locale'] = 'th_TH';
$txt['lang_dictionary'] = 'th';
//https://developers.google.com/recaptcha/docs/language
$txt['lang_recaptcha'] = 'th';

// Ensure you remember to use uppercase for character set strings.
$txt['lang_character_set'] = 'UTF-8';
// Character set right to left?  0 = ltr; 1 = rtl
$txt['lang_rtl'] = '0';
// Number format.
$txt['number_format'] = '1,234.00';

$txt['days_title'] = 'วัน';
$txt['days'] = array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์');
$txt['days_short'] = array('อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.');
// Months must start with 1 => 'January'. (or translated, of course.)
$txt['months_title'] = 'เดือน';
$txt['months'] = array(1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม');
$txt['months_titles'] = array(1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม');
$txt['months_short'] = array(1 => 'ม.ค', 2 => 'ก.พ', 3 => 'มี.ค', 4 => 'เม.ย', 5 => 'พ.ค', 6 => 'มิ.ย', 7 => 'ก.ค', 8 => 'ส.ค', 9 => 'ก.ย', 10 => 'ต.ค', 11 => 'พ.ย', 12 => 'ธ.ค');
$txt['prev_month'] = 'เดือนที่แล้ว';
$txt['next_month'] = 'เดือนหน้า';
$txt['start'] = 'เริ่ม';
$txt['end'] = 'จบ';
$txt['starts'] = 'เริ่ม';
$txt['ends'] = 'สิ้นสุด';
$txt['none'] = 'ไม่มี';

$txt['minutes_label'] = 'นาที';
$txt['hours_label'] = 'ชั่วโมง';
$txt['years_title'] = 'ปี';

$txt['time_am'] = 'ก่อนเที่ยง';
$txt['time_pm'] = 'หลังเที่ยง';

// Short form of minutes
$txt['minutes_short'] = 'นาที';
// Short form of hour
$txt['hour_short'] = 'ช.ม';
// Short form of hours
$txt['hours_short'] = 'ช.ม';
// Decimal sign
$txt['decimal_sign'] = '.';

$txt['admin'] = 'ผู้ดูแลระบบ';
$txt['moderate'] = 'ผู้ดูแล';

$txt['save'] = 'บันทึก';
$txt['reset'] = 'รีเซ็ต';
$txt['upload'] = 'อัพโหลด';
$txt['upload_all'] = 'อัพโหลดทั้งหมด';
$txt['processing'] = 'กำลังประมวลผล...';

$txt['modify'] = 'แก้ไข';
$txt['forum_index'] = '%1$s - ดัชนี';
$txt['members'] = 'สมาชิก';
$txt['board_name'] = 'ชื่อบอร์ด';
$txt['posts'] = 'กระทู้';

$txt['member_postcount'] = 'กระทู้';
$txt['no_subject'] = '(ไม่มีหัวข้อ)';
$txt['view_profile'] = 'ดูโปรไฟล์';
$txt['guest_title'] = 'ผู้มาเยือน';
$txt['author'] = 'ผู้เขียน';
$txt['on'] = 'ที่';
$txt['remove'] = 'ลบ';
$txt['start_new_topic'] = 'เริ่มหัวข้อใหม่';

$txt['login'] = 'Log in';
// Use numeric entities in the below string.
$txt['username'] = 'ชื่อผู้ใช้';
$txt['password'] = 'รหัสผ่าน';

$txt['username_no_exist'] = 'ชื่อผู้ใช้นั้นไม่มีอยู่จริง';
$txt['no_user_with_email'] = 'ไม่มีชื่อผู้ใช้ที่เชื่อมโยงกับอีเมลนั้น';

$txt['board_moderator'] = 'ผู้ดูแลบอร์ด';
$txt['remove_topic'] = 'ลบหัวข้อ';
$txt['topics'] = 'หัวข้อ';
$txt['modify_msg'] = 'แก้ไขข้อความ';
$txt['name'] = 'ชื่อ';
$txt['email'] = 'อีเมล';
$txt['user_email_address'] = 'ที่อยู่อีเมล';
$txt['subject'] = 'หัวเรื่อง';
$txt['message'] = 'ข้อความ';
$txt['redirects'] = 'เปลี่ยนเส้นทาง';
$txt['quick_modify'] = 'แก้ไขอินไลน์';
$txt['quick_modify_message'] = 'คุณแก้ไขข้อความนี้สำเร็จแล้ว';
$txt['reason_for_edit'] = 'เหตุผลในการแก้ไข';

$txt['choose_pass'] = 'เลือกรหัสผ่าน';
$txt['verify_pass'] = 'ยืนยันรหัสผ่าน';
$txt['notify_announcements'] = 'อนุญาตให้ผู้ดูแลระบบส่งข่าวสำคัญให้ฉันทางอีเมล';

$txt['position'] = 'ตำแหน่ง';

// argument(s): username
$txt['view_profile_of_username'] = 'ดูรายละเอียดของ %1$s';
$txt['total'] = 'ทั้งหมด';
$txt['website'] = 'เว็บไซต์';
$txt['register'] = 'Sign up';
$txt['warning_status'] = 'สถานะคำเตือน';
$txt['user_warn_watch'] = 'ผู้ใช้อยู่ในรายการเฝ้าดูผู้ดูแล';
$txt['user_warn_moderate'] = 'กระทู้ของผู้ใช้เข้าร่วมคิวการอนุมัติ';
$txt['user_warn_mute'] = 'ผู้ใช้ถูกแบนจากการโพสต์';
$txt['warn_watch'] = 'เฝ้าดู';
$txt['warn_moderate'] = 'ดูแล';
$txt['warn_mute'] = 'ปิดเสียง';

$txt['message_index'] = 'ดัชนีข้อความ';
$txt['news'] = 'ข่าว';
$txt['home'] = 'หน้าแรก';
$txt['page'] = 'หน้า';
$txt['prev'] = 'หน้าก่อน';
$txt['next'] = 'หน้าต่อไป';

$txt['lock_unlock'] = 'ล็อก/ปลดล็อกหัวข้อ';
$txt['post'] = 'ตั้งกระทู้';
$txt['error_occured'] = 'เกิดข้อผิดพลาด';
$txt['at'] = 'เวลา';
$txt['by'] = 'โดย';
$txt['logout'] = 'Log out';
$txt['started_by'] = 'เริ่มโดย';
$txt['topic_started_by'] = 'เริ่มโดย <strong>%1$s</strong> ใน <em>%2$s</em>';
$txt['replies'] = 'ตอบกลับ';
$txt['last_post'] = 'กระทู้ล่าสุด';
$txt['first_post'] = 'กระทู้แรก';
$txt['last_poster'] = 'กระทู้ล่าสุด โดย';
$txt['last_post_message'] = '<strong>โพสต์ล่าสุด: </strong>%3$s <span class="postby">%2$s โดย %1$s</span>';
$txt['last_post_topic'] = '%1$s<br>โดย %2$s';
$txt['post_by_member'] = '<strong>%1$s</strong> โดย <strong>%2$s</strong><br>';
$txt['boardindex_total_posts'] = '%1$s กระทู้ใน %2$s หัวข้อ โดย %3$s สมาชิก';
$txt['show'] = 'แสดง';
$txt['hide'] = 'ซ่อน';

$txt['admin_login'] = 'เข้าสู่ระบบผู้ดูแลระบบ';
// Use numeric entities in the below string.
$txt['topic'] = 'หัวข้อ';
$txt['help'] = 'ช่วยเหลือ';
$txt['terms_and_rules'] = 'ข้อตกลงและเงื่อนไข';
$txt['watch_board'] = 'เฝ้าดูบอร์ดนี้';
$txt['unwatch_board'] = 'เลิกเฝ้าดูบอร์ด';
$txt['watch_topic'] = 'เฝ้าดูหัวข้อนี้';
$txt['unwatch_topic'] = 'เลิกเฝ้าดูหัวข้อ';
$txt['watching_topic'] = 'Topic you are watching';
$txt['watching_this_topic'] = 'คุณกำลังเฝ้าดูหัวข้อนี้และจะได้รับการแจ้งเตือนเกี่ยวกับเรื่องนี้';
$txt['notify'] = 'แจ้งเตือน';
$txt['unnotify'] = 'หยุดการแจ้งเตือน';

// Use numeric entities in the below string.
// argument(s): forum name
$txt['regards_team'] = 'ขอแสดงความนับถือ,
ทีม %1$s';

$txt['notify_replies'] = 'แจ้งเตือนการตอบกลับ';
$txt['move_topic'] = 'ย้ายหัวข้อ';
$txt['move_to'] = 'ย้ายไปที่';
$txt['pages'] = 'หน้า';
$txt['users_active'] = 'ผู้ใช้ที่ใช้งานใน %1$d นาทีที่ผ่านมา';
$txt['personal_messages'] = 'ข้อความส่วนตัว';
$txt['reply_quote'] = 'ตอบกลับโดยอ้างถึงข้อความ';
$txt['reply'] = 'ตอบกลับ';
$txt['reply_noun'] = 'ตอบ';
$txt['reply_number'] = 'ตอบกลับ #%1$s%2$s';
$txt['approve'] = 'อนุมัติ';
$txt['unapprove'] = 'ไม่อนุมัติ';
$txt['approve_all'] = 'อนุมัติทั้งหมด';
$txt['issue_warning'] = 'ออกคำเตือน';
$txt['awaiting_approval'] = 'รอการอนุมัติ';
$txt['attach_awaiting_approve'] = 'ไฟล์แนบรอการอนุมัติ';
$txt['post_awaiting_approval'] = 'ข้อความนี้กำลังรอการอนุมัติจากผู้ดูแล';
$txt['there_are_unapproved_topics'] = 'มี %1$s หัวข้อและ %2$s กระทู้ที่รอการอนุมัติในบอร์ดนี้ คลิก<a href="%3$s">ที่นี่</a>เพื่อดูทั้งหมด';
$txt['send_message'] = 'ส่งข้อความ';

$txt['msg_alert_no_messages'] = 'คุณไม่มีข้อความใดๆ';
$txt['msg_alert_one_message'] = 'คุณมี <a href="%1$s">1 ข้อความ</a>';
$txt['msg_alert_many_message'] = 'คุณมี <a href="%1$s">%2$d ข้อความ</a>';
$txt['msg_alert_one_new'] = 'เป็นข้อความใหม่ 1 ข้อความ';
$txt['msg_alert_many_new'] = 'เป็นข้อความใหม่ %1$d ข้อความ';
$txt['new_alert'] = 'การแจ้งเตือนใหม่';
$txt['remove_message'] = 'ลบกระทู้นี้';
$txt['remove_message_question'] = 'ลบกระทู้นี้หรือไม่';

$txt['topic_alert_none'] = 'ไม่มีข้อความ...';
$txt['pm_alert_none'] = 'ไม่มีข้อความ...';
$txt['no_messages'] = 'ไม่มีข้อความ';

$txt['online_users'] = 'ผู้ใช้ออนไลน์';
$txt['jump_to'] = 'ข้ามไปที่';
$txt['go'] = 'ไป';
$txt['are_sure_remove_topic'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบหัวข้อนี้';
$txt['yes'] = 'ใช่';
$txt['no'] = 'ไม่';

$txt['search_end_results'] = 'สิ้นสุดผล';
$txt['search_on'] = 'เมื่อ';

$txt['search'] = 'ค้นหา';
$txt['all'] = 'ทั้งหมด';
$txt['search_entireforum'] = 'ทั้งฟอรั่ม';
$txt['search_thisboard'] = 'บอร์ดนี้';
$txt['search_thistopic'] = 'หัวข้อนี้';
$txt['search_members'] = 'สมาชิก';

$txt['back'] = 'กลับ';
$txt['continue'] = 'ดำเนินการต่อ';
$txt['password_reminder'] = 'เตือนรหัสผ่าน';
$txt['topic_started'] = 'หัวข้อที่ตั้งโดย';
$txt['title'] = 'ชื่อ';
$txt['post_by'] = 'โดย';
$txt['memberlist_searchable'] = 'รายชื่อสมาชิกที่ลงทะเบียนทั้งหมดที่สามารถค้นหาได้';
$txt['welcome_newest_member'] = 'ยินดีต้อนรับ %1$s สมาชิกใหม่ล่าสุดของเรา';
$txt['admin_center'] = 'ศูนย์ผู้ดูแลระบบ';
$txt['last_edit_by'] = '<span class="lastedit">แก้ไขล่าสุด</span>: %1$s โดย %2$s';
$txt['last_edit_reason'] = '<span id="reason" class="lastedit">เหตุผล</span>: %1$s';
$txt['notify_deactivate'] = 'คุณต้องการปิดใช้งานการแจ้งเตือนในหัวข้อนี้หรือไม่?';
$txt['modified_time'] = 'แก้ไขล่าสุด';
$txt['modified_by'] = 'แก้ไขโดย';

$txt['recent_posts'] = 'กระทู้ล่าสุด';

$txt['location'] = 'ที่ตั้ง';
$txt['location_desc'] = 'Geographic location.';
$txt['gender'] = 'เพศ';
$txt['gender_0'] = 'None';
$txt['gender_1'] = 'Male';
$txt['gender_2'] = 'Female';
$txt['gender_desc'] = 'Your gender.';
$txt['icq'] = 'ICQ';
$txt['icq_desc'] = 'This is your ICQ number.';
$txt['skype'] = 'Skype';
$txt['skype_desc'] = 'Your Skype username';
$txt['personal_text'] = 'ข้อความ';
$txt['date_registered'] = 'วันที่ลงทะเบียน';

$txt['recent_view'] = 'ดูกระทู้ล่าสุดบนฟอรั่ม';
$txt['recent_updated'] = 'เป็นหัวข้อที่ปรับปรุงล่าสุด';
$txt['is_recent_updated'] = '%1$s เป็นหัวข้อที่ปรับปรุงล่าสุด';

$txt['male'] = 'ชาย';
$txt['female'] = 'หญิง';

$txt['error_invalid_characters_username'] = 'อักขระที่ไม่ถูกต้องที่ใช้ในชื่อผู้ใช้';

// argument(s): forum name, login URL, login JavaScript snippet
$txt['welcome_guest'] = 'Welcome to <strong>%1$s</strong>. Please <a href="%2$s" onclick="%3$s">log in</a>.';

// argument(s): forum name, login URL, login JavaScript snippet, signup URL
$txt['welcome_guest_register'] = 'Welcome to <strong>%1$s</strong>. Please <a href="%2$s" onclick="%3$s">log in</a> or <a href="%4$s">sign up</a>.';

// argument(s): $scripturl
$txt['welcome_guest_activate'] = '<a href="%1$s?action=activate">คุณพลาดอีเมลยืนยันการใช้งานหรือไม่</a>';

// argument(s): $scripturl
$txt['register_prompt'] = 'Don\'t have an account? <a href="%1$s?action=signup">Sign up</a>.';

// argument(s): forum name
$txt['welcome_to_forum'] = 'Welcome to <strong>%1$s</strong>.';

// @todo the following to sprintf
$txt['hello_member'] = 'เฮ้';
// Use numeric entities in the below string.
$txt['hello_guest'] = 'ยินดีต้อนรับ';
$txt['select_destination'] = 'กรุณาเลือกปลายทาง';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['posted_by'] = 'กระทู้โดย';

$txt['icon_smiley'] = 'ยิ้ม';
$txt['icon_angry'] = 'โกรธ';
$txt['icon_cheesy'] = 'ยิ้มกว้างๆ';
$txt['icon_laugh'] = 'ขำขัน';
$txt['icon_sad'] = 'เศร้า';
$txt['icon_wink'] = 'ยิ้มเท่ห์';
$txt['icon_grin'] = 'ยิงฟันยิ้ม';
$txt['icon_shocked'] = 'ตกใจ';
$txt['icon_cool'] = 'เจ๋ง';
$txt['icon_huh'] = 'ฮืม';
$txt['icon_rolleyes'] = 'ขยิบตา';
$txt['icon_tongue'] = 'แลบลิ้น';
$txt['icon_embarrassed'] = 'อายจัง';
$txt['icon_lips'] = 'รูดซิบปาก';
$txt['icon_undecided'] = 'ลังเล';
$txt['icon_kiss'] = 'จุมพิต';
$txt['icon_cry'] = 'ร้องไห้';

$txt['moderator'] = 'ผู้ดูแล';
$txt['moderators'] = 'ผู้ดูแล';

$txt['views'] = 'การดู';
$txt['new'] = 'ใหม่';

$txt['view_all_members'] = 'ดูสมาชิกทั้งหมด';
$txt['view'] = 'ดู';

$txt['viewing_members'] = 'กำลังดูสมาชิก %1$s ถึง %2$s';
$txt['of_total_members'] = 'จาก %1$s สมาชิกทั้งหมด';

$txt['forgot_your_password'] = 'ลืมรหัสผ่านหรือไม่?';

$txt['date'] = 'วัน';
// Use numeric entities in the below string.
$txt['from'] = 'จาก';
$txt['check_new_messages'] = 'ตรวจสอบข้อความใหม่';
$txt['to'] = 'ถึง';

$txt['board_topics'] = 'กระทู้';
$txt['members_title'] = 'สมาชิก';
$txt['members_list'] = 'รายชื่อสมาชิก';
$txt['new_posts'] = 'กระทู้ใหม่';
$txt['old_posts'] = 'ไม่มีกระทู้ใหม่';
$txt['redirect_board'] = 'บอร์ดเปลี่ยนเส้นทาง';

$txt['sendtopic_send'] = 'ส่ง';
$txt['report_sent'] = 'ส่งรายงานของคุณเรียบร้อยแล้ว';
$txt['post_becomes_unapproved'] = 'ข้อความของคุณไม่ได้รับการอนุมัติเนื่องจากถูกโพสต์ในหัวข้อที่ไม่ได้รับการอนุมัติ เมื่อหัวข้อได้รับการอนุมัติ ข้อความของคุณจะได้รับการอนุมัติด้วย';

$txt['time_offset'] = 'ส่วนต่างของเวลา';
$txt['or'] = 'หรือ';

$txt['no_matches'] = 'ขออภัย ไม่พบรายการที่ตรงกัน';

$txt['notification'] = 'การแจ้งเตือน';

$txt['your_ban'] = 'ขออภัย %1$s คุณถูกแบนจากการใช้ฟอรัมนี้!';
$txt['your_ban_expires'] = 'การแบนนี้มีการตั้งค่าให้หมดอายุ %1$s';
$txt['your_ban_expires_never'] = 'การแบนนี้ไม่ได้ตั้งค่าให้หมดอายุ';
$txt['ban_continue_browse'] = 'คุณสามารถเรียกดูฟอรั่มในฐานะผู้มาเยือนได้';

$txt['mark_as_read'] = 'ทำเครื่องหมายข้อความทั้งหมดว่าอ่านแล้ว';

$txt['locked_topic'] = 'หัวข้อที่ถูกล็อค';
$txt['normal_topic'] = 'หัวข้อปกติ';
$txt['participation_caption'] = 'หัวข้อที่คุณโพสต์ใน';
$txt['moved_topic'] = 'หัวข้อที่ย้าย';

$txt['go_caps'] = 'ไป';

$txt['print'] = 'พิมพ์';
$txt['profile'] = 'โปรไฟล์';
$txt['topic_summary'] = 'สรุปหัวข้อ';
$txt['not_applicable'] = 'ไม่มี';
$txt['name_in_use'] = 'สมาชิกคนอื่นใช้ชื่อนี้แล้ว';

$txt['total_members'] = 'สมาชิกทั้งหมด';
$txt['total_posts'] = 'กระทู้ทั้งหมด';
$txt['total_topics'] = 'หัวข้อทั้งหมด';

$txt['time_logged_in'] = 'เวลาอยู่ในระบบ';

$txt['preview'] = 'ดูตัวอย่าง';
$txt['always_logged_in'] = 'ตลอดไป';

$txt['logged'] = 'บันทึก';
$txt['show_ip'] = 'แสดงที่อยู่ IP';
// Use numeric entities in the below string.
$txt['ip'] = 'IP';
$txt['url'] = 'URL';
$txt['www'] = 'เว็บไซต์';

$txt['hours'] = 'ชั่วโมง';
$txt['minutes'] = 'นาที';
$txt['seconds'] = 'วินาที';

// Used upper case in Paid subscriptions management
$txt['hour'] = 'ชั่วโมง';
$txt['days_word'] = 'วัน';

$txt['search_for'] = 'ค้นหา';
$txt['search_match'] = 'จับคู่';

$txt['forum_in_maintenance'] = 'ฟอรัมของคุณอยู่ในโหมดบำรุงรักษา เฉพาะผู้ดูแลระบบเท่านั้นที่สามารถเข้าสู่ระบบได้ในขณะนี้';
$txt['maintenance_page'] = 'คุณสามารถปิดโหมดการบำรุงรักษาจาก<a href="%1$s"> การตั้งค่าเซิร์ฟเวอร์</a>';

$txt['read_one_time'] = 'อ่าน 1 ครั้ง';
$txt['read_many_times'] = 'อ่าน %1$d ครั้ง';

$txt['forum_stats'] = 'สถิติฟอรั่ม';
$txt['latest_member'] = 'สมาชิกล่าสุด';
$txt['total_cats'] = 'หมวดหมู่ทั้งหมด';
$txt['latest_post'] = 'กระทู้ล่าสุด';

$txt['total_boards'] = 'บอร์ดทั้งหมด';

$txt['print_page'] = 'พิมพ์หน้านี้';
$txt['print_page_text'] = 'ข้อความเท่านั้น';
$txt['print_page_images'] = 'ข้อความพร้อมรูปภาพ';

$txt['valid_email'] = 'นี่ต้องเป็นที่อยู่อีเมลที่ถูกต้อง';

$txt['geek'] = 'มากเกินบรรยาย';
$txt['info_center_title'] = '%1$s - ศูนย์ข้อมูล';

$txt['watch'] = 'เฝ้าดู';
$txt['unwatch'] = 'หยุดการเฝ้าดู';

$txt['check_all'] = 'Select all';

// Use numeric entities in the below string.
$txt['database_error'] = 'ฐานข้อมูลผิดพลาด';
$txt['try_again'] = 'กรุณาลองอีกครั้ง หากคุณกลับมาที่หน้าจอแสดงข้อผิดพลาดนี้ ให้รายงานข้อผิดพลาดกับผู้ดูแลระบบ';
$txt['file'] = 'ไฟล์';
$txt['line'] = 'บรรทัด';
// Use numeric entities in the below string.
$txt['tried_to_repair'] = 'SMF ตรวจพบและพยายามซ่อมแซมข้อผิดพลาดในฐานข้อมูลของคุณโดยอัตโนมัติ หากคุณยังคงประสบปัญหาหรือยังคงได้รับอีเมลเหล่านี้ โปรดติดต่อโฮสต์ของคุณ';
$txt['database_error_versions'] = '<strong>หมายเหตุ:</strong> ดูเหมือนว่าฐานข้อมูลของคุณ<em>อาจ</em>จำเป็นต้องอัปเกรด ไฟล์ในฟอรัมของคุณอยู่ที่เวอร์ชัน %1$s ในขณะที่ฐานข้อมูลของคุณอยู่ที่เวอร์ชัน %2$s ข้อผิดพลาดข้างต้นอาจหายไปหากคุณใช้ upgrade.php เวอร์ชันล่าสุด';
$txt['template_parse_error'] = 'ข้อผิดพลาดในการแยกวิเคราะห์แม่แบบ!';
$txt['template_parse_error_message'] = 'ดูเหมือนว่ามีอะไรบางอย่างที่มีรสเปรี้ยวบนฟอรัมด้วยระบบแม่แบบ ปัญหานี้ควรเกิดขึ้นชั่วคราวเท่านั้นดังนั้นโปรดกลับมาอีกครั้งในภายหลังแล้วลองอีกครั้ง หากคุณยังคงดูข้อความนี้โปรดติดต่อผู้ดูแลระบบ<br><br>คุณสามารถลอง<a href="javascript: location.reload();">รีเฟรชหน้านี้</a>';
// argument(s): filename, $boardurl, $scripturl
$txt['template_parse_error_details'] = 'เกิดปัญหาในการโหลดเทมเพลตหรือไฟล์ภาษา <pre><strong>%1$s</strong></pre> โปรดตรวจสอบไวยากรณ์และลองอีกครั้ง - อย่าลืมเครื่องหมายอัญประกาศเดี่ยว (<pre>\'</pre>) มักจะต้องใช้เครื่องหมายทับ (<pre>\\</pre>) หากต้องการดูข้อมูลข้อผิดพลาดเฉพาะเพิ่มเติมจาก PHP ให้ลอง<a href="%2$s%1$s">เข้าถึงไฟล์โดยตรง</a><br><br>คุณอาจต้องการลอง<a href= "javascript:location.reload();">รีเฟรชหน้านี้</a>หรือ<a href="%3$s?theme=1">ใช้ธีมเริ่มต้น</a>';
$txt['template_parse_errmsg'] = 'น่าเสียดายที่ไม่มีข้อมูลเพิ่มเติมในขณะนี้ว่ามีอะไรผิดปกติ';

$txt['today'] = '<strong>วันนี้</strong> เวลา ';
$txt['yesterday'] = '<strong>เมื่อวานนี้</strong> เวลา ';
$txt['new_poll'] = 'โพลใหม่';
$txt['poll_question'] = 'คำถาม';
$txt['poll_vote'] = 'ส่งโหวต';
$txt['poll_total_voters'] = 'จำนวนสมาชิกโหวดทั้งหมด';
$txt['poll_results'] = 'ดูผลลัพธ์';
$txt['poll_lock'] = 'ล็อคการโหวต';
$txt['poll_unlock'] = 'ปลดล็อคการโหวต';
$txt['poll_edit'] = 'แก้ไขโพล';
$txt['poll'] = 'โพล';
$txt['one_hour'] = '1 ชั่วโมง';
$txt['one_day'] = '1 วัน';
$txt['one_week'] = '1 สัปดาห์';
$txt['two_weeks'] = '2 สัปดาห์';
$txt['one_month'] = '1 เดือน';
$txt['two_months'] = '2 เดือน';
$txt['forever'] = 'ตลอดไป';
$txt['moved'] = 'ย้ายแล้ว';
$txt['move_why'] = 'โปรดป้อนคำอธิบายสั้นๆ ว่า<br>เหตุใดหัวข้อนี้จึงถูกย้าย';
$txt['board'] = 'บอร์ด';
$txt['in'] = 'ใน';
$txt['sticky_topic'] = 'หัวข้อปักหมุด';

$txt['delete'] = 'ลบ';
$txt['no_change'] = 'ไม่มีการเปลี่ยนแปลง';

$txt['your_pms'] = 'ข้อความส่วนตัวของคุณ';

$txt['kilobyte'] = 'กิโลไบต์';
$txt['megabyte'] = 'เมกะไบต์';

$txt['more_stats'] = '[สถิติเพิ่มเติม]';

// Use numeric entities in the below three strings.
$txt['code'] = 'โค๊ด';
$txt['code_select'] = 'เลือก';
$txt['code_expand'] = 'ขยาย';
$txt['code_shrink'] = 'ยุบ';
$txt['quote_from'] = 'อ้างจาก';
$txt['quote'] = 'อ้างถึง';
$txt['quote_action'] = 'อ้างถึง';
$txt['quote_selected_action'] = 'อ้างข้อความที่เลือก';
$txt['fulledit'] = 'แก้ไขแบบเต็ม';
$txt['edit'] = 'แก้ไข';
$txt['quick_edit'] = 'แก้ไขด่วน';
$txt['post_options'] = 'เพิ่มเติม...';

$txt['merge_to_topic_id'] = 'ID ของหัวข้อเป้าหมาย';
$txt['split'] = 'แยกหัวข้อ';
$txt['merge'] = 'รวมหัวข้อ';
$txt['target_id'] = 'เลือกเป้าหมายตาม ID หัวข้อ';
$txt['target_below'] = 'เลือกเป้าหมายจากรายการด้านล่าง';
$txt['subject_new_topic'] = 'ชื่อสำหรับหัวข้อใหม่';
$txt['split_this_post'] = 'แยกกระทู้นี้เท่านั้น';
$txt['split_after_and_this_post'] = 'แยกหัวข้อหลังจากและรวมถึงกระทู้นี้';
$txt['select_split_posts'] = 'เลือกกระทูัที่จะแยก';
$txt['new_topic'] = 'หัวข้อใหม่';
$txt['split_successful'] = 'หัวข้อแบ่งออกเป็นสองหัวข้อได้สำเร็จ';
$txt['origin_topic'] = 'หัวข้อเดิม';
$txt['please_select_split'] = 'โปรดเลือกกระทู้ที่คุณต้องการแยก';
$txt['merge_successful'] = 'รวมหัวข้อสำเร็จแล้ว';
$txt['new_merged_topic'] = 'หัวข้อที่รวมใหม่';
$txt['topic_to_merge'] = 'หัวข้อที่จะรวม';
$txt['target_board'] = 'บอร์ดเป้าหมาย';
$txt['target_topic'] = 'หัวข้อเป้าหมาย';
$txt['merge_desc'] = 'ฟังก์ชันนี้จะรวมข้อความของสองหัวข้อเป็นหัวข้อเดียว ข้อความจะถูกจัดเรียงตามเวลาที่โพสต์ ดังนั้น กระทู้แรกสุดจะเป็นข้อความแรกของหัวข้อที่ผสาน';

$txt['set_sticky'] = 'ตั้งหัวข้อปักหมุด';
$txt['set_nonsticky'] = 'ยกเลิกการปักหมุด';
$txt['set_lock'] = 'ล็อคหัวข้อ';
$txt['set_unlock'] = 'ยกเลิกการล็อคหัวข้อ';

$txt['search_advanced'] = 'การค้นหาขั้นสูง';

$txt['security_risk'] = 'ความเสี่ยงด้านความปลอดภัยที่สำคัญ:';
$txt['not_removed'] = 'คุณยังไม่ได้ลบ ';
$txt['not_removed_extra'] = '%1$s เป็นข้อมูลสำรองของ %2$s ที่ไม่ได้สร้างโดย SMF สามารถเข้าถึงได้โดยตรงและใช้เพื่อเข้าถึงฟอรัมของคุณโดยไม่ได้รับอนุญาต คุณควรลบออกทันที';
$txt['generic_warning'] = 'คำเตือน';
$txt['agreement_missing'] = 'คุณต้องการให้ผู้ใช้ใหม่ยอมรับข้อตกลงการลงทะเบียน อย่างไรก็ตาม ไฟล์ (agreement.txt) ไม่มีอยู่';
$txt['policy_agreement_missing'] = 'คุณต้องการให้ผู้ใช้ใหม่ยอมรับนโยบายความเป็นส่วนตัว อย่างไรก็ตาม นโยบายความเป็นส่วนตัวว่างเปล่า';
$txt['auth_secret_missing'] = 'ไม่สามารถตั้งค่าความลับในการตรวจสอบสิทธิ์ใน Settings.php สิ่งนี้ทำให้ความปลอดภัยของฟอรั่มของคุณอ่อนแอลง และทำให้เสี่ยงต่อการถูกโจมตี ตรวจสอบสิทธิ์ของไฟล์ใน Settings.php เพื่อให้แน่ใจว่า SMF สามารถเขียนไปยังไฟล์ได้';

$txt['cache_writable'] = 'ไดเรกทอรีแคชไม่สามารถเขียนได้ ซึ่งจะส่งผลเสียต่อประสิทธิภาพของฟอรัมของคุณ';

$txt['page_created_full'] = 'เพจสร้างใน %1$.3f วินาทีโดยมี %2$d เควรี';

$txt['report_to_mod_func'] = 'ใช้ฟังก์ชันนี้เพื่อแจ้งให้ผู้ดูแลและผู้ดูแลระบบทราบถึงข้อความที่ไม่เหมาะสมหรือเป็นปัญหา';
$txt['report_profile_func'] = 'ใช้ฟังก์ชันนี้เพื่อแจ้งผู้ดูแลระบบเกี่ยวกับเนื้อหาโปรไฟล์ที่ไม่เหมาะสม เช่น สแปมหรือรูปภาพที่ไม่เหมาะสม';

$txt['online'] = 'ออนไลน์';
$txt['member_is_online'] = '%1$s ออนไลน์อยู่';
$txt['offline'] = 'ออฟไลน์';
$txt['member_is_offline'] = '%1$s ออฟไลน์อยู่';
$txt['pm_online'] = 'ข้อความส่วนตัว (ออนไลน์)';
$txt['pm_offline'] = 'ข้อความส่วนตัว (ออฟไลน์)';
$txt['status'] = 'สถานะ';

$txt['go_up'] = 'ขึ้น';
$txt['go_down'] = 'ลง';

// argument(s): SMF_FULL_VERSION, SMF_SOFTWARE_YEAR, $scripturl
$forum_copyright = '<a href="%3$s?action=credits" title="License" target="_blank" rel="noopener">%1$s &copy; %2$s</a>, <a href="https://www.simplemachines.org" title="Simple Machines" target="_blank" rel="noopener">Simple Machines</a>';

$txt['birthdays'] = 'วันเกิด:';
$txt['events'] = 'กิจกรรม:';
$txt['birthdays_upcoming'] = 'วันเกิดที่จะมาถึง:';
$txt['events_upcoming'] = 'กิจกรรมที่จะเกิดขึ้น:';
// Prompt for holidays in the calendar, leave blank to just display the holiday's name.
$txt['calendar_prompt'] = 'วันหยุด:';
$txt['calendar_month'] = 'เดือน';
$txt['calendar_year'] = 'ปี';
$txt['calendar_day'] = 'วัน';
$txt['calendar_event_title'] = 'ชื่อกิจกรรม';
$txt['calendar_event_options'] = 'ตัวเลือกกิจกรรม';
$txt['calendar_post_in'] = 'โพสต์ใน';
$txt['calendar_edit'] = 'แก้ไขกิจกรรม';
$txt['calendar_export'] = 'ส่งออกเหตุการณ์';
$txt['calendar_view_week'] = 'ดูสัปดาห์';
$txt['event_delete_confirm'] = 'ลบกิจกรรมนี้หรือไม่';
$txt['event_delete'] = 'ลบกิจกรรม';
$txt['calendar_post_event'] = 'เพิ่มกิจกรรม';
$txt['calendar'] = 'ปฏิทิน';
$txt['calendar_link'] = 'ลิงก์ไปยังปฏิทิน';
$txt['calendar_upcoming'] = 'ปฏิทินที่กำลังจะมาถึง';
$txt['calendar_today'] = 'ปฏิทินวันนี้';
$txt['calendar_week'] = 'สัปดาห์';
$txt['calendar_week_title'] = 'สัปดาห์ %1$d จาก %2$d';
// %1$s is the month, %2$s is the day, %3$s is the year. Change to suit your language.
$txt['calendar_week_beginning'] = 'สัปดาห์ที่เริ่มต้น %2$s %1$s, %3$s';
$txt['calendar_numb_days'] = 'จำนวนวัน';
$txt['calendar_how_edit'] = 'คุณจะแก้ไขกิจกรรมเหล่านี้อย่างไร';
$txt['calendar_link_event'] = 'ลิงก์กิจกรรมเพื่อโพสต์';
$txt['calendar_confirm_delete'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้';
$txt['calendar_linked_events'] = 'กิจกรรมที่เชื่อมโยง';
$txt['calendar_click_all'] = 'คลิกเพื่อดู %1$s ทั้งหมด';
$txt['calendar_allday'] = 'ทั้งวัน';
$txt['calendar_timezone'] = 'เขตเวลา';
$txt['calendar_list'] = 'รายการ';
$txt['calendar_empty'] = 'ไม่มีกิจกรรมที่จะแสดง';

$txt['movetopic_change_subject'] = 'เปลี่ยนชื่อหัวข้อ';
$txt['movetopic_new_subject'] = 'ชื่อใหม่';
$txt['movetopic_change_all_subjects'] = 'เปลี่ยนชื่อเรื่องทุกข้อความ';
$txt['move_topic_unapproved_js'] = 'คำเตือน! หัวข้อนี้ยังไม่ได้รับการอนุมัติ\n\nไม่แนะนำให้คุณสร้างหัวข้อการเปลี่ยนเส้นทาง เว้นแต่คุณต้องการอนุมัติโพสต์ทันทีหลังจากการย้าย';
$txt['movetopic_auto_board'] = '[บอร์ด]';
$txt['movetopic_auto_topic'] = '[ลิงค์หัวข้อ]';

// argument(s): $txt['movetopic_auto_board'], $txt['movetopic_auto_topic']
$txt['movetopic_default'] = 'หัวข้อนี้ถูกย้ายไปที่ %1$s แล้ว

%2$s';

$txt['movetopic_redirect'] = 'เปลี่ยนเส้นทางไปยังหัวข้อที่ย้าย';

$txt['post_redirection'] = 'ตั้งหัวข้อเปลี่ยนเส้นทาง';
$txt['redirect_topic_expires'] = 'ลบหัวข้อการเปลี่ยนเส้นทางโดยอัตโนมัติ';
$txt['mergetopic_redirect'] = 'เปลี่ยนเส้นทางไปยังหัวข้อที่ผสาน';
$txt['merge_topic_unapproved_js'] = 'คำเตือน! หัวข้อนี้ยังไม่ได้รับการอนุมัติ\n\nไม่แนะนำให้คุณสร้างหัวข้อการเปลี่ยนเส้นทาง เว้นแต่ว่าคุณต้องการอนุมัติโพสต์ทันทีหลังจากการรวม';

$txt['theme_template_error'] = 'ไม่สามารถโหลดเทมเพลต \'%1$s\'';
$txt['theme_language_error'] = 'ไม่สามารถโหลดไฟล์ภาษา \'%1$s\'';

$txt['sub_boards'] = 'บอร์ดย่อย';
$txt['restricted_board'] = 'บอร์ดที่ถูกจำกัด';

$txt['smtp_no_connect'] = 'ไม่สามารถเชื่อมต่อกับโฮสต์ SMTP ได้';
$txt['smtp_port_ssl'] = 'การตั้งค่าพอร์ต SMTP ไม่ถูกต้อง ควรเป็น 465 สำหรับเซิร์ฟเวอร์ SSL ชื่อโฮสต์อาจต้องมี ssl:// นำหน้า';
$txt['smtp_bad_response'] = 'ไม่สามารถรับรหัสตอบกลับของเซิร์ฟเวอร์เมล';
$txt['smtp_error'] = 'พบปัญหาในการส่งเมล ข้อผิดพลาด: ';
$txt['mail_send_unable'] = 'ไม่สามารถส่งอีเมลไปยังที่อยู่อีเมล \'%1$s\'';

$txt['mlist_search'] = 'ค้นหาสมาชิก';
$txt['mlist_search_again'] = 'ค้นหาอีกครั้ง';
$txt['mlist_search_filter'] = 'ตัวเลือกการค้นหา';
$txt['mlist_search_email'] = 'ค้นหาตามที่อยู่อีเมล';
$txt['mlist_search_messenger'] = 'ค้นหาด้วยชื่อเล่นของผู้ส่งสาร';
$txt['mlist_search_group'] = 'ค้นหาตามตำแหน่ง';
$txt['mlist_search_name'] = 'ค้นหาด้วยชื่อ';
$txt['mlist_search_website'] = 'ค้นหาตามเว็บไซต์';
$txt['mlist_search_results'] = 'ผลการค้นหาสำหรับ';
$txt['mlist_search_by'] = 'ค้นหาโดย %1$s';
$txt['mlist_menu_view'] = 'ดูรายชื่อสมาชิก';

$txt['attach_downloaded'] = 'ดาวน์โหลด %1$d ครั้ง';
$txt['attach_viewed'] = 'ดู %1$d ครั้ง';

$txt['settings'] = 'ตั้งค่า';
$txt['never'] = 'ไม่เคย';
$txt['more'] = 'เพิ่มเติม';
$txt['etc'] = 'เป็นต้น';

$txt['hostname'] = 'ชื่อโฮสต์';
$txt['you_are_post_banned'] = 'ขออภัย %1$s คุณถูกแบนไม่ให้โพสต์และส่งข้อความส่วนตัวในฟอรัมนี้';
$txt['ban_reason'] = 'เหตุผล';
$txt['select_item_check'] = 'กรุณาเลือกอย่างน้อยหนึ่งรายการในรายการ';

$txt['tables_optimized'] = 'ปรับตารางฐานข้อมูลให้เหมาะสม';

$txt['add_poll'] = 'เพิ่มโพล';
$txt['poll_options_limit'] = 'คุณสามารถเลือกได้สูงสุด %1$s ตัวเลือกเท่านั้น';
$txt['poll_remove'] = 'ลบโพล';
$txt['poll_remove_warn'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบโพลออกจากหัวข้อ';
$txt['poll_results_expire'] = 'จะแสดงผลเมื่อปิดโหวต';
$txt['poll_expires_on'] = 'ปิดโหวต';
$txt['poll_expired_on'] = 'ปิดโหวตแล้ว';
$txt['poll_change_vote'] = 'ลบโหวต';
$txt['poll_return_vote'] = 'ตัวเลือกการโหวด';
$txt['poll_cannot_see'] = 'คุณไม่สามารถดูผลโพลนี้ได้ในขณะนี้';

$txt['quick_mod_approve'] = 'อนุมัติที่เลือก';
$txt['quick_mod_remove'] = 'ลบรายการที่เลือก';
$txt['quick_mod_lock'] = 'ล็อก/ปลดล็อกที่เลือกไว้';
$txt['quick_mod_sticky'] = 'ปักหมุด/เลิกปักหมุดที่เลือก';
$txt['quick_mod_move'] = 'ย้ายที่เลือกไปที่';
$txt['quick_mod_merge'] = 'รวมที่เลือก';
$txt['quick_mod_markread'] = 'ทำเครื่องหมายว่าอ่านแล้ว';
$txt['quick_mod_markunread'] = 'ทำเครื่องหมายว่ายังไม่ได้อ่าน';
$txt['quick_mod_selected'] = 'ด้วยตัวเลือกที่เลือกทำ';
$txt['quick_mod_go'] = 'ไป';
$txt['quickmod_confirm'] = 'คุณแน่ใจหรือว่าต้องการทำเช่นนี้?';

$txt['spell_check'] = 'ตรวจสอบการสะกด';

$txt['quick_reply'] = 'ตอบกลับอย่างรวดเร็ว';
$txt['quick_reply_warning'] = 'คำเตือน! หัวข้อนี้ถูกล็อกอยู่ในขณะนี้ เฉพาะผู้ดูแลระบบและผู้ดูแลเท่านั้นที่สามารถตอบกลับได้';
$txt['quick_reply_verification'] = 'หลังจากส่งโพสต์ของคุณแล้ว ระบบจะนำคุณไปยังหน้าโพสต์ปกติเพื่อยืนยันโพสต์ของคุณ %1$s';
$txt['quick_reply_verification_guests'] = '(จำเป็นสำหรับผู้มาเยือนทุกคน)';
$txt['quick_reply_verification_posts'] = '(จำเป็นสำหรับผู้ใช้ทั้งหมดที่มีน้อยกว่า %1$d กระทู้)';
$txt['wait_for_approval'] = 'หมายเหตุ: กระทู้นี้จะไม่แสดงจนกว่าจะได้รับการอนุมัติจากผู้ดูแล';

$txt['notification_enable_board'] = 'คุณแน่ใจหรือไม่ว่าต้องการเปิดใช้งานการแจ้งเตือนหัวข้อใหม่สำหรับบอร์ดนี้';
$txt['notification_disable_board'] = 'คุณแน่ใจหรือไม่ว่าต้องการปิดการแจ้งเตือนหัวข้อใหม่สำหรับบอร์ดนี้';
$txt['notification_enable_topic'] = 'คุณแน่ใจหรือไม่ว่าต้องการเปิดใช้งานการแจ้งเตือนการตอบกลับใหม่สำหรับหัวข้อนี้';
$txt['notification_disable_topic'] = 'คุณแน่ใจหรือไม่ว่าต้องการปิดใช้งานการแจ้งเตือนการตอบกลับใหม่สำหรับหัวข้อนี้';

// Mentions
$txt['mentions'] = 'กล่าวถึง';

// Likes
$txt['likes'] = 'ชอบ';
$txt['like'] = 'ชอบ';
$txt['unlike'] = 'ไม่ถูกใจ';
$txt['like_success'] = 'เนื้อหาของคุณได้รับการกดถูกใจเรียบร้อยแล้ว';
$txt['like_delete'] = 'เนื้อหาของคุณถูกลบเรียบร้อยแล้ว';
$txt['like_insert'] = 'แทรกเนื้อหาของคุณสำเร็จแล้ว';
$txt['like_error'] = 'เกิดข้อผิดพลาดกับคำขอของคุณ';
$txt['like_disable'] = 'ฟีเจอร์การชอบถูกปิดใช้งาน';
$txt['not_valid_like_type'] = 'ประเภทที่ชอบไม่ใช่ประเภทที่ถูกต้อง';
// Translators, if you need to make more strings to suit your language, e.g. $txt['likes_2'] = 'Two people like this', please do so.
$txt['likes_1'] = '<a href="%1$s">%2$s คน</a>ชอบสิ่งนี้';
$txt['likes_n'] = '<a href="%1$s">%2$s คน</a>ชอบสิ่งนี้';
$txt['you_likes_0'] = 'คุณชอบสิ่งนี้';
$txt['you_likes_1'] = 'คุณและ<a href="%1$s">อีก %2$s คน</a>ชอบสิ่งนี้';
$txt['you_likes_n'] = 'คุณและ<a href="%1$s">อีก %2$s คน</a>ชอบสิ่งนี้';

$txt['report_to_mod'] = 'รายงานต่อผู้ดูแล';
$txt['report_profile'] = 'รายงานโปรไฟล์ของ %1$s';

$txt['unread_topics_visit'] = 'หัวข้อที่ยังไม่ได้อ่านล่าสุด';
// argument(s): scripturl
$txt['unread_topics_visit_none'] = 'ไม่พบหัวข้อที่ยังไม่ได้อ่านตั้งแต่ครั้งล่าสุดที่คุณเข้ามา <a href="%1$s?action=unread;all">คลิกที่นี่เพื่อลองหัวข้อที่ยังไม่ได้อ่านทั้งหมด</a>';
$txt['updated_topics_visit_none'] = 'ไม่พบหัวข้อที่อัปเดตตั้งแต่การเยี่ยมชมครั้งล่าสุดของคุณ';
$txt['unread_topics_all'] = 'หัวข้อที่ยังไม่ได้อ่านทั้งหมด';
$txt['unread_replies'] = 'อัปเดตหัวข้อ';

$txt['who_title'] = 'ใครออนไลน์อยู่';
$txt['who_and'] = ' และ ';
$txt['who_viewing_topic'] = ' กำลังดูหัวข้อนี้';
$txt['who_viewing_board'] = ' กำลังดูบอร์ดนี้';
$txt['who_member'] = 'สมาชิก';

// No longer used by default theme, but for backwards compat
$txt['powered_by_php'] = 'ขับเคลื่อนโดย PHP';
$txt['powered_by_mysql'] = 'ขับเคลื่อนโดย MySQL';
$txt['valid_css'] = 'CSS ที่ถูกต้อง';

$txt['rss'] = 'RSS';
$txt['atom'] = 'Atom';
$txt['html'] = 'HTML';

$txt['guest'] = 'ผู้มาเยือน';
$txt['guests'] = 'ผู้มาเยือน';
$txt['user'] = 'ผู้ใช้';
$txt['users'] = 'ผู้ใช้';
$txt['hidden'] = 'ซ่อน';

// Plural form of hidden for languages other than English
$txt['hidden_s'] = 'ซ่อน';
$txt['buddy'] = 'เพื่อน';
$txt['buddies'] = 'เพื่อน';
$txt['most_online_ever'] = 'ออนไลน์มากที่สุดตลอดกาล';
$txt['most_online_today'] = 'ออนไลน์มากที่สุดวันนี้';

$txt['merge_select_target_board'] = 'เลือกบอร์ดเป้าหมายของหัวข้อที่ผสาน';
$txt['merge_select_poll'] = 'เลือกโพลที่หัวข้อที่รวมควรมี';
$txt['merge_topic_list'] = 'เลือกหัวข้อที่จะรวม';
$txt['merge_select_subject'] = 'เลือกหัวเรื่องของหัวข้อที่ผสาน';
$txt['merge_custom_subject'] = 'หัวเรื่องที่กำหนดเอง';
$txt['merge_include_notifications'] = 'รวมการแจ้งเตือน?';
$txt['merge_check'] = 'ผสาน?';
$txt['merge_no_poll'] = 'ไม่มีโพล';
$txt['merge_why'] = 'โปรดป้อนคำอธิบายสั้นๆ ว่าทำไมหัวข้อเหล่านี้จึงถูกรวมเข้าด้วยกัน';
$txt['merged_subject'] = '[MERGED] %1$s';
// argument(s): $txt['movetopic_auto_topic']
$txt['mergetopic_default'] = 'หัวข้อนี้ถูกรวมเข้ากับ %2$s แล้ว';

$txt['response_prefix'] = 'ต่อ: ';
$txt['current_icon'] = 'ไอคอนปัจจุบัน';
$txt['message_icon'] = 'ไอคอนข้อความ';

$txt['smileys_current'] = 'ชุดรูปแสดงอารมณ์ปัจจุบัน';
$txt['smileys_none'] = 'ไม่มีรูปแสดงอารมณ์';
$txt['smileys_forum_board_default'] = 'ฟอรั่ม/บอร์ดค่าเริ่มต้น';

$txt['search_results'] = 'ผลการค้นหา';
$txt['search_no_results'] = 'ขออภัย ไม่พบรายการที่ตรงกัน';

$txt['total_time_logged_days'] = ' วัน ';
$txt['total_time_logged_hours'] = ' ชั่วโมงและ ';
$txt['total_time_logged_minutes'] = ' นาที';
$txt['total_time_logged_d'] = 'วัน ';
$txt['total_time_logged_h'] = 'ชั่วโมง ';
$txt['total_time_logged_m'] = 'นาที';

$txt['approve_members_waiting'] = 'การอนุมัติสมาชิก';

$txt['activate_code'] = 'รหัสเปิดใช้งานของคุณคือ';

$txt['find_members'] = 'ค้นหาสมาชิก';
$txt['find_username'] = 'ชื่อ ชื่อผู้ใช้ หรือที่อยู่อีเมล';
$txt['find_buddies'] = 'แสดงเฉพาะเพื่อน?';
$txt['find_wildcards'] = 'อักษรพิเศษที่อนุญาต: *, ?';
$txt['find_no_results'] = 'ไม่พบผลลัพธ์';
$txt['find_results'] = 'ผลลัพธ์';
$txt['find_close'] = 'ปิด';

$txt['unread_since_visit'] = 'แสดงกระทู้ที่ยังไม่ได้อ่านตั้งแต่ครั้งล่าสุด';
$txt['show_unread_replies'] = 'แสดงการตอบกลับใหม่ในกระทู้ของคุณ';

$txt['change_color'] = 'เปลี่ยนสี';

$txt['quickmod_delete_selected'] = 'ลบรายการที่เลือก';
$txt['quickmod_split_selected'] = 'แยกที่เลือก';

$txt['show_personal_messages_heading'] = 'ข้อความใหม่';
$txt['show_personal_messages'] = 'คุณมี <strong>%1$s</strong> ข้อความส่วนตัวที่ยังไม่ได้อ่านในกล่องจดหมายของคุณ<br><br><a href="%2$s">ไปที่กล่องจดหมายของคุณ</a>';

$txt['help_popup'] = 'เดี๋ยวอธิบายให้:';

$txt['previous_next_back'] = 'หัวข้อก่อนหน้า';
$txt['previous_next_forward'] = 'หัวข้อถัดไป';

$txt['mark_unread'] = 'ทำเครื่องหมายว่ายังไม่ได้อ่าน';

$txt['ssi_not_direct'] = 'โปรดอย่าเข้าถึง SSI.php ด้วย URL โดยตรง คุณอาจต้องการใช้พาธ (%1$s) หรือเพิ่ม ?ssi_function=something';
$txt['ssi_session_broken'] = 'SSI.php ไม่สามารถโหลดเซสชันได้! ซึ่งอาจทำให้เกิดปัญหากับการออกจากระบบและฟังก์ชันอื่นๆ - โปรดตรวจสอบให้แน่ใจว่าได้รวม SSI.php ก่อน *สิ่งอื่น* ในสคริปต์ทั้งหมดของคุณ!';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['preview_title'] = 'ตัวอย่างกระทู้';
$txt['preview_fetch'] = 'กำลังเรียกตัวอย่าง...';
$txt['preview_new'] = 'ข้อความใหม่';
$txt['pm_error_while_submitting'] = 'เกิดข้อผิดพลาดต่อไปนี้ขณะส่งข้อความส่วนตัวนี้:';
$txt['error_while_submitting'] = 'ข้อความมีข้อผิดพลาดที่ต้องแก้ไขก่อนดำเนินการต่อ:';
$txt['error_old_topic'] = 'คำเตือน: ไม่มีการตั้งกระทู้หัวข้อนี้เป็นเวลาอย่างน้อย %1$d วัน<br>หากคุณมั่นใจว่าต้องการตอบกลับ โปรดพิจารณาเริ่มหัวข้อใหม่';

$txt['split_selected_posts'] = 'กระทู้ที่เลือก';
$txt['split_selected_posts_desc'] = 'กระทู้ด้านล่างจะสร้างหัวข้อใหม่หลังจากแยก';
$txt['split_reset_selection'] = 'รีเซ็ตการเลือก';

$txt['modify_cancel'] = 'ยกเลิก';
$txt['modify_cancel_all'] = 'ยกเลิกทั้งหมด';
$txt['mark_read_short'] = 'ทำเครื่องหมายว่าอ่านแล้ว';

$txt['alerts'] = 'การแจ้งเตือน';

$txt['pm_short'] = 'ข้อความของฉัน';
$txt['pm_menu_read'] = 'อ่านข้อความของคุณ';
$txt['pm_menu_send'] = 'ส่งข้อความ';

$txt['unapproved_posts'] = 'กระทู้ที่ไม่ได้รับการอนุมัติ (หัวข้อ: %1$d, กระทู้: %2$d)';

$txt['ajax_in_progress'] = 'กำลังโหลด...';

$txt['mod_reports_waiting'] = 'กระทู้รายงาน';

$txt['view_unread_category'] = 'กระทู้ที่ยังไม่ได้อ่าน';
$txt['new_posts_in_category'] = 'คลิกเพื่อดูกระทู้ใหม่ใน %1$s';
$txt['verification'] = 'การยืนยัน';
$txt['visual_verification_hidden'] = 'กรุณาเว้นช่องนี้ว่างไว้';
$txt['visual_verification_description'] = 'พิมพ์ตัวอักษรที่แสดงในภาพ';
$txt['visual_verification_sound'] = 'ฟังตัวอักษร';
$txt['visual_verification_request_new'] = 'ขออีกภาพ';

// Sub menu labels
$txt['summary'] = 'สรุป';
$txt['account'] = 'การตั้งค่าบัญชี';
$txt['theme'] = 'รูปลักษณ์และเลย์เอาต์';
$txt['forumprofile'] = 'โปรไฟล์ฟอรั่ม';
$txt['activate_changed_email_title'] = 'เปลี่ยนที่อยู่อีเมลแล้ว';
$txt['activate_changed_email_desc'] = 'คุณได้เปลี่ยนที่อยู่อีเมลของคุณ เพื่อยืนยันที่อยู่นี้ คุณจะได้รับอีเมล คลิกลิงก์ในอีเมลนั้นเพื่อเปิดใช้งานบัญชีของคุณอีกครั้ง';
$txt['modSettings_title'] = 'คุณสมบัติและตัวเลือก';
$txt['package'] = 'ตัวจัดการแพ็คเกจ';
$txt['errorlog'] = 'บันทึกข้อผิดพลาด';
$txt['edit_permissions'] = 'สิทธิ์';
$txt['mc_unapproved_attachments'] = 'ไฟล์แนบที่ไม่ได้รับการอนุมัติ';
$txt['mc_unapproved_poststopics'] = 'กระทู้และหัวข้อที่ไม่ได้รับการอนุมัติ';
$txt['mc_reported_posts'] = 'กระทู้รายงาน';
$txt['mc_reported_members'] = 'สมาชิกที่รายงาน';
$txt['modlog_view'] = 'บันทึกการดูแล';
$txt['calendar_menu'] = 'ดูปฏิทิน';

// @todo Send email strings - should move?
$txt['send_email'] = 'ส่งอีเมล';

$txt['ignoring_user'] = 'คุณกำลังละเว้นผู้ใช้รายนี้';
$txt['show_ignore_user_post'] = 'แสดงโพสต์ให้ฉันดู';

$txt['spider'] = 'แมงมุม';
$txt['spiders'] = 'แมงมุม';

$txt['downloads'] = 'ดาวน์โหลด';
$txt['filesize'] = 'ขนาดไฟล์';

// Restore topic
$txt['restore_topic'] = 'กู้คืนหัวข้อ';
$txt['restore_message'] = 'กู้คืน';
$txt['quick_mod_restore'] = 'กู้คืนที่เลือก';

// Editor prompt.
$txt['prompt_text_email'] = 'กรุณากรอกอีเมล์';
$txt['prompt_text_ftp'] = 'โปรดป้อนที่อยู่ FTP';
$txt['prompt_text_url'] = 'โปรดป้อน URL ที่คุณต้องการเชื่อมโยง';
$txt['prompt_text_img'] = 'ใส่ตำแหน่งภาพ';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['autosuggest_delete_item'] = 'ลบรายการ';

// Debug related - when $db_show_debug is true.
$txt['debug_templates'] = 'แม่แบบ: ';
$txt['debug_subtemplates'] = 'แม่แบบย่อย: ';
$txt['debug_language_files'] = 'ไฟล์ภาษา: ';
$txt['debug_stylesheets'] = 'สไตล์ชีท: ';
$txt['debug_files_included'] = 'ไฟล์รวม: ';
$txt['debug_memory_use'] = 'หน่วยความจำที่ใช้: ';
$txt['debug_kb'] = 'กิโลไบต์';
$txt['debug_show'] = 'แสดง';
$txt['debug_cache_hits'] = 'แคชฮิต: ';
$txt['debug_cache_misses'] = 'แคชพลาด: ';
$txt['debug_cache_seconds_bytes'] = '%1$ss - %2$s ไบต์';
$txt['debug_cache_seconds_bytes_total'] = '%1$ss สำหรับ %2$s ไบต์';
$txt['debug_queries_used'] = 'เควรีที่ใช้: %1$d';
$txt['debug_queries_used_and_warnings'] = 'เควรีที่ใช้: %1$d, %2$d คำเตือน';
$txt['debug_query_in_line'] = 'ใน <em>%1$s</em> บรรทัด <em>%2$s</em> ';
$txt['debug_query_which_took'] = 'ซึ่งใช้เวลา %1$s วินาที';
$txt['debug_query_which_took_at'] = 'ซึ่งใช้เวลา %1$s วินาทีที่ %2$s ในการขอ';
$txt['debug_show_queries'] = '[แสดงเควรี]';
$txt['debug_hide_queries'] = '[ซ่อนเควรี]';
$txt['debug_tokens'] = 'โทเค็น: ';
$txt['debug_browser'] = 'ID เบราว์เซอร์: ';
$txt['debug_hooks'] = 'ตะขอถูกเรียก: ';
$txt['debug_instances'] = 'อินสแตนซ์ที่สร้าง: ';
$txt['are_sure_mark_read'] = 'คุณแน่ใจหรือไม่ว่าต้องการทำเครื่องหมายข้อความว่าอ่านแล้ว';

// Inline attachments messages.
$txt['attachments_not_enable'] = 'ไฟล์แนบถูกปิดการใช้งาน';
$txt['attachments_no_data_loaded'] = 'ไม่ใช่ ID ไฟล์แนบที่ถูกต้อง';
$txt['attachments_not_allowed_to_see'] = 'You cannot view this attachment.';
$txt['attachments_no_msg_associated'] = 'ไม่มีข้อความที่เกี่ยวข้องกับไฟล์แนบนี้';
$txt['attachments_unapproved'] = 'ไฟล์แนบกำลังรอการอนุมัติ';

// Accessibility
$txt['hide_category'] = 'ซ่อนหมวดหมู่';
$txt['show_category'] = 'แสดงหมวดหมู่';
$txt['hide_infocenter'] = 'ซ่อนศูนย์ข้อมูล';
$txt['show_infocenter'] = 'แสดงศูนย์ข้อมูล';

// Notification post control
$txt['notify_topic_0'] = 'ไม่ติดตาม';
$txt['notify_topic_1'] = 'ไม่มีการแจ้งเตือนหรืออีเมล';
$txt['notify_topic_2'] = 'รับการแจ้งเตือน';
$txt['notify_topic_3'] = 'รับอีเมลและการแจ้งเตือน';
$txt['notify_topic_0_desc'] = 'คุณจะไม่ได้รับอีเมลหรือการแจ้งเตือนสำหรับหัวข้อนี้ และจะไม่ปรากฏในรายการตอบกลับและหัวข้อที่ยังไม่ได้อ่านของคุณ คุณจะยังคงได้รับ @การกล่าวถึง สำหรับหัวข้อนี้';
$txt['notify_topic_1_desc'] = 'คุณจะไม่ได้รับอีเมลหรือการแจ้งเตือนใด ๆ แต่จะได้รับเฉพาะ @การกล่าวถึง โดยสมาชิกรายอื่น';
$txt['notify_topic_2_desc'] = 'คุณจะได้รับการแจ้งเตือนสำหรับหัวข้อนี้';
$txt['notify_topic_3_desc'] = 'คุณจะได้รับทั้งการแจ้งเตือนและอีเมลสำหรับหัวข้อนี้';
$txt['notify_board_1'] = 'ไม่มีการแจ้งเตือนหรืออีเมล';
$txt['notify_board_2'] = 'รับการแจ้งเตือน';
$txt['notify_board_3'] = 'รับอีเมลและการแจ้งเตือน';
$txt['notify_board_1_desc'] = 'คุณจะไม่ได้รับอีเมลหรือการแจ้งเตือนสำหรับหัวข้อใหม่';
$txt['notify_board_2_desc'] = 'คุณจะได้รับการแจ้งเตือนสำหรับบอร์ดนี้';
$txt['notify_board_3_desc'] = 'คุณจะได้รับทั้งการแจ้งเตือนและอีเมลสำหรับบอร์ดนี้';

$txt['notify_board_prompt'] = 'คุณต้องการอีเมลแจ้งเตือนเมื่อมีคนตั้งหัวข้อใหม่ในบอร์ดนี้หรือไม่?';
$txt['notify_board_subscribed'] = '%1$s สมัครรับการแจ้งเตือนหัวข้อใหม่สำหรับบอร์ดนี้';
$txt['notify_board_unsubscribed'] = '%1$s ได้ยกเลิกการรับการแจ้งเตือนหัวข้อใหม่สำหรับบอร์ดนี้แล้ว';

$txt['notify_topic_prompt'] = 'คุณต้องการอีเมลแจ้งเตือนหากมีผู้ตอบหัวข้อนี้หรือไม่?';
$txt['notify_topic_subscribed'] = '%1$s สมัครรับการแจ้งเตือนการตอบกลับใหม่สำหรับหัวข้อนี้';
$txt['notify_topic_unsubscribed'] = '%1$s ได้ยกเลิกการสมัครรับการแจ้งเตือนการตอบกลับใหม่สำหรับหัวข้อนี้แล้ว';

$txt['notify_announcements_prompt'] = 'คุณต้องการรับจดหมายข่าว ประกาศ และการแจ้งเตือนที่สำคัญทางอีเมลหรือไม่?';
$txt['notify_announcements_subscribed'] = '%1$s สมัครรับจดหมายข่าว การประกาศ และการแจ้งเตือนที่สำคัญของฟอรัมแล้ว';
$txt['notify_announcements_unsubscribed'] = '%1$s ได้ยกเลิกการสมัครรับจดหมายข่าว การประกาศ และการแจ้งเตือนที่สำคัญของฟอรัมแล้ว';

$txt['unsubscribe_announcements_plain'] = 'หากต้องการยกเลิกการสมัครรับจดหมายข่าว ประกาศ และการแจ้งเตือนที่สำคัญของฟอรัม ให้ไปที่ลิงก์นี้: %1$s';
$txt['unsubscribe_announcements_html'] = '<span style="font-size:small"><a href="%1$s">ยกเลิกการสมัคร</a>จากจดหมายข่าว การประกาศ และการแจ้งเตือนที่สำคัญของฟอรัม</span>';
$txt['unsubscribe_announcements_manual'] = 'To unsubscribe from forum newsletters, announcements and important notifications, contact us at %1$s with your request.';

// Mobile Actions
$txt['mobile_action'] = 'การกระทำของผู้ใช้';
$txt['mobile_moderation'] = 'การดูแล';
$txt['mobile_user_menu'] = 'Main Menu';
$txt['mobile_generic_menu'] = '%1$s Menu';

// Formats for lists in a sentence (e.g. "Alice, Bob, and Charlie")
// Examples:
// 	$txt['sentence_list_format'][2] specifies a format for a list with two items
// 	$txt['sentence_list_format']['n'] specifies the default format
// Notes on placeholders:
// 	{1} = first item in the list, {2} = second item, etc.
// 	{-1} = last item in the list, {-2} = second last item, etc.
// 	{series} = concatenated string of the rest of the items in the list
$txt['sentence_list_format'][1] = '{1}';
$txt['sentence_list_format'][2] = '{1} และ {-1}';
$txt['sentence_list_format'][3] = '{series} และ {-1}';
$txt['sentence_list_format'][4] = '{series} และ {-1}';
$txt['sentence_list_format'][5] = '{series} และ {-1}';
$txt['sentence_list_format']['n'] = '{series} และ {-1}';
// Separators used to build lists in a sentence
$txt['sentence_list_separator'] = ' ';
$txt['sentence_list_separator_alt'] = '; ';

?>