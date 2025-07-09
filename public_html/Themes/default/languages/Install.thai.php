<?php
// Version: 2.1.3; Install

// These should be the same as those in index.language.php.
$txt['lang_character_set'] = 'UTF-8';
$txt['lang_rtl'] = '0';

$txt['install_step_welcome'] = 'ยินดีต้อนรับ';
$txt['install_step_writable'] = 'ตรวจสอบการเขียนไฟล์';
$txt['install_step_forum'] = 'การตั้งค่าฟอรัม';
$txt['install_step_databaseset'] = 'การตั้งค่าฐานข้อมูล';
$txt['install_step_databasechange'] = 'เติมฐานข้อมูล';
$txt['install_step_admin'] = 'บัญชีผู้ดูแลระบบ';
$txt['install_step_delete'] = 'เสร็จสิ้นการติดตั้ง';

$txt['smf_installer'] = 'โปรแกรมติดตั้ง SMF';
$txt['installer_language'] = 'ภาษา';
$txt['installer_language_set'] = 'ตั้งค่า';
$txt['congratulations'] = 'ยินดีด้วย กระบวนการติดตั้งเสร็จสมบูรณ์!';
$txt['congratulations_help'] = 'หากคุณต้องการความช่วยเหลือเมื่อใดก็ตาม หรือ SMF ทำงานไม่ถูกต้อง โปรดอย่าลืมว่า <a href="https://www.simplemachines.org/community/index.php" target="_blank" rel="noopener">มีความช่วยเหลือ</a>หากคุณต้องการ';
$txt['still_writable'] = 'ไดเร็กทอรีการติดตั้งของคุณยังคงเขียนได้ เป็นความคิดที่ดีที่จะ chmod เพื่อไม่ให้เขียนได้ด้วยเหตุผลด้านความปลอดภัย';
$txt['delete_installer'] = 'คลิกที่นี่เพื่อลบไฟล์ install.php ทันที';
$txt['delete_installer_maybe'] = '<em>(ไม่สามารถใช้ได้กับทุกเซิร์ฟเวอร์)</em>';
$txt['go_to_your_forum'] = 'ตอนนี้คุณสามารถดู<a href="%1$s">ฟอรัมที่เพิ่งติดตั้งใหม่ของคุณ</a>และเริ่มใช้งานได้ ก่อนอื่นคุณควรตรวจสอบให้แน่ใจว่าคุณได้เข้าสู่ระบบแล้ว หลังจากนั้นคุณจะสามารถเข้าถึงศูนย์การจัดการได้';
$txt['good_luck'] = 'ขอให้โชคดี!<br>Simple Machines';

$txt['install_welcome'] = 'ยินดีต้อนรับ';
$txt['install_welcome_desc'] = 'ยินดีต้อนรับสู่ SMF สคริปต์นี้จะแนะนำคุณตลอดขั้นตอนการติดตั้ง %1$s เราจะรวบรวมรายละเอียดเล็กน้อยเกี่ยวกับฟอรัมของคุณในไม่กี่ขั้นตอนถัดไป และหลังจากนั้นไม่กี่นาทีฟอรัมของคุณจะพร้อมใช้งาน';
$txt['install_no_https'] = 'สภาพแวดล้อมของคุณไม่รองรับสตรีม https ฟังก์ชันบางอย่าง เช่น การรับการอัปเดตจาก simplemachines.org จะไม่ทำงาน';
$txt['install_no_mbstring'] = 'สภาพแวดล้อมของคุณไม่สนับสนุนไลบรารี mbstring ที่จำเป็น โปรดเปิดใช้งาน mbstring แล้วลองอีกครั้ง';
$txt['install_no_fileinfo'] = 'Your environment does not support the required fileinfo library.  Please enable fileinfo and try again.';
$txt['install_all_lovely'] = 'เราได้ทำการทดสอบเบื้องต้นบนเซิร์ฟเวอร์ของคุณเสร็จสิ้นแล้ว และทุกอย่างดูเหมือนจะเป็นไปตามลำดับ เพียงคลิกปุ่ม &quot;ดำเนินการต่อ&quot; ด้านล่างเพื่อเริ่มต้น';

$txt['user_refresh_install'] = 'ฟอรั่มรีเฟรช';
$txt['user_refresh_install_desc'] = 'ขณะติดตั้ง โปรแกรมติดตั้งพบว่า (ด้วยรายละเอียดที่คุณให้มา) ตารางอย่างน้อยหนึ่งตารางที่โปรแกรมติดตั้งนี้อาจสร้างมีอยู่แล้ว<br>ตารางที่ขาดหายไปในการติดตั้งของคุณได้รับการสร้างขึ้นใหม่ด้วยข้อมูลเริ่มต้น แต่ไม่มีข้อมูลใดถูกลบออกจาก ตารางที่มีอยู่';

$txt['default_topic_subject'] = 'ยินดีต้อนรับสู่ SMF!';
$txt['default_topic_message'] = 'ยินดีต้อนรับสู่ Simple Machines Forum!<br><br>เราหวังว่าคุณจะสนุกกับการใช้ฟอรัมของคุณ&nbsp; หากคุณมีปัญหาใด ๆ โปรด [url=https://www.simplemachines.org/community/index.php]ขอความช่วยเหลือจากเรา[/url].<br><br>ขอบคุณ!<br>Simple Machines';
$txt['default_board_name'] = 'พูดคุยเรื่องทั่วไป';
$txt['default_board_description'] = 'พูดคุยกันได้ทุกเรื่องในบอร์ดนี้';
$txt['default_category_name'] = 'หมวดหมู่ทั่วไป';
$txt['default_time_format'] = '%b %d, %Y, %I:%M %p';
$txt['default_news'] = 'SMF - เพิ่งติดตั้ง!';
$txt['default_reserved_names'] = 'Admin\nWebmaster\nGuest\nroot\\mผู้ดูแลระบบ\nผู้ดูแลเว็บ\nผู้มาเยือน';
$txt['default_fugue_smileyset_name'] = 'Fugue\'s Set';
$txt['default_alienine_smileyset_name'] = 'Alienine\'s Set';
$txt['default_aaron_smileyset_name'] = 'Aaron\'s Set';
$txt['default_akyhne_smileyset_name'] = 'Akyhne\'s Set';
$txt['default_legacy_smileyset_name'] = '2.0 Default';
$txt['default_theme_name'] = 'ธีมเริ่มต้น SMF - Curve2';

