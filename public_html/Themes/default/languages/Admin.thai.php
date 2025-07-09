<?php
// Version: 2.1.3; Admin

global $settings, $scripturl;

$txt['settings_saved'] = 'บันทึกการตั้งค่าเรียบร้อยแล้ว';
$txt['settings_not_saved'] = 'การเปลี่ยนแปลงของคุณไม่ได้รับการบันทึกเนื่องจาก: %1$s';

$txt['admin_boards'] = 'บอร์ดและหมวดหมู่';
$txt['admin_users'] = 'สมาชิก';
$txt['admin_newsletters'] = 'จดหมายข่าว';
$txt['admin_edit_news'] = 'ข่าว';
$txt['admin_groups'] = 'กลุ่มสมาชิก';
$txt['admin_members'] = 'จัดการสมาชิก';
$txt['admin_members_list'] = 'ด้านล่างนี้คือรายชื่อของสมาชิกทั้งหมดที่ลงทะเบียนกับฟอรั่มของคุณ';
$txt['admin_next'] = 'ต่อไป';
$txt['admin_censored_words'] = 'คำเซ็นเซอร์';
$txt['admin_censored_where'] = 'ใส่คำที่จะเซ็นเซอร์ทางด้านซ้ายและสิ่งที่จะเปลี่ยนทางด้านขวา
เช่น: ตู่=ควาย';
$txt['admin_censored_desc'] = 'ตามปกติของฟอรั่มสาธารณะ อาจมีคำบางคำที่คุณต้องการห้ามไม่ให้โพสต์โดยผู้ใช้ฟอรั่มของคุณ คุณสามารถป้อนคำใดๆ ด้านล่างที่คุณต้องการให้เซ็นเซอร์ทุกครั้งที่ใช้โดยสมาชิก<br>ล้างช่องเพื่อลบคำนั้นออกจากการเซ็นเซอร์';
$txt['admin_reserved_names'] = 'ชื่อที่สงวนไว้';
$txt['admin_modifications'] = 'การตั้งค่าม็อด';
$txt['admin_server_settings'] = 'การตั้งค่าเซิร์ฟเวอร์';
$txt['admin_reserved_set'] = 'ตั้งชื่อที่สงวนไว้';
$txt['admin_reserved_line'] = 'หนึ่งคำสงวนต่อบรรทัด';
$txt['admin_basic_settings'] = 'หน้านี้อนุญาตให้คุณเปลี่ยนการตั้งค่าพื้นฐานสำหรับฟอรัมของคุณ โปรดใช้ความระมัดระวังกับการตั้งค่าเหล่านี้ เนื่องจากอาจทำให้ฟอรัมใช้งานไม่ได้';
$txt['admin_maintain'] = 'เปิดใช้งานโหมดบำรุงรักษา';
$txt['admin_title'] = 'ชื่อฟอรั่ม';
$txt['cookie_name'] = 'ชื่อคุกกี้';
$txt['admin_webmaster_email'] = 'ที่อยู่อีเมลของผู้ดูแลเว็บ';
$txt['cachedir'] = 'ไดเรกทอรีแคช';
$txt['admin_news'] = 'เปิดใช้งานข่าว';
$txt['admin_manage_members'] = 'สมาชิก';
$txt['admin_main'] = 'หลัก';
$txt['admin_config'] = 'การกำหนดค่า';
$txt['admin_version_check'] = 'ตรวจสอบเวอร์ชันโดยละเอียด';
$txt['admin_smffile'] = 'ไฟล์ SMF';
$txt['admin_smfpackage'] = 'แพ็คเกจ SMF';
$txt['admin_logoff'] = 'สิ้นสุดเซสชันผู้ดูแลระบบ';
$txt['admin_maintenance'] = 'การซ่อมบำรุง';
$txt['admin_credits'] = 'เครดิต';
$txt['admin_agreement'] = 'กำหนดให้สมาชิกใหม่ยอมรับข้อตกลงการลงทะเบียน';
$txt['admin_agreement_minor_edit'] = 'นี่คือการแก้ไขเล็กน้อย';
$txt['reset_agreement_desc'] = 'การดำเนินการนี้จะบังคับให้สมาชิกทุกคนอ่านซ้ำและยอมรับข้อตกลงการลงทะเบียนเพื่อใช้ฟอรั่มต่อไป';
$txt['admin_privacy_policy'] = 'กำหนดให้สมาชิกใหม่ยอมรับนโยบายความเป็นส่วนตัว';
$txt['reset_privacy_policy_desc'] = 'การดำเนินการนี้จะบังคับให้สมาชิกทุกคนอ่านซ้ำและยอมรับนโยบายความเป็นส่วนตัวเพื่อใช้งานฟอรัมต่อไป';
$txt['admin_agreement_info'] = 'อัปเดตล่าสุด: %1$s';
$txt['admin_agreement_default'] = 'ค่าเริ่มต้น';
$txt['admin_agreement_select_language'] = 'ภาษาที่จะแก้ไข';
$txt['admin_agreement_select_language_change'] = 'เปลี่ยน';
$txt['admin_agreement_not_saved'] = 'ยังไม่ได้บันทึกการเปลี่ยนแปลงข้อตกลง บางทีการอนุญาตไฟล์ในไฟล์อาจไม่ได้ตั้งค่าอย่างถูกต้อง';
$txt['admin_delete_members'] = 'ลบสมาชิกที่เลือก';
$txt['admin_repair'] = 'ซ่อมแซมบอร์ดและหัวข้อทั้งหมด';
$txt['admin_main_welcome'] = 'นี่คือ &quot;%1$s&quot; ของคุณ จากที่นี่ คุณสามารถแก้ไขการตั้งค่า ดูแลฟอรั่มของคุณ ดูบันทึก ติดตั้งแพ็คเกจ จัดการธีม และอื่นๆ อีกมากมาย<br><br>หากคุณมีปัญหาใดๆ โปรดดูที่หน้า&quot;การสนับสนุน &amp; เครดิต&quot;. หากข้อมูลนั้นไม่สามารถช่วยคุณได้ โปรด<a href="https://www.simplemachines.org/community/index.php" target="_blank" rel="noopener">ขอความช่วยเหลือจากเรา </a> ที่มีปัญหา<br>คุณอาจพบคำตอบสำหรับคำถามหรือปัญหาของคุณโดยคลิกที่สัญลักษณ์ <span class="main_icons help" title="%3$s"></span> เพื่อดูข้อมูลเพิ่มเติมเกี่ยวกับ ฟังก์ชั่นที่เกี่ยวข้อง';
$txt['admin_news_desc'] = 'Please place one news item per box. <abbr title="Bulletin Board Code">BBC</abbr> <span title="Because everyone loves brackets!">tags</span>, such as <span class="monospace">[b]</span>, <span class="monospace">[i]</span> and <span class="monospace">[u]</span>, are allowed in your news, as well as smileys. Clear a news item\'s text box to remove it.';
$txt['administrators'] = 'ผู้ดูแลฟอรัม';
$txt['admin_reserved_desc'] = 'ชื่อที่สงวนไว้จะป้องกันไม่ให้สมาชิกลงทะเบียนชื่อผู้ใช้บางชื่อหรือใช้คำเหล่านี้ในชื่อที่แสดง เลือกตัวเลือกที่คุณต้องการใช้จากด้านล่างก่อนส่ง';
$txt['admin_match_whole'] = 'ตรงกับชื่อเต็มเท่านั้น หากไม่ได้เลือก ให้ค้นหาภายในชื่อ';
$txt['admin_match_case'] = 'เหมือนกันทุกตัวอักษร หากไม่ได้เลือก การค้นหาจะไม่พิจารณาตัวพิมพ์เล็กและตัวพิมพ์ใหญ่';
$txt['admin_check_user'] = 'ตรวจสอบชื่อผู้ใช้';
$txt['admin_check_display'] = 'ตรวจสอบชื่อที่แสดง';
$txt['admin_fader_delay'] = 'หน่วงเวลาการซีดจางระหว่างรายการสำหรับเฟดเดอร์ข่าว หน่วยเป็นมิลลิวินาที';
$txt['additional_options_collapsable'] = 'เปิดใช้งานตัวเลือกโพสต์เพิ่มเติมที่ยุบได้';
$txt['guest_post_no_email'] = 'อย่าแสดงช่องอีเมลสำหรับโพสต์ของผู้มาเยือน';
$txt['zero_for_no_limit'] = '(0 สำหรับไม่จำกัด)';
$txt['zero_to_disable'] = '(ตั้งค่าเป็น 0 เพื่อปิดการใช้งาน)';
$txt['dont_show_attach_under_post'] = 'อย่าแสดงไฟล์แนบใต้โพสต์หากมีการฝังไฟล์แนบอยู่แล้ว';
$txt['dont_show_attach_under_post_sub'] = 'เปิดใช้งานสิ่งนี้หากคุณไม่ต้องการให้ไฟล์แนบปรากฏสองครั้ง ไฟล์แนบที่ฝังอยู่ในโพสต์จะยังคงนับรวมในขีดจำกัดของไฟล์แนบ และยังคงได้รับการปฏิบัติเหมือนไฟล์แนบทั่วไป';

$txt['admin_backup_fail'] = 'ไม่สามารถสำรองข้อมูล Settings.php - ตรวจสอบให้แน่ใจว่า Settings_bak.php มีอยู่แล้วและสามารถเขียนได้';
$txt['registration_agreement'] = 'ข้อตกลงการลงทะเบียน';
$txt['registration_agreement_desc'] = 'ข้อตกลงนี้จะแสดงขึ้นเมื่อผู้ใช้ลงทะเบียนบัญชีในฟอรัมนี้ และต้องยอมรับก่อนที่ผู้ใช้จะลงทะเบียนต่อได้';
$txt['privacy_policy'] = 'นโยบายความเป็นส่วนตัว';
$txt['privacy_policy_desc'] = 'นโยบายความเป็นส่วนตัวนี้อธิบายคำสัญญาที่คุณให้ไว้กับผู้ใช้ของคุณเกี่ยวกับวิธีที่คุณจะใช้ข้อมูลส่วนบุคคลของพวกเขา จะแสดงเมื่อผู้ใช้ลงทะเบียนบัญชีในฟอรั่มนี้และต้องได้รับการยอมรับก่อนที่ผู้ใช้จะสามารถทำการลงทะเบียนต่อไปได้';
$txt['errors_list'] = 'รายการข้อผิดพลาดของฟอรัม';
$txt['errors_found'] = 'ข้อผิดพลาดต่อไปนี้ทำให้ฟอรั่มของคุณเปรอะเปื้อน';
$txt['errors_fix'] = 'คุณต้องการพยายามแก้ไขข้อผิดพลาดเหล่านี้หรือไม่';
$txt['errors_do_recount'] = 'ข้อผิดพลาดทั้งหมดได้รับการแก้ไขและสร้างพื้นที่กอบกู้แล้ว โปรดคลิกปุ่มด้านล่างเพื่อนับสถิติสำคัญบางส่วน';
$txt['errors_recount_now'] = 'นับสถิติ';
$txt['errors_fixing'] = 'แก้ไขข้อผิดพลาดของฟอรัม';
$txt['errors_fixed'] = 'แก้ไขข้อผิดพลาดทั้งหมดแล้ว โปรดตรวจสอบหมวดหมู่ บอร์ด หรือหัวข้อที่สร้างขึ้นเพื่อตัดสินใจว่าจะทำอย่างไรกับพวกเขา';
$txt['attachments_avatars'] = 'ไฟล์แนบและรูปประจำตัว';
$txt['attachments_desc'] = 'จากที่นี่ คุณสามารถจัดการไฟล์ที่แนบมากับระบบของคุณได้ คุณสามารถลบสิ่งที่แนบมาตามขนาดและตามวันที่จากระบบของคุณ สถิติของไฟล์แนบจะแสดงอยู่ด้านล่างด้วย';
$txt['attachment_stats'] = 'สถิติไฟล์แนบ';
$txt['attachment_integrity_check'] = 'การตรวจสอบความสมบูรณ์ของไฟล์แนบ';
$txt['attachment_integrity_check_desc'] = 'ฟังก์ชันนี้จะตรวจสอบความสมบูรณ์และขนาดของไฟล์แนบและชื่อไฟล์ที่แสดงในฐานข้อมูล และหากจำเป็น ให้แก้ไขข้อผิดพลาดที่พบ';
$txt['attachment_check_now'] = 'เรียกใช้การตรวจสอบตอนนี้';
$txt['attachment_pruning'] = 'ล้างไฟล์แนบ';
$txt['attachment_pruning_message'] = 'ข้อความที่จะเพิ่มในโพสต์';
$txt['attachment_pruning_warning'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบไฟล์แนบเหล่านี้\nการดำเนินการนี้ไม่สามารถยกเลิกได้!';

$txt['attachment_total'] = 'ไฟล์แนบทั้งหมด';
$txt['attachmentdir_size'] = 'ขนาดรวมของไดเร็กทอรีไฟล์แนบทั้งหมด';
$txt['attachmentdir_size_current'] = 'ขนาดรวมของไดเร็กทอรีไฟล์แนบปัจจุบัน';
$txt['attachmentdir_files_current'] = 'ไฟล์ทั้งหมดในไดเร็กทอรีไฟล์แนบปัจจุบัน';
$txt['attachment_space'] = 'พื้นที่ว่างทั้งหมด';
$txt['attachment_files'] = 'ไฟล์ที่เหลือทั้งหมด';

$txt['attachment_log'] = 'บันทึกไฟล์แนบ';
$txt['attachment_remove_old'] = 'ลบไฟล์แนบที่เก่ากว่า';
$txt['attachment_remove_size'] = 'ลบไฟล์แนบที่มีขนาดใหญ่กว่า';
$txt['attachment_name'] = 'ชื่อไฟล์แนบ';
$txt['attachment_file_size'] = 'ขนาดไฟล์';
$txt['attachmentdir_size_not_set'] = 'ไม่ได้กำหนดขนาดไดเร็กทอรีสูงสุดในขณะนี้';
$txt['attachmentdir_files_not_set'] = 'ไม่มีการจำกัดไฟล์ไดเร็กทอรีในขณะนี้';
$txt['attachment_delete_admin'] = '[ไฟล์แนบถูกลบโดยผู้ดูแลระบบ]';
$txt['live'] = 'สดจาก Simple Machines...';
$txt['remove_all'] = 'ล้างบันทึก';
$txt['agreement_not_writable'] = 'คำเตือน - agreement.txt ไม่สามารถเขียนได้ การเปลี่ยนแปลงใดๆ ที่คุณทำจะไม่ถูกบันทึก';

$txt['version_check_desc'] = 'ซึ่งจะแสดงเวอร์ชันของไฟล์การติดตั้งของคุณเทียบกับเวอร์ชันล่าสุด หากไฟล์เหล่านี้ล้าสมัย คุณควรดาวน์โหลดและอัปเกรดเป็นเวอร์ชันล่าสุดที่ <a href="https://www.simplemachines.org/" target="_blank" rel="noopener">www.simplemachines.org</a>';
$txt['version_check_more'] = '(รายละเอียดเพิ่มเติม)';

$txt['smf_news_cant_connect'] = 'คุณไม่สามารถเชื่อมต่อกับไฟล์ข่าวล่าสุดของ simplemachines.org';

$txt['manage_calendar'] = 'ปฏิทิน';
$txt['manage_search'] = 'ค้นหา';

$txt['smileys_manage'] = 'ไอคอนแสดงอารมณ์และข้อความ';
$txt['theme_admin'] = 'ธีมและเลย์เอาต์';
$txt['registration_center'] = 'การลงทะเบียน';

$txt['viewmembers_online'] = 'ออนไลน์ล่าสุด';
$txt['viewmembers_today'] = 'วันนี้';
$txt['viewmembers_day_ago'] = 'วันที่ผ่านมา';
$txt['viewmembers_days_ago'] = 'วันที่ผ่านมา';

$txt['display_name'] = 'ชื่อที่แสดง';
$txt['email_address'] = 'ที่อยู่อีเมล';
$txt['ip_address'] = 'ที่อยู่ IP';
$txt['member_id'] = 'ไอดี';

$txt['unknown'] = 'ไม่รู้จัก';

// argument(s): HTTP_REFERER (if applicable), HTTP_USER_AGENT, ip address
$txt['security_wrong'] = 'พยายามเข้าสู่ระบบผู้ดูแลระบบ!
ผู้อ้างอิง: %1$s
ตัวแทนผู้ใช้: %2$s
IP: %3$s';

$txt['email_as_html'] = 'ส่งในรูปแบบ HTML (ด้วยสิ่งนี้ คุณสามารถใส่ HTML ปกติในอีเมลได้)';
$txt['email_parsed_html'] = 'เพิ่ม &lt;br&gt;s และ &amp;nbsp;s ในข้อความนี้';
// argument(s): $scripturl
$txt['email_variables'] = 'ในข้อความนี้ คุณสามารถใช้&quot;ตัวแปร&quot;สองสามตัว คลิก<a href="%1$s?action=helpadmin;help=email_members" onclick="return reqOverlayDiv(this.href);" class="help">ที่นี่</a>สำหรับข้อมูลเพิ่มเติม';
$txt['email_force'] = 'Send this to members even if they have chosen not to receive announcements.<br><span class="alert">This should only be used in exceptional circumstances. Using this to send promotional or other non-essential email messages violates many countries\' privacy and anti-spam laws.</span>';
$txt['email_as_pms'] = 'ส่งสิ่งนี้ไปยังกลุ่มเหล่านี้โดยใช้ข้อความส่วนตัว';
$txt['email_continue'] = 'ดำเนินการต่อ';
$txt['email_done'] = 'เสร็จแล้ว';

$txt['warnings'] = 'คำเตือน';
$txt['warnings_desc'] = 'ระบบนี้อนุญาตให้ผู้ดูแลระบบและผู้ดูแลสามารถออกคำเตือนให้กับผู้ใช้ และสามารถลบสิทธิ์ของผู้ใช้โดยอัตโนมัติเมื่อระดับการเตือนเพิ่มขึ้น เพื่อใช้ประโยชน์จากระบบนี้อย่างเต็มที่ ควรเปิดใช้งาน &quot;โพสต์การตรวจสอบ&quot;';

$txt['ban_title'] = 'รายการห้าม';

$txt['ban_errors_detected'] = 'เกิดข้อผิดพลาดต่อไปนี้ขณะบันทึกหรือแก้ไขการแบน';
$txt['ban_description'] = 'ที่นี่คุณสามารถแบนคนที่มีปัญหาได้โดยใช้ IP ชื่อโฮสต์ ชื่อผู้ใช้ หรืออีเมล';
$txt['ban_add_new'] = 'เพิ่มการแบนใหม่';
$txt['ban_banned_entity'] = 'นิติบุคคลต้องห้าม';
$txt['ban_on_ip'] = 'แบน IP (เช่น 192.168.10-20.*)';
$txt['ban_on_hostname'] = 'แบนชื่อโฮสต์ (เช่น *.mil)';
$txt['ban_on_email'] = 'แบนที่อยู่อีเมล (เช่น *@ลุงตู่.gov.th)';
$txt['ban_on_username'] = 'แบนชื่อผู้ใช้';
$txt['ban_notes'] = 'หมายเหตุ';
$txt['ban_restriction'] = 'ข้อจำกัด';
$txt['ban_full_ban'] = 'แบนเต็มที่';
$txt['ban_partial_ban'] = 'แบนบางส่วน';
$txt['ban_cannot_post'] = 'โพสต์ไม่ได้';
$txt['ban_cannot_register'] = 'ลงทะเบียนไม่ได้';
$txt['ban_cannot_login'] = 'เข้าสู่ระบบไม่ได้';
$txt['ban_add'] = 'เพิ่ม';
$txt['ban_edit_list'] = 'รายการแบน';
$txt['ban_type'] = 'แบบแบน';
$txt['ban_days'] = 'วัน';
$txt['ban_will_expire_within'] = 'แบนจะหมดอายุหลังจาก';
$txt['ban_added'] = 'เพิ่ม';
$txt['ban_expires'] = 'หมดอายุ';
$txt['ban_hits'] = 'ฮิต';
$txt['ban_actions'] = 'การกระทำ';
$txt['ban_expiration'] = 'วันหมดอายุ';
$txt['ban_reason_desc'] = 'เหตุผลในการแบน จะแสดงต่อสมาชิกที่ถูกแบน';
$txt['ban_notes_desc'] = 'หมายเหตุที่อาจช่วยเหลือพนักงานคนอื่น ๆ';
$txt['ban_remove_selected'] = 'ลบรายการที่เลือก';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_remove_selected_confirm'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบการแบนที่เลือก';
$txt['ban_modify'] = 'แก้ไข';
$txt['ban_name'] = 'ชื่อแบน';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_edit'] = 'แก้ไขการแบน';
$txt['ban_add_notes'] = '<strong>หมายเหตุ</strong>: หลังจากสร้างการแบนข้างต้น คุณสามารถเพิ่มรายการเพิ่มเติมที่เรียกใช้การแบน เช่น ที่อยู่ IP ชื่อโฮสต์ และที่อยู่อีเมล';
$txt['ban_expired'] = 'หมดอายุ / ปิดการใช้งาน';
// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_restriction_empty'] = 'ไม่ได้เลือกข้อจำกัด';

$txt['ban_triggers'] = 'ตัวกระตุ้น';
$txt['ban_add_trigger'] = 'เพิ่มตัวกระตุ้นการแบน';
$txt['ban_add_trigger_submit'] = 'เพิ่ม';
$txt['ban_edit_trigger'] = 'แก้ไข';
$txt['ban_edit_trigger_title'] = 'แก้ไขตัวกระตุ้นการแบน';
$txt['ban_edit_trigger_submit'] = 'แก้ไข';
$txt['ban_remove_selected_triggers'] = 'ลบตัวกระตุ้นการแบนที่เลือก';
$txt['ban_no_entries'] = 'ขณะนี้ไม่มีการแบนที่มีผลบังคับใช้';

// Escape any single quotes in here twice.. 'it\'s' -> 'it\\\'s'.
$txt['ban_remove_selected_triggers_confirm'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบตัวกระตุ้นการแบนที่เลือก';
$txt['ban_trigger_browse'] = 'เรียกดูตัวกระตุ้นการแบน';
$txt['ban_trigger_browse_description'] = 'หน้าจอนี้แสดงที่ตัวตนถูกแบนทั้งหมดซึ่งจัดกลุ่มตามที่อยู่ IP ชื่อโฮสต์ ที่อยู่อีเมล และชื่อผู้ใช้';

$txt['ban_log'] = 'บันทึกการแบน';
$txt['ban_log_description'] = 'บันทึกการแบนแสดงความพยายามทั้งหมดในการเข้าสู่ฟอรัมโดยผู้ใช้ที่ถูกแบน (การแบน \'การแบนแบบเต็ม\' และ \'ไม่สามารถลงทะเบียน\' เท่านั้น)';
$txt['ban_log_no_entries'] = 'ขณะนี้ไม่มีรายการบันทึกการแบน';
$txt['ban_log_ip'] = 'IP';
$txt['ban_log_email'] = 'ที่อยู่อีเมล';
$txt['ban_log_member'] = 'สมาชิก';
$txt['ban_log_date'] = 'วันที่';
$txt['ban_log_remove_all'] = 'ล้างบันทึก';
$txt['ban_log_remove_all_confirm'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบรายการบันทึกการแบนทั้งหมด';
$txt['ban_log_remove_selected'] = 'ลบรายการที่เลือก';
$txt['ban_log_remove_selected_confirm'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบรายการบันทึกการแบนที่เลือกทั้งหมด';
$txt['ban_no_triggers'] = 'ขณะนี้ยังไม่มีตัวกระตุ้นการแบน';

$txt['settings_not_writable'] = 'การตั้งค่าเหล่านี้ไม่สามารถเปลี่ยนแปลงได้เนื่องจาก Settings.php เป็นแบบอ่านอย่างเดียว';

$txt['maintain_title'] = 'การบำรุงรักษาฟอรั่ม';
$txt['maintain_info'] = 'ปรับตารางให้เหมาะสม สำรองข้อมูล ตรวจสอบข้อผิดพลาด และล้างบอร์ดด้วยเครื่องมือเหล่านี้';
$txt['maintain_sub_database'] = 'ฐานข้อมูล';
$txt['maintain_sub_routine'] = 'กิจวัตรประจำวัน';
$txt['maintain_sub_members'] = 'สมาชิก';
$txt['maintain_sub_topics'] = 'กระทู้';
$txt['maintain_done'] = 'งานบำรุงรักษา \'%1$s\' ดำเนินการสำเร็จแล้ว';
$txt['maintain_no_errors'] = 'ยินดีด้วย ไม่พบข้อผิดพลาด ขอบคุณสำหรับการตรวจสอบ';

$txt['maintain_tasks'] = 'งานที่กำหนดเวลาไว้';
$txt['maintain_tasks_desc'] = 'จัดการงานทั้งหมดที่กำหนดโดย SMF';
$txt['scheduled_tasks_settings'] = 'การตั้งค่า';
$txt['scheduled_tasks_settings_desc'] = 'การตั้งค่าเพื่อควบคุมวิธีการรันงานตามกำหนดการ';

$txt['scheduled_log'] = 'บันทึกงาน';
$txt['scheduled_log_desc'] = 'บันทึกนี้แสดงงานตามกำหนดเวลาทั้งหมดที่รันบนฟอรัมของคุณ';
$txt['admin_log'] = 'บันทึกผู้ดูแลระบบ';
$txt['admin_log_desc'] = 'แสดงรายการงานการดูแลระบบที่ดำเนินการโดยผู้ดูแลระบบฟอรัมของคุณ';
$txt['moderation_log'] = 'บันทึกการดูแล';
$txt['moderation_log_desc'] = 'แสดงรายการกิจกรรมการกลั่นกรองที่ดำเนินการโดยผู้ดูแลในฟอรัมของคุณ';
$txt['spider_log_desc'] = 'ตรวจสอบรายการที่เกี่ยวข้องกับกิจกรรมแมงมุมเครื่องมือค้นหาในฟอรั่มของคุณ';
$txt['log_settings_desc'] = 'ใช้ตัวเลือกเหล่านี้เพื่อกำหนดค่าวิธีการบันทึกในฟอรัมของคุณ';
$txt['modlog_enabled'] = 'เปิดใช้งานบันทึกการดูแล';
$txt['adminlog_enabled'] = 'เปิดใช้งานบันทึกการดูแลระบบ';
$txt['userlog_enabled'] = 'เปิดใช้งานบันทึกการแก้ไขโปรไฟล์';

$txt['mailqueue_title'] = 'จดหมาย';

$txt['db_error_send'] = 'ส่งอีเมลเกี่ยวกับข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล';
$txt['db_persist'] = 'ใช้การเชื่อมต่อแบบถาวร';
$txt['ssi_db_user'] = 'ชื่อผู้ใช้ฐานข้อมูลเพื่อใช้ในโหมด SSI';
$txt['ssi_db_passwd'] = 'รหัสผ่านฐานข้อมูลเพื่อใช้ในโหมด SSI';

$txt['default_language'] = 'ภาษาฟอรั่มเริ่มต้น';

$txt['maintenance_subject'] = 'หัวข้อที่จะแสดง';
$txt['maintenance_message'] = 'ข้อความสำหรับแสดง';

$txt['errorlog_desc'] = 'บันทึกข้อผิดพลาดจะติดตามทุกข้อผิดพลาดที่พบโดยฟอรัมของคุณ หากต้องการลบข้อผิดพลาดออกจากฐานข้อมูล ให้ทำเครื่องหมายที่ช่องทำเครื่องหมาย แล้วคลิกปุ่ม %1$s ที่ด้านล่างของหน้า';
$txt['errorlog_no_entries'] = 'ขณะนี้ไม่มีรายการบันทึกข้อผิดพลาด';

$txt['theme_settings'] = 'การตั้งค่าธีม';
$txt['theme_current_settings'] = 'ธีมปัจจุบัน';

$txt['dvc_your'] = 'รุ่นของคุณ';
$txt['dvc_current'] = 'รุ่นปัจจุบัน';
$txt['dvc_sources'] = 'แหล่งที่มา';
$txt['dvc_default'] = 'เทมเพลตเริ่มต้น';
$txt['dvc_templates'] = 'เทมเพลตปัจจุบัน';
$txt['dvc_languages'] = 'ไฟล์ภาษา';
$txt['dvc_tasks'] = 'งานเบื้องหลัง';

$txt['smileys_default_set_for_theme'] = 'เลือกชุดรูปแสดงอารมณ์เริ่มต้นสำหรับธีมนี้';
$txt['smileys_no_default'] = '(ใช้ชุดรูปแสดงอารมณ์เริ่มต้นสากล)';

$txt['censor_test'] = 'ทดสอบคำเซ็นเซอร์';
$txt['censor_test_save'] = 'ทดสอบ';
$txt['censor_case'] = 'ละเว้นตัวพิมพ์เล็กและใหญ่เมื่อเซ็นเซอร์';
$txt['censor_whole_words'] = 'ตรวจสอบเฉพาะทั้งคำ';

$txt['admin_confirm_password'] = '(ยืนยัน)';
$txt['admin_incorrect_password'] = 'รหัสผ่านผิดพลาด';

$txt['age'] = 'อายุผู้ใช้';
$txt['activation_status'] = 'สถานะการเปิดใช้งาน';
$txt['activated'] = 'เปิดใช้งานแล้ว';
$txt['not_activated'] = 'ไม่ได้เปิดใช้งาน';
$txt['primary'] = 'หลัก';
$txt['additional'] = 'เพิ่มเติม';
$txt['wild_cards_allowed'] = 'อักขระตัวแทน * และ ? ได้รับอนุญาต';
$txt['search_for'] = 'ค้นหา';
$txt['search_match'] = 'จับคู่';
$txt['member_part_of_these_membergroups'] = 'สมาชิกเป็นส่วนหนึ่งของกลุ่มสมาชิกเหล่านี้';
$txt['membergroups'] = 'กลุ่มสมาชิก';
$txt['confirm_delete_members'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบสมาชิกที่เลือก';

$txt['support_credits_title'] = 'การสนับสนุนและเครดิต';
$txt['support_title'] = 'ข้อมูลสนับสนุน';
$txt['support_versions_current'] = 'รุ่น SMF ปัจจุบัน';
$txt['support_versions_forum'] = 'รุ่นฟอรั่ม';
$txt['support_versions_db'] = '%1$s รุ่น';
$txt['support_versions_db_engine'] = '%1$s เอนจิ้น';
$txt['support_versions_server'] = 'รุ่นเซิร์ฟเวอร์';
$txt['support_versions_gd'] = 'รุ่นGD';
$txt['support_versions_imagemagick'] = 'รุ่น ImageMagick';
$txt['support_versions'] = 'ข้อมูลรุ่น';
$txt['support_resources'] = 'แหล่งข้อมูลสนับสนุน';
$txt['support_resources_p1'] = '<a href="%1$s">คู่มือออนไลน์</a>ของเรามีเอกสารหลักสำหรับ SMF คู่มือออนไลน์ของ SMF มีเอกสารมากมายเพื่อช่วยตอบคำถามสนับสนุนและอธิบาย<a href="%2$s">คุณลักษณะ</a> <a href="%3$s">การตั้งค่า</a> <a href="%4$s">ธีม</a> <a href="%5$s">แพ็คเกจ</a> ฯลฯ คู่มือออนไลน์จะจัดทำเอกสารแต่ละส่วนของ SMF อย่างละเอียดและควรตอบคำถามส่วนใหญ่อย่างรวดเร็ว';
$txt['support_resources_p2'] = 'หากคุณไม่พบคำตอบสำหรับคำถามของคุณในคู่มือออนไลน์ คุณอาจต้องการค้นหา<a href="%1$s">ชุมชนการสนับสนุน</a>ของเราหรือขอความช่วยเหลือใน<a href= "%2$s">ภาษาอังกฤษ</a>หรือหนึ่งใน<a href="%3$s">บอร์ดสนับสนุนระหว่างประเทศ</a>ของเรา ชุมชนการสนับสนุน SMF สามารถใช้สำหรับ<a href="%4$s">การสนับสนุน</a> <a href="%5$s">การปรับแต่ง</a> และอื่นๆ อีกมากมาย เช่น การพูดคุยเกี่ยวกับ SMF การค้นหาโฮสต์ และหารือเกี่ยวกับปัญหาการดูแลระบบกับผู้ดูแลฟอรัมอื่นๆ';

$txt['membergroups_members'] = 'สมาชิกทั่วไป';
$txt['membergroups_guests'] = 'ผู้มาเยือน';
$txt['membergroups_add_group'] = 'เพิ่มกลุ่ม';
$txt['membergroups_permissions'] = 'สิทธิ์';

$txt['permitgroups_restrict'] = 'จำกัด';
$txt['permitgroups_standard'] = 'มาตรฐาน';
$txt['permitgroups_moderator'] = 'ผู้ดูแล';
$txt['permitgroups_maintenance'] = 'การซ่อมบำรุง';
$txt['permitgroups_inherit'] = 'สืบทอด';

$txt['confirm_delete_attachments_all'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบไฟล์แนบทั้งหมด';
$txt['confirm_delete_attachments'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบไฟล์แนบที่เลือก';
$txt['attachment_manager_browse_files'] = 'เรียกดูไฟล์';
$txt['attachment_manager_repair'] = 'บำรุงรักษา';
$txt['attachment_manager_avatars'] = 'รูปประจำตัว';
$txt['attachment_manager_attachments'] = 'เอกสารแนบ';
$txt['attachment_manager_thumbs'] = 'รูปขนาดย่อ';
$txt['attachment_manager_last_active'] = 'ใช้งานล่าสุด';
$txt['attachment_manager_member'] = 'สมาชิก';
$txt['attachment_manager_avatars_older'] = 'ลบรูปประจำตัวออกจากสมาชิกที่ไม่ได้ใช้งานเกิน';
$txt['attachment_manager_total_avatars'] = 'รูปประจำตัวทั้งหมด';

$txt['attachment_manager_avatars_no_entries'] = 'ขณะนี้ไม่มีรูปประจำตัว';
$txt['attachment_manager_attachments_no_entries'] = 'ขณะนี้ไม่มีไฟล์แนบ';
$txt['attachment_manager_thumbs_no_entries'] = 'ขณะนี้ไม่มีภาพขนาดย่อ';

$txt['attachment_manager_settings'] = 'การตั้งค่าไฟล์แนบ';
$txt['attachment_manager_avatar_settings'] = 'การตั้งค่ารูปประจำตัว';
$txt['attachment_manager_browse'] = 'เรียกดูไฟล์';
$txt['attachment_manager_maintenance'] = 'การบำรุงรักษาไฟล์';
$txt['attachment_manager_save'] = 'บันทึก';

$txt['attachmentEnable'] = 'โหมดไฟล์แนบ';
$txt['attachmentEnable_deactivate'] = 'ปิดการใช้งานไฟล์แนบ';
$txt['attachmentEnable_enable_all'] = 'เปิดใช้งานไฟล์แนบทั้งหมด';
$txt['attachmentEnable_disable_new'] = 'ปิดการใช้งานไฟล์แนบใหม่';
$txt['attachmentCheckExtensions'] = 'ตรวจสอบนามสกุลของไฟล์แนบ';
$txt['attachmentExtensions'] = 'นามสกุลไฟล์แนบที่อนุญาต';
$txt['attachmentShowImages'] = 'แสดงไฟล์แนบรูปภาพเป็นรูปภาพใต้โพสต์';
$txt['attachmentUploadDir'] = 'ไดเรกทอรีไฟล์แนบ';
$txt['attachmentUploadDir_multiple_configure'] = 'จัดการไดเร็กทอรีไฟล์แนบ';
$txt['attachmentDirSizeLimit'] = 'พื้นที่ไดเรกทอรีไฟล์แนบสูงสุด';
$txt['attachmentPostLimit'] = 'ขนาดไฟล์แนบสูงสุดต่อโพสต์';
$txt['attachmentSizeLimit'] = 'ขนาดสูงสุดต่อไฟล์แนบ';
$txt['attachmentNumPerPostLimit'] = 'จำนวนไฟล์แนบสูงสุดต่อโพสต์';
$txt['attachment_img_enc_warning'] = 'ขณะนี้ไม่ได้ติดตั้งโมดูล GD หรือส่วนขยาย IMAgick หรือ MagickWand ไม่สามารถเข้ารหัสรูปภาพซ้ำได้';
$txt['attachment_ini_max'] = 'อนุญาตสูงสุดโดย php.ini: %1$s';
$txt['attachment_image_reencode'] = 'เข้ารหัสไฟล์แนบรูปภาพที่อาจเป็นอันตรายอีกครั้ง';
$txt['attachment_image_paranoid_warning'] = 'การตรวจสอบความปลอดภัยอย่างละเอียดอาจส่งผลให้มีไฟล์แนบที่ถูกปฏิเสธจำนวนมาก';
$txt['attachment_image_paranoid'] = 'ดำเนินการตรวจสอบความปลอดภัยอย่างละเอียดในไฟล์แนบของรูปภาพที่อัปโหลด';
$txt['attachmentThumbnails'] = 'ปรับขนาดภาพเมื่อแสดงใต้โพสต์';
$txt['attachment_thumb_png'] = 'บันทึกภาพขนาดย่อเป็น PNG';
$txt['attachment_thumb_memory'] = 'หน่วยความจำภาพขนาดย่อที่ปรับเปลี่ยนได้';
$txt['attachment_thumb_memory_note'] = 'If disabled, memory is limited to 128M';
$txt['attachmentThumbWidth'] = 'ความกว้างสูงสุดของภาพขนาดย่อ';
$txt['attachmentThumbHeight'] = 'ความสูงสูงสุดของภาพขนาดย่อ';
$txt['attachment_thumbnail_settings'] = 'การตั้งค่าภาพขนาดย่อ';
$txt['attachment_security_settings'] = 'การตั้งค่าความปลอดภัยของไฟล์แนบ';

$txt['attach_dir_does_not_exist'] = 'ไม่ได้อยู่';
$txt['attach_dir_not_writable'] = 'เขียนไม่ได้';
// argument(s): session_id, session_var, scripturl
$txt['attach_dir_files_missing'] = 'Files Missing (<a href="%3$s?action=admin;area=manageattachments;sa=repair;%2$s=%1$s">Repair</a>)';
$txt['attach_dir_unused'] = 'ไม่ได้ใช้';
$txt['attach_dir_empty'] = 'ว่างเปล่า';
$txt['attach_dir_ok'] = 'ตกลง';
$txt['attach_dir_basedir'] = 'ไดเรกทอรีฐาน';
$txt['attach_dir_desc'] = 'สร้างไดเร็กทอรีใหม่หรือเปลี่ยนไดเร็กทอรีปัจจุบันด้านล่าง <br>ในการสร้างไดเร็กทอรีใหม่ภายในโครงสร้างไดเร็กทอรีของฟอรัม ให้ใช้เพียงชื่อไดเร็กทอรี <br>หากต้องการลบไดเร็กทอรี ให้เว้นช่องป้อนข้อมูลพาธ สามารถลบได้เฉพาะไดเร็กทอรีว่าง หากต้องการดูว่าไดเร็กทอรีว่างหรือไม่ ให้ตรวจสอบไฟล์หรือไดเร็กทอรีย่อยในวงเล็บถัดจากจำนวนไฟล์ <br> ในการเปลี่ยนชื่อไดเร็กทอรี เพียงแค่เปลี่ยนชื่อในฟิลด์อินพุต เฉพาะไดเร็กทอรีที่ไม่มีไดเร็กทอรีย่อยเท่านั้นที่สามารถเปลี่ยนชื่อได้';
$txt['attach_dir_base_desc'] = 'คุณสามารถใช้พื้นที่ด้านล่างเพื่อเปลี่ยนไดเร็กทอรีฐานปัจจุบันหรือสร้างไดเร็กทอรีใหม่ ไดเร็กทอรีฐานใหม่จะถูกเพิ่มลงในรายการไดเร็กทอรีสิ่งที่แนบมาด้วย คุณยังสามารถกำหนดไดเร็กทอรีที่มีอยู่ให้เป็นไดเร็กทอรีฐาน';
$txt['attach_dir_save_problem'] = 'อ๊ะ ดูเหมือนว่าจะมีปัญหา';
$txt['attachments_no_create'] = 'ไม่สามารถสร้างไดเร็กทอรีไฟล์แนบใหม่ โปรดดำเนินการโดยใช้ไคลเอนต์ FTP หรือตัวจัดการไฟล์ไซต์ของคุณ';
$txt['attachments_no_write'] = 'ไดเร็กทอรีนี้ถูกสร้างขึ้นแล้ว แต่ไม่สามารถเขียนได้ โปรดพยายามดำเนินการโดยใช้ไคลเอนต์ FTP หรือตัวจัดการไฟล์ไซต์ของคุณ';
$txt['attach_dir_duplicate_msg'] = 'ไม่สามารถเพิ่ม มีไดเร็กทอรีนี้อยู่แล้ว';
$txt['attach_dir_exists_msg'] = 'ไม่สามารถเคลื่อนย้ายได้ มีไดเรกทอรีอยู่แล้วที่เส้นทางนั้น';
$txt['attach_dir_base_dupe_msg'] = 'ไม่สามารถเพิ่ม ไดเร็กทอรีฐานนี้ถูกสร้างขึ้นแล้ว';
$txt['attach_dir_base_no_create'] = 'สร้างไม่ได้ โปรดตรวจสอบอินพุตพาธหรือสร้างไดเร็กทอรีนี้โดยใช้ไคลเอ็นต์ FTP หรือตัวจัดการไฟล์ของไซต์แล้วลองอีกครั้ง';
$txt['attach_dir_no_rename'] = 'ไม่สามารถย้ายหรือเปลี่ยนชื่อ โปรดตรวจสอบว่าเส้นทางถูกต้องหรือไดเรกทอรีนี้ไม่มีไดเรกทอรีย่อยใดๆ';
$txt['attach_dir_no_delete'] = 'ไม่ว่างเปล่าและไม่สามารถลบได้ โปรดดำเนินการโดยใช้ไคลเอนต์ FTP หรือตัวจัดการไฟล์ไซต์ของคุณ';
$txt['attach_dir_no_remove'] = 'ยังคงมีไฟล์หรือเป็นไดเร็กทอรีฐานและไม่สามารถลบได้';
$txt['attach_dir_is_current'] = 'ไม่สามารถลบในขณะที่ถูกเลือกเป็นไดเร็กทอรีปัจจุบัน';
$txt['attach_dir_is_current_bd'] = 'ไม่สามารถลบในขณะที่ถูกเลือกเป็นไดเร็กทอรีฐานปัจจุบัน';
$txt['attach_dir_invalid'] = 'ไดเรกทอรีไม่ถูกต้อง';
$txt['attach_last_dir'] = 'ไดเร็กทอรีไฟล์แนบที่ใช้งานล่าสุด';
$txt['attach_current_dir'] = 'ไดเรกทอรีไฟล์แนบปัจจุบัน';
$txt['attach_current'] = 'ปัจจุบัน';
$txt['attach_path_manage'] = 'จัดการเส้นทางของไฟล์แนบ';
$txt['attach_directories'] = 'ไดเรกทอรีไฟล์แนบ';
$txt['attach_paths'] = 'เส้นทางไดเรกทอรีไฟล์แนบ';
$txt['attach_path'] = 'เส้นทาง';
$txt['attach_current_size'] = 'ขนาด (KB)';
$txt['attach_num_files'] = 'ไฟล์';
$txt['attach_dir_status'] = 'สถานะ';
$txt['attach_add_path'] = 'เพิ่มเส้นทาง';
$txt['attach_path_current_bad'] = 'เส้นทางของไฟล์แนบปัจจุบันไม่ถูกต้อง';
$txt['attachmentDirFileLimit'] = 'จำนวนไฟล์สูงสุดต่อไดเร็กทอรี';

$txt['attach_base_paths'] = 'เส้นทางไดเรกทอรีฐาน';
$txt['attach_num_dirs'] = 'ไดเรกทอรี';
$txt['max_image_width'] = 'ความกว้างสูงสุดของรูปภาพที่โพสต์หรือแนบ';
$txt['max_image_height'] = 'ความสูงของการแสดงรูปภาพที่โพสต์หรือแนบสูงสุด';

$txt['automanage_attachments'] = 'เลือกวิธีการจัดการไดเร็กทอรีไฟล์แนบ';
$txt['attachments_normal'] = '(ด้วยตนเอง) พฤติกรรมเริ่มต้นของ SMF';
$txt['attachments_auto_years'] = '(อัตโนมัติ) แบ่งตามปี';
$txt['attachments_auto_months'] = '(อัตโนมัติ) แบ่งตามปีและเดือน';
$txt['attachments_auto_days'] = '(อัตโนมัติ) แบ่งตามปี เดือน และวัน';
$txt['attachments_auto_16'] = '(อัตโนมัติ) 16 ไดเรกทอรีสุ่ม';
$txt['attachments_auto_16x16'] = '(อัตโนมัติ) 16 ไดเร็กทอรีสุ่ม 16 ไดเร็กทอรีย่อยแบบสุ่ม';
$txt['attachments_auto_space'] = '(อัตโนมัติ) เมื่อถึงขีดจำกัดพื้นที่ไดเร็กทอรีอย่างใดอย่างหนึ่ง';

$txt['use_subdirectories_for_attachments'] = 'สร้างไดเร็กทอรีใหม่ภายในไดเร็กทอรีฐาน';
$txt['use_subdirectories_for_attachments_note'] = 'มิฉะนั้น ไดเร็กทอรีใหม่จะถูกสร้างขึ้นภายในไดเร็กทอรีหลักของฟอรัม';
$txt['basedirectory_for_attachments'] = 'ตั้งค่าไดเร็กทอรีฐานสำหรับไฟล์แนบ';
$txt['basedirectory_for_attachments_current'] = 'ไดเรกทอรีฐานปัจจุบัน';
// argument(s): scripturl
$txt['basedirectory_for_attachments_warning'] = '<div class="smalltext">โปรดทราบว่าไดเร็กทอรีไม่ถูกต้อง <br>(<a href="%1$s?action=admin;area=manageattachments;sa=attachpaths">พยายามแก้ไข</a>)</div>';
// argument(s): scripturl
$txt['attach_current_dir_warning'] = '<div class="smalltext">ดูเหมือนว่าจะมีปัญหากับไดเรกทอรีนี้ <br>(<a href="%1$s?action=admin;area=manageattachments;sa=attachpaths">พยายามแก้ไข</a>)</div>';

$txt['attachment_transfer'] = 'การโอนไฟล์แนบ';
$txt['attachment_transfer_desc'] = 'ถ่ายโอนไฟล์ระหว่างไดเร็กทอรี';
$txt['attachment_transfer_select'] = 'เลือกไดเรกทอรี';
$txt['attachment_transfer_now'] = 'โอนย้าย';
$txt['attachment_transfer_from'] = 'โอนไฟล์จาก';
$txt['attachment_transfer_auto'] = 'โดยอัตโนมัติตามพื้นที่หรือจำนวนไฟล์';
$txt['attachment_transfer_auto_select'] = 'เลือกไดเรกทอรีฐาน';
$txt['attachment_transfer_to'] = 'หรือไปยังไดเร็กทอรีเฉพาะ';
$txt['attachment_transfer_empty'] = 'ล้างไดเรกทอรีต้นทาง';
$txt['attachment_transfer_no_base'] = 'ไม่มีไดเร็กทอรีฐาน';
$txt['attachment_transfer_forum_root'] = 'ไดเรกทอรีรากของฟอรั่ม';
$txt['attachment_transfer_no_room'] = 'ถึงขีดจำกัดขนาดไดเรกทอรีหรือจำนวนไฟล์แล้ว';
$txt['attachment_transfer_no_find'] = 'ไม่พบไฟล์ที่จะโอน';
$txt['attachments_transferred'] = 'โอน %1$d ไฟล์ไปที่ %2$s แล้ว';
$txt['attachments_not_transferred'] = '%1$d ไฟล์ไม่ถูกโอน';
$txt['attachment_transfer_no_dir'] = 'ไม่ได้เลือกไดเร็กทอรีต้นทางหรือตัวเลือกเป้าหมายอย่างใดอย่างหนึ่ง';
$txt['attachment_transfer_same_dir'] = 'คุณไม่สามารถเลือกไดเร็กทอรีเดียวกันเป็นทั้งต้นทางและปลายทาง';
$txt['attachment_transfer_progress'] = 'โปรดรอ กำลังดำเนินการโอน';

$txt['mods_cat_avatars'] = 'รูปประจำตัว';
$txt['avatar_directory'] = 'ไดเรกทอรีรูปประจำตัว';
$txt['avatar_directory_wrong'] = 'ไดเร็กทอรีรูปประจำตัวไม่ถูกต้อง ซึ่งจะทำให้เกิดปัญหาหลายประการกับฟอรัมของคุณ';
$txt['avatar_url'] = 'URLรูปประจำต้ว';
$txt['avatar_max_width_external'] = 'ความกว้างสูงสุดของรูปประจำตัวภายนอก';
$txt['avatar_max_height_external'] = 'ความสูงสูงสุดของรูปประจำตัวภายนอก';
$txt['avatar_action_too_large'] = 'ถ้ารูปประจำตัวใหญ่เกินไป...';
$txt['option_refuse'] = 'ปฏิเสธมัน';
$txt['option_css_resize'] = 'ปรับขนาดในเบราว์เซอร์ของผู้ใช้';
$txt['option_download_and_resize'] = 'ดาวน์โหลดและปรับขนาดบนเซิร์ฟเวอร์';
$txt['avatar_max_width_upload'] = 'ความกว้างสูงสุดของรูปประจำตัวที่อัปโหลด';
$txt['avatar_max_height_upload'] = 'ความสูงสูงสุดของรูปประจำตัวที่อัปโหลด';
$txt['avatar_resize_upload'] = 'ปรับขนาดรูปประจำตัวขนาดใหญ่';
$txt['avatar_resize_upload_note'] = '(ต้องใช้โมดูล GD หรือ ImageMagick ที่มีส่วนขยาย IMAgick หรือ MagickWand)';
$txt['avatar_download_png'] = 'ใช้ PNG สำหรับการปรับขนาดรูปประจำตัว';
$txt['avatar_img_enc_warning'] = 'ขณะนี้ไม่ได้ติดตั้งโมดูล GD หรือส่วนขยาย Imagick หรือ MagickWand คุณสมบัติรูปประจำตัวบางอย่างถูกปิดใช้งาน';
$txt['avatar_external'] = 'รูปประจำตัวภายนอก';
$txt['avatar_upload'] = 'รูปประจำตัวที่อัปโหลดได้';
$txt['avatar_server_stored'] = 'รูปประจำตัวที่จัดเก็บโดยเซิร์ฟเวอร์';
$txt['avatar_server_stored_groups'] = 'กลุ่มสมาชิกที่ได้รับอนุญาตให้เลือกเซิร์ฟเวอร์ที่จัดเก็บรูปประจำตัว';
$txt['avatar_upload_groups'] = 'กลุ่มสมาชิกได้รับอนุญาตให้อัปโหลดรูปประจำตัวไปยังเซิร์ฟเวอร์';
$txt['avatar_external_url_groups'] = 'กลุ่มสมาชิกที่ได้รับอนุญาตให้เลือก URL ภายนอก';
$txt['avatar_select_permission'] = 'เลือกการอนุญาตสำหรับแต่ละกลุ่ม';
$txt['avatar_download_external'] = 'ดาวน์โหลดรูปประจำตัวตาม URL ที่กำหนด';
$txt['option_specified_dir'] = 'ไดเรกทอรีเฉพาะ...';
$txt['custom_avatar_dir_wrong'] = 'The Upload directory is not valid. This will prevent custom avatars from working properly.';
$txt['custom_avatar_dir'] = 'อัปโหลดไดเรกทอรี';
$txt['custom_avatar_dir_desc'] = 'นี่ควรเป็นไดเร็กทอรีที่ถูกต้องและสามารถเขียนได้ ซึ่งแตกต่างจากไดเร็กทอรีที่เซิร์ฟเวอร์เก็บไว้';
$txt['custom_avatar_url'] = 'อัปโหลด URL';
$txt['custom_avatar_check_empty'] = 'ไดเร็กทอรีรูปประจำตัวแบบกำหนดเองที่คุณระบุอาจว่างเปล่าหรือไม่ถูกต้อง โปรดตรวจสอบให้แน่ใจว่าการตั้งค่าเหล่านี้ถูกต้อง';
$txt['avatar_reencode'] = 'เข้ารหัสรูปประจำตัวที่อาจเป็นอันตรายอีกครั้ง';
$txt['avatar_paranoid_warning'] = 'การตรวจสอบความปลอดภัยอย่างละเอียดอาจส่งผลให้มีรูปประจำตัวจำนวนมากที่ถูกปฏิเสธ';
$txt['avatar_paranoid'] = 'ดำเนินการตรวจสอบความปลอดภัยอย่างละเอียดในรูปประจำตัวที่อัปโหลด';
$txt['gravatar_settings'] = 'Gravatar';
$txt['gravatarEnabled'] = 'เปิดใช้งาน Gravatar สำหรับผู้ใช้ฟอรัมหรือไม่';
$txt['gravatarOverride'] = 'บังคับให้ใช้ Gravatar แทนรูปประจำตัวปกติหรือไม่?';
$txt['gravatarAllowExtraEmail'] = 'อนุญาตให้จัดเก็บที่อยู่อีเมลเพิ่มเติมสำหรับ Gravatar หรือไม่';
$txt['gravatarMaxRating'] = 'เรทสูงสุดที่อนุญาต?';
$txt['gravatar_maxG'] = 'เรท G (ยอมรับได้โดยทั่วไป)';
$txt['gravatar_maxPG'] = 'เรท PG (คำแนะนำจากผู้ปกครอง)';
$txt['gravatar_maxR'] = 'เรท R (จำกัด)';
$txt['gravatar_maxX'] = 'เรท X (ชัดเจน)';
$txt['gravatarDefault'] = 'รูปภาพเริ่มต้นที่จะแสดงเมื่อที่อยู่อีเมลไม่มี Gravatar ที่ตรงกัน';
$txt['gravatar_mm'] = 'โครงร่างเงาบุคคลสไตล์การ์ตูนที่เรียบง่าย';
$txt['gravatar_identicon'] = 'รูปแบบทางเรขาคณิตตามแฮชอีเมล';
$txt['gravatar_monsterid'] = '\'มอนสเตอร์\' ที่สร้างขึ้นด้วยสี ใบหน้า และอื่นๆ';
$txt['gravatar_wavatar'] = 'ใบหน้าที่สร้างด้วยคุณสมบัติและภูมิหลังที่แตกต่างกัน';
$txt['gravatar_retro'] = 'ใบหน้าพิกเซลสไตล์อาร์เคด 8 บิตที่สร้างขึ้นอย่างยอดเยี่ยม';
$txt['gravatar_blank'] = 'ภาพ PNG แบบโปร่งใส';

$txt['repair_attachments'] = 'รักษาไฟล์แนบ';
$txt['repair_attachments_complete'] = 'การบำรุงรักษาเสร็จสมบูรณ์';
$txt['repair_attachments_complete_desc'] = 'ข้อผิดพลาดที่เลือกทั้งหมดได้รับการแก้ไขแล้ว';
$txt['repair_attachments_no_errors'] = 'ไม่พบข้อผิดพลาด';
$txt['repair_attachments_error_desc'] = 'พบข้อผิดพลาดต่อไปนี้ระหว่างการบำรุงรักษา ทำเครื่องหมายที่ช่องถัดจากข้อผิดพลาดที่คุณต้องการแก้ไขและกดดำเนินการต่อ';
$txt['repair_attachments_continue'] = 'ดำเนินการต่อ';
$txt['repair_attachments_cancel'] = 'ยกเลิก';
$txt['attach_repair_missing_thumbnail_parent'] = '%1$d ภาพขนาดย่อไม่มีไฟล์แนบระดับบนสุด';
$txt['attach_repair_parent_missing_thumbnail'] = '%1$d ผู้ปกครองถูกตั้งค่าสถานะว่ามีภาพขนาดย่อแต่ไม่มี';
$txt['attach_repair_file_missing_on_disk'] = '%1$d ไฟล์แนบ/รูปประจำตัวมีรายการแต่ไม่มีอยู่ในดิสก์แล้ว';
$txt['attach_repair_file_wrong_size'] = '%1$d ไฟล์แนบ/รูปประจำตัวกำลังถูกรายงานเนื่องจากขนาดไฟล์ไม่ถูกต้อง';
$txt['attach_repair_file_size_of_zero'] = '%1$d ไฟล์แนบ/รูปประจำตัวมีขนาดเท่ากับศูนย์บนดิสก์ (สิ่งเหล่านี้จะถูกลบ)';
$txt['attach_repair_attachment_no_msg'] = '%1$d ไฟล์แนบไม่มีข้อความที่เชื่อมโยงอีกต่อไป';
$txt['attach_repair_avatar_no_member'] = 'รูปประจำตัว %1$d รูปไม่มีสมาชิกที่เชื่อมโยงกับพวกเขาอีกต่อไป';
$txt['attach_repair_wrong_folder'] = '%1$d ไฟล์แนบอยู่ในไดเรกทอรีที่ไม่ถูกต้อง';
$txt['attach_repair_files_without_attachment'] = '%1$d ไฟล์ไม่มีรายการที่เกี่ยวข้องในฐานข้อมูล (สิ่งเหล่านี้จะถูกลบ)';

$txt['news_title'] = 'ข่าวสารและจดหมายข่าว';
$txt['news_settings_desc'] = 'คุณสามารถเปลี่ยนการตั้งค่าและการอนุญาตที่เกี่ยวข้องกับข่าวสารและจดหมายข่าวได้ที่นี่';
$txt['news_mailing_desc'] = 'จากเมนูนี้ คุณสามารถส่งข้อความถึงสมาชิกทุกคนที่ลงทะเบียนและป้อนที่อยู่อีเมลของพวกเขา คุณสามารถแก้ไขรายชื่อการแจกจ่ายหรือส่งข้อความถึงทุกคน มีประโยชน์สำหรับข้อมูลอัปเดต/ข่าวสารที่สำคัญ';
$txt['news_error_no_news'] = 'ไม่มีอะไรเขียน';
$txt['groups_edit_news'] = 'กลุ่มอนุญาตให้แก้ไขรายการข่าว';
$txt['groups_send_mail'] = 'กลุ่มที่ได้รับอนุญาตให้ส่งจดหมายข่าวฟอรัม';
$txt['xmlnews_enable'] = 'เปิดใช้งานข่าว XML/RSS';
$txt['xmlnews_maxlen'] = 'ความยาวข้อความสูงสุด';
$txt['xmlnews_maxlen_note'] = '(0 เพื่อปิดการใช้งาน ไอ้เวร...)';
$txt['xmlnews_attachments'] = 'แนบไฟล์แนบในฟีด XML/RSS';
$txt['xmlnews_attachments_note'] = 'หมายเหตุ: รูปแบบฟีดบางรูปแบบจะแนบไฟล์แนบหนึ่งไฟล์ต่อโพสต์เท่านั้น';
$txt['editnews_clickadd'] = 'เพิ่มอีกรายการ';
$txt['editnews_remove_selected'] = 'ลบรายการที่เลือก';
$txt['editnews_remove_confirm'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบรายการข่าวที่เลือก';
$txt['censor_clickadd'] = 'เพิ่มอีกคำ';

$txt['layout_controls'] = 'ฟอรั่ม';
$txt['logs'] = 'บันทึก';
$txt['generate_reports'] = 'รายงาน';

$txt['update_available'] = 'อัพเดทพร้อมใช้งาน';
$txt['update_message'] = 'You\'re using an outdated version of SMF, which contains some bugs which have since been fixed.
	It is recommended that you <a href="#" id="update-link" class="bbc_link strong">update your forum</a> to the latest version as soon as possible. It only takes a minute!';

$txt['manageposts'] = 'กระทู้และหัวข้อ';
$txt['manageposts_title'] = 'จัดการกระทู้และหัวข้อ';
$txt['manageposts_description'] = 'คุณสามารถจัดการการตั้งค่าทั้งหมดที่เกี่ยวข้องกับหัวข้อและกระทู้ได้ที่นี่';

$txt['manageposts_seconds'] = 'วินาที';
$txt['manageposts_minutes'] = 'นาที';
$txt['manageposts_characters'] = 'ตัวอักษร';
$txt['manageposts_days'] = 'วัน';
$txt['manageposts_posts'] = 'กระทู้';
$txt['manageposts_topics'] = 'หัวข้อ';

$txt['manageposts_settings'] = 'การตั้งค่ากระทู้';
$txt['manageposts_settings_description'] = 'คุณสามารถตั้งค่าทุกอย่างที่เกี่ยวข้องกับกระทู้และการตั้งกระทู้ได้ที่นี่';

$txt['manageposts_bbc_settings'] = 'รหัสบอร์ด (Bulletin Board Code)';
$txt['manageposts_bbc_settings_description'] = 'รหัสบอร์ดสามารถใช้เพื่อเพิ่มมาร์กอัปในข้อความในฟอรัม ตัวอย่างเช่น หากต้องการเน้นคำว่า \'บ้าน\' คุณสามารถพิมพ์ [b]บ้าน[/b] แท็กรหัสกระดานข่าวทั้งหมดล้อมรอบด้วยวงเล็บเหลี่ยม (\'[\' และ \']\')';
$txt['manageposts_bbc_settings_title'] = 'การตั้งค่ารหัสบอร์ด';

$txt['manageposts_topic_settings'] = 'ตั้งค่าหัวข้อ';
$txt['manageposts_topic_settings_description'] = 'คุณสามารถตั้งค่าทั้งหมดที่เกี่ยวข้องกับหัวข้อได้ที่นี่';

$txt['managedrafts_settings'] = 'การตั้งค่าแบบร่าง';
$txt['managedrafts_settings_description'] = 'คุณสามารถตั้งค่าทั้งหมดที่เกี่ยวข้องกับแบบร่างได้ที่นี่';
$txt['manage_drafts'] = 'แบบร่าง';

$txt['removeNestedQuotes'] = 'ลบเครื่องหมายคำพูดที่ซ้อนกันเมื่ออ้างอิง';
$txt['disable_wysiwyg'] = 'ปิดการใช้งานตัวแก้ไข WYSIWYG';
$txt['max_messageLength'] = 'ขนาดกระทู้สูงสุดที่อนุญาต';
$txt['max_messageLength_zero'] = '0 ไม่จำกัดจำนวน';
$txt['convert_to_mediumtext'] = 'ฐานข้อมูลของคุณไม่ได้รับการกำหนดค่าให้ยอมรับข้อความที่ยาวเกิน 65535 อักขระ โปรดใช้หน้า<a href="%1$s">การบำรุงรักษาฐานข้อมูล</a>เพื่อแปลงฐานข้อมูล จากนั้นกลับมาเพิ่มขนาดโพสต์สูงสุดที่อนุญาต';
$txt['topicSummaryPosts'] = 'กระทู้ที่จะแสดงในสรุปหัวข้อ';
$txt['spamWaitTime'] = 'เวลาที่ต้องการระหว่างกระทู้จาก IP เดียวกัน';
$txt['edit_wait_time'] = 'เวลารอแก้ไขมารยาท';
$txt['edit_disable_time'] = 'เวลาสูงสุดหลังจากตั้งกระทู้เพื่อให้สามารถแก้ไขได้';
$txt['preview_characters'] = 'ความยาวสูงสุดของการแสดงตัวอย่างกระทู้ล่าสุด/ครั้งแรก';
$txt['preview_characters_units'] = 'ตัวอักษร';
$txt['quote_expand'] = 'ความสูงของคำพูดขั้นต่ำเพื่อเพิ่มลิงก์ขยายบนเครื่องหมายคำพูดขนาดใหญ่';
$txt['quote_expand_pixels_units'] = 'พิกเซล';
$txt['message_index_preview_first'] = 'เมื่อใช้ตัวอย่างกระทู้ ให้แสดงข้อความของกระทู้แรก';
$txt['message_index_preview_first_desc'] = 'ปล่อยว่างไว้เพื่อแสดงข้อความของกระทู้ที่แล้วแทน';
$txt['show_user_images'] = 'แสดงรูปประจำตัวของผู้ใช้ในมุมมองข้อความ';
$txt['show_blurb'] = 'แสดงข้อความส่วนตัวในมุมมองข้อความ';
$txt['hide_post_group'] = 'ซ่อนชื่อกลุ่มโพสต์สำหรับสมาชิกที่จัดกลุ่ม';
$txt['hide_post_group_desc'] = 'การเปิดใช้งานนี้จะไม่แสดงชื่อกลุ่มโพสต์ของสมาชิกในมุมมองข้อความ ถ้าพวกเขาถูกกำหนดให้กับกลุ่มที่ไม่ใช่กระทู้';
$txt['subject_toggle'] = 'แสดงหัวเรื่องในหัวข้อ';
$txt['show_profile_buttons'] = 'แสดงปุ่มดูโปรไฟล์ใต้กระทู้';
$txt['show_modify'] = 'แสดงวันที่แก้ไขล่าสุดในกระทู้ที่แก้ไข';

$txt['enableBBC'] = 'เปิดใช้งานรหัสบอร์ด (bulletin board code)';
$txt['enablePostHTML'] = 'เปิดใช้งาน HTML <em>พื้นฐาน</em>ในโพสต์';
$txt['autoLinkUrls'] = 'เชื่อมโยง URL โดยอัตโนมัติ';
$txt['disabledBBC'] = 'เปิดใช้งานแท็กรหัสบอร์ด';
$txt['legacyBBC'] = 'แท็กรหัสบอร์ดดั้งเดิม';
$txt['bbcTagsToUse'] = 'ใช้งานแท็ก BBC';
$txt['enabled_bbc_select'] = 'เลือกแท็กที่อนุญาตให้ใช้';
$txt['enabled_bbc_select_all'] = 'เลือกแท็กทั้งหมด';
$txt['groups_can_use'] = 'กลุ่มสมาชิกได้รับอนุญาตให้ใช้ %1$s';

$txt['enableParticipation'] = 'เปิดใช้งานไอคอนการมีส่วนร่วม';
$txt['oldTopicDays'] = 'เวลาก่อนหัวข้อถูกเตือนว่าเก่าเมื่อตอบกลับ';
$txt['defaultMaxTopics'] = 'จำนวนหัวข้อต่อหน้าในดัชนีข้อความ';
$txt['defaultMaxMessages'] = 'จำนวนข้อความต่อหน้าในหน้าหัวข้อ';
$txt['disable_print_topic'] = 'ปิดใช้งานคุณสมบัติการพิมพ์หัวข้อ';
$txt['enableAllMessages'] = 'ขนาดหัวข้อสูงสุดที่จะแสดงกระทู้&quot;ทั้งหมด&quot;';
$txt['enableAllMessages_zero'] = '0 ที่จะไม่แสดง&quot;ทั้งหมด&quot;';
$txt['disableCustomPerPage'] = 'ปิดใช้งานจำนวนหัวข้อ/ข้อความที่ผู้ใช้กำหนดต่อหน้า';
$txt['enablePreviousNext'] = 'เปิดใช้งานลิงก์หัวข้อก่อนหน้า/ถัดไป';

$txt['not_done_title'] = 'ยังไม่เสร็จ';
$txt['not_done_reason'] = 'เพื่อหลีกเลี่ยงไม่ให้เซิร์ฟเวอร์ของคุณทำงานหนักเกินไป กระบวนการนี้จึงหยุดชั่วคราว ควรดำเนินการต่อโดยอัตโนมัติในไม่กี่วินาที หากไม่เป็นเช่นนั้น โปรดคลิกดำเนินการต่อด้านล่าง';
$txt['not_done_continue'] = 'ดำเนินการต่อ';

$txt['general_settings'] = 'ทั่วไป';
$txt['database_settings'] = 'ฐานข้อมูล';
$txt['cookies_sessions_settings'] = 'คุกกี้และวาระ';
$txt['security_settings'] = 'ความปลอดภัย';
$txt['caching_settings'] = 'แคช';
$txt['export_settings'] = 'การส่งออกข้อมูล';
$txt['load_balancing_settings'] = 'โหลดบาลานซ์';
$txt['phpinfo_settings'] = 'ข้อมูล PHP';
$txt['phpinfo_localsettings'] = 'การตั้งค่าท้องถิ่น';
$txt['phpinfo_defaultsettings'] = 'การตั้งค่าเริ่มต้น';
$txt['phpinfo_itemsettings'] = 'การตั้งค่า';

$txt['language_configuration'] = 'ภาษา';
$txt['language_description'] = 'ส่วนนี้อนุญาตให้คุณแก้ไขภาษาที่ติดตั้งในฟอรัมของคุณและดาวน์โหลดภาษาใหม่ได้จากเว็บไซต์ Simple Machines คุณสามารถแก้ไขการตั้งค่าเกี่ยวกับภาษาได้ที่นี่';
$txt['language_edit'] = 'แก้ไขภาษา';
$txt['language_add'] = 'เพิ่มภาษา';
$txt['language_settings'] = 'การตั้งค่า';
$txt['could_not_language_backup'] = 'ไม่สามารถทำการสำรองข้อมูลก่อนที่จะลบชุดภาษานี้ ส่งผลให้ไม่มีการเปลี่ยนแปลงใดๆ ในขณะนี้ (เปลี่ยนการอนุญาตเพื่อให้สามารถเขียนแพ็คเกจ/สำรองข้อมูล หรือปิดการสำรองข้อมูล - ไม่แนะนำ)';

$txt['advanced'] = 'ขั้นสูง';
$txt['simple'] = 'เรียบง่าย';

$txt['admin_news_newsletter_queue_done'] = 'เพิ่มจดหมายข่าวไปยังคิวจดหมายเรียบร้อยแล้ว';
$txt['admin_news_select_recipients'] = 'โปรดเลือกผู้ที่จะได้รับสำเนาจดหมายข่าว';
$txt['admin_news_select_group'] = 'กลุ่มสมาชิก';
$txt['admin_news_select_group_desc'] = 'เลือกกลุ่มที่จะได้รับจดหมายข่าวนี้';
$txt['admin_news_select_members'] = 'สมาชิก';
$txt['admin_news_select_members_desc'] = 'สมาชิกเพิ่มเติมเพื่อรับจดหมายข่าว';
$txt['admin_news_select_excluded_members'] = 'ไม่รวมสมาชิก';
$txt['admin_news_select_excluded_members_desc'] = 'สมาชิกที่ไม่ควรรับจดหมายข่าว';
$txt['admin_news_select_excluded_groups'] = 'กลุ่มที่ยกเว้น';
$txt['admin_news_select_excluded_groups_desc'] = 'เลือกกลุ่มที่ไม่ควรรับจดหมายข่าวอย่างแน่นอน';
$txt['admin_news_select_email'] = 'ที่อยู่อีเมล';
$txt['admin_news_select_email_desc'] = 'A semi-colon separated list of email addresses which should be sent a newsletter (i.e. address1; address2). This is additional to the groups listed above.<br><span class="alert">Note: You must manually handle any unsubscribe requests regarding newsletters sent to these email addresses.</span>';
$txt['admin_news_select_override_notify'] = 'แทนที่การตั้งค่าการแจ้งเตือน';
// Use entities in below.
$txt['admin_news_cannot_pm_emails_js'] = 'คุณไม่สามารถส่งข้อความส่วนตัวไปยังที่อยู่อีเมลได้ หากคุณดำเนินการต่อที่อยู่อีเมลที่ป้อนทั้งหมดจะถูกละเว้น\n\nคุณแน่ใจหรือไม่ว่าต้องการดำเนินการนี้';

$txt['mailqueue_browse'] = 'เรียกดูคิว';
$txt['mailqueue_settings'] = 'การตั้งค่า';
$txt['mailqueue_test'] = 'ส่งแบบทดสอบ';

$txt['admin_search'] = 'ค้นหาอย่างรวดเร็ว';
$txt['admin_search_type_internal'] = 'งาน/การตั้งค่า';
$txt['admin_search_type_member'] = 'สมาชิก';
$txt['admin_search_type_online'] = 'คู่มือออนไลน์';
$txt['admin_search_go'] = 'ไป';
$txt['admin_search_results'] = 'ผลการค้นหา';
$txt['admin_search_results_desc'] = 'ผลลัพธ์สำหรับการค้นหา: &quot;%1$s&quot;';
$txt['admin_search_results_again'] = 'ค้นหาอีกครั้ง';
$txt['admin_search_results_none'] = 'ไม่พบผลลัพธ์';

$txt['admin_search_section_sections'] = 'ส่วน';
$txt['admin_search_section_settings'] = 'การตั้งค่า';

$txt['mods_cat_features'] = 'ทั่วไป';
$txt['antispam_title'] = 'ป้องกันสแปม';
$txt['mods_cat_modifications_misc'] = 'เบ็ดเตล็ด';
$txt['mods_cat_layout'] = 'เลย์เอาต์';
$txt['moderation_settings_short'] = 'การดูแล';
$txt['signature_settings_short'] = 'ลายเซ็น';
$txt['custom_profile_shorttitle'] = 'ฟิลด์โปรไฟล์';
$txt['pruning_title'] = 'ล้างการบันทึก';
$txt['pruning_desc'] = 'ตัวเลือกต่อไปนี้มีประโยชน์ในการป้องกันไม่ให้บันทึกของคุณมีขนาดใหญ่เกินไป เนื่องจากรายการเก่าส่วนใหญ่ไม่ได้มีประโยชน์มากมายขนาดนั้น';
$txt['log_settings'] = 'การตั้งค่าบันทึก';

$txt['boards_edit'] = 'แก้ไขบอร์ด';
$txt['mboards_new_cat'] = 'สร้างหมวดหมู่ใหม่';
$txt['manage_holidays'] = 'จัดการวันหยุด';
$txt['calendar_settings'] = 'การตั้งค่าปฏิทิน';
$txt['search_weights'] = 'น้ำหนัก';
$txt['search_method'] = 'วิธีค้นหา';

$txt['smiley_sets'] = 'ชุดรูปแสดงอารมณ์';
$txt['smileys_add'] = 'เพิ่มรูปแสดงอารมณ์';
$txt['smileys_edit'] = 'แก้ไขรูปแสดงอารมณ์';
$txt['smileys_set_order'] = 'ตั้งค่าลำดับรูปแสดงอารมณ์';
$txt['icons_edit_message_icons'] = 'ไอคอนข้อความ';

$txt['membergroups_new_group'] = 'เพิ่มกลุ่มสมาชิก';
$txt['membergroups_edit_groups'] = 'แก้ไขกลุ่มสมาชิก';
$txt['permissions_groups'] = 'สิทธิ์ทั่วไป';
$txt['permissions_boards'] = 'สิทธิ์ของบอร์ด';
$txt['permissions_profiles'] = 'แก้ไขโปรไฟล์';
$txt['permissions_post_moderation'] = 'การดูแลกระทู้';

$txt['browse_packages'] = 'เรียกดูแพ็คเกจ';
$txt['download_packages'] = 'เพิ่มแพ็คเกจ';
$txt['installed_packages'] = 'แพ็คเกจที่ติดตั้ง';
$txt['package_file_perms'] = 'สิทธิ์ของไฟล์';
$txt['package_settings'] = 'ตัวเลือก';
$txt['themeadmin_admin_title'] = 'จัดการและติดตั้ง';
$txt['themeadmin_list_title'] = 'การตั้งค่าธีม';
$txt['themeadmin_reset_title'] = 'ตัวเลือกสมาชิก';
$txt['themeadmin_edit_title'] = 'แก้ไขธีม';
$txt['admin_browse_register_new'] = 'สมัครสมาชิกใหม่';

$txt['search_engines'] = 'เครื่องมือค้นหา';
$txt['spiders'] = 'แมงมุม';
$txt['spider_logs'] = 'บันทึกแมงมุม';
$txt['spider_stats'] = 'สถิติ';

$txt['paid_subscriptions'] = 'สมัครสมาชิกแบบชำระเงิน';
$txt['paid_subs_view'] = 'ดูการสมัครสมาชิก';

$txt['hooks_title_list'] = 'ตะขอบูรณาการ';
$txt['hooks_field_hook_name'] = 'ชื่อตะขอ';
$txt['hooks_field_function_name'] = 'ชื่อฟังก์ชัน';
$txt['hooks_field_function_method'] = 'ฟังก์ชันคือเมธอดและคลาสของมันถูกสร้างอินสแตนซ์';
$txt['hooks_field_function'] = 'ฟังก์ชัน';
$txt['hooks_field_included_file'] = 'รวมไฟล์';
$txt['hooks_field_file_name'] = 'ชื่อไฟล์';
$txt['hooks_field_hook_exists'] = 'สถานะ';
$txt['hooks_active'] = 'มีอยู่';
$txt['hooks_disabled'] = 'ปิดใช้งาน';
$txt['hooks_missing'] = 'ไม่พบ';
$txt['hooks_temp'] = 'Temporary';
$txt['hooks_no_hooks'] = 'ขณะนี้ไม่มีตะขอในระบบ';
$txt['hooks_button_remove'] = 'ลบ';
$txt['hooks_disable_instructions'] = 'คลิกที่ไอคอนสถานะเพื่อเปิดหรือปิดใช้งานตะขอ';
$txt['hooks_disable_legend'] = 'ลีเจนต์';
$txt['hooks_disable_legend_exists'] = 'ตะขอมีอยู่และใช้งานอยู่';
$txt['hooks_disable_legend_disabled'] = 'ตะขอมีอยู่ แต่ถูกปิดการใช้งาน';
$txt['hooks_disable_legend_missing'] = 'ไม่พบตะขอ';
$txt['hooks_disable_legend_temp'] = 'the hook is temporary';
$txt['hooks_disable_legend_temp_missing'] = 'temporary hook not found';
$txt['hooks_reset_filter'] = 'ไม่มีตัวกรอง';

$txt['board_perms_allow'] = 'อนุญาต';
$txt['board_perms_ignore'] = 'ไม่สนใจ';
$txt['board_perms_deny'] = 'ปฏิเสธ';
$txt['all_boards_in_cat'] = 'บอร์ดทั้งหมดในหมวดนี้';

$txt['likes_like'] = 'อนุญาตให้กลุ่มสมาชิกกดถูกใจโพสต์';

$txt['mention'] = 'กลุ่มสมาชิกได้รับอนุญาตให้พูดถึงผู้ใช้';

$txt['notifications'] = 'การแจ้งเตือน';
$txt['notify_settings'] = 'การตั้งค่าการแจ้งเตือน';
$txt['notifications_desc'] = 'หน้านี้อนุญาตให้คุณตั้งค่าตัวเลือกการแจ้งเตือนเริ่มต้นสำหรับผู้ใช้';
 // The GDPR page of the EU exists in several languages; change the language code at the end of the url
$txt['notify_announcements_desc'] = 'Enabling this default option violates the rules of the <a href="https://ec.europa.eu/info/law/law-topic/data-protection/eu-data-protection-rules_en" target="_blank" rel="noopener" class="bbc_link">GDPR</a> and many other countries\' privacy and anti-spam laws.';

$txt['enable_sm_stats'] = 'อนุญาตการเก็บสถิติ';

?>