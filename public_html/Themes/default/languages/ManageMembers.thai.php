<?php
// Version: 2.1.0; ManageMembers

global $context;

$txt['groups'] = 'Groups';
$txt['viewing_groups'] = 'Viewing Membergroups';

$txt['membergroups_title'] = 'จัดการกลุ่มสมาชิก';
$txt['membergroups_description'] = 'กลุ่มสมาชิก คือ กลุ่มของสมาชิก ซึ่งมีตั้งค่าการอนุญาตการเข้าถึง กลุ่มสมาชิกจำนวนหนึ่งเป็นกลุ่มมาตรฐานที่กำหนดไว้โดยการนับจำนวนกระทู้ คุณสามารถกำหนดให้ใครบางคนสามารถเข้าถึงบางบอร์ดและการตั้งค่าการใช้งานเพิ่มเติมได้';
$txt['membergroups_modify'] = 'แก้ไข';

$txt['membergroups_add_group'] = 'เพิ่มกลุ่ม';
$txt['membergroups_regular'] = 'กลุ่มฟอรั่มพื้นฐาน';
$txt['membergroups_post'] = 'กลุ่มที่นับจำนวนของกระทู้';
$txt['membergroups_guests_na'] = 'n/a';

$txt['membergroups_group_name'] = 'ชื่อกลุ่มสมาชิก';
$txt['membergroups_new_board'] = 'บอร์ดที่มองเห็นได้';
$txt['membergroups_new_board_desc'] = 'บอร์ดที่สมาชิกกลุ่มนี้สามารถมองเห็นได้';
$txt['membergroups_new_board_post_groups'] = '<em>บันทึก: ตามปกติ, กลุ่มหัวข้อที่ไม่ต้องการเข้าถึง แต่ว่ากลุ่มสมาชิกในนี้จะให้พวกเขาเข้าถึง</em>';
$txt['membergroups_new_as_inherit'] = 'inherit from';
$txt['membergroups_new_as_type'] = 'โดยชนิด';
$txt['membergroups_new_as_copy'] = 'หรือพื้นฐานของ';
$txt['membergroups_new_copy_none'] = '(ไม่มี)';
$txt['membergroups_can_edit_later'] = 'คุณสามารถแก้ไขได้ภายหลัง';
$txt['membergroups_can_manage_access'] = 'This group can see all boards because they have the power to manage boards.';

$txt['membergroups_cannot_delete_paid'] = 'This group cannot be deleted, it is currently in use by the following paid subscription(s): %1$s';

$txt['membergroups_edit_group'] = 'แก้ไขกลุ่ม';
$txt['membergroups_edit_name'] = 'ชื่อกลุ่ม';
$txt['membergroups_edit_inherit_permissions'] = 'Inherit permissions';
$txt['membergroups_edit_inherit_permissions_desc'] = 'Select &quot;No&quot; to enable group to have own permission set.';
$txt['membergroups_edit_inherit_permissions_no'] = 'No - Use unique permissions';
$txt['membergroups_edit_inherit_permissions_from'] = 'Inherit from';
$txt['membergroups_edit_hidden'] = 'Visibility';
$txt['membergroups_edit_hidden_no'] = 'Visible';
$txt['membergroups_edit_hidden_boardindex'] = 'Visible - Apart from in group key';
$txt['membergroups_edit_hidden_all'] = 'Invisible';
// Do not use numeric entities in the below string.
$txt['membergroups_edit_hidden_warning'] = 'Are you sure you want to disallow assignment of this group as a users primary group?\n\nDoing so will restrict assignment to additional groups only, and will update all current &quot;primary&quot; members to have it as an additional group only.\n\nIt will also remove the group as moderator from any boards it is currently assigned to moderate.';
$txt['membergroups_edit_desc'] = 'Group description';
$txt['membergroups_edit_group_type'] = 'Group type';
$txt['membergroups_edit_select_group_type'] = 'Select Group type';
$txt['membergroups_group_type_private'] = 'Private <span class="smalltext">(Membership must be assigned)</span>';
$txt['membergroups_group_type_protected'] = 'Protected <span class="smalltext">(Only administrators can manage and assign)</span>';
$txt['membergroups_group_type_request'] = 'Requestable <span class="smalltext">(User may request membership)</span>';
$txt['membergroups_group_type_free'] = 'Free <span class="smalltext">(User may leave and join group at will)</span>';
$txt['membergroups_group_type_post'] = 'Post Based <span class="smalltext">(Membership based on post count)</span>';
$txt['membergroups_min_posts'] = 'จำนวนกระทู้ที่ต้องการ';
$txt['membergroups_online_color'] = 'สีรายชื่อขณะออนไลน์';
$txt['membergroups_icon_count'] = 'Number of icon images';
$txt['membergroups_icon_image'] = 'Icon image filename';
$txt['membergroups_icon_image_note'] = 'You can upload custom images to the forum\'s default theme directory to be able to select them here. Different images can be used in different themes, just give them the same name.';
$txt['membergroups_icon_image_size'] = 'Max size allowed 128x32px';
$txt['membergroups_max_messages'] = 'จำนวนข้อความส่วนตัวสูงสุด';
$txt['membergroups_max_messages_note'] = '0 = ไม่จำกัด';
$txt['membergroups_tfa_force'] = 'Force Two-Factor-Authentication (2FA) for this membergroup';
$txt['membergroups_tfa_force_note'] = 'Be sure to warn your users before you activate this!';
$txt['membergroups_edit_save'] = 'บันทึก';
$txt['membergroups_delete'] = 'ลบ';
$txt['membergroups_confirm_delete'] = 'คุณแน่ใจหรือไม่ที่จะลบกลุ่มนี้?';
$txt['membergroups_confirm_delete_mod'] = 'This group is assigned to moderate one or more boards. Are you sure you want to delete it?';
$txt['membergroups_swap_mod'] = 'This group is assigned to moderate one or more boards. Changing it to a post group will result in that group being dropped as moderator of those boards.';

$txt['membergroups_members_title'] = 'แสดงสมาชิกทั้งหมดจากกลุ่ม';
$txt['membergroups_members_group_members'] = 'Group Members';
$txt['membergroups_members_no_members'] = 'กลุ่มนี้ปัจจุบันว่างเปล่า';
$txt['membergroups_members_add_title'] = 'เพิ่มสมาชิกที่กลุ่มนี้';
$txt['membergroups_members_add_desc'] = 'รายการของสมาชิกเพื่อเพิ่ม';
$txt['membergroups_members_add'] = 'เพิ่มสมาชิก';
$txt['membergroups_members_remove'] = 'ลบออกจากกลุ่ม';
$txt['membergroups_members_last_active'] = 'Last Active';
$txt['membergroups_members_additional_only'] = 'Add as additional group only.';
$txt['membergroups_members_group_moderators'] = 'Group Moderators';
$txt['membergroups_members_description'] = 'Description';
// Use javascript escaping in the below.
$txt['membergroups_members_deadmin_confirm'] = 'Are you sure you wish to remove yourself from the Administration group?';

$txt['membergroups_postgroups'] = 'กลุ่มกระทู้';
$txt['membergroups_settings'] = 'ตั้งค่ากลุ่มสมาชิก';
$txt['groups_manage_membergroups'] = 'กลุ่มที่อนุญาตให้แก้ไขกลุ่มสมาชิก';
$txt['membergroups_select_permission_type'] = 'เลือกอนุญาตข้อมูลส่วนตัว';
$txt['membergroups_images_url'] = 'Themes/default/images/membericons/';
$txt['membergroups_select_visible_boards'] = 'แสดงบอร์ด';
$txt['membergroups_members_top'] = 'Members';
$txt['membergroups_name'] = 'Name';
$txt['membergroups_icons'] = 'Icons';

$txt['admin_browse_approve'] = 'สมาชิกที่กำลังรออนุมัติ';
$txt['admin_browse_approve_desc'] = 'จากที่นี่คุณสามารถจัดการสมาชิกที่กำลังรออนุมัติทั้งหมด';
$txt['admin_browse_activate'] = 'สมาชิกที่รอยืนยันการใช้งาน';
$txt['admin_browse_activate_desc'] = 'จากที่นี่คุณสามารถจัดการสมาชิกที่กำลังรอยืนยันการใช้งานทั้งหมด';
$txt['admin_browse_awaiting_approval'] = 'รออนุมัติ <span style="font-weight: normal">(%d)</span>';
$txt['admin_browse_awaiting_activate'] = 'รอยืนยันการใช้งาน <span style="font-weight: normal">(%d)</span>';

$txt['admin_browse_username'] = 'ชื่อผู้ใช้งาน';
$txt['admin_browse_email'] = 'อีเมล์';
$txt['admin_browse_ip'] = 'IP Address';
$txt['admin_browse_registered'] = 'ลงทะเบียน';
$txt['admin_browse_id'] = 'ID';
$txt['admin_browse_with_selected'] = 'เลือกกับ';
$txt['admin_browse_no_members_approval'] = 'ขณะนี้ไม่มีสมาชิกที่กำลังรออนุมัติ';
$txt['admin_browse_no_members_activate'] = 'ขณะนี้ไม่มีสมาชิกที่รอยืนยันการใช้งาน';

// Don't use entities in the below strings, except the main ones. (lt, gt, quot.)
$txt['admin_browse_warn'] = 'เลือกสมาชิกทั้งหมด?';
$txt['admin_browse_outstanding_warn'] = 'ละทิ้งสมาชิกทั้งหมด?';
$txt['admin_browse_w_approve'] = 'อนุมัติ';
$txt['admin_browse_w_activate'] = 'ยืนยัน';
$txt['admin_browse_w_delete'] = 'ลบ';
$txt['admin_browse_w_reject'] = 'ทิ้ง';
$txt['admin_browse_w_remind'] = 'เตือน';
$txt['admin_browse_w_approve_deletion'] = 'อนุมัติ (ลบชื่อผู้ใช้งาน)';
$txt['admin_browse_w_email'] = 'และส่งอีเมล์';
$txt['admin_browse_no_email'] = '(no email)';
$txt['admin_browse_w_approve_require_activate'] = 'อนุมัติและต้องการ การยืนยันใช้งาน';

$txt['admin_browse_filter_by'] = 'กรองโดย';
$txt['admin_browse_filter_show'] = 'การแสดงผล';
$txt['admin_browse_filter_type_0'] = 'ชื่อผู้ใช้งานใหม่ยังไม่ได้ยืนยันใช้งาน';
$txt['admin_browse_filter_type_2'] = 'เปลี่ยนอีเมล์ที่ยังไม่ได้ยืนยันใช้งาน';
$txt['admin_browse_filter_type_3'] = 'ชื่อผู้ใช้งานใหม่ยังไม่ได้อนุมัติ';
$txt['admin_browse_filter_type_4'] = 'ลบชื่อผู้ใช้งานที่ไม่ได้อนุมัติ';
$txt['admin_browse_filter_type_5'] = 'Unapproved underage accounts';

$txt['admin_browse_outstanding'] = 'สมาชิกที่สำคัญ';
$txt['admin_browse_outstanding_days_1'] = 'กับสมาชิกทั้งหมดที่ลงทะเบียนนานกว่า';
$txt['admin_browse_outstanding_days_2'] = 'วัน';
$txt['admin_browse_outstanding_perform'] = 'กระทำดังต่อไปนี้';
$txt['admin_browse_outstanding_go'] = 'ปฏิบัติ';

$txt['check_for_duplicate'] = 'Check for duplicates';
$txt['dont_check_for_duplicate'] = 'Don\'t check for duplicates';
$txt['duplicates'] = 'Duplicates';

$txt['not_activated'] = 'Not activated';

?>