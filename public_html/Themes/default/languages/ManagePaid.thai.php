<?php
// Version: 2.1.0; ManagePaid

global $boardurl;

// Some payment gateways need language specific information.
$txt['lang_paypal'] = 'TH';

// Symbols.
$txt['usd_symbol'] = '%1.2f $';
$txt['eur_symbol'] = '%1.2f &euro;';
$txt['gbp_symbol'] = '%1.2f &pound;';
$txt['cad_symbol'] = '%1.2f C$';
$txt['aud_symbol'] = '%1.2f A$';

$txt['usd'] = 'ดอลลาร์สหรัฐ ($)';
$txt['eur'] = 'EUR (&euro;)';
$txt['gbp'] = 'ปอนด์สเตอร์ลิง (&pound;)';
$txt['cad'] = 'ดอลลาร์แคนนาดา (C$)';
$txt['aud'] = 'ดอลลาร์ออสเตรเลีย (A$)';
$txt['other'] = 'อื่นๆ';

$txt['paid_username'] = 'ชื่อผู้ใช้';

$txt['paid_subscriptions_desc'] = 'จากส่วนนี้ คุณสามารถเพิ่ม ลบ และแก้ไขวิธีการสมัครสมาชิกแบบชำระเงินในฟอรัมของคุณได้';
$txt['paid_subs_settings'] = 'การตั้งค่า';
$txt['paid_subs_settings_desc'] = 'จากที่นี่ คุณสามารถแก้ไขวิธีการชำระเงินที่ผู้ใช้ของคุณสามารถใช้ได้';
$txt['paid_subs_view'] = 'ดูการสมัครสมาชิก';
$txt['paid_subs_view_desc'] = 'จากส่วนนี้ คุณสามารถดูการสมัครรับข้อมูลทั้งหมดที่คุณมีได้';

// Setting type strings.
$txt['paid_enabled'] = 'เปิดใช้งานการสมัครสมาชิกแบบชำระเงิน';
$txt['paid_enabled_desc'] = 'ต้องตรวจสอบการสมัครสมาชิกแบบชำระเงินเพื่อใช้ในฟอรัม';
$txt['paid_email'] = 'ส่งอีเมลแจ้งเตือน';
$txt['paid_email_desc'] = 'แจ้งผู้ดูแลระบบเมื่อการสมัครเปลี่ยนแปลงโดยอัตโนมัติ';
$txt['paid_email_to'] = 'อีเมลสำหรับการติดต่อ';
$txt['paid_email_to_desc'] = 'รายการที่อยู่คั่นด้วยเครื่องหมายจุลภาคสำหรับส่งอีเมลเพื่อส่งการแจ้งเตือน';
$txt['paidsubs_test'] = 'เปิดใช้งานโหมดทดสอบ';
$txt['paidsubs_test_desc'] = 'สิ่งนี้ทำให้การสมัครสมาชิกแบบชำระเงินเข้าสู่โหมด &quot;ทดสอบ&quot; ซึ่งจะใช้วิธีการชำระเงินแบบแซนด์บ็อกซ์ใน PayPal, Authorize.net ฯลฯ หากเป็นไปได้ อย่าเปิดใช้งานเว้นแต่คุณจะรู้ว่าคุณกำลังทำอะไร!';
$txt['paidsubs_test_confirm'] = 'คุณแน่ใจหรือไม่ว่าต้องการเปิดใช้งานโหมดทดสอบ';
$txt['paid_email_no'] = 'อย่าส่งการแจ้งเตือนใด ๆ';
$txt['paid_email_error'] = 'แจ้งเมื่อสมัครสมาชิกล้มเหลว';
$txt['paid_email_all'] = 'แจ้งการเปลี่ยนแปลงการสมัครอัตโนมัติทั้งหมด';
$txt['paid_currency'] = 'เลือกสกุลเงิน';
$txt['paid_currency_code'] = 'รหัสสกุลเงิน';
$txt['paid_currency_code_desc'] = 'รหัสที่ใช้โดยผู้ค้าชำระเงิน';
$txt['paid_currency_symbol'] = 'สัญลักษณ์ที่ใช้โดยวิธีการชำระเงิน';
$txt['paid_currency_symbol_desc'] = 'Use \'%1.2f\' to specify where number goes. For example $%1.2f, %1.2f EUR etc';
$txt['paid_settings_save'] = 'บันทึก';

$txt['paypal_email'] = 'ที่อยู่อีเมล PayPal';
$txt['paypal_email_desc'] = 'เว้นว่างไว้หากคุณไม่ต้องการใช้ PayPal';
$txt['paypal_additional_emails'] = 'ที่อยู่อีเมล PayPal หลัก';
$txt['paypal_additional_emails_desc'] = 'ถ้าต่างกัน (สำหรับบัญชีธุรกิจ)';
$txt['paypal_sandbox_email'] = 'ที่อยู่อีเมลแซนด์บ็อกซ์ PayPal';
$txt['paypal_sandbox_email_desc'] = 'สามารถเว้นว่างไว้ได้หากโหมดทดสอบถูกปิดใช้งานหรือไม่ได้ใช้ PayPal';

// argument(s): $boardurl
$txt['paid_note'] = '<strong class="alert">Note:</strong><br>
SMF currently supports <strong>PayPal</strong> as the installed payment method.
<ul class="bbc_list">
	<li>It is not necessary to enable IPN in your PayPal account; but if you do, the forum will receive payment notifications for all payments made to your account, and this will generate Paid Subscriptions errors for payments that are not subscription related.</li>
	<li>You must have a business or premier account to use recurring payments.</li>
	<li>You must provide your primary PayPal email address for validation purposes.</li>
</ul>
<br>
If you install a different payment gateway, you may need to set up a return URL for payment notification. For all payment types, this return URL should be set as:
<br><br>
<ul class="bbc_list">
	<li><strong>%1$s/subscriptions.php</strong></li>
</ul>
<br>
You can normally find it in your customer panels, usually under the term &quot;Return URL&quot; or &quot;Callback URL&quot;.';

// View subscription strings.
$txt['paid_name'] = 'ชื่อ';
$txt['paid_status'] = 'สถานะ';
$txt['paid_cost'] = 'ค่าใช้จ่าย';
$txt['paid_duration'] = 'ระยะเวลา';
$txt['paid_active'] = 'เปิดใช้งานแล้ว';
$txt['paid_pending'] = 'รอดำเนินการชำระเงิน';
$txt['paid_finished'] = 'เสร็จสิ้น';
$txt['paid_total'] = 'ทั้งหมด';
$txt['paid_is_active'] = 'เปิดใช้งานแล้ว';
$txt['paid_none_yet'] = 'คุณยังไม่ได้ตั้งค่าการสมัครใดๆ';
$txt['paid_payments_pending'] = 'การชำระเงินที่รอดำเนินการ';
$txt['paid_order'] = 'ลำดับ';

$txt['yes'] = 'ใช่';
$txt['no'] = 'ไม่';

// Add/Edit/Delete subscription.
$txt['paid_add_subscription'] = 'เพิ่มการสมัครสมาชิก';
$txt['paid_edit_subscription'] = 'แก้ไขการสมัคร';
$txt['paid_delete_subscription'] = 'ลบการสมัคร';

$txt['paid_mod_name'] = 'ชื่อสมัคสมาชิก';
$txt['paid_mod_desc'] = 'คำอธิบาย';
$txt['paid_mod_reminder'] = 'ส่งอีเมลเตือนความจำ';
$txt['paid_mod_reminder_desc'] = 'วันก่อนการสมัครสมาชิกจะหมดอายุเพื่อส่งการเตือนความจำ';
$txt['paid_mod_email'] = 'อีเมลที่จะส่งเมื่อเสร็จสิ้น';
$txt['paid_mod_email_desc'] = 'โดยที่ {NAME} เป็นชื่อสมาชิก {FORUM} คือชื่อชุมชน หัวเรื่องอีเมลควรอยู่ในบรรทัดแรก ว่างเปล่าสำหรับไม่มีการแจ้งเตือนทางอีเมล';
$txt['paid_mod_cost_usd'] = 'ค่าใช้จ่าย (USD)';
$txt['paid_mod_cost_eur'] = 'ค่าใช้จ่าย (EUR)';
$txt['paid_mod_cost_gbp'] = 'ค่าใช้จ่าย (GBP)';
$txt['paid_mod_cost_cad'] = 'ค่าใช้จ่าย (CAD)';
$txt['paid_mod_cost_aud'] = 'ค่าใช้จ่าย (AUD)';
$txt['paid_mod_cost_blank'] = 'เว้นว่างไว้เพื่อไม่ให้เสนอสกุลเงินนี้';
$txt['paid_mod_span'] = 'ระยะเวลาของการสมัคร';
$txt['paid_mod_span_days'] = 'วัน';
$txt['paid_mod_span_weeks'] = 'สัปดาห์';
$txt['paid_mod_span_months'] = 'เดือน';
$txt['paid_mod_span_years'] = 'ปี';
$txt['paid_mod_active'] = 'เปิดใช้งานแล้ว';
$txt['paid_mod_active_desc'] = 'ต้องสมัครสมาชิกใหม่จึงจะเข้าร่วมได้';
$txt['paid_mod_prim_group'] = 'กลุ่มหลักเมื่อสมัครสมาชิก';
$txt['paid_mod_prim_group_desc'] = 'กลุ่มหลักที่จะนำผู้ใช้เข้าเมื่อสมัครสมาชิก';
$txt['paid_mod_add_groups'] = 'กลุ่มเพิ่มเติมเมื่อสมัครสมาชิก';
$txt['paid_mod_add_groups_desc'] = 'กลุ่มเพิ่มเติมเพื่อเพิ่มผู้ใช้หลังจากสมัครสมาชิก';
$txt['paid_mod_no_group'] = 'อย่าเปลี่ยน';
$txt['paid_mod_edit_note'] = 'โปรดทราบว่าเนื่องจากกลุ่มนี้มีสมาชิกอยู่แล้ว จึงไม่สามารถเปลี่ยนแปลงการตั้งค่ากลุ่มได้!';
$txt['paid_mod_delete_warning'] = '<strong>คำเตือน</strong><br><br>หากคุณลบการสมัครนี้ ผู้ใช้ทั้งหมดที่สมัครรับข้อมูลในปัจจุบันจะสูญเสียสิทธิ์การเข้าถึงที่ได้รับจากการสมัครรับข้อมูล เว้นแต่คุณจะแน่ใจว่าต้องการทำเช่นนี้ ขอแนะนำให้คุณปิดใช้งานการสมัครรับข้อมูลแทนที่จะลบออก<br>';
$txt['paid_mod_repeatable'] = 'อนุญาตให้ผู้ใช้ต่ออายุการสมัครสมาชิกนี้โดยอัตโนมัติ';
$txt['paid_mod_fixed_price'] = 'สมัครสมาชิกราคาคงที่และระยะเวลา';
$txt['paid_mod_flexible_price'] = 'ราคาการสมัครสมาชิกแตกต่างกันไปตามระยะเวลาที่สั่งซื้อ';
$txt['paid_mod_price_breakdown'] = 'รายละเอียดราคาที่ยืดหยุ่น';
$txt['paid_mod_price_breakdown_desc'] = 'กำหนดที่นี่ว่าค่าสมัครสมาชิกควรมีค่าใช้จ่ายเท่าใดขึ้นอยู่กับช่วงเวลาที่สมัคร ตัวอย่างเช่น การสมัครใช้บริการอาจมีค่าใช้จ่าย 12USD สำหรับหนึ่งเดือน แต่เพียง 100USD ต่อปีเท่านั้น หากคุณไม่ต้องการกำหนดราคาในช่วงเวลาใดเวลาหนึ่ง ให้เว้นว่างไว้';
$txt['flexible'] = 'ยืดหยุ่น';

$txt['paid_per_day'] = 'ราคาต่อวัน';
$txt['paid_per_week'] = 'ราคาต่อสัปดาห์';
$txt['paid_per_month'] = 'ราคาต่อเดือน';
$txt['paid_per_year'] = 'ราคาต่อปี';
$txt['day'] = 'วัน';
$txt['week'] = 'สัปดาห์';
$txt['month'] = 'เดือน';
$txt['year'] = 'ปี';

// View subscribed users.
$txt['viewing_users_subscribed'] = 'กำลังดูผู้ใช้';
$txt['view_users_subscribed'] = 'กำลังดูผู้ใช้ที่สมัครรับข้อมูล: &quot;%1$s&quot;';
$txt['no_subscribers'] = 'ขณะนี้ไม่มีสมาชิกสำหรับการสมัครรับข้อมูลนี้';
$txt['add_subscriber'] = 'เพิ่มสมาชิกใหม่';
$txt['edit_subscriber'] = 'แก้ไขสมาชิก';
$txt['delete_selected'] = 'ลบที่เลือกไว้';
$txt['complete_selected'] = 'เติมที่เลือกไว้';

// @todo These strings are used in conjunction with JavaScript. Use numeric entities.
$txt['delete_are_sure'] = 'คุณแน่ใจหรือไม่ว่าต้องการลบบันทึกทั้งหมดของการสมัครรับข้อมูลที่เลือก';
$txt['complete_are_sure'] = 'คุณแน่ใจหรือไม่ว่าต้องการสมัครรับข้อมูลที่เลือกให้เสร็จสมบูรณ์';

$txt['start_date'] = 'วันที่เริ่มต้น';
$txt['end_date'] = 'วันที่สิ้นสุด';
$txt['start_date_and_time'] = 'วันที่และเวลาเริ่มต้น';
$txt['end_date_and_time'] = 'วันที่และเวลาสิ้นสุด';
$txt['edit'] = 'แก้ไข';
$txt['one_username'] = 'โปรดป้อนชื่อผู้ใช้เดียวเท่านั้น';
$txt['minute'] = 'นาที';
$txt['error_member_not_found'] = 'ไม่พบสมาชิกที่ป้อน';
$txt['member_already_subscribed'] = 'สมาชิกรายนี้สมัครรับข้อมูลการสมัครสมาชิกนี้แล้ว โปรดแก้ไขการสมัครสมาชิกที่มีอยู่';
$txt['search_sub'] = 'ค้นหาผู้ใช้';

// Make payment.
$txt['paid_confirm_payment'] = 'ยืนยันการชำระเงิน';
$txt['paid_confirm_desc'] = 'หากต้องการดำเนินการชำระเงินต่อ โปรดตรวจสอบรายละเอียดด้านล่างและกด &quot;สั่งซื้อ&quot;';
$txt['paypal'] = 'PayPal';
$txt['paid_confirm_paypal'] = 'หากต้องการชำระเงินโดยใช้ <a href="https://www.paypal.com">PayPal</a> โปรดคลิกปุ่มด้านล่าง คุณจะถูกนำไปที่ไซต์ PayPal เพื่อชำระเงิน';
$txt['paid_paypal_order'] = 'สั่งซื้อกับ PayPal';
$txt['paid_done'] = 'ชำระเงินเรียบร้อยแล้ว';
$txt['paid_done_desc'] = 'ขอบคุณสำหรับการชำระเงินของคุณ เมื่อธุรกรรมได้รับการยืนยันแล้ว การสมัครจะเปิดใช้งาน';
$txt['paid_sub_return'] = 'กลับไปที่การสมัครรับข้อมูล';
$txt['paid_current_desc'] = 'ด้านล่างนี้คือรายการการสมัครรับข้อมูลปัจจุบันและก่อนหน้าทั้งหมดของคุณ หากต้องการขยายการสมัครสมาชิกที่มีอยู่ ให้เลือกจากรายการด้านบน';
$txt['paid_admin_add'] = 'เพิ่มการสมัครสมาชิกนี้';

$txt['paid_not_set_currency'] = 'คุณยังไม่ได้ตั้งค่าสกุลเงินของคุณ โปรดดำเนินการจากส่วน<a href="%1$s">การตั้งค่า</a>ก่อนดำเนินการต่อ';
$txt['paid_no_cost_value'] = 'คุณต้องป้อนค่าใช้จ่ายและระยะเวลาในการสมัคร';
$txt['paid_invalid_duration'] = 'คุณต้องป้อนระยะเวลาที่ถูกต้องสำหรับการสมัครนี้';
$txt['paid_invalid_duration_D'] = 'หากกำหนดระยะเวลาการสมัครสมาชิกเป็นวัน คุณสามารถใช้ได้ 1 ถึง 90 วันเท่านั้น หากคุณต้องการสมัครสมาชิกนาน คุณควรใช้สัปดาห์ เดือน หรือปี';
$txt['paid_invalid_duration_W'] = 'หากกำหนดระยะเวลาการสมัครสมาชิกเป็นสัปดาห์ คุณสามารถใช้ได้ 1 ถึง 52 สัปดาห์เท่านั้น หากคุณต้องการสมัครสมาชิกนาน คุณควรใช้เดือนหรือปี';
$txt['paid_invalid_duration_M'] = 'หากกำหนดระยะเวลาการสมัครสมาชิกเป็นเดือน คุณจะใช้ได้เพียง 1 ถึง 24 เดือนเท่านั้น หากคุณต้องการสมัครสมาชิกนาน คุณควรใช้ปี';
$txt['paid_invalid_duration_Y'] = 'หากกำหนดระยะเวลาการสมัครสมาชิกเป็นปี คุณสามารถใช้ได้ 1 ถึง 5 ปีเท่านั้น';
$txt['paid_all_freq_blank'] = 'คุณต้องป้อนต้นทุนอย่างน้อยหนึ่งในสี่ระยะเวลา';

// Some error strings.
$txt['paid_no_data'] = 'ไม่มีการส่งข้อมูลที่ถูกต้องไปยังสคริปต์';

$txt['paypal_could_not_connect'] = 'ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ PayPal';
$txt['paid_sub_not_active'] = 'การสมัครสมาชิกนั้นไม่ได้รับผู้ใช้ใหม่';
$txt['paid_disabled'] = 'การสมัครแบบชำระเงินปิดใช้งานอยู่ในขณะนี้';
$txt['paid_unknown_transaction_type'] = 'ประเภทธุรกรรมการสมัครสมาชิกแบบชำระเงินที่ไม่รู้จัก';
$txt['paid_empty_member'] = 'ตัวจัดการการสมัครสมาชิกแบบชำระเงินไม่สามารถกู้คืน ID สมาชิกได้';
$txt['paid_could_not_find_member'] = 'ตัวจัดการการสมัครสมาชิกแบบชำระเงินไม่พบสมาชิกที่มี ID: %1$d';
$txt['paid_count_not_find_subscription'] = 'ตัวจัดการการสมัครสมาชิกแบบชำระเงินไม่พบการสมัครสมาชิกสำหรับ ID สมาชิก: %1$s, ID การสมัครสมาชิก: %2$s';
$txt['paid_count_not_find_subscription_log'] = 'ตัวจัดการการสมัครสมาชิกแบบชำระเงินไม่พบรายการบันทึกการสมัครสำหรับ ID สมาชิก: %1$s, ID การสมัครสมาชิก: %2$s';
$txt['paid_count_not_find_outstanding_payment'] = 'ไม่พบรายการชำระเงินคงค้างสำหรับรหัสสมาชิก: %1$s รหัสการสมัครรับข้อมูล: %2$s เพิกเฉย';
$txt['paid_admin_not_setup_gateway'] = 'ขออภัย ผู้ดูแลระบบยังตั้งค่าการสมัครสมาชิกแบบชำระเงินไม่เสร็จ โปรดกลับมาตรวจสอบในภายหลัง';
$txt['paid_make_recurring'] = 'ชำระเงินเป็นงวด';

$txt['subscriptions'] = 'การสมัครรับข้อมูล';
$txt['subscription'] = 'การสมัครรับข้อมูล';
$txt['paid_subs_desc'] = 'ด้านล่างนี้คือรายการการสมัครรับข้อมูลทั้งหมดที่มีอยู่ในฟอรัมนี้';
$txt['paid_subs_none'] = 'ขณะนี้ไม่มีการสมัครสมาชิกแบบชำระเงิน';

$txt['paid_current'] = 'การสมัครรับข้อมูลที่มีอยู่';
$txt['pending_payments'] = 'การชำระเงินที่รอดำเนินการ';
$txt['pending_payments_desc'] = 'สมาชิกรายนี้พยายามชำระเงินต่อไปนี้สำหรับการสมัครรับข้อมูลนี้ แต่ฟอรัมยังไม่ได้รับการยืนยัน หากคุณแน่ใจว่าได้รับการชำระเงินแล้ว ให้คลิก &quot;ยอมรับ&quot; เพื่อดำเนินการสมัครรับข้อมูล หรือคุณสามารถคลิก &quot;ลบ&quot; เพื่อลบการอ้างอิงถึงการชำระเงินทั้งหมด';
$txt['pending_payments_value'] = 'ค่า';
$txt['pending_payments_accept'] = 'ยอมรับ';
$txt['pending_payments_remove'] = 'ลบ';

?>