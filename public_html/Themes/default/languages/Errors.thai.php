<?php
// Version: 2.1.5; Errors

global $scripturl, $modSettings;

$txt['no_access'] = 'คุณไม่ได้รับอนุญาตให้เข้าถึงส่วนนี้';
$txt['not_found'] = 'ขออภัย ส่วนนี้ไม่พร้อมใช้งานในขณะนี้';

$txt['mods_only'] = 'เฉพาะผู้ดูแลเท่านั้นที่สามารถใช้ฟังก์ชันลบโดยตรง โปรดลบข้อความนี้ผ่านคุณลักษณะแก้ไข';
$txt['no_name'] = 'คุณไม่ได้กรอกชื่อช่อง มันเป็นสิ่งจำเป็น';
$txt['no_email'] = 'คุณไม่ได้กรอกข้อมูลในฟิลด์อีเมล มันเป็นสิ่งจำเป็น';
$txt['topic_locked'] = 'หัวข้อนี้ถูกล็อค คุณไม่ได้รับอนุญาตให้โพสต์หรือแก้ไขข้อความ';
$txt['no_password'] = 'ช่องรหัสผ่านว่างเปล่า';
$txt['already_a_user'] = 'ชื่อผู้ใช้ที่คุณพยายามใช้มีอยู่แล้ว';
$txt['cant_move'] = 'คุณไม่ได้รับอนุญาตให้ย้ายหัวข้อ';
$txt['passwords_dont_match'] = 'รหัสผ่านไม่เหมือนกัน';
$txt['register_to_use'] = 'ขออภัย คุณต้องลงทะเบียนก่อนใช้คุณสมบัตินี้';
$txt['password_invalid_character'] = 'อักขระที่ใช้ในรหัสผ่านไม่ถูกต้อง';
$txt['name_invalid_character'] = 'อักขระที่ใช้ในชื่อไม่ถูกต้อง';
$txt['email_invalid_character'] = 'อักขระที่ใช้ในอีเมลไม่ถูกต้อง';
$txt['username_reserved'] = 'ชื่อผู้ใช้ที่คุณพยายามใช้มีชื่อที่สงวนไว้ \'%1$s\' โปรดลองใช้ชื่อผู้ใช้อื่น';
$txt['numbers_one_to_nine'] = 'ช่องนี้รับเฉพาะตัวเลขตั้งแต่ 0-9';
$txt['not_a_user'] = 'ไม่มีผู้ใช้ที่มีโปรไฟล์ที่คุณกำลังพยายามดูอยู่';
$txt['not_a_topic'] = 'ไม่มีหัวข้อนี้ในบอร์ดนี้';
$txt['email_in_use'] = 'ที่อยู่อีเมลนั้น (%1$s) ถูกใช้โดยสมาชิกที่ลงทะเบียนแล้ว หากคุณรู้สึกว่านี่เป็นข้อผิดพลาด ให้ไปที่หน้าเข้าสู่ระบบและใช้การเตือนรหัสผ่านกับที่อยู่นั้น';
$txt['attachments_no_write'] = 'ไดเร็กทอรีไฟล์แนบไม่สามารถเขียนได้';
$txt['avatars_no_write'] = 'ไดเร็กทอรีรูปประจำตัวไม่สามารถเขียนได้';
$txt['attachment_not_created'] = 'ไม่สามารถสร้างไฟล์แนบได้';
$txt['export_dir_not_writable'] = 'ไดเรกทอรีส่งออกไม่สามารถเขียนได้';
$txt['export_dir_forced_change'] = '%1$s ไม่สามารถเขียนได้ กำลังลองอีกครั้งที่ %2$s';
$txt['export_low_diskspace'] = 'พื้นที่ดิสก์ไม่เพียงพอสำหรับการส่งออกโปรไฟล์สมาชิกต่อไป พื้นที่ดิสก์ขั้นต่ำปัจจุบันถูกตั้งค่าเป็น %1$d%% กระบวนการส่งออกจะพยายามดำเนินการต่อโดยอัตโนมัติในวันพรุ่งนี้';

$txt['didnt_select_vote'] = 'คุณไม่ได้เลือกตัวเลือกการโหวต';
$txt['poll_error'] = 'โพลนั้นไม่มีอยู่ โพลถูกล็อค หรือคุณพยายามโหวตสองครั้ง';
$txt['members_only'] = 'ตัวเลือกนี้มีให้สำหรับสมาชิกที่ลงทะเบียนเท่านั้น';
$txt['locked_by_admin'] = 'สิ่งนี้ถูกล็อคโดยผู้ดูแลระบบ คุณไม่สามารถปลดล็อกได้';
$txt['feature_disabled'] = 'ขออภัย คุณลักษณะนี้ถูกปิดใช้งาน';
$txt['feature_no_exists'] = 'ขออภัย คุณลักษณะนี้ไม่มีอยู่';
$txt['couldnt_connect'] = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์หรือไม่พบไฟล์';
$txt['no_board'] = 'ไม่มีบอร์ดที่คุณระบุ';
$txt['no_message'] = 'ไม่มีข้อความอีกต่อไป';
$txt['cant_split'] = 'คุณไม่ได้รับอนุญาตให้แยกหัวข้อ';
$txt['cant_merge'] = 'คุณไม่ได้รับอนุญาตให้รวมหัวข้อ';
$txt['no_topic_id'] = 'คุณระบุ ID หัวข้อที่ไม่ถูกต้อง';
$txt['split_first_post'] = 'ไม่สามารถแยกกระทู้แรกของหัวข้อ';
$txt['topic_one_post'] = 'หัวข้อนี้มีข้อความเดียวเท่านั้นและไม่สามารถแยกได้';
$txt['no_posts_selected'] = 'ไม่ได้เลือกข้อความ';
$txt['selected_all_posts'] = 'ไม่สามารถแยกออกได้ คุณได้เลือกทุกข้อความ';
$txt['cant_find_messages'] = 'ไม่พบข้อความ';
$txt['cant_find_user_email'] = 'ไม่พบที่อยู่อีเมลของผู้ใช้';
$txt['cant_insert_topic'] = 'แทรกหัวข้อไม่ได้';
$txt['already_a_mod'] = 'คุณได้เลือกชื่อผู้ใช้ของผู้ดูแลที่มีอยู่แล้ว โปรดเลือกชื่อผู้ใช้อื่น';
$txt['session_timeout'] = 'วาระของคุณหมดเวลาขณะโพสต์ โปรดกลับไปและลองอีกครั้ง';
$txt['session_verify_fail'] = 'การตรวจสอบวาระล้มเหลว โปรดลองออกจากระบบและกลับเข้ามาใหม่อีกครั้ง แล้วลองอีกครั้ง';
$txt['verify_url_fail'] = 'ไม่สามารถตรวจสอบ URL ที่อ้างอิงได้ โปรดกลับไปและลองอีกครั้ง';
$txt['token_verify_fail'] = 'การตรวจสอบโทเค็นล้มเหลว โปรดกลับไปและลองอีกครั้ง';
$txt['guest_vote_disabled'] = 'ผู้มาเยือนไม่สามารถลงคะแนนในแบบสำรวจนี้ได้';

$txt['cannot_like_content'] = 'คุณไม่สามารถชอบเนื้อหานั้นได้';
$txt['cannot_view_likes'] = 'คุณไม่สามารถดูได้ว่าใครชอบเนื้อหานั้น';
$txt['cannot_access_mod_center'] = 'คุณไม่ได้รับอนุญาตให้เข้าถึงศูนย์ผู้ดูแล';
$txt['cannot_admin_forum'] = 'คุณไม่ได้รับอนุญาตให้ดูแลระบบฟอรัมนี้';
$txt['cannot_announce_topic'] = 'คุณไม่ได้รับอนุญาตให้ประกาศหัวข้อบนกระดานนี้';
$txt['cannot_approve_posts'] = 'คุณไม่ได้รับอนุญาตให้อนุมัติรายการ';
$txt['cannot_post_unapproved_attachments'] = 'คุณไม่ได้รับอนุญาตให้โพสต์ไฟล์แนบที่ไม่ได้รับอนุมัติ';
$txt['cannot_post_unapproved_topics'] = 'คุณไม่ได้รับอนุญาตให้โพสต์หัวข้อที่ไม่ได้รับการอนุมัติ';
$txt['cannot_post_unapproved_replies_own'] = 'คุณไม่ได้รับอนุญาตให้โพสต์การตอบกลับที่ไม่ได้รับการอนุมัติในหัวข้อของคุณ';
$txt['cannot_post_unapproved_replies_any'] = 'คุณไม่ได้รับอนุญาตให้โพสต์การตอบกลับที่ไม่ได้รับการอนุมัติในหัวข้อของผู้ใช้รายอื่น';
$txt['cannot_calendar_edit_any'] = 'คุณไม่สามารถแก้ไขกิจกรรมในปฏิทิน';
$txt['cannot_calendar_edit_own'] = 'คุณไม่มีสิทธิ์ที่จำเป็นในการแก้ไขกิจกรรมของคุณเอง';
$txt['cannot_calendar_post'] = 'ไม่อนุญาตให้โพสต์กิจกรรม - ขออภัย';
$txt['cannot_calendar_view'] = 'ขออภัย คุณไม่ได้รับอนุญาตให้ดูปฏิทิน';
$txt['cannot_remove_any'] = 'ขออภัย คุณไม่มีสิทธิ์ลบหัวข้อนี้ ตรวจสอบเพื่อให้แน่ใจว่าหัวข้อนี้ไม่ได้เพียงแค่ย้ายไปยังบอร์ดอื่น';
$txt['cannot_remove_own'] = 'คุณไม่สามารถลบหัวข้อของคุณเองในบอร์ดนี้ได้ ตรวจสอบเพื่อให้แน่ใจว่าหัวข้อนี้ไม่ได้เพียงแค่ย้ายไปยังบอร์ดอื่น';
$txt['cannot_edit_news'] = 'คุณไม่ได้รับอนุญาตให้แก้ไขรายการข่าวในฟอรัมนี้';
$txt['cannot_pm_read'] = 'ขออภัย คุณไม่สามารถอ่านข้อความส่วนตัวของคุณได้';
$txt['cannot_pm_send'] = 'คุณไม่ได้รับอนุญาตให้ส่งข้อความส่วนตัว';
$txt['cannot_lock_any'] = 'คุณไม่ได้รับอนุญาตให้ล็อกหัวข้อนี้';
$txt['cannot_lock_own'] = 'ขออภัย แต่คุณไม่สามารถล็อคหัวข้อของคุณเองที่นี่';
$txt['cannot_make_sticky'] = 'คุณไม่ได้รับอนุญาตให้ปักหมุดหัวข้อนี้';
$txt['cannot_manage_attachments'] = 'คุณไม่ได้รับอนุญาตให้จัดการไฟล์แนบหรือรูปประจำตัว';
$txt['cannot_manage_bans'] = 'คุณไม่ได้รับอนุญาตให้เปลี่ยนรายการแบน';
$txt['cannot_manage_boards'] = 'คุณไม่ได้รับอนุญาตให้จัดการบอร์ดและหมวดหมู่';
$txt['cannot_manage_membergroups'] = 'คุณไม่มีสิทธิ์แก้ไขหรือกำหนดกลุ่มสมาชิก';
$txt['cannot_manage_permissions'] = 'คุณไม่มีสิทธิ์จัดการสิทธิ์';
$txt['cannot_manage_smileys'] = 'คุณไม่ได้รับอนุญาตให้จัดการรูปแสดงอารมณ์และข้อความ';
$txt['cannot_merge_any'] = 'คุณไม่ได้รับอนุญาตให้รวมหัวข้อในหนึ่งในบอร์ดที่เลือก';
$txt['cannot_merge_redirect'] = 'หัวข้อที่คุณเลือกอย่างน้อยหนึ่งหัวข้อเป็นหัวข้อเปลี่ยนเส้นทางและไม่สามารถรวมได้';
$txt['cannot_moderate_forum'] = 'คุณไม่ได้รับอนุญาตให้ดูแลฟอรัมนี้';
$txt['cannot_moderate_board'] = 'คุณไม่ได้รับอนุญาตให้ดูแลบอร์ดนี้';
$txt['cannot_modify_any'] = 'คุณไม่ได้รับอนุญาตให้แก้ไขกระทู้';
$txt['cannot_modify_own'] = 'ขออภัย คุณไม่ได้รับอนุญาตให้แก้ไขข้อความของคุณเอง';
$txt['cannot_modify_replies'] = 'แม้ว่ากระทู้นี้จะเป็นการตอบกลับหัวข้อของคุณ คุณไม่สามารถแก้ไขได้';
$txt['cannot_move_own'] = 'คุณไม่ได้รับอนุญาตให้ย้ายหัวข้อของคุณเองในบอร์ดนี้';
$txt['cannot_move_any'] = 'คุณไม่ได้รับอนุญาตให้ย้ายหัวข้อในบอร์ดนี้';
$txt['cannot_poll_add_own'] = 'ขออภัย คุณไม่ได้รับอนุญาตให้เพิ่มโพลในหัวข้อของคุณเองในบอร์ดนี้';
$txt['cannot_poll_add_any'] = 'คุณไม่มีสิทธิ์เพิ่มโพลในหัวข้อนี้';
$txt['cannot_poll_edit_own'] = 'คุณไม่สามารถแก้ไขโพลนี้ได้ แม้ว่าจะเป็นของคุณเองก็ตาม';
$txt['cannot_poll_edit_any'] = 'คุณถูกปฏิเสธไม่ให้แก้ไขโพลในบอร์ดนี้';
$txt['cannot_poll_lock_own'] = 'คุณไม่ได้รับอนุญาตให้ล็อกโพลของคุณเองในบอร์ดนี้';
$txt['cannot_poll_lock_any'] = 'ขออภัย คุณไม่ได้รับอนุญาตให้ล็อกโพล';
$txt['cannot_poll_post'] = 'คุณไม่ได้รับอนุญาตให้โพสต์โพลในบอร์ดปัจจุบัน';
$txt['cannot_poll_remove_own'] = 'คุณไม่ได้รับอนุญาตให้ลบโพลล์จากหัวข้อของคุณ';
$txt['cannot_poll_remove_any'] = 'คุณไม่สามารถลบโพลบนบอร์ดนี้ได้';
$txt['cannot_poll_view'] = 'คุณไม่ได้รับอนุญาตให้ดูโพลในบอร์ดนี้';
$txt['cannot_poll_vote'] = 'ขออภัย คุณไม่สามารถโหวดในโพลในบอร์ดนี้ได้';
$txt['cannot_post_attachment'] = 'คุณไม่ได้รับอนุญาตให้โพสต์สิ่งที่แนบมาที่นี่';
$txt['cannot_post_new'] = 'ขออภัย คุณไม่สามารถโพสต์หัวข้อใหม่ในบอร์ดนี้ได้';
$txt['cannot_post_reply_any'] = 'คุณไม่ได้รับอนุญาตให้โพสต์การตอบกลับหัวข้อบนบอร์ดนี้';
$txt['cannot_post_reply_own'] = 'คุณไม่ได้รับอนุญาตให้โพสต์คำตอบ แม้แต่ในหัวข้อของคุณเอง ในบอร์ดนี้';
$txt['cannot_post_redirect'] = 'คุณไม่สามารถโพสต์ในบอร์ดปลี่ยนเส้นทาง';
$txt['cannot_profile_remove_own'] = 'ขออภัย คุณไม่ได้รับอนุญาตให้ลบบัญชีของคุณเอง';
$txt['cannot_profile_remove_any'] = 'คุณไม่มีสิทธิ์ที่เหมาะสมในการลบบัญชี';
$txt['cannot_profile_extra_any'] = 'คุณไม่ได้รับอนุญาตให้แก้ไขการตั้งค่าโปรไฟล์';
$txt['cannot_profile_identity_any'] = 'คุณไม่ได้รับอนุญาตให้แก้ไขการตั้งค่าบัญชี';
$txt['cannot_profile_title_any'] = 'คุณไม่สามารถแก้ไขชื่อที่กำหนดเองได้';
$txt['cannot_profile_extra_own'] = 'ขออภัย คุณไม่มีสิทธิ์ที่จำเป็นในการแก้ไขข้อมูลโปรไฟล์ของคุณ';
$txt['cannot_profile_identity_own'] = 'คุณไม่สามารถเปลี่ยนตัวตนของคุณได้ในขณะนี้';
$txt['cannot_profile_title_own'] = 'คุณไม่ได้รับอนุญาตให้เปลี่ยนชื่อที่คุณกำหนดเอง';
$txt['cannot_profile_server_avatar'] = 'คุณไม่ได้รับอนุญาตให้ใช้เซิร์ฟเวอร์ที่จัดเก็บรูปประจำตัว';
$txt['cannot_profile_upload_avatar'] = 'คุณไม่ได้รับอนุญาตให้อัปโหลดรูปประจำตัว';
$txt['cannot_profile_remote_avatar'] = 'คุณไม่มีสิทธิ์ใช้รูปประจำตัวระยะไกล';
$txt['cannot_profile_view'] = 'ขออภัย แต่คุณไม่สามารถดูโปรไฟล์ได้';
$txt['cannot_delete_own'] = 'คุณไม่ได้รับอนุญาตให้ลบกระทู้ของคุณเองบนบอร์ดนี้';
$txt['cannot_delete_replies'] = 'ขออภัย คุณไม่สามารถลบกระทู้เหล่านี้ แม้ว่าจะเป็นการตอบกลับหัวข้อของคุณก็ตาม';
$txt['cannot_delete_any'] = 'ไม่อนุญาตให้ลบกระทู้ในบอร์ดนี้';
$txt['cannot_report_any'] = 'คุณไม่ได้รับอนุญาตให้รายงานโพสต์ในบอร์ดนี้';
$txt['cannot_search_posts'] = 'คุณไม่ได้รับอนุญาตให้ค้นหากระทู้ในฟอรัมนี้';
$txt['cannot_send_mail'] = 'คุณไม่มีสิทธิ์ส่งอีเมลถึงทุกคน';
$txt['cannot_issue_warning'] = 'ขออภัย คุณไม่ได้รับอนุญาตให้ออกคำเตือนแก่สมาชิก';
$txt['cannot_send_email_to_members'] = 'ขออภัย ผู้ดูแลระบบไม่อนุญาตให้ส่งอีเมลในบอร์ดนี้';
$txt['cannot_split_any'] = 'ไม่อนุญาตให้แยกหัวข้อในบอร์ดนี้';
$txt['cannot_view_attachments'] = 'ดูเหมือนว่าคุณไม่ได้รับอนุญาตให้ดาวน์โหลดหรือดูไฟล์แนบในบอร์ดนี้';
$txt['cannot_view_mlist'] = 'คุณไม่สามารถดูรายชื่อสมาชิกได้เนื่องจากคุณไม่ได้รับอนุญาตให้ทำเช่นนั้น';
$txt['cannot_view_stats'] = 'คุณไม่ได้รับอนุญาตให้ดูสถิติของฟอรัม';
$txt['cannot_who_view'] = 'ขออภัย คุณไม่มีสิทธิ์ที่เหมาะสมในการดูรายชื่อผู้ที่ออนไลน์';

$txt['no_theme'] = 'ธีมนั้นไม่มีอยู่';
$txt['theme_dir_wrong'] = 'ไดเร็กทอรีของธีมเริ่มต้นไม่ถูกต้อง โปรดแก้ไขโดยคลิกที่ข้อความนี้';
$txt['registration_disabled'] = 'ขออภัย การลงทะเบียนถูกปิดการใช้งานในขณะนี้';
$txt['registration_no_secret_question'] = 'ขออภัย ไม่มีการกำหนดคำถามลับสำหรับสมาชิกรายนี้';
$txt['poll_range_error'] = 'ขออภัย โพลต้องดำเนินการนานกว่า 0 วัน';
$txt['delFirstPost'] = 'คุณไม่ได้รับอนุญาตให้ลบกระทู้แรกในหัวข้อ<p>หากคุณต้องการลบหัวข้อนี้ ให้คลิกที่ลิงก์ลบหัวข้อ หรือขอให้ผู้ดูแล/ผู้ดูแลระบบดำเนินการให้คุณ</p>';
$txt['parent_error'] = 'สร้างบอร์ดไม่ได้!';
$txt['login_cookie_error'] = 'คุณไม่สามารถเข้าสู่ระบบได้ โปรดตรวจสอบการตั้งค่าคุกกี้ของคุณ';
$txt['login_ssl_required'] = 'คุณสามารถเข้าสู่ระบบผ่าน HTTPS เท่านั้น';
$txt['register_ssl_required'] = 'คุณสามารถลงทะเบียนผ่าน HTTPS เท่านั้น';
$txt['incorrect_answer'] = 'ขออภัย คุณไม่ได้ตอบคำถามของคุณอย่างถูกต้อง โปรดคลิกย้อนกลับเพื่อลองอีกครั้ง หรือคลิกกลับสองครั้งเพื่อใช้วิธีการเริ่มต้นในการรับรหัสผ่านของคุณ';
$txt['no_mods'] = 'ไม่พบผู้ดูแล!';
$txt['parent_not_found'] = 'โครงสร้างบอร์ดเสียหาย: หาบอร์ดแม่ไม่เจอ';
$txt['modify_post_time_passed'] = 'คุณไม่สามารถแก้ไขกระทู้นี้ได้ เนื่องจากหมดเวลาสำหรับการแก้ไขแล้ว';

$txt['calendar_off'] = 'คุณไม่สามารถเข้าถึงปฏิทินได้ในขณะนี้เนื่องจากถูกปิดใช้งาน';
$txt['calendar_export_off'] = 'คุณไม่สามารถส่งออกกิจกรรมในปฏิทินได้เนื่องจากฟีเจอร์นั้นถูกปิดใช้งานอยู่ในขณะนี้';
$txt['invalid_month'] = 'ค่าเดือนไม่ถูกต้อง';
$txt['invalid_year'] = 'ค่าปีไม่ถูกต้อง';
$txt['invalid_day'] = 'ค่าวันไม่ถูกต้อง';
$txt['event_month_missing'] = 'ไม่มีเดือนของกิจกรรม';
$txt['event_year_missing'] = 'ไม่มีปีของกิจกรรม';
$txt['event_day_missing'] = 'ไม่มีวันของกิจกรรม';
$txt['event_title_missing'] = 'ไม่มีชื่อกิจกรรม';
$txt['invalid_date'] = 'วันที่ไม่ถูกต้อง';
$txt['no_event_title'] = 'ไม่มีการป้อนชื่อกิจกรรม';
$txt['missing_event_id'] = 'ไม่มี ID กิจกรรม';
$txt['cant_edit_event'] = 'คุณไม่ได้รับอนุญาตให้แก้ไขกิจกรรมนี้';
$txt['missing_board_id'] = 'ไม่มี ID บอร์ด';
$txt['missing_topic_id'] = 'ไม่มี ID หัวข้อ';
$txt['topic_doesnt_exist'] = 'ไม่มีหัวข้อ';
$txt['not_your_topic'] = 'คุณไม่ใช่เจ้าของหัวข้อนี้';
$txt['board_doesnt_exist'] = 'ไม่มีบอร์ดนี้';
$txt['invalid_days_numb'] = 'จำนวนวันที่จะขยายไม่ถูกต้อง';

$txt['moveto_noboards'] = 'ไม่มีบอร์ดที่จะย้ายหัวข้อนี้ไป!';
$txt['topic_already_moved'] = 'หัวข้อนี้ %1$s ถูกย้ายไปที่บอร์ด %2$s โปรดตรวจสอบตำแหน่งใหม่ก่อนที่จะย้ายอีกครั้ง';

$txt['already_activated'] = 'บัญชีของคุณถูกเปิดใช้งานแล้ว';
$txt['still_awaiting_approval'] = 'บัญชีของคุณยังรอการอนุมัติจากผู้ดูแลระบบ';

$txt['invalid_email'] = 'ที่อยู่อีเมล / ช่วงที่อยู่อีเมลไม่ถูกต้อง<br>ตัวอย่างที่อยู่อีเมลที่ถูกต้อง: prayut@gov.th.<br>ตัวอย่างของช่วงที่อยู่อีเมลที่ถูกต้อง: *@*.gov.th';
$txt['invalid_expiration_date'] = 'วันหมดอายุไม่ถูกต้อง';
$txt['invalid_hostname'] = 'ชื่อโฮสต์ / ช่วงชื่อโฮสต์ไม่ถูกต้อง<br>ตัวอย่างชื่อโฮสต์ที่ถูกต้อง: rimsa.gov.th<br>ตัวอย่างของช่วงชื่อโฮสต์ที่ถูกต้อง: *.gov.th';
$txt['invalid_ip'] = 'ช่วง IP / IP ไม่ถูกต้อง<br>ตัวอย่างที่อยู่ IP ที่ถูกต้อง: 127.0.0.1<br>ตัวอย่างของช่วง IP ที่ถูกต้อง: 127.0.0-20*';
$txt['invalid_tracking_ip'] = 'ช่วง IP / IP ไม่ถูกต้อง<br>ตัวอย่างที่อยู่ IP ที่ถูกต้อง: 127.0.0.1<br>ตัวอย่างของช่วง IP ที่ถูกต้อง: 127.0.0.*';
$txt['invalid_username'] = 'ไม่พบชื่อสมาชิก';
$txt['no_user_selected'] = 'ไม่พบสมาชิก';
$txt['no_ban_admin'] = 'คุณไม่สามารถแบนผู้ดูแลระบบ - คุณต้องลดระดับพวกเขาก่อน!';
$txt['no_bantype_selected'] = 'ไม่ได้เลือกประเภทการแบน';
$txt['ban_not_found'] = 'ไม่พบการแบน';
$txt['ban_unknown_restriction_type'] = 'ไม่ทราบประเภทข้อจำกัด';
$txt['ban_name_empty'] = 'ชื่อของแบนถูกเว้นว่างไว้';
$txt['ban_name_is_too_long'] = 'The selected name is too long. Use no more than 20 characters.';
$txt['ban_id_empty'] = 'ไม่พบIDแบน';
$txt['ban_no_triggers'] = 'ไม่ได้ระบุตัวกระตุ้นการแบน';
$txt['ban_ban_item_empty'] = 'ไม่พบตัวกระตุ้นการแบน';
$txt['impossible_insert_new_bangroup'] = 'เกิดข้อผิดพลาดขณะแทรกการแบนใหม่';

$txt['ban_name_exists'] = 'ชื่อของการแบนนี้มีอยู่แล้ว โปรดเลือกชื่ออื่น';
$txt['ban_trigger_already_exists'] = 'ตัวกระตุ้นการแบนนี้ (%1$s) มีอยู่แล้วใน %2$s';

$txt['recycle_no_valid_board'] = 'ไม่ได้เลือกบอร์ดที่ถูกต้องสำหรับหัวข้อรีไซเคิล';
$txt['post_already_deleted'] = 'หัวข้อหรือข้อความถูกย้ายไปที่บอร์ดรีไซเคิลแล้ว คุณแน่ใจหรือไม่ว่าต้องการลบออกทั้งหมด <br>หากเป็นเช่นนั้น ให้ไปที่<a href="%1$s">ลิงก์นี้</a>';

$txt['login_threshold_fail'] = 'ขออภัย คุณหมดโอกาสในการเข้าสู่ระบบแล้ว โปรดกลับมาลองอีกครั้งในภายหลัง';
$txt['login_threshold_brute_fail'] = 'ขออภัย คุณพยายามเข้าสู่ระบบถึงเกณฑ์สำหรับบัญชี %1$s แล้ว โปรดรอ 30 วินาทีแล้วลองอีกครั้งในภายหลัง';

$txt['who_off'] = 'คุณไม่สามารถเข้าถึงผู้ที่ออนไลน์ได้ในขณะนี้เนื่องจากถูกปิดใช้งาน';

$txt['merge_create_topic_failed'] = 'เกิดข้อผิดพลาดในการสร้างหัวข้อใหม่';
$txt['merge_need_more_topics'] = 'การรวมหัวข้อต้องมีอย่างน้อยสองหัวข้อในการรวม';

$txt['post_WaitTime_broken'] = 'การตั้งกระทู้ล่าสุดจาก IP ของคุณน้อยกว่า %1$d วินาทีที่แล้ว โปรดลองอีกครั้งในภายหลัง.';
$txt['register_WaitTime_broken'] = 'คุณลงทะเบียนไปแล้วเมื่อ %1$d วินาทีที่แล้ว!';
$txt['login_WaitTime_broken'] = 'คุณจะต้องรอประมาณ %1$d วินาทีเพื่อเข้าสู่ระบบอีกครั้ง ขออภัย';
$txt['pm_WaitTime_broken'] = 'ข้อความส่วนตัวล่าสุดจาก IP ของคุณน้อยกว่า %1$d วินาทีที่แล้ว โปรดลองอีกครั้งในภายหลัง';
$txt['reporttm_WaitTime_broken'] = 'รายงานหัวข้อล่าสุดจาก IP ของคุณน้อยกว่า %1$d วินาทีที่แล้ว โปรดลองอีกครั้งในภายหลัง';
$txt['sendmail_WaitTime_broken'] = 'อีเมลล่าสุดที่ส่งจาก IP ของคุณน้อยกว่า %1$d วินาทีที่แล้ว โปรดลองอีกครั้งในภายหลัง';
$txt['search_WaitTime_broken'] = 'การค้นหาล่าสุดของคุณน้อยกว่า %1$d วินาทีที่แล้ว โปรดลองอีกครั้งในภายหลัง';
$txt['remind_WaitTime_broken'] = 'การช่วยเตือนครั้งล่าสุดของคุณน้อยกว่า %1$d วินาทีที่แล้ว โปรดลองอีกครั้งในภายหลัง';

$txt['email_missing_data'] = 'คุณต้องป้อนบางอย่างทั้งในหัวเรื่องและกล่องข้อความ';

$txt['topic_gone'] = 'หัวข้อหรือบอร์ดที่คุณกำลังมองหาดูเหมือนจะหายไปหรือคุณไม่ได้รับอนุญาต';
$txt['theme_edit_missing'] = 'ไม่พบไฟล์ที่คุณพยายามแก้ไข';

$txt['pm_not_yours'] = 'ข้อความส่วนตัวที่คุณพยายามจะอ้างอิงไม่ใช่ข้อความของคุณเองหรือไม่มีอยู่จริง โปรดกลับไปและลองอีกครั้ง';
$txt['mangled_post'] = 'ข้อมูลในแบบฟอร์มที่บิดเบี้ยว - โปรดย้อนกลับและลองอีกครั้ง';
$txt['too_many_groups'] = 'ขออภัย คุณเลือกกลุ่มมากเกินไป โปรดลบบางกลุ่มออกจากการเลือกของคุณ';
$txt['post_upload_error'] = 'ข้อมูลโพสต์หายไป ข้อผิดพลาดนี้อาจเกิดจากการพยายามส่งไฟล์ที่ใหญ่กว่าที่เซิร์ฟเวอร์อนุญาต โปรดติดต่อผู้ดูแลระบบของคุณหากปัญหานี้ยังคงมีอยู่';
$txt['quoted_post_deleted'] = 'โพสต์ที่คุณพยายามอ้างไม่มีอยู่ ถูกลบ หรือคุณไม่สามารถดูได้อีก';
$txt['pm_too_many_per_hour'] = 'คุณมีข้อความส่วนตัวเกินขีดจำกัด %1$d ข้อความต่อชั่วโมง';

$txt['register_only_once'] = 'ขออภัย คุณไม่ได้รับอนุญาตให้ลงทะเบียนหลายบัญชีพร้อมกันจากคอมพิวเตอร์เครื่องเดียวกัน';
$txt['admin_setting_coppa_require_contact'] = 'คุณต้องป้อนที่อยู่ติดต่อทางไปรษณีย์หรือโทรสารหากต้องการการอนุมัติจากพ่อแม่/ผู้ปกครอง';

$txt['error_long_name'] = 'ชื่อที่คุณพยายามใช้ยาวเกินไป';
$txt['error_no_name'] = 'ไม่ได้ระบุชื่อ';
$txt['error_bad_name'] = 'ชื่อที่คุณส่งมาไม่สามารถใช้ได้ เนื่องจากเป็นหรือมีชื่อที่สงวนไว้';
$txt['error_no_email'] = 'ไม่ได้ระบุที่อยู่อีเมล';
$txt['error_bad_email'] = 'ได้รับที่อยู่อีเมลที่ไม่ถูกต้อง';
$txt['error_no_event'] = 'ไม่ได้ระบุชื่อกิจกรรม';
$txt['error_no_subject'] = 'ไม่มีการกรอกหัวข้อ';
$txt['error_no_question'] = 'ไม่มีการกรอกคำถามสำหรับโพลนี้';
$txt['error_no_message'] = 'เนื้อหาของข้อความว่างเปล่า';
$txt['error_long_message'] = 'ข้อความยาวเกินความยาวสูงสุดที่อนุญาต (%1$d อักขระ)';
$txt['error_no_comment'] = 'ช่องแสดงความคิดเห็นเว้นว่างไว้';
// duplicate of post_too_long in Post.{language}.php
$txt['error_post_too_long'] = 'ข้อความของคุณยาวเกินไป โปรดย้อนกลับและย่อให้สั้นลง แล้วลองอีกครั้ง';
$txt['error_session_timeout'] = 'วาระของคุณหมดเวลาขณะโพสต์ โปรดลองส่งข้อความของคุณอีกครั้ง';
$txt['error_no_to'] = 'ไม่ได้ระบุผู้รับ';
$txt['error_bad_to'] = 'ไม่พบผู้รับ \'ถึง\' อย่างน้อยหนึ่งราย';
$txt['error_bad_bcc'] = 'ไม่พบผู้รับ \'bcc\' อย่างน้อยหนึ่งราย';
$txt['error_form_already_submitted'] = 'คุณได้ส่งโพสต์นี้แล้ว! คุณอาจเผลอคลิกสองครั้งหรือพยายามรีเฟรชหน้า';
$txt['error_poll_few'] = 'คุณต้องมีอย่างน้อยสองทางเลือก!';
$txt['error_poll_many'] = 'คุณต้องมีตัวเลือกไม่เกิน 256 ตัวเลือก';
$txt['error_need_qr_verification'] = 'โปรดกรอกส่วนการยืนยันด้านล่างให้เสร็จสมบูรณ์เพื่อกระทู้ของคุณ';
$txt['error_wrong_verification_code'] = 'ตัวอักษรที่คุณพิมพ์ไม่ตรงกับตัวอักษรที่แสดงในภาพ';
$txt['error_wrong_verification_recaptcha'] = 'การยืนยันล้มเหลว ค่า captcha ไม่ถูกต้อง';
$txt['error_wrong_verification_answer'] = 'คุณไม่ได้ตอบคำถามยืนยันอย่างถูกต้อง';
$txt['error_need_verification_code'] = 'โปรดป้อนรหัสยืนยันด้านล่างเพื่อดำเนินการตามผลลัพธ์';
$txt['error_bad_file'] = 'ขออภัย ไม่สามารถเปิดไฟล์ที่ระบุได้: %1$s';
$txt['error_bad_line'] = 'บรรทัดที่คุณระบุไม่ถูกต้อง';
$txt['error_draft_not_saved'] = 'เกิดข้อผิดพลาดขณะบันทึกฉบับร่าง';
$txt['error_topic_locked_already'] = 'หัวข้อนี้ถูกล็อกโดยการดำเนินการอื่นของผู้ดูแล';
$txt['error_topic_unlocked_already'] = 'หัวข้อนี้ถูกปลดล็อกแล้วโดยการดำเนินการอื่นของผู้ดูแล';
$txt['error_topic_sticky_already'] = 'หัวข้อนี้ถูกปักหมุดโดยการดำเนินการอื่นของผู้กลั่นกรอง';
$txt['error_topic_nonsticky_already'] = 'หัวข้อนี้ถูกยกเลิกการปักหมุดโดยการดำเนินการอื่นของผู้ดูแล';

$txt['smiley_not_found'] = 'ไม่พบรูปแสดงอารมณ์';
$txt['smiley_has_no_code'] = 'ไม่มีรหัสสำหรับรูปแสดงอารมณ์นี้';
$txt['smiley_has_no_filename'] = 'ไม่มีชื่อไฟล์สำหรับรูปแสดงอารมณ์นี้';
$txt['smiley_not_unique'] = 'มีรูปแสดงอารมณ์ที่มีรหัสนั้นอยู่แล้ว';
$txt['smiley_set_already_exists'] = 'มีชุดรูปแสดงอารมณ์ที่มี URL นั้นอยู่แล้ว';
$txt['smiley_set_not_found'] = 'ไม่พบชุดรูปแสดงอารมณ์';
$txt['smiley_set_dir_not_found'] = 'ไดเร็กทอรีของชุดรูปแสดงอารมณ์ %1$s ไม่ถูกต้องหรือไม่สามารถเข้าถึงได้';
$txt['smiley_set_path_already_used'] = 'URL ของชุดรูปแสดงอารมณ์ถูกใช้ไปแล้วโดยชุดรูปแสดงอารมณ์อื่น';
$txt['smiley_set_unable_to_import'] = 'ไม่สามารถนำเข้าชุดรูปแสดงอารมณ์ ไดเร็กทอรีไม่ถูกต้องหรือไม่สามารถเข้าถึงได้';

$txt['smileys_upload_error'] = 'ไม่สามารถอัปโหลดไฟล์';
$txt['smileys_upload_error_blank'] = 'ชุดรูปแสดงอารมณ์ทั้งหมดต้องมีรูปภาพ';
$txt['smileys_upload_error_name'] = 'รูปแสดงอารมณ์ทั้งหมดต้องมีชื่อไฟล์เหมือนกัน';
$txt['smileys_upload_error_illegal'] = 'ประเภทรูปภาพที่ไม่ถูกต้อง';

$txt['search_invalid_weights'] = 'น้ำหนักการค้นหาไม่ได้รับการกำหนดค่าอย่างเหมาะสม ควรกำหนดค่าน้ำหนักอย่างน้อยหนึ่งรายการให้ไม่เป็นศูนย์ โปรดรายงานข้อผิดพลาดนี้ไปยังผู้ดูแลระบบ';
$txt['unable_to_create_temporary'] = 'ไม่สามารถสร้างตารางชั่วคราวเพื่อค้นหา กรุณารายงานข้อผิดพลาดนี้ให้กับผู้ดูแลระบบ';

$txt['package_no_file'] = 'ไม่พบไฟล์แพ็คเกจ!';
$txt['packageget_unable'] = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ โปรดลองใช้ <a href="%1$s" target="_blank" rel="noopener">URL นี้</a>แทน';
$txt['not_on_simplemachines'] = 'ขออภัย สามารถดาวน์โหลดแพ็คเกจเช่นนี้จากเซิร์ฟเวอร์ simplemachines.org เท่านั้น';
$txt['package_cant_uninstall'] = 'แพ็คเกจนี้ไม่เคยติดตั้งหรือถอนการติดตั้งไปแล้ว - คุณไม่สามารถถอนการติดตั้งได้ในขณะนี้';
$txt['package_cant_download'] = 'คุณไม่สามารถดาวน์โหลดหรือติดตั้งแพ็คเกจใหม่ได้เนื่องจากไดเร็กทอรี Packages หรือไฟล์ใดไฟล์หนึ่งในนั้นไม่สามารถเขียนได้!';
$txt['package_upload_error_nofile'] = 'คุณไม่ได้เลือกแพ็คเกจที่จะอัปโหลด';
$txt['package_upload_error_failed'] = 'ไม่สามารถอัปโหลดแพ็คเกจ โปรดตรวจสอบการอนุญาตไดเรกทอรี!';
$txt['package_upload_error_exists'] = 'ไฟล์ที่คุณกำลังอัปโหลดมีอยู่แล้วบนเซิร์ฟเวอร์ โปรดลบออกก่อนแล้วลองอีกครั้ง';
$txt['package_upload_error_supports'] = 'ปัจจุบันตัวจัดการแพ็คเกจอนุญาตเฉพาะประเภทไฟล์เหล่านี้: %1$s';
$txt['package_upload_error_broken'] = 'การอัปโหลดแพ็กเกจล้มเหลวเนื่องจากข้อผิดพลาดต่อไปนี้:<br>&quot;%1$s&quot;';
$txt['package_theme_upload_error_broken'] = 'การอัปโหลดธีมล้มเหลวเนื่องจากข้อผิดพลาดต่อไปนี้:<br>&quot;%1$s&quot;';

$txt['package_get_error_not_found'] = 'ไม่พบแพ็คเกจที่คุณพยายามติดตั้ง คุณอาจต้องการอัปโหลดแพ็คเกจไปยังไดเร็กทอรี Packages ของคุณด้วยตนเอง';
$txt['package_get_error_missing_xml'] = 'แพ็กเกจที่คุณพยายามติดตั้งไม่มี package-info.xml ที่ต้องอยู่ในไดเร็กทอรีแพ็กเกจราก';
$txt['package_get_error_is_zero'] = 'แม้ว่าแพ็คเกจจะถูกดาวน์โหลดไปยังเซิร์ฟเวอร์ แต่ดูเหมือนว่าจะว่างเปล่า โปรดตรวจสอบไดเร็กทอรี Packages และ &quot;temp&quot; ไดเร็กทอรีย่อยสามารถเขียนได้ทั้งคู่ หากคุณยังคงประสบปัญหานี้อยู่ คุณควรลองแยกแพ็คเกจบนพีซีของคุณและอัปโหลดไฟล์ที่แยกแล้วไปยังไดเร็กทอรีย่อยในไดเร็กทอรี Packages ของคุณแล้วลองอีกครั้ง ตัวอย่างเช่น หากแพ็คเกจถูกเรียก Shout.tar.gz คุณควร:<br>1) ดาวน์โหลดแพ็คเกจไปยังพีซีในพื้นที่ของคุณและแตกไฟล์เป็นไฟล์<br>2) การใช้ไคลเอนต์ FTP สร้างไดเร็กทอรีใหม่ใน &quot ของคุณ;แพ็คเกจ&quot; โฟลเดอร์ ในตัวอย่างนี้ คุณอาจเรียกมันว่า "shout"<br>3) อัปโหลดไฟล์ทั้งหมดจากแพ็คเกจที่แยกแล้วไปยังไดเร็กทอรีนี้<br>4) กลับไปที่หน้าเรียกดูตัวจัดการแพ็คเกจและจะพบแพ็คเกจโดยอัตโนมัติ โดยเอสเอ็มเอฟ';
$txt['package_get_error_packageinfo_corrupt'] = 'SMF ไม่พบข้อมูลที่ถูกต้องใดๆ ภายในไฟล์ package-info.xml ที่รวมอยู่ในแพ็คเกจ อาจมีข้อผิดพลาดของม็อด หรือแพ็คเกจอาจเสียหาย';
$txt['package_get_error_is_theme'] = 'คุณไม่สามารถติดตั้งธีมจากส่วนนี้ โปรดใช้หน้าการจัดการ<a href="{MANAGETHEMEURL}">ธีมและเลย์เอาต์</a>เพื่ออัปโหลด';
$txt['package_get_error_is_mod'] = 'คุณไม่สามารถติดตั้งม็อดจากส่วนนี้ โปรดใช้หน้า<a href="{MANAGEMODURL}">ตัวจัดการแพ็คเกจ</a>เพื่ออัปโหลด';
$txt['package_get_error_theme_not_compatible'] = 'ธีมของคุณไม่แสดงว่ามีความเข้ากันได้กับ %1$s โปรดติดต่อผู้เขียนธีม';
$txt['package_get_error_theme_no_based_on_found'] = 'ธีมที่คุณพยายามติดตั้งขึ้นอยู่กับธีมอื่น: %1$s คุณต้องติดตั้งธีมนั้นก่อน';
$txt['package_get_error_theme_no_new_version'] = 'ธีมที่คุณพยายามติดตั้งได้รับการติดตั้งแล้วหรือเป็นเวอร์ชันที่ล้าสมัย เวอร์ชันที่ติดตั้งแล้วคือ: %2$s และเวอร์ชันที่คุณพยายามติดตั้งคือ: %1$s';

$txt['no_membergroup_selected'] = 'ไม่ได้เลือกกลุ่มสมาชิก';
$txt['membergroup_does_not_exist'] = 'กลุ่มสมาชิกไม่มีอยู่หรือไม่ถูกต้อง';

$txt['at_least_one_admin'] = 'ต้องมีผู้ดูแลระบบอย่างน้อยหนึ่งคนในฟอรัม!';

$txt['error_functionality_not_windows'] = 'ขออภัย ฟังก์ชันนี้ยังไม่พร้อมใช้งานสำหรับเซิร์ฟเวอร์ที่ใช้ Windows';

// Don't use entities in the below string.
$txt['attachment_not_found'] = 'ไม่พบไฟล์แนบ';

$txt['error_no_boards_selected'] = 'ไม่ได้เลือกบอร์ดที่ถูกต้อง';
$txt['error_no_boards_available'] = 'ขออภัย ขณะนี้ไม่มีบอร์ดสำหรับคุณ';
$txt['error_invalid_search_string'] = 'คุณลืมที่จะค้นหาอะไร?';
$txt['error_invalid_search_string_blacklist'] = 'คำค้นหาของคุณมีคำที่ไม่สุภาพมากเกินไป โปรดลองอีกครั้งโดยใช้ข้อความค้นหาอื่น';
$txt['error_search_string_small_words'] = 'แต่ละคำต้องมีความยาวอย่างน้อยสองอักขระ';
$txt['error_query_not_specific_enough'] = 'คำค้นหาของคุณไม่มีผลลัพธ์ที่ตรงกัน';
$txt['error_no_messages_in_time_frame'] = 'ไม่พบโพสต์ในกรอบเวลาที่เลือก';
$txt['error_no_labels_selected'] = 'ไม่ได้เลือกป้ายกำกับ';
$txt['error_no_search_daemon'] = 'ไม่สามารถเข้าถึงภูตการค้นหา';

$txt['profile_errors_occurred'] = 'เกิดข้อผิดพลาดต่อไปนี้ขณะพยายามบันทึกโปรไฟล์ของคุณ';
$txt['profile_error_bad_offset'] = 'การชดเชยเวลาอยู่นอกช่วง';
$txt['profile_error_bad_timezone'] = 'เขตเวลาที่ระบุไม่ถูกต้อง';
$txt['profile_error_no_name'] = 'ช่องชื่อเว้นว่างไว้';
$txt['profile_error_digits_only'] = 'กล่อง \'จำนวนโพสต์\' มีได้เฉพาะตัวเลขเท่านั้น';
$txt['profile_error_name_taken'] = 'ชื่อผู้ใช้/ชื่อที่แสดงได้ถูกนำไปใช้แล้ว';
$txt['profile_error_name_too_long'] = 'ชื่อที่เลือกยาวเกินไป มีความยาวไม่เกิน 60 ตัวอักษร';
$txt['profile_error_no_email'] = 'ช่องอีเมลเว้นว่างไว้';
$txt['profile_error_bad_email'] = 'คุณยังไม่ได้ป้อนที่อยู่อีเมลที่ถูกต้อง';
$txt['profile_error_email_taken'] = 'ผู้ใช้รายอื่นลงทะเบียนด้วยที่อยู่อีเมลนั้นแล้ว';
$txt['profile_error_no_password'] = 'คุณไม่ได้ป้อนรหัสผ่านของคุณ';
$txt['profile_error_bad_new_password'] = 'รหัสผ่านใหม่ที่คุณป้อนไม่ตรงกัน';
$txt['profile_error_bad_password'] = 'รหัสผ่านที่คุณป้อนไม่ถูกต้อง';
$txt['profile_error_bad_avatar'] = 'รูปประจำตัวที่คุณเลือกไม่ใช่รูปภาพที่ถูกต้อง';
$txt['profile_error_bad_avatar_invalid_url'] = 'URL ที่คุณระบุไม่ถูกต้อง โปรดตรวจสอบ';
$txt['profile_error_bad_avatar_url_too_long'] = 'URL รูปประจำตัวที่คุณระบุยาวเกินไป โปรดใช้ URL ที่สั้นกว่านี้';
$txt['profile_error_bad_avatar_too_large'] = 'รูปภาพที่คุณพยายามใช้เกินการตั้งค่าความกว้าง/ความสูงสูงสุด โปรดใช้ภาพที่เล็กกว่า';
$txt['profile_error_bad_avatar_fail_reencode'] = 'รูปภาพที่คุณอัปโหลดเสียหายและการพยายามกู้คืนล้มเหลว';
// argument(s): the minimum length of user passwords as stored in the settings
$txt['profile_error_password_short'] = 'รหัสผ่านของคุณต้องมีความยาวอย่างน้อย %1$s อักขระ';
$txt['profile_error_password_restricted_words'] = 'รหัสผ่านของคุณต้องไม่มีชื่อผู้ใช้ ที่อยู่อีเมล หรือคำอื่นๆ ที่ใช้กันทั่วไป';
$txt['profile_error_password_chars'] = 'รหัสผ่านของคุณต้องประกอบด้วยอักษรตัวพิมพ์ใหญ่และตัวพิมพ์เล็ก รวมทั้งตัวเลข';
$txt['profile_error_already_requested_group'] = 'คุณมีคำขอที่ค้างอยู่สำหรับกลุ่มนี้แล้ว!';
$txt['profile_error_signature_not_yet_saved'] = 'ยังไม่ได้บันทึกลายเซ็น';
$txt['profile_error_personal_text_too_long'] = 'ข้อความส่วนตัวยาวเกินไป';
$txt['profile_error_user_title_too_long'] = 'ชื่อที่กำหนดเองยาวเกินไป';
$txt['profile_error_website_title_too_long'] = 'The website title is too long.';
$txt['profile_error_custom_field_mail_fail'] = 'การตรวจสอบความถูกต้องของเมลส่งคืนข้อผิดพลาด คุณต้องป้อนอีเมลในรูปแบบที่ถูกต้อง (ศาสดา@คนชอบหมี.com)';
$txt['profile_error_custom_field_regex_fail'] = 'การตรวจสอบ regex ส่งคืนข้อผิดพลาด หากคุณไม่แน่ใจว่าจะพิมพ์อะไรที่นี่ โปรดติดต่อผู้ดูแลฟอรัม';
$txt['profile_error_custom_field_nohtml_fail'] = 'ไม่อนุญาตให้ใช้แท็ก HTML';
$txt['profile_error_posts_out_of_range'] = 'The number of posts is out of range';

// Registration form.
$txt['under_age_registration_prohibited'] = 'ขออภัย ผู้ใช้ที่อายุต่ำกว่า %1$d ไม่สามารถลงทะเบียนในฟอรัมนี้ได้';
$txt['error_too_quickly'] = 'คุณดำเนินการลงทะเบียนเร็วเกินไป เร็วกว่าที่ควรจะเป็น โปรดรอสักครู่แล้วลองอีกครั้ง';
$txt['mysql_error_space'] = ' - ตรวจสอบพื้นที่จัดเก็บฐานข้อมูลหรือติดต่อผู้ดูแลระบบเซิร์ฟเวอร์';

$txt['icon_not_found'] = 'ไม่พบภาพไอคอนในธีมเริ่มต้น - โปรดตรวจสอบให้แน่ใจว่าได้อัปโหลดรูปภาพแล้วและลองอีกครั้ง';
$txt['icon_after_itself'] = 'ไม่สามารถวางไอคอนไว้ข้างหลังตัวเองได้';
$txt['icon_name_too_long'] = 'ชื่อไฟล์ไอคอนต้องมีความยาวไม่เกิน 16 อักขระ';

$txt['name_censored'] = 'ขออภัย ชื่อที่คุณพยายามใช้ %1$s มีคำที่ถูกเซ็นเซอร์ โปรดลองใช้ชื่ออื่น';

$txt['poll_already_exists'] = 'หัวข้อสามารถมีโพลที่เกี่ยวข้องได้เพียงแบบเดียวเท่านั้น';
$txt['poll_not_found'] = 'ไม่มีโพลที่เกี่ยวข้องกับหัวข้อนี้!';

$txt['error_while_adding_poll'] = 'เกิดข้อผิดพลาดต่อไปนี้ขณะเพิ่มโพลนี้';
$txt['error_while_editing_poll'] = 'เกิดข้อผิดพลาดต่อไปนี้ขณะแก้ไขโพลนี้';

$txt['loadavg_search_disabled'] = 'เนื่องจากเซิร์ฟเวอร์ทำงานหนัก ฟังก์ชันการค้นหาจึงถูกปิดใช้งานโดยอัตโนมัติและชั่วคราว โปรดลองอีกครั้งในอีกสักครู่';
$txt['loadavg_generic_disabled'] = 'ขออภัย เนื่องจากเซิร์ฟเวอร์ทำงานหนัก ฟีเจอร์นี้จึงไม่สามารถใช้งานได้ในขณะนี้';
$txt['loadavg_allunread_disabled'] = 'ทรัพยากรของเซิร์ฟเวอร์มีความต้องการสูงเกินไปชั่วคราวในการค้นหาหัวข้อทั้งหมดที่คุณยังไม่ได้อ่าน';
$txt['loadavg_unreadreplies_disabled'] = 'ขณะนี้เซิร์ฟเวอร์ทำงานหนัก โปรดลองอีกครั้งในภายหลัง';
$txt['loadavg_show_posts_disabled'] = 'โปรดลองอีกครั้งในภายหลัง โพสต์ของสมาชิกรายนี้ไม่สามารถใช้ได้ในขณะนี้เนื่องจากมีการโหลดสูงบนเซิร์ฟเวอร์';
$txt['loadavg_unread_disabled'] = 'ทรัพยากรของเซิร์ฟเวอร์มีความต้องการสูงเกินไปชั่วคราวในการแสดงรายการหัวข้อที่คุณยังไม่ได้อ่าน';
$txt['loadavg_userstats_disabled'] = 'สถิติของสมาชิกรายนี้ไม่สามารถใช้ได้ในขณะนี้เนื่องจากมีการโหลดสูงบนเซิร์ฟเวอร์ โปรดลองอีกครั้งในภายหลัง';

$txt['cannot_edit_permissions_inherited'] = 'คุณไม่สามารถแก้ไขการอนุญาตที่สืบทอดมาโดยตรง คุณต้องแก้ไขกลุ่มหลักหรือแก้ไขการสืบทอดกลุ่มสมาชิก';

$txt['mc_no_modreport_specified'] = 'คุณต้องระบุรายงานที่คุณต้องการดู';
$txt['mc_no_modreport_found'] = 'รายงานที่ระบุไม่มีอยู่หรืออยู่นอกขอบเขตสำหรับคุณ';

$txt['st_cannot_retrieve_file'] = 'ไม่สามารถเรียกไฟล์ %1$s';
$txt['admin_file_not_found'] = 'ไม่สามารถโหลดไฟล์ที่ร้องขอได้: %1$s';

$txt['themes_none_selectable'] = 'ต้องเลือกอย่างน้อยหนึ่งธีม';
$txt['themes_default_selectable'] = 'ธีมเริ่มต้นของฟอรัมโดยรวมต้องเป็นธีมที่เลือกได้';
$txt['ignoreboards_disallowed'] = 'ไม่ได้เปิดใช้งานตัวเลือกในการละเว้นบอร์ด';

$txt['mboards_delete_error'] = 'ไม่ได้เลือกหมวดหมู่';
$txt['mboards_delete_board_error'] = 'ไม่ได้เลือกบอร์ด';

$txt['mboards_parent_own_child_error'] = 'คุณไม่สามารถสร้างบอร์ดให้เป็นบอร์ดย่อยของตัวเองได้';
$txt['mboards_board_own_child_error'] = 'คุณไม่สามารถสร้างบอร์ดเป็นบอร์ดย่อยของตัวเองได้';

$txt['smileys_upload_error_notwritable'] = 'ไดเร็กทอรีรูปแสดงอารมณ์ต่อไปนี้ไม่สามารถเขียนได้: %1$s';
$txt['smileys_upload_error_types'] = 'รูปภาพแสดงอารมณ์มีได้เฉพาะส่วนขยายต่อไปนี้: %1$s';

$txt['change_email_success'] = 'ที่อยู่อีเมลของคุณมีการเปลี่ยนแปลงและได้ส่งอีเมลเปิดใช้งานใหม่ไป';
$txt['resend_email_success'] = 'ส่งอีเมลเปิดใช้งานใหม่เรียบร้อยแล้ว';

$txt['custom_option_need_name'] = 'ตัวเลือกโปรไฟล์ต้องมีชื่อ';
$txt['custom_option_not_unique'] = 'ชื่อช่องไม่ซ้ำกัน';
$txt['custom_option_regex_error'] = 'Regex ที่คุณป้อนไม่ถูกต้อง';

$txt['warning_no_reason'] = 'คุณต้องป้อนเหตุผลในการเปลี่ยนระดับการเตือนของสมาชิก';
$txt['warning_notify_blank'] = 'คุณเลือกที่จะแจ้งผู้ใช้แต่ไม่ได้กรอกหัวข้อ/ฟิลด์ข้อความ';

$txt['cannot_connect_doc_site'] = 'ไม่สามารถเชื่อมต่อกับคู่มือออนไลน์ Simple Machines โปรดตรวจสอบว่าการกำหนดค่าเซิร์ฟเวอร์ของคุณอนุญาตให้เชื่อมต่ออินเทอร์เน็ตภายนอกและลองอีกครั้งในภายหลัง';

$txt['movetopic_no_reason'] = 'คุณต้องป้อนเหตุผลในการย้ายหัวข้อ หรือยกเลิกการเลือกตัวเลือกเพื่อ "โพสต์หัวข้อการเปลี่ยนเส้นทาง"';

$txt['error_custom_field_too_long'] = '&quot;%1$s&quot; ช่องต้องมีความยาวไม่เกิน %2$d อักขระ';
$txt['error_custom_field_invalid_email'] = '&quot;%1$s&quot; ฟิลด์ต้องเป็นที่อยู่อีเมลที่ถูกต้อง';
$txt['error_custom_field_not_number'] = '&quot;%1$s&quot; ฟิลด์ต้องเป็นตัวเลข';
$txt['error_custom_field_inproper_format'] = '&quot;%1$s&quot; ฟิลด์เป็นรูปแบบที่ไม่ถูกต้อง';
$txt['error_custom_field_empty'] = '&quot;%1$s&quot; ฟิลด์ไม่สามารถเว้นว่างได้';

$txt['email_no_template'] = 'เทมเพลตอีเมล &quot;%1$s&quot; ไม่สามารถพบได้.';

$txt['search_api_missing'] = 'ไม่พบ API การค้นหา โปรดติดต่อผู้ดูแลระบบเพื่อตรวจสอบว่าได้อัปโหลดไฟล์ที่ถูกต้องแล้ว';
$txt['search_api_not_compatible'] = 'API การค้นหาที่เลือกซึ่งฟอรัมใช้นั้นล้าสมัยแล้ว - กลับไปสู่การค้นหามาตรฐาน โปรดตรวจสอบไฟล์ %1$s';

// Registration Agreement
$txt['error_no_agreement'] = 'ไม่มีข้อตกลงการลงทะเบียนที่จะแสดง!';
$txt['error_no_privacy_policy'] = 'ไม่ได้สร้างนโยบายความเป็นส่วนตัวสำหรับฟอรัมนี้';

// Unsubscribe
$txt['unsubscribe_invalid'] = 'ลิงก์ยกเลิกการสมัครที่นำคุณมาที่นี่ดูเหมือนจะไม่ถูกต้อง';

// Handling hook calls
$txt['hook_fail_loading_file'] = 'Hook call: ไฟล์ที่พาธ: %s ไม่สามารถโหลดได้';
$txt['hook_fail_call_to'] = 'Hook call: ไม่สามารถเรียกฟังก์ชัน "%1$s" ในไฟล์ %2$s ได้';

$txt['file_not_created'] = 'ไม่สามารถสร้างไฟล์ที่ "%1$s" โปรดตรวจสอบให้แน่ใจว่าไดเร็กทอรีหลักมีสิทธิ์ที่เหมาะสม';
$txt['file_minimize_fail'] = 'ไม่พบไฟล์ "%1$s" ในธีมปัจจุบันหรือธีมเริ่มต้น ดังนั้นจึงไม่รวมอยู่ในไฟล์ย่อขนาด';
$txt['unlink_minimized_fail'] = 'ไฟล์ต่อไปนี้ไม่สามารถลบได้ โปรดตรวจสอบสิทธิ์ของไฟล์และไดเรกทอรีหลัก<br>%1$s';

// SubActions failed attempt.
$txt['sub_action_fail'] = 'ไม่สามารถเรียก %s ได้';

// Restore topic/posts
$txt['cannot_restore_first_post'] = 'คุณไม่สามารถกู้คืนโพสต์แรกในหัวข้อได้';
$txt['parent_topic_missing'] = 'หัวข้อหลักของกระทู้ที่คุณพยายามกู้คืนถูกลบไปแล้ว';
$txt['restored_disabled'] = 'การกู้คืนหัวข้อถูกปิดใช้งาน';
$txt['restore_not_found'] = 'ไม่สามารถกู้คืนข้อความต่อไปนี้ หัวข้อเดิมอาจถูกลบ:<ul style="margin-top: 0px;">%1$s</ul>คุณจะต้องย้ายสิ่งเหล่านี้ด้วยตนเอง';

$txt['error_invalid_dir'] = 'ไดเร็กทอรีที่คุณป้อนไม่ถูกต้อง';

// json errors.
$txt['json_JSON_ERROR_DEPTH'] = 'ข้อผิดพลาดในการถอดรหัส JSON: เกินความลึกสูงสุดของสแต็ก';
$txt['json_JSON_ERROR_STATE_MISMATCH'] = 'ข้อผิดพลาดในการถอดรหัส JSON: JSON ไม่ถูกต้องหรือผิดรูปแบบ';
$txt['json_JSON_ERROR_CTRL_CHAR'] = 'ข้อผิดพลาดในการถอดรหัส JSON: ข้อผิดพลาดของอักขระควบคุม อาจเข้ารหัสไม่ถูกต้อง';
$txt['json_JSON_ERROR_SYNTAX'] = 'ข้อผิดพลาดในการถอดรหัส JSON: ข้อผิดพลาดทางไวยากรณ์, JSON ที่มีรูปแบบไม่ถูกต้อง';
$txt['json_JSON_ERROR_UTF8'] = 'ข้อผิดพลาดในการถอดรหัส JSON: อักขระ UTF-8 ที่มีรูปแบบไม่ถูกต้อง อาจเข้ารหัสอย่างไม่ถูกต้อง';
$txt['json_JSON_ERROR_RECURSION'] = 'ข้อผิดพลาดในการถอดรหัส JSON: การอ้างอิงแบบเรียกซ้ำอย่างน้อยหนึ่งรายการในค่าที่จะเข้ารหัส';
$txt['json_JSON_ERROR_INF_OR_NAN'] = 'ข้อผิดพลาดในการถอดรหัส JSON: ค่า NAN หรือ INF อย่างน้อยหนึ่งค่าในค่าที่จะเข้ารหัส';
$txt['json_JSON_ERROR_UNSUPPORTED_TYPE'] = 'ข้อผิดพลาดในการถอดรหัส JSON: กำหนดค่าประเภทที่ไม่สามารถเข้ารหัสได้';
$txt['json_unknown'] = 'ข้อผิดพลาดที่ไม่รู้จัก';

// The following strings are used with various trigger_error calls. Most include the function that they're called from.
// Board errors
$txt['create_board_missing_options'] = 'createBoard(): ไม่ได้ตั้งค่าตัวเลือกที่จำเป็นอย่างน้อยหนึ่งตัวเลือก';
$txt['move_board_no_target'] = 'createBoard(): ไม่ได้ตั้งค่าบอร์ดเป้าหมาย';
$txt['modify_board_move_to_incorrect'] = 'modifiedBoard(): ค่า move_to \'%s\' ไม่ถูกต้อง';

// Category errors
$txt['create_category_no_name'] = 'createCategory(): จำเป็นต้องมีชื่อหมวดหมู่';
$txt['cannot_move_to_deleted_category'] = 'deleteCategories(): คุณไม่สามารถย้ายบอร์ดไปยังหมวดหมู่ที่กำลังถูกลบ';

// Package manager error
$txt['undefined_xml_attribute'] = 'แอตทริบิวต์ XML ที่ไม่ได้กำหนด: %s';
$txt['undefined_xml_element'] = 'องค์ประกอบ XML ที่ไม่ได้กำหนด: %s';

// loadMemberData() error
$txt['invalid_member_data_set'] = 'loadMemberData(): ชุดสมาชิกไม่ถูกต้อง: \'%s\'';

// loadMemberContext() error
$txt['user_not_loaded'] = 'loadMemberContext(): รหัสสมาชิก \'%d\' ไม่เคยโหลดโดย loadMemberData()';

// logActions() errors
$txt['logActions_not_array'] = 'logActions(): data ไม่ใช่อาร์เรย์ที่มีการกระทำ \'%s\'';
$txt['logActions_topic_not_numeric']  = 'logActions(): หัวข้อของข้อมูลไม่ใช่ตัวเลข';
$txt['logActions_message_not_numeric'] = 'logActions(): ข้อความของข้อมูลไม่ใช่ตัวเลข';
$txt['logActions_member_not_numeric'] = 'logActions(): สมาชิกของข้อมูลไม่ใช่ตัวเลข';
$txt['logActions_board_not_numeric'] = 'logActions(): บอร์ดข้อมูลไม่ใช่ตัวเลข';
$txt['logActions_board_to_not_numeric'] = 'logActions(): data\'s board_to ไม่ใช่ตัวเลข';

// Login error
$txt['login_no_session_cookie'] = 'Login2(): ไม่สามารถเข้าสู่ระบบโดยไม่มีวาระหรือคุกกี้';

// PM error (see isAccessiblePM function)
$txt['pm_invalid_validation_type'] = 'ระบุประเภทการตรวจสอบที่ไม่ได้กำหนดไว้';

$txt['check_submit_once_invalid_action'] = 'checkSubmitOnce(): การกระทำที่ไม่ถูกต้อง \'%s\'';

$txt['get_server_versions_no_database'] = 'getServerVersions(): คุณต้องเชื่อมต่อกับฐานข้อมูลเพื่อรับเวอร์ชันเซิร์ฟเวอร์';

// Subs-Db-postgresql.php line 801
$txt['postgres_id_not_int'] = 'กำลังพยายามส่งคืนฟิลด์ ID ซึ่งไม่ใช่ Int';

$txt['add_members_to_group_invalid_type'] = 'addMembersToGroup(): ไม่ทราบประเภท \'%s\'';

$txt['get_members_online_stats_invalid_sort'] = 'ไม่อนุญาตให้เรียงลำดับฟังก์ชัน getMembersOnlineStats()';

$txt['get_board_list_cannot_include_and_exclude'] = 'getBoardList(): ไม่อนุญาตให้ตั้งค่าทั้ง excluded_boards และ included_boards';

$txt['parse_path_filename_required'] = 'parse_path(): ไม่ควรมีชื่อไฟล์ว่างเปล่า';
$txt['parse_modification_filename_not_full_path'] = 'parseModification(): ชื่อไฟล์ \'%s\' ไม่ใช่เส้นทางแบบเต็ม!';
$txt['parse_boardmod_filename_not_full_path'] = 'parseBoardMod(): ชื่อไฟล์ \'%s\' ไม่ใช่พาธแบบเต็ม!';
$txt['package_flush_cache_not_writable'] = 'package_flush_cache(): บางไฟล์ยังไม่สามารถเขียนได้';

$txt['create_post_invalid_member_id'] = 'createPost(): id สมาชิกไม่ถูกต้อง \'%d\'';

$txt['invalid_statistic_type'] = 'updateStats(): ประเภทสถิติที่ไม่ถูกต้อง \'%s\'';

$txt['fetch_web_data_bad_url'] = 'fetch_web_data(): URL ไม่ถูกต้อง';

$txt['unicode_update_failed'] = 'A new version of Unicode is available, but SMF could not update to it. Please make sure %1$s and all the files in it are writable. SMF will try to update its Unicode data files again automatically.';

?>