$txt['default_administrator_group'] = 'ผู้ดูแลระบบ';
$txt['default_global_moderator_group'] = 'ผู้ดูแลทั่วทั้งบอร์ด';
$txt['default_moderator_group'] = 'ผู้ดูแล';
$txt['default_newbie_group'] = 'น้องใหม่';
$txt['default_junior_group'] = 'สมาชิกจูเนียร์';
$txt['default_full_group'] = 'สมาชิกแบบเต็มรูปแบบ';
$txt['default_senior_group'] = 'ท่านสมาชิก';
$txt['default_hero_group'] = 'ฮีโร่!';

$txt['default_smiley_smiley'] = 'ยิ้ม';
$txt['default_wink_smiley'] = 'ยิ้มเท่ห์';
$txt['default_cheesy_smiley'] = 'ยิ้มกว้างๆ';
$txt['default_grin_smiley'] = 'ยิงฟันยิ้ม';
$txt['default_angry_smiley'] = 'โกรธ';
$txt['default_sad_smiley'] = 'เศร้า';
$txt['default_shocked_smiley'] = 'ตกใจ';
$txt['default_cool_smiley'] = 'เจ๋ง';
$txt['default_huh_smiley'] = 'ฮืม?';
$txt['default_roll_eyes_smiley'] = 'ขยิบตา';
$txt['default_tongue_smiley'] = 'แลบลิ้น';
$txt['default_embarrassed_smiley'] = 'อายจัง';
$txt['default_lips_sealed_smiley'] = 'รูดซิบปาก';
$txt['default_undecided_smiley'] = 'ลังเล';
$txt['default_kiss_smiley'] = 'จุมพิต';
$txt['default_cry_smiley'] = 'ร้องไห้';
$txt['default_evil_smiley'] = 'ชั่วร้าย';
$txt['default_azn_smiley'] = 'อัซนี';
$txt['default_afro_smiley'] = 'แอฟโฟร';
$txt['default_laugh_smiley'] = 'ขำขัน';
$txt['default_police_smiley'] = 'ตำรวจ';
$txt['default_angel_smiley'] = 'เทพ';

$txt['error_message_click'] = 'คลิกที่นี่';
$txt['error_message_try_again'] = 'เพื่อลองขั้นตอนนี้อีกครั้ง';
$txt['error_message_bad_try_again'] = 'เพื่อลองติดตั้งต่อไป แต่โปรดทราบว่าเราไม่แนะนำ<em>อย่างยิ่ง</em>';

$txt['install_settings'] = 'การตั้งค่าฟอรัม';
$txt['install_settings_info'] = 'หน้านี้กำหนดให้คุณต้องกำหนดการตั้งค่าหลักสองสามรายการสำหรับฟอรัมของคุณ SMF ตรวจพบการตั้งค่าคีย์สำหรับคุณโดยอัตโนมัติ';
$txt['install_settings_name'] = 'ชื่อฟอรั่ม';
$txt['install_settings_name_info'] = 'นี่คือชื่อฟอรั่มของคุณ กล่าวคือ &quot;ฟอรัมการทดสอบ&quot;';
$txt['install_settings_name_default'] = 'ชุมชนของฉัน';
$txt['install_settings_url'] = 'URL ของฟอรัม';
$txt['install_settings_url_info'] = 'นี่คือ URL ไปยังฟอรัมของคุณ <strong>โดยไม่มี \'/\' ต่อท้าย!</strong><br>ในกรณีส่วนใหญ่ คุณสามารถปล่อยให้ค่าเริ่มต้นในช่องนี้อยู่คนเดียว ซึ่งมักจะถูกต้อง';
$txt['install_settings_reg_mode'] = 'โหมดการลงทะเบียน';
$txt['install_settings_reg_modes'] = 'โหมดการลงทะเบียน';
$txt['install_settings_reg_immediate'] = 'ลงทะเบียนทันที';
$txt['install_settings_reg_email'] = 'การเปิดใช้งานอีเมล';
$txt['install_settings_reg_admin'] = 'การอนุมัติของผู้ดูแลระบบ';
$txt['install_settings_reg_disabled'] = 'การลงทะเบียนปิดการใช้งาน';
$txt['install_settings_reg_mode_info'] = 'ฟิลด์นี้อนุญาตให้คุณเปลี่ยนโหมดการลงทะเบียนในการติดตั้งเพื่อป้องกันการลงทะเบียนที่ไม่ต้องการ';
$txt['install_settings_compress'] = 'เอาต์พุต Gzip';
$txt['install_settings_compress_title'] = 'บีบอัดเอาต์พุตเพื่อประหยัดแบนด์วิดท์';
// In this string, you can translate the word "PASS" to change what it says when the test passes.
$txt['install_settings_compress_info'] = 'ฟังก์ชันนี้ทำงานไม่ถูกต้องบนเซิร์ฟเวอร์ทั้งหมด แต่สามารถช่วยประหยัดแบนด์วิดท์ได้มาก<br>คลิก<a href="install.php?obgz=1&amp;pass_string=ผ่าน" onclick="return reqWin(this.href, 200, 60);" target="_blank" rel="noopener">ที่นี่</a>เพื่อทดสอบ (ควรพูดว่า "ผ่าน")';
$txt['install_settings_dbsession'] = 'วาระฐานข้อมูล';
$txt['install_settings_dbsession_title'] = 'ใช้ฐานข้อมูลสำหรับวาระแทนการใช้ไฟล์';
$txt['install_settings_dbsession_info1'] = 'คุณลักษณะนี้มักจะดีที่สุด เนื่องจากทำให้วาระมีความน่าเชื่อถือมากขึ้น';
$txt['install_settings_dbsession_info2'] = 'โดยทั่วไป คุณลักษณะนี้เป็นความคิดที่ดี แต่อาจทำงานไม่ถูกต้องบนเซิร์ฟเวอร์นี้';
$txt['install_settings_stats'] = 'อนุญาตให้เก็บสถิติ';
$txt['install_settings_stats_title'] = 'อนุญาตให้ Simple Machines รวบรวมสถิติพื้นฐานทุกเดือน';
$txt['install_settings_stats_info'] = 'หากเปิดใช้งาน จะทำให้ Simple Machines เข้าชมไซต์ของคุณเดือนละครั้งเพื่อรวบรวมสถิติพื้นฐาน วิธีนี้จะช่วยให้เราตัดสินใจได้ว่าการกำหนดค่าใดที่จะปรับซอฟต์แวร์ให้เหมาะสมที่สุด สำหรับข้อมูลเพิ่มเติม โปรดไปที่<a href="https://www.simplemachines.org/about/stats.php" target="_blank" rel="noopener">หน้าข้อมูล</a>ของเรา';
$txt['install_settings_proceed'] = 'ดำเนินการ';

$txt['db_settings'] = 'การตั้งค่าเซิร์ฟเวอร์ฐานข้อมูล';
$txt['db_settings_info'] = 'นี่คือการตั้งค่าที่จะใช้สำหรับเซิร์ฟเวอร์ฐานข้อมูลของคุณ หากคุณไม่ทราบคุณค่า คุณควรถามโฮสว่าค่าเหล่านี้คืออะไร';
$txt['db_settings_type'] = 'ประเภทฐานข้อมูล';
$txt['db_settings_type_info'] = 'ตรวจพบฐานข้อมูลที่รองรับหลายประเภท คุณต้องการใช้ประเภทใด โปรดทราบว่าไม่รองรับการรัน pre-SMF 2.0 RC3 ร่วมกับ SMF เวอร์ชันใหม่กว่าในฐานข้อมูล PostgreSQL เดียวกัน คุณต้องอัปเกรดการติดตั้งที่เก่ากว่าของคุณในกรณีนี้';
$txt['db_settings_server'] = 'ชื่อเซิร์ฟเวอร์';
$txt['db_settings_server_info'] = 'นี่เป็น localhost เกือบทุกครั้ง ดังนั้น หากคุณไม่ทราบ ให้ลองใช้ localhost';
$txt['db_settings_username'] = 'ชื่อผู้ใช้';
$txt['db_settings_username_info'] = 'กรอกชื่อผู้ใช้ที่คุณต้องการเพื่อเชื่อมต่อกับฐานข้อมูลของคุณที่นี่<br>หากคุณไม่ทราบว่ามันคืออะไร ให้ลองใช้ชื่อผู้ใช้ของบัญชี ftp ของคุณ ซึ่งส่วนใหญ่จะเหมือนกัน';
$txt['db_settings_password'] = 'รหัสผ่าน';
$txt['db_settings_password_info'] = 'ใส่รหัสผ่านที่คุณต้องการเชื่อมต่อกับฐานข้อมูลของคุณที่นี่<br>หากคุณไม่ทราบข้อมูลนี้ คุณควรลองใช้รหัสผ่านไปยังบัญชี ftp ของคุณ';
$txt['db_settings_database'] = 'ชื่อฐานข้อมูล';
$txt['db_settings_database_info'] = 'กรอกชื่อฐานข้อมูลที่คุณต้องการใช้สำหรับ SMF เพื่อจัดเก็บข้อมูล';
$txt['db_settings_database_info_note'] = 'หากไม่มีฐานข้อมูลนี้ โปรแกรมติดตั้งนี้จะพยายามสร้างมันขึ้นมา';
$txt['db_settings_port'] = 'พอร์ตฐานข้อมูล';
$txt['db_settings_port_info'] = 'เว้นว่างไว้เพื่อใช้ค่าเริ่มต้น';
$txt['db_settings_prefix'] = 'คำนำหน้าตาราง';
$txt['db_settings_prefix_info'] = 'คำนำหน้าสำหรับทุกตารางในฐานข้อมูล <strong>อย่าติดตั้งสองฟอรัมที่มีคำนำหน้าเหมือนกัน!</strong><br>คีย์นี้ช่วยให้สามารถติดตั้งหลายรายการในฐานข้อมูลเดียว';
$txt['db_populate'] = 'เติมฐานข้อมูล';
$txt['db_populate_info'] = 'ขณะนี้การตั้งค่าของคุณได้รับการบันทึกและฐานข้อมูลได้รับการเติมข้อมูลทั้งหมดที่จำเป็นในการเริ่มต้นใช้งานฟอรัมของคุณ สรุป:';
$txt['db_populate_info2'] = 'คลิก &quot;ดำเนินการต่อ&quot; เพื่อไปยังหน้าการสร้างบัญชีผู้ดูแลระบบ';
$txt['db_populate_inserts'] = 'แทรก %1$d แถวแล้ว';
$txt['db_populate_tables'] = 'สร้าง %1$d ตารางแล้ว';
$txt['db_populate_insert_dups'] = 'ละเว้น %1$d เม็ดมีดที่ซ้ำกัน';
$txt['db_populate_table_dups'] = 'ละเว้น %1$d ตารางที่ซ้ำกัน';

$txt['user_settings'] = 'สร้างบัญชีของคุณ';
$txt['user_settings_info'] = 'ตัวช่วยการติดตั้งจะสร้างบัญชีผู้ดูแลระบบใหม่ให้กับคุณ';
$txt['user_settings_username'] = 'ชื่อผู้ใช้ของคุณ';
$txt['user_settings_username_info'] = 'เลือกชื่อที่คุณต้องการใช้สำหรับเข้าสู่ระบบ<br>สามารถเปลี่ยนแปลงได้ในภายหลัง';
$txt['user_settings_password'] = 'รหัสผ่าน';
$txt['user_settings_password_info'] = 'กรอกรหัสผ่านที่คุณต้องการได้ที่นี่และจำไว้ให้ดี';
$txt['user_settings_again'] = 'รหัสผ่าน';
$txt['user_settings_again_info'] = '(ใช้สำหรับการตรวจสอบเท่านั้น)';
$txt['user_settings_admin_email'] = 'อีเมลของผู้ดูแลระบบ';
$txt['user_settings_admin_email_info'] = 'ระบุอีเมลของคุณ ต้องเป็นอีเมลที่ถูกต้องเท่านั้น';
$txt['user_settings_server_email'] = 'อีเมลของผู้ดูแลเว็บ';
$txt['user_settings_server_email_info'] = 'ระบุ<strong>อีเมลที่ SMF จะใช้ในการส่งอีเมล</strong> ต้องเป็นอีเมลที่ถูกต้องเท่านั้น';
$txt['user_settings_database'] = 'รหัสผ่านฐานข้อมูล';
$txt['user_settings_database_info'] = 'เพื่อเหตุผลทางด้านความปลอดภัย ตัวช่วยการติดตั้งต้องการให้คุณระบุรหัสผ่านฐานข้อมูลเพื่อใช้สำหรับสร้างบัญชีผู้ดูแลระบบ';
$txt['user_settings_skip'] = 'ข้าม';
$txt['user_settings_skip_sure'] = 'คุณแน่ใจหรือไม่ว่าต้องการข้ามการสร้างบัญชีผู้ดูแลระบบ';
$txt['user_settings_proceed'] = 'เสร็จสิ้น';

$txt['ftp_checking_writable'] = 'ตรวจสอบสิทธิ์การเขียนไฟล์';
$txt['ftp_setup'] = 'ข้อมูลการเชื่อมต่อ FTP';
$txt['ftp_setup_info'] = 'ตัวช่วยการติดตั้งนี้สามารถเชื่อมต่อผ่าน FTP เพื่อให้สามารถแก้ไขไฟล์ที่มีสิทธิ์การเขียนได้กับไม่ได้ หากวิธีนี้ใช้ไม่ได้ผล คุณจะต้องเข้าไปแก้ไขด้วยตนเองและกำหนดสิทธิ์ไฟล์ให้สามารถเขียนได้ โปรดทราบว่าดำเนินการดังกล่าวยังไม่สนับสนุน SSL';
$txt['ftp_setup_why'] = 'ขั้นตอนนี้มีไว้สำหรับทำอะไร';
$txt['ftp_setup_why_info'] = 'ไฟล์บางไฟล์จำเป็นต้องมีสิทธิ์ในการเขียนเพื่อให้ SMF ทำงานได้อย่างถูกต้อง ขั้นตอนนี้จะเป็นการอนุญาตตัวช่วยการติดตั้งกำหนดสิทธิ์ไฟล์ให้สามารถเขียนได้ อย่างไรก็ตามในบางครั้งอาจจะไม่ทำงาน ในกรณีนี้ กรุณาสร้างไฟล์โดยกำหนดสิทธิ์เป็น 777 (คือเขียนได้ แต่ในบางโฮสต์อาจจะเป็น 755) ดังต่อไปนี้:';
$txt['ftp_setup_again'] = 'เพื่อทดสอบว่าไฟล์เหล่านี้สามารถเขียนได้อีกครั้ง';

$txt['error_missing_files'] = 'ไม่พบไฟล์สำหรับที่ใช้สำหรับการติดตั้งในไดเรกทอรีของสคริปต์นี้<br><br>กรุณาตรวจสอบให้แน่ใจว่าคุณได้อัปโหลดแพ็คเกจการติดตั้งทั้งหมด รวมถึงไฟล์ sql แล้วลองอีกครั้ง';
$txt['error_session_save_path'] = 'กรุณาแจ้งโฮสต์ของคุณว่ามีการระบุ <strong>session.save_path ใน php.ini</strong> ไม่ถูกต้อง! จะต้องเปลี่ยนเป็นไดเร็กทอรี<strong>ที่มีอยู่</strong>และสามารถ<strong>เขียนได้</strong>โดยผู้ใช้ ในขณะที่ PHP กำลังทำงานอยู่<br>';
$txt['error_windows_chmod'] = 'คุณกำลังใช้เซิร์ฟเวอร์ที่ทำงานด้วยระบบปฏิบัติการ Windows และไฟล์สำคัญบางไฟล์ไม่สามารถเขียนได้ กรุณาขอให้โฮสต์ของคุณให้<strong>สิทธิ์การเขียน</strong>แก่ผู้ใช้ ในขณะที่ PHP กำลังทำงานภายใต้ไฟล์การติดตั้ง SMF ของคุณ ไฟล์หรือไดเร็กทอรีต่อไปนี้ต้องสามารถเขียนได้:';
$txt['settings_error'] = 'ไม่สามารถบันทึกการตั้งค่าของคุณไปที่ไฟล์ Settings.php ได้';
$txt['error_ftp_no_connect'] = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ FTP ด้วยรายละเอียดเหล่านี้ได้';
$txt['error_db_file'] = 'ไม่พบสคริปต์แหล่งข้อมูลของฐานข้อมูล กรุณาตรวจสอบว่าไฟล์ %1$s อยู่ในไดเรกทอรีแหล่งข้อมูลของกระดานสนทนาแล้ว';
$txt['error_db_connect'] = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ฐานข้อมูลด้วยข้อมูลที่ให้มาได้<br><br>หากคุณไม่แน่ใจว่าจะพิมพ์อะไร กรุณาติดต่อโฮสต์ของคุณ';
$txt['error_db_connect_settings'] = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ฐานข้อมูลได้<br><br>กรุณาตรวจสอบว่าตัวแปรข้อมูลฐานข้อมูลถูกต้องแล้วใน Settings.php';
$txt['error_db_database'] = 'The installer was unable to access the &quot;<em>%1$s</em>&quot; database. With some hosts, you have to create the database in your administration panel before SMF can use it. Some also add prefixes, such as your username, to your database names.';
$txt['error_db_queries'] = 'Some of the queries were not executed properly. This could be caused by an unsupported (development or old) version of your database software.<br><br>Technical information about the queries:';
$txt['error_db_queries_line'] = 'Line #';
$txt['error_db_missing'] = 'The installer was unable to detect any database support in PHP. Please ask your host to ensure that PHP was compiled with the desired database, or that the proper extension is being loaded.';
$txt['error_db_script_missing'] = 'The installer could not find any install script files for the detected databases. Please check you have uploaded the necessary install script files to your forum directory, for example &quot;%1$s&quot;';
$txt['error_session_missing'] = 'The installer was unable to detect sessions support in your server\'s installation of PHP. Please ask your host to ensure that PHP was compiled with session support (which in fact is the PHP default, meaning your host currently has explicitly disabled it).';
$txt['error_user_settings_again_match'] = 'You typed in two completely different passwords!';
$txt['error_user_settings_no_password'] = 'Your password must be at least four characters long.';
$txt['error_user_settings_taken'] = 'Sorry, a member is already registered with that username and/or email address.<br><br>A new account has not been created.';
$txt['error_user_settings_query'] = 'A database error occurred while trying to create an administrator. This error was:';
$txt['error_sourcefile_missing'] = 'Unable to find the Sources/%1$s file. Please make sure it was uploaded properly, and then try again.';
$txt['error_db_alter_priv'] = 'The database account you specified does not have permission to ALTER, CREATE, and/or DROP tables in the database. This is necessary for SMF to function properly.';
$txt['error_versions_do_not_match'] = 'The installer has detected another version of SMF already installed with the specified information. If you are trying to upgrade, you should use the upgrader, not the installer.<br><br>Otherwise, you may wish to use different information, or create a backup and then delete the data currently in the database.';
$txt['error_mod_security'] = 'The installer has detected the mod_security module is installed on your web server. Mod_security will block submitted forms even before SMF gets a say in anything. SMF has a built-in security scanner that will work more effectively than mod_security and that won\'t block submitted forms.<br><br><a href="https://www.simplemachines.org/redirect/mod_security">More information about disabling mod_security</a>';
$txt['error_mod_security_no_write'] = 'The installer has detected the mod_security module is installed on your web server. Mod_security will block submitted forms even before SMF gets a say in anything. SMF has a built-in security scanner that will work more effectively than mod_security and that won\'t block submitted forms.<br><br><a href="https://www.simplemachines.org/redirect/mod_security">More information about disabling mod_security</a><br><br>Alternatively, you may wish to use your ftp client to chmod .htaccess in the forum directory to be writable (777), and then refresh this page.';
$txt['error_utf8_version'] = 'The current version of your database doesn\'t support the use of the UTF-8 character set. You can still install SMF without any problems, but only with UTF-8 support unchecked. If you would like to switch over to UTF-8 in the future (e.g. after the database server of your forum has been upgraded to version >= %1$s), you can convert your forum to UTF-8 through the admin panel.';
$txt['error_valid_admin_email_needed'] = 'You have not entered a valid email address for your administrator account.';
$txt['error_valid_server_email_needed'] = 'You have not entered a valid webmaster email address.';
$txt['error_already_installed'] = 'The installer has detected that you already have SMF installed. It is strongly advised that you do <strong>not</strong> try to overwrite an existing installation, continuing with installation <strong>may result in the loss or corruption of existing data</strong>.<br><br>If you wish to upgrade please visit the <a href="https://www.simplemachines.org">Simple Machines Website</a> and download the latest <em>upgrade</em> package.<br><br>If you wish to overwrite your existing installation, including all data, it is recommended that you delete the existing database tables and replace Settings.php and try again.';
$txt['error_warning_notice'] = 'Warning!';
$txt['error_script_outdated'] = 'This install script is out of date! The current version of SMF is %1$s, but this install script is for %2$s.<br><br>
	It is recommended that you visit the <a href="https://www.simplemachines.org">Simple Machines</a> website to ensure you are installing the latest version.';
$txt['error_db_prefix_numeric'] = 'The selected database type does not support the use of numeric prefixes.';
$txt['error_pg_scs'] = 'PostgreSQL is configured incorrectly. Please turn on the standard_conforming_strings configuration parameter.';
$txt['error_invalid_characters_username'] = 'Invalid character used in Username.';
$txt['error_username_too_long'] = 'Username may only be up to 25 characters long.';
$txt['error_username_left_empty'] = 'Username field was left empty.';
$txt['error_db_prefix_reserved'] = 'The prefix that you entered is a reserved prefix. Please enter another prefix.';
$txt['error_utf8_support'] = 'The database you are trying to use is not using UTF-8 charset';

$txt['ftp_login'] = 'Your FTP connection information';
$txt['ftp_login_info'] = 'This web installer needs your FTP information in order to automate the installation for you. Please note that none of this information is saved in your installation, it is just used to setup SMF.';
$txt['ftp_server'] = 'Server';
$txt['ftp_server_info'] = 'The address (often localhost) and port for your FTP server.';
$txt['ftp_port'] = 'Port';
$txt['ftp_username'] = 'Username';
$txt['ftp_username_info'] = 'The username to login with. <em>This will not be saved anywhere.</em>';
$txt['ftp_password'] = 'Password';
$txt['ftp_password_info'] = 'The password to login with. <em>This will not be saved anywhere.</em>';
$txt['ftp_path'] = 'Install Path';
$txt['ftp_path_info'] = 'This is the <em>relative</em> path you use in your FTP client.';
$txt['ftp_path_found_info'] = 'The path in the box above was automatically detected.';
$txt['ftp_path_help'] = 'Your FTP path is the path you see when you log in to your FTP client. It commonly starts with &quot;<pre>www</pre>&quot;, &quot;<pre>public_html</pre>&quot;, or &quot;<pre>httpdocs</pre>&quot;, but it should include the directory SMF is in too, such as &quot;/public_html/forum&quot;. It is different from your URL and full path.<br><br>Files in this path may be overwritten, so make sure it is correct.';
$txt['ftp_path_help_close'] = 'Close';
$txt['ftp_connect'] = 'Connect';

$txt['force_ssl'] = 'Enable SSL';
$txt['force_ssl_label'] = 'Force SSL throughout the forum';
$txt['force_ssl_info'] = 'Make sure SSL and HTTPS are supported throughout the forum, otherwise your forum may become inaccessible';

$txt['chmod_linux_info'] = 'If you have a shell account, the convenient below command can automatically correct permissions on these files';

// The upgrader needs text strings too!
$txt['upgrade_step_login'] = 'Login';
$txt['upgrade_step_options'] = 'Upgrade Options';
$txt['upgrade_step_backup'] = 'Backup';
$txt['upgrade_step_database'] = 'Database Changes';
$txt['upgrade_step_convertutf'] = 'Convert to UTF-8';
$txt['upgrade_step_convertjson'] = 'Convert serialized strings to JSON';
$txt['upgrade_step_delete'] = 'Delete Upgrade.php';

$txt['upgrade_upgrade_utility'] = 'SMF Upgrade Utility';
$txt['upgrade_warning'] = 'Warning!';
$txt['upgrade_critical_error'] = 'Critical Error!';
$txt['upgrade_continue'] = 'Continue';
$txt['upgrade_skip'] = 'Skip';
$txt['upgrade_note'] = 'Note!';
$txt['upgrade_step'] = 'Step';
$txt['upgrade_steps'] = 'Steps';
$txt['upgrade_progress'] = 'Progress';
$txt['upgrade_overall_progress'] = 'Overall Progress';
$txt['upgrade_step_progress'] = 'Step Progress';
$txt['upgrade_time_elapsed'] = 'Time Elapsed';
$txt['upgrade_time_mins'] = 'mins';
$txt['upgrade_time_secs'] = 'seconds';
$txt['upgrade_username'] = 'Username:';
$txt['upgrade_wrong_username'] = 'Username Incorrect';
$txt['upgrade_password'] = 'Password:';
$txt['upgrade_wrong_password'] = 'Password Incorrect';
$txt['upgrade_script_timeout_minutes'] = 'This upgrade script cannot be run until %1$s has been inactive for at least %2$d minutes';
$txt['upgrade_script_timeout_seconds'] = 'This upgrade script cannot be run until %1$s has been inactive for at least %2$d seconds';

$txt['upgrade_wait'] = 'Please wait while a backup is created. For large forums this may take some time!';
$txt['upgrade_wait2'] = 'Please wait while your database is converted to UTF-8. For large forums this may take some time!';
$txt['upgrade_sec_login'] = 'For security purposes please login with your admin account to proceed with the upgrade.';
$txt['upgrade_incomplete'] = 'Incomplete';
$txt['upgrade_not_quite_done'] = 'Not quite done yet!';
$txt['upgrade_paused_overload'] = 'This upgrade has been paused to avoid overloading your server. Do not worry, nothing is wrong. Simply click the <label for="contbutt">continue button</label> below to keep going.';
$txt['upgrade_continue_step'] = 'Continue from step reached during last execution of upgrade script.';
$txt['upgrade_bypass'] = '<strong>Note:</strong> If necessary, the above security check can be bypassed for users who may administrate a server, but may not have admin rights on the forum. In order to bypass the above check, simply open &quot;upgrade.php&quot; in a text editor and replace &quot;$disable_security = false;&quot; with &quot;$disable_security = true;&quot; and refresh this page.';
$txt['upgrade_areyouready'] = 'Before the upgrade gets underway, please review the options below and press &quot;Continue&quot; when you are ready to begin.';
$txt['upgrade_backup_table'] = 'Perform a tables backup in your database with the prefix';
$txt['upgrade_backup_complete'] = 'Backup Complete! Click Continue to Proceed.';
$txt['upgrade_recommended'] = 'recommended!';
$txt['upgrade_maintenance'] = 'Put the forum into maintenance mode during upgrade.';
$txt['upgrade_maintenance_title'] = 'Maintenance Title:';
$txt['upgrade_maintenance_message'] = 'Maintenance Message:';
$txt['upgrade_customize'] = 'Customize';
$txt['upgrade_debug_info'] = 'Output extra debugging information.';
$txt['upgrade_empty_errorlog'] = 'Empty error log before upgrading.';
$txt['upgrade_delete_karma'] = 'Delete all karma settings and info from the DB';
$txt['upgrade_reprocess_attachments'] = 'Rerun attachment conversion';
$txt['upgrade_stats_collection'] = 'Allow Simple Machines to collect basic stats monthly.';
$txt['upgrade_stats_info'] = 'If enabled, this will allow Simple Machines to visit your site once a month to collect basic statistics. This will help us make decisions as to which configurations to optimise the software for. For more information please visit our <a href="%1$s" target="_blank" rel="noopener">info page</a>.';
$txt['upgrade_migrate_settings_file'] = 'Migrate to a new Settings file.';
$txt['upgrade_db_changes'] = 'Executing database changes';
$txt['upgrade_db_patient'] = 'Please be patient - this may take some time on large forums. The time elapsed increments from the server to show progress is being made.';
$txt['upgrade_db_complete'] = '1 Database Updates Complete! Click Continue to Proceed.';
$txt['upgrade_db_complete2'] = 'Database Updates Complete! Click Continue to Proceed.';
$txt['upgrade_script'] = 'Executing upgrade script';
$txt['upgrade_error'] = 'Error!';
$txt['upgrade_unknown_error'] = 'Unknown Error!';
/* Same sentence, 3 different strings */
$txt['upgrade_completed'] = 'Completed';
$txt['upgrade_outof'] = 'out of';
$txt['upgrade_tables'] = 'tables.';

$txt['upgrade_run_script'] = 'We recommend that you do not run this script unless you are sure that';
$txt['upgrade_run_script2'] = 'has completed their upgrade.';
$txt['upgrade_run'] = 'You can choose to either run the upgrade again from the beginning or continue from the last step reached during the most recent upgrade.';

$txt['upgrade_completed_table'] = 'Completed Table:';
$txt['upgrade_current_table'] = 'Current Table:';
$txt['upgrade_fulltext'] = 'Please note that your fulltext index was dropped to facilitate the conversion and will need to be recreated in the admin area after the upgrade is complete.';
$txt['upgrade_conversion_proceed'] = 'Conversion Complete! Click Continue to Proceed.';
$txt['upgrade_convert_datajson'] = 'Converting data from serialize to JSON...';
$txt['upgrade_json_completed'] = 'Convert to JSON Complete! Click Continue to Proceed.';
$txt['upgrade_executing'] = 'Executing:';
$txt['upgrade_of'] = 'of';
$txt['upgrade_admin_login'] = 'Admin Login:';
$txt['upgrade_admin_disabled'] = '(DISABLED)';
$txt['upgrade_done'] = 'Upgrade complete. Now you are ready to use <a href="%1$s/index.php">your installation of SMF</a>. Hope you like it!';

$txt['upgrade_delete_now'] = 'Delete upgrade.php and its data files now';
$txt['upgrade_delete_server'] = '(does not work on all servers).';
$txt['upgrade_problems'] = 'If you had any problems with this upgrade, or have any problems using SMF, please do not hesitate to <a href="%1$s">ask us for assistance</a>.';
$txt['upgrade_luck'] = 'Best of luck,';

$txt['upgrade_ftp_login'] = 'Your FTP connection information';
$txt['upgrade_ftp_perms'] = 'The upgrader can fix any issues with file permissions to make upgrading as simple as possible. Simply enter your connection information below or alternatively click <a href="#" onclick="warning_popup();">here</a> for a list of files which need to be changed.';
$txt['upgrade_ftp_warning'] = 'Warning';
$txt['upgrade_ftp_files'] = 'The following files need to be made writable to continue:';
$txt['upgrade_ftp_shell'] = 'If you have a shell account, the command below can automatically correct permissions on these files';
$txt['upgrade_ftp_error'] = 'The following error was encountered when trying to connect:';

$txt['upgrade_ready_proceed'] = 'Thank you for choosing to upgrade to SMF %1$s. All files appear to be in place and the upgrade can now proceed.';
$txt['upgrade_error_script_js'] = 'The upgrade script cannot find script.js or it is out of date. Make sure your theme paths are correct. You can download a setting checker tool from the <a href="%1$s">Simple Machines Website</a>';
$txt['upgrade_warning_lots_data'] = 'This upgrade script has detected that your forum contains a lot of data which needs upgrading. This process may take quite some time depending on your server and forum size, and for very large forums (~300,000 messages) may take several hours to complete.';
$txt['upgrade_warning_out_of_date'] = 'This upgrade script is out of date! The current version of SMF is <em id="smfVersion" style="white-space: nowrap;">??</em> but this upgrade script is for <em id="yourVersion" style="white-space: nowrap;">%1$s</em>.<br><br>It is recommended that you visit the <a href="%2$s">Simple Machines Website</a> to ensure you are upgrading to the latest version.';

$txt['upgrade_forumdir_settings'] = 'It looks as if your forum directory settings <em>might</em> be incorrect. Your forum directory is currently set to &quot;%1$s&quot;, but should probably be &quot;%2$s&quot;. Settings.php currently lists your paths as:';
$txt['upgrade_forumdir'] = 'Forum Directory:';
$txt['upgrade_sourcedir'] = 'Source Directory:';
$txt['upgrade_cachedir'] = 'Cache Directory:';
$txt['upgrade_incorrect_settings'] = 'If these seem incorrect please open Settings.php in a text editor before proceeding with this upgrade. If they are incorrect due to you moving your forum to a new location please download and execute the <a href="https://download.simplemachines.org/?tools">Repair Settings</a> tool from the Simple Machines website before continuing.';

$txt['upgrade_fulltext_error'] = 'Your fulltext search index was dropped to facilitate the conversion. You will need to recreate it.';
$txt['upgrade_writable_files'] = 'The following files need to be writable to continue the upgrade. Please ensure the Windows permissions are correctly set to allow this:';
$txt['upgrade_time_user'] = '&quot;%1$s&quot; is running the upgrade script.';

// We represent the time here in backwards variables, as it makes the code easier.
$txt['upgrade_time_hms'] = 'The upgrade script has been running for the last %3$d hours, %2$d minutes and %1$d seconds.';
$txt['upgrade_time_ms'] = 'The upgrade script has been running for the last %2$d minutes and %1$d seconds.';
$txt['upgrade_time_s'] = 'The upgrade script has been running for the last %1$d seconds.';
$txt['upgrade_time_updated_hms'] = 'The upgrade script was last updated %3$d hours, %2$d minutes and %1$d seconds ago.';
$txt['upgrade_time_updated_hm'] = 'The upgrade script was last updated %2$d minutes and %1$d seconds ago.';
$txt['upgrade_time_updated_s'] = 'The upgrade script was last updated %1$d seconds ago.';
$txt['upgrade_completed_time_hms'] = 'Upgrade completed in %3$d hours, %2$s minutes and %1$s seconds';
$txt['upgrade_completed_time_ms'] = 'Upgrade completed in %2$s minutes and %1$s seconds';
$txt['upgrade_completed_time_s'] = 'Upgrade completed in %1$s seconds';
$txt['upgrade_success_time_db'] = 'Successful! Database upgrades completed in %3$d hours, %2$d minutes and %1$d seconds.';

$txt['upgrade_unsuccessful'] = 'Unsuccessful!';
$txt['upgrade_thisquery'] = 'This query:';
$txt['upgrade_causerror'] = 'Caused the error:';
$txt['upgrade_completedtables_outof'] = 'Completed <span id="tab_done">%1$d</span> out of %2$d tables.';
$txt['upgrade_success'] = 'Successful!';
$txt['upgrade_loop'] = 'Upgrade script appears to be going into a loop - step: ';
$txt['upgrade_respondtime'] = 'Server has not responded for %1$d seconds. It may be worth waiting a little longer before trying again.';
$txt['upgrade_respondtime_clickhere'] = 'Click here to try again.';
$txt['mtitle'] = 'Upgrading the forum...';
$txt['mmessage'] = 'Don\'t worry, your forum will be updated shortly. It will only be a minute ;).';

// Upgrader error messages
// argument(s): template name (if applicable)
$txt['error_unexpected_template_call'] = 'Error: Unexpected call to use the %1$s template. Please copy and paste all the text above and visit the SMF support forum to let the developers know that there is a bug.';
$txt['error_invalid_template'] = 'Upgrade aborted!  Invalid template: template_%1$s';
$txt['error_lang_index_missing'] = 'The upgrader was unable to find language files for the selected language, %1$s.<br>SMF will not work in this language without the language files installed.<br><br>Please either install them, or <a href="%2$s?step=0;lang=english">try English instead</a>.';
$txt['error_upgrade_files_missing'] = 'The upgrader was unable to find some crucial files.<br><br>Please make sure you uploaded all of the files included in the package, including the Themes, Sources, and other directories.';
$txt['error_upgrade_old_files'] = 'The upgrader found some old or outdated files.<br><br>Please make certain you uploaded the new versions of all the files included in the package.';
$txt['error_upgrade_old_lang_files'] = 'The upgrader found some old or outdated language files for the selected language, %1$s.<br><br>Please make certain you uploaded the new versions of all the files included in the package, even the theme and language files for the default theme.<br>&nbsp;&nbsp;&nbsp;[<a href="%2$s?skiplang">SKIP</a>] [<a href="%2$s?lang=english">Try English</a>]';
$txt['error_php_too_low'] = 'Warning!  You do not appear to have a version of PHP installed on your webserver that meets SMF\'s minimum installations requirements.<br><br>Please ask your host to upgrade.';
$txt['error_db_too_low'] = 'Your %1$s version does not meet the minimum requirements of SMF.<br><br>Please ask your host to upgrade.';
$txt['error_db_privileges'] = 'The %1$s user you have set in Settings.php does not have proper privileges.<br><br>Please ask your host to give this user the ALTER, CREATE, and DROP privileges.';
$txt['error_dir_not_writable'] = 'The directory: %1$s has to be writable to continue the upgrade. Please make sure permissions are correctly set to allow this.';
$txt['error_cache_not_found'] = 'The cache directory could not be found.<br><br>Please make sure you have a directory called &quot;cache&quot; in your forum directory before continuing.';
$txt['error_agreement_not_writable'] = 'The upgrader was unable to obtain write access to agreement.txt.<br><br>If you are using a linux or unix based server, please ensure that the file is chmod\'d to 777, or if it does not exist that the directory this upgrader is in is 777.<br>If your server is running Windows, please ensure that the internet guest account has the proper permissions on it or its folder.';
$txt['error_not_admin'] = 'You need to be an admin to perform an upgrade!';

$txt['warning_lang_old'] = 'The language files for your selected language, %1$s, have not been updated to the latest version. Upgrade will continue with the forum default, %2$s.';
$txt['warning_lang_missing'] = 'The upgrader could not find the &quot;Install&quot; language file for your selected language, %1$s. Upgrade will continue with the forum default, %2$s.';

// Attachment & Avatar folder checks
$txt['warning_av_missing'] = 'Warning! Avatar directory not found. Continuing may be unsafe. Please confirm folder settings before proceeding.';
$txt['warning_custom_av_missing'] = 'Warning! Custom avatar directory not found. Continuing may be unsafe. Please confirm folder settings before proceeding.';
$txt['warning_att_dir_missing'] = 'Warning! One or more attachment directories not found. Continuing may be unsafe. Please confirm folder settings before proceeding.';

// Page titles
$txt['updating_smf_installation'] = 'Updating Your SMF Installation!';
$txt['upgrade_options'] = 'Upgrade Options';
$txt['backup_database'] = 'Backup Database';
$txt['database_changes'] = 'Database Changes';
$txt['upgrade_complete'] = 'Upgrade Complete';
$txt['converting_utf8'] = 'Converting to UTF-8';
$txt['converting_json'] = 'Converting to JSON';

?>