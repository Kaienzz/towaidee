<?php
// Version: 2.1.0; EmailTemplates

// Since all of these strings are being used in emails, numeric entities should be used.

// Do not translate anything that is between {}, they are used as replacement variables and MUST remain exactly how they are.
//   Additionally, do not translate the @additional_params: line or the variable names in the lines that follow it. You may
//   translate the description of the variable. Do not translate @description:, however you may translate the rest of that line.

// Do not use block comments in this file, they will have special meaning.

global $txtBirthdayEmails;

/**
	@additional_params: resend_activate_message
		REALNAME: The display name for the member receiving the email.
		USERNAME:  The user name for the member receiving the email.
		ACTIVATIONLINK:  The URL link to activate the member's account.
		ACTIVATIONCODE:  The code needed to activate the member's account.
		ACTIVATIONLINKWITHOUTCODE: The URL to the page where the activation code can be entered.
		FORGOTPASSWORDLINK: The URL to the "forgot password" page.
	@description:
*/
$txt['resend_activate_message_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['resend_activate_message_body'] = 'ขอขอบคุณสำหรับการลงทะเบียนที่ {FORUMNAME} ชื่อผู้ใช้ของคุณคือ {USERNAME} หากคุณลืมรหัสผ่าน คุณสามารถรีเซ็ตได้โดยไปที่ {FORGOTPASSWORDLINK}

ก่อนที่คุณจะสามารถเข้าสู่ระบบ คุณต้องเปิดใช้งานบัญชีของคุณก่อนโดยเลือกลิงก์ต่อไปนี้:

{ACTIVATIONLINK}

หากคุณมีปัญหาใดๆ ในการเปิดใช้งาน โปรดไปที่ {ACTIVATIONLINKWITHOUTCODE} และป้อนรหัส "{ACTIVATIONCODE}"

{REGARDS}';

/**
	@additional_params: resend_pending_message
		REALNAME: The display name for the member receiving the email.
		USERNAME:  The user name for the member receiving the email.
	@description:
*/
$txt['resend_pending_message_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['resend_pending_message_body'] = 'สวัสดี {REALNAME} คำขอลงทะเบียนของคุณที่ {FORUMNAME} ได้รับแล้ว

ชื่อผู้ใช้ที่คุณลงทะเบียนคือ {USERNAME}

ก่อนที่คุณจะเข้าสู่ระบบและเริ่มใช้ฟอรัมได้ คำขอของคุณจะได้รับการตรวจสอบและอนุมัติ

{REGARDS}';

/**
	@additional_params: mc_group_approve
		USERNAME: The user name for the member receiving the email.
		GROUPNAME: The name of the membergroup that the user was accepted into.
	@description: The request to join a particular membergroup has been accepted.
*/
$txt['mc_group_approve_subject'] = 'การอนุมัติการเป็นสมาชิกกลุ่ม';
$txt['mc_group_approve_body'] = 'เรียน {USERNAME},

เรายินดีที่จะแจ้งให้คุณทราบว่าการสมัครเข้าร่วมกลุ่ม "{GROUPNAME}" ที่ {FORUMNAME} ของคุณได้รับการยอมรับแล้ว และบัญชีของคุณได้รับการอัปเดตเพื่อรวมกลุ่มสมาชิกใหม่นี้

{REGARDS}';

/**
	@additional_params: mc_group_reject
		USERNAME: The user name for the member receiving the email.
		GROUPNAME: The name of the membergroup that the user was rejected from.
	@description: The request to join a particular membergroup has been rejected.
*/
$txt['mc_group_reject_subject'] = 'การปฏิเสธการเป็นสมาชิกกลุ่ม';
$txt['mc_group_reject_body'] = 'เรียน {USERNAME},

ขออภัยที่ต้องแจ้งให้คุณทราบว่าการสมัครเข้าร่วมกลุ่ม "{GROUPNAME}" ที่ {FORUMNAME} ของคุณถูกปฏิเสธ

{REGARDS}';

/**
	@additional_params: mc_group_reject_reason
		USERNAME: The user name for the member receiving the email.
		GROUPNAME: The name of the membergroup that the user was rejected from.
		REASON: Reason for the rejection.
	@description: The request to join a particular membergroup has been rejected with a reason given.
*/
$txt['mc_group_reject_reason_subject'] = 'การปฏิเสธการเป็นสมาชิกกลุ่ม';
$txt['mc_group_reject_reason_body'] = 'เรียน {USERNAME},

ขออภัยที่ต้องแจ้งให้คุณทราบว่าการสมัครเข้าร่วมกลุ่ม "{GROUPNAME}" ที่ {FORUMNAME} ของคุณถูกปฏิเสธ

นี่เป็นเพราะเหตุผลต่อไปนี้: {REASON}

{REGARDS}';

/**
	@additional_params: admin_approve_accept
		NAME: The display name of the member.
		USERNAME: The user name for the member receiving the email.
		PROFILELINK: The URL of the profile page.
		FORGOTPASSWORDLINK: The URL of the "forgot password" page.
	@description:
*/
$txt['admin_approve_accept_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['admin_approve_accept_body'] = 'ยินดีต้อนรับ {NAME}

บัญชีของคุณได้รับการเปิดใช้งานด้วยตนเองโดยผู้ดูแลระบบ และขณะนี้คุณสามารถเข้าสู่ระบบและโพสต์ได้ ชื่อผู้ใช้ของคุณคือ: {USERNAME} หากคุณลืมรหัสผ่าน คุณสามารถเปลี่ยนได้ที่ {FORGOTPASSWORDLINK}

{REGARDS}';

/**
	@additional_params: admin_approve_activation
		USERNAME: The user name for the member receiving the email.
		ACTIVATIONLINK:  The URL link to activate the member's account.
		ACTIVATIONLINKWITHOUTCODE: The URL to the page where the activation code can be entered.
		ACTIVATIONCODE: The activation code.
	@description:
*/
$txt['admin_approve_activation_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['admin_approve_activation_body'] = 'ยินดีต้อนรับ {USERNAME}!

บัญชีของคุณบน {FORUMNAME} ได้รับการอนุมัติจากผู้ดูแลฟอรัม ก่อนที่คุณจะสามารถเข้าสู่ระบบ คุณต้องเปิดใช้งานบัญชีของคุณก่อนโดยเลือกลิงก์ต่อไปนี้:

{ACTIVATIONLINK}

หากคุณมีปัญหาใดๆ ในการเปิดใช้งาน โปรดไปที่ {ACTIVATIONLINKWITHOUTCODE} และป้อนรหัส "{ACTIVATIONCODE}"

{REGARDS}';

/**
	@additional_params: admin_approve_reject
		USERNAME: The user name for the member receiving the email.
	@description:
*/
$txt['admin_approve_reject_subject'] = 'การลงทะเบียนถูกปฏิเสธ';
$txt['admin_approve_reject_body'] = 'เรียน {USERNAME},

ขออภัย ใบสมัครเข้าร่วม {FORUMNAME} ของคุณถูกปฏิเสธ

{REGARDS}';

/**
	@additional_params: admin_approve_delete
		USERNAME: The user name for the member receiving the email.
	@description:
*/
$txt['admin_approve_delete_subject'] = 'บัญชีถูกลบ';
$txt['admin_approve_delete_body'] = 'เรียน {USERNAME},

บัญชีของคุณบน {FORUMNAME} ถูกลบแล้ว อาจเป็นเพราะคุณไม่เคยเปิดใช้งานบัญชีของคุณ ซึ่งในกรณีนี้ คุณควรจะสามารถลงทะเบียนได้อีกครั้ง

{REGARDS}';

/**
	@additional_params: admin_approve_remind
		USERNAME: The user name for the member receiving the email.
		ACTIVATIONLINK:  The URL link to activate the member's account.
		ACTIVATIONLINKWITHOUTCODE: The URL to the page where the activation code can be entered.
		ACTIVATIONCODE: The activation code.
	@description:
*/
$txt['admin_approve_remind_subject'] = 'การแจ้งเตือนการลงทะเบียน';
$txt['admin_approve_remind_body'] = 'เรียน {USERNAME},
คุณยังไม่ได้เปิดใช้งานบัญชีของคุณที่ {FORUMNAME}

โปรดใช้ลิงก์ด้านล่างเพื่อเปิดใช้งานบัญชีของคุณ:
{ACTIVATIONLINK}

หากคุณมีปัญหาใดๆ ในการเปิดใช้งาน โปรดไปที่ {ACTIVATIONLINKWITHOUTCODE} และป้อนรหัส "{ACTIVATIONCODE}"

{REGARDS}';

/**
	@additional_params:
		USERNAME: The user name for the member receiving the email.
		ACTIVATIONLINK:  The URL link to activate the member's account.
		ACTIVATIONLINKWITHOUTCODE: The URL to the page where the activation code can be entered.
		ACTIVATIONCODE: The activation code.
	@description:
*/
$txt['admin_register_activate_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['admin_register_activate_body'] = 'ขอขอบคุณสำหรับการลงทะเบียนที่ {FORUMNAME} ชื่อผู้ใช้ของคุณคือ {USERNAME} และรหัสผ่านของคุณคือ {PASSWORD}

ก่อนที่คุณจะสามารถเข้าสู่ระบบ คุณต้องเปิดใช้งานบัญชีของคุณก่อนโดยเลือกลิงก์ต่อไปนี้:

{ACTIVATIONLINK}

หากคุณมีปัญหาใดๆ ในการเปิดใช้งาน โปรดไปที่ {ACTIVATIONLINKWITHOUTCODE} และป้อนรหัส "{ACTIVATIONCODE}"

{REGARDS}';

$txt['admin_register_immediate_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['admin_register_immediate_body'] = 'ขอขอบคุณสำหรับการลงทะเบียนที่ {FORUMNAME} ชื่อผู้ใช้ของคุณคือ {USERNAME} รหัสผ่านของคุณคือ {PASSWORD} และ URL ของฟอรัมคือ: {SCRIPTURL}

{REGARDS}';

/**
	@additional_params: new_announcement
		TOPICSUBJECT: The subject of the topic being announced.
		MESSAGE: The message body of the first post of the announced topic.
		TOPICLINK: A link to the topic being announced.
		UNSUBSCRIBELINK: Link to unsubscribe from announcements.
	@description:
*/
$txt['new_announcement_subject'] = 'ประกาศใหม่: {TOPICSUBJECT}';
$txt['new_announcement_body'] = '{MESSAGE}

คุณสามารถดูประกาศฉบับเต็มได้โดยไปที่ลิงค์นี้:
{TOPICLINK}

หากต้องการยกเลิกการสมัครรับข่าวสารเหล่านี้ ให้ไปที่ลิงก์นี้:
{UNSUBSCRIBELINK}

สำหรับการควบคุมการแจ้งเตือนทางอีเมลที่คุณได้รับมากขึ้น ให้เข้าสู่ระบบฟอรัมและไปที่ส่วนการแจ้งเตือนในโปรไฟล์ของคุณ

{REGARDS}';

/**
	@additional_params: notify_boards_once_body
		TOPICSUBJECT: The subject of the topic causing the notification
		TOPICLINK: A link to the topic.
		MESSAGE: This is the body of the message.
		UNSUBSCRIBELINK: Link to unsubscribe from notifications.
	@description:
*/
$txt['notify_boards_once_body_subject'] = 'หัวข้อใหม่: {TOPICSUBJECT}';
$txt['notify_boards_once_body_body'] = 'มีการสร้างหัวข้อใหม่ \'{TOPICSUBJECT}\' บนบอร์ดที่คุณกำลังดูอยู่

สามารถรับชมได้ที่
{TOPICLINK}

อาจมีการโพสต์หัวข้อเพิ่มเติม แต่คุณจะไม่ได้รับการแจ้งเตือนทางอีเมลเพิ่มเติมสำหรับบอร์ดนี้ จนกว่าคุณจะกลับมาที่บอร์ดและอ่านบางหัวข้อ

ข้อความของหัวข้อแสดงอยู่ด้านล่าง:
{MESSAGE}

ยกเลิกการสมัครหัวข้อใหม่จากบอร์ดนี้โดยใช้ลิงก์นี้:
{UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notify_boards_once
		TOPICSUBJECT: The subject of the topic causing the notification
		TOPICLINK: A link to the topic.
		UNSUBSCRIBELINK: Link to unsubscribe from notifications.
	@description:
*/
$txt['notify_boards_once_subject'] = 'หัวข้อใหม่: {TOPICSUBJECT}';
$txt['notify_boards_once_body'] = 'มีการสร้างหัวข้อใหม่ \'{TOPICSUBJECT}\' บนบอร์ดที่คุณกำลังดูอยู่

สามารถรับชมได้ที่
{TOPICLINK}

อาจมีการโพสต์หัวข้อเพิ่มเติม แต่คุณจะไม่ได้รับการแจ้งเตือนทางอีเมลเพิ่มเติมสำหรับบอร์ดนี้ จนกว่าคุณจะกลับมาที่บอร์ดและอ่านบางหัวข้อ

ยกเลิกการสมัครหัวข้อใหม่จากบอร์ดนี้โดยใช้ลิงก์นี้:
{UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notify_boards_body
		TOPICSUBJECT: The subject of the topic causing the notification
		TOPICLINK: A link to the topic.
		MESSAGE: This is the body of the message.
		UNSUBSCRIBELINK: Link to unsubscribe from notifications.
	@description:
*/
$txt['notify_boards_body_subject'] = 'หัวข้อใหม่: {TOPICSUBJECT}';
$txt['notify_boards_body_body'] = 'มีการสร้างหัวข้อใหม่ \'{TOPICSUBJECT}\' บนบอร์ดที่คุณกำลังดูอยู่

สามารถรับชมได้ที่
{TOPICLINK}

ข้อความของหัวข้อแสดงอยู่ด้านล่าง:
{MESSAGE}

ยกเลิกการสมัครหัวข้อใหม่จากบอร์ดนี้โดยใช้ลิงก์นี้:
{UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notify_boards
		TOPICSUBJECT: The subject of the topic causing the notification
		TOPICLINK: A link to the topic.
		UNSUBSCRIBELINK: Link to unsubscribe from notifications.
	@description:
*/
$txt['notify_boards_subject'] = 'หัวข้อใหม่: {TOPICSUBJECT}';
$txt['notify_boards_body'] = 'มีการสร้างหัวข้อใหม่ \'{TOPICSUBJECT}\' บนบอร์ดที่คุณกำลังดูอยู่

สามารถรับชมได้ที่
{TOPICLINK}

ยกเลิกการสมัครหัวข้อใหม่จากบอร์ดนี้โดยใช้ลิงก์นี้:
{UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: alert_unapproved_reply
		SUBJECT: The subject of the topic causing the notification
		LINK: A link to the topic.
	@description:
*/
$txt['alert_unapproved_reply_subject'] = 'หัวข้อตอบกลับ: {SUBJECT}';
$txt['alert_unapproved_reply_body'] = 'มีการโพสต์คำตอบใน \'{SUBJECT}\' โดย {POSTERNAME}

สามารถรับชมได้ที่
{LINK}

{REGARDS}';

/**
	@additional_params: unapproved_attachment
		SUBJECT: The subject of the topic causing the notification
		LINK: A link to the message with the attachment.
	@description:
*/
$txt['unapproved_attachment_subject'] = 'ไฟล์แนบใหม่ที่ไม่ได้รับอนุมัติใน: {SUBJECT}';
$txt['unapproved_attachment_body'] = 'มีการสร้างไฟล์แนบใหม่ใน \'{SUBJECT}\' ซึ่งต้องได้รับการอนุมัติ

คุณสามารถอนุมัติหรือปฏิเสธไฟล์แนบนี้ได้จากลิงก์ด้านล่างซึ่งจะนำคุณไปยังข้อความที่เป็นส่วนหนึ่งของ

{LINK}

{REGARDS}';

/**
	@additional_params: alert_unapproved_post
		SUBJECT: The subject of the topic causing the notification
		LINK: A link to the topic.
	@description:
*/
$txt['alert_unapproved_post_subject'] = 'กระทู้ใหม่ที่ไม่ได้รับอนุมัติ: {SUBJECT}';
$txt['alert_unapproved_post_body'] = 'มีการตั้งกระทู้ใหม่ซึ่งต้องได้รับการอนุมัติ: \'{SUBJECT}\'

คุณสามารถอนุมัติหรือปฏิเสธโพสต์นี้โดยใช้ลิงก์ด้านล่าง:
{LINK}

{REGARDS}';

/**
	@additional_params: alert_unapproved_topic
		SUBJECT: The subject of the topic causing the notification
		LINK: A link to the topic.
	@description:
*/
$txt['alert_unapproved_topic_subject'] = 'หัวข้อใหม่ที่ไม่ได้รับการอนุมัติ: {SUBJECT}';
$txt['alert_unapproved_topic_body'] = 'มีการสร้างหัวข้อใหม่ซึ่งต้องได้รับการอนุมัติ: \'{SUBJECT}\'

คุณสามารถอนุมัติหรือปฏิเสธหัวข้อนี้โดยใช้ลิงก์ด้านล่าง:
{LINK}

{REGARDS}';

/**
	@additional_params: request_membership
		RECPNAME: The name of the person receiving the email
		APPLYNAME: The name of the person applying for group membership
		GROUPNAME: The name of the group being applied to.
		REASON: The reason given by the applicant for wanting to join the group.
		MODLINK: Link to the group moderation page.
	@description:
*/
$txt['request_membership_subject'] = 'ใบสมัครกลุ่มใหม่';
$txt['request_membership_body'] = 'เรียน {RECPNAME},

{APPLYNAME} ได้ขอเป็นสมาชิกกลุ่ม "{GROUPNAME}" ผู้ใช้ให้เหตุผลดังต่อไปนี้:

{REASON}

คุณสามารถอนุมัติหรือปฏิเสธใบสมัครนี้โดยใช้ลิงก์ด้านล่าง:

{MODLINK}

{REGARDS}';

/**
	@additional_params: paid_subscription
		REALNAME: The real (display) name of the person receiving the email.
		PROFILE_LINK: Link to profile of member receiving email where can renew.
		SUBSCRIPTION: Name of the subscription.
		END_DATE: Date it expires.
	@description:
*/
$txt['paid_subscription_reminder_subject'] = 'การสมัครกำลังจะหมดอายุที่ {FORUMNAME}';
$txt['paid_subscription_reminder_body'] = '{REALNAME},

Your subscription at {FORUMNAME} is about to expire. If you have elected to auto-renew, you do not need to take action; otherwise, you may wish to consider subscribing once more. Details are below:

Subscription Name: {SUBSCRIPTION}
Expires: {END_DATE}

To edit your subscriptions visit the following URL:
{PROFILE_LINK}

{REGARDS}';

/**
	@additional_params: activate_reactivate
		ACTIVATIONLINK:  The URL link to reactivate the member's account.
		ACTIVATIONCODE:  The code needed to reactivate the member's account.
		ACTIVATIONLINKWITHOUTCODE: The URL to the page where the activation code can be entered.
	@description:
*/
$txt['activate_reactivate_subject'] = 'ยินดีต้อนรับกลับสู่ {FORUMNAME}';
$txt['activate_reactivate_body'] = 'เพื่อยืนยันที่อยู่อีเมลของคุณอีกครั้ง บัญชีของคุณจึงถูกปิดการใช้งาน คลิกลิงก์ต่อไปนี้เพื่อเปิดใช้งานอีกครั้ง:
{ACTIVATIONLINK}

หากคุณมีปัญหาในการเปิดใช้งาน โปรดไปที่ {ACTIVATIONLINKWITHOUTCODE} และใช้รหัส "{ACTIVATIONCODE}"

{REGARDS}';

/**
	@additional_params: forgot_password
		REALNAME: The real (display) name of the person receiving the reminder.
		REMINDLINK: The link to reset the password.
		IP: The IP address of the requester.
		MEMBERNAME:
	@description:
*/
$txt['forgot_password_subject'] = 'รหัสผ่านใหม่สำหรับ {FORUMNAME}';
$txt['forgot_password_body'] = 'เรียน {REALNAME},
อีเมลนี้ถูกส่งเนื่องจากมีการใช้ฟังก์ชัน \'ลืมรหัสผ่าน\' กับบัญชีของคุณ ในการตั้งรหัสผ่านใหม่ ให้คลิกที่ลิงค์ต่อไปนี้:
{REMINDLINK}

IP: {IP}
ชื่อผู้ใช้: {MEMBERNAME}

{REGARDS}';

/**
	@additional_params: send_email
		EMAILSUBJECT: The subject the user wants to email.
		EMAILBODY: The body the user wants to email.
		SENDERNAME: The name of the member sending the email.
		RECPNAME: The name of the person receiving the email.
	@description:
*/
$txt['send_email_subject'] = '{EMAILSUBJECT}';
$txt['send_email_body'] = '{EMAILBODY}';

/**
	@additional_params: report_to_moderator
		TOPICSUBJECT: The subject of the reported post.
		POSTERNAME: The reported post's author's name.
		REPORTERNAME: The name of the person reporting the post.
		TOPICLINK: The URL of the post that is being reported.
		REPORTLINK: The URL of the moderation center report.
		COMMENT: The comment left by the reporter, hopefully to explain why they are reporting the post.
	@description: When a user reports a post this email is sent out to moderators and admins of that board.
*/
$txt['report_to_moderator_subject'] = 'กระทู้ที่รายงาน: {TOPICSUBJECT} โดย {POSTERNAME}';
$txt['report_to_moderator_body'] = 'กระทู้ต่อไปนี้ "{TOPICSUBJECT}" โดย {POSTERNAME} ได้รับการรายงานโดย {REPORTERNAME} ในบอร์ดที่คุณดูแล:

หัวข้อ: {TOPICLINK}
ศูนย์กลั่นกรอง: {REPORTLINK}

ผู้รายงานได้แสดงความคิดเห็นดังต่อไปนี้:
{COMMENT}

{REGARDS}';

/**
	@additional_params: report_to_moderator
		TOPICSUBJECT: The subject of the reported post.
		POSTERNAME: The reported post's author's name.
		COMMENTERNAME: The name of the person who replied to the report.
		TOPICLINK: The URL of the post that is being reported.
		REPORTLINK: The URL of the moderation center report.
	@description: When a moderator replies to a moderation report, this can be sent to the other moderators who previously replied.
*/
$txt['reply_to_moderator_subject'] = 'ติดตามกระทู้ที่รายงาน: {TOPICSUBJECT} โดย {POSTERNAME}';
$txt['reply_to_moderator_body'] = 'ก่อนหน้านี้ มีการรายงาน "{TOPICSUBJECT}" ไปยังผู้ดูแล

ตั้งแต่นั้นมา {COMMENTERNAME} ได้เพิ่มความคิดเห็นในรายงาน ข้อมูลเพิ่มเติมสามารถพบได้ในฟอรัม

หัวข้อ: {TOPICLINK}
ศูนย์กลั่นกรอง: {REPORTLINK}

{REGARDS}';

/**
	@additional_params: report_user_profile
		MEMBERNAME: The display name of the reported user
		REPORTERNAME: The name of the person reporting the profile
		PROFILELINK: The link to the profile that was reported
		COMMENT: The comment left by the reporter.
 	@description: When a user's profile is reported
*/
$txt['report_member_profile_subject'] = 'โปรไฟล์ที่รายงาน: {MEMBERNAME}';
$txt['report_member_profile_body'] = 'โปรไฟล์ของ "{MEMBERNAME}" ได้รับการรายงานโดย {REPORTERNAME} แล้ว

โปรไฟล์: {PROFILELINK}
ศูนย์กลั่นกรอง: {REPORTLINK}

ผู้รายงานได้แสดงความคิดเห็นดังต่อไปนี้:
{COMMENT}

{REGARDS}';

/**
	@additional_params: report_user_profile
		MEMBERNAME: The display name of the reported user
		COMMENTERNAME: The name of the person who added the comment
		PROFILELINK: The link to the profile that was reported
 	@description: When someone replies to a report about a profile, this can be sent to others who replied
*/
$txt['reply_to_member_report_subject'] = 'ติดตามโปรไฟล์ที่รายงาน: {MEMBERNAME}';
$txt['reply_to_member_report_body'] = 'ก่อนหน้านี้ มีการรายงานโปรไฟล์ของ {MEMBERNAME}

ตั้งแต่นั้นมา {COMMENTERNAME} ได้เพิ่มความคิดเห็นในรายงาน ข้อมูลเพิ่มเติมสามารถพบได้ในฟอรั่ม

โปรไฟล์: {PROFILELINK}
ศูนย์กลั่นกรอง: {REPORTLINK}

{REGARDS}';

/**
	@additional_params: change_password
		USERNAME: The user name for the member receiving the email.
		PASSWORD: The password for the member.
	@description:
*/
$txt['change_password_subject'] = 'รายละเอียดรหัสผ่านใหม่';
$txt['change_password_body'] = 'เรียน {USERNAME},

รายละเอียดการเข้าสู่ระบบของคุณที่ {FORUMNAME} มีการเปลี่ยนแปลงและการรีเซ็ตรหัสผ่านของคุณ ด้านล่างนี้คือรายละเอียดการเข้าสู่ระบบใหม่ของคุณ

ชื่อผู้ใช้ของคุณคือ "{USERNAME}" และรหัสผ่านของคุณคือ "{PASSWORD}"

คุณสามารถเปลี่ยนได้หลังจากที่คุณเข้าสู่ระบบโดยไปที่หน้าโปรไฟล์หรือโดยไปที่หน้านี้หลังจากที่คุณเข้าสู่ระบบ:
{SCRIPTURL}?action=profile

{REGARDS}';

/**
	@additional_params: register_activate
		REALNAME: The display name for the member receiving the email.
		USERNAME: The user name for the member receiving the email.
		PASSWORD: The password for the member.
		ACTIVATIONLINK:  The URL link to reactivate the member's account.
		ACTIVATIONLINKWITHOUTCODE: The URL to the page where the activation code can be entered.
		ACTIVATIONCODE:  The code needed to reactivate the member's account.
		FORGOTPASSWORDLINK: The URL to the "forgot password" page.
	@description:
*/
$txt['register_activate_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['register_activate_body'] = 'ขอขอบคุณสำหรับการลงทะเบียนที่ {FORUMNAME} ชื่อผู้ใช้ของคุณคือ {USERNAME} หากคุณลืมรหัสผ่าน คุณสามารถรีเซ็ตได้โดยไปที่ {FORGOTPASSWORDLINK}

ก่อนที่คุณจะเข้าสู่ระบบได้ คุณต้องเปิดใช้งานบัญชีของคุณก่อน โดยไปที่ลิงก์นี้:

{ACTIVATIONLINK}

หากคุณมีปัญหาในการเปิดใช้งาน โปรดไปที่ {ACTIVATIONLINKWITHOUTCODE} และใช้รหัส "{ACTIVATIONCODE}"

{REGARDS}';

/**
	@additional_params: register_coppa
		REALNAME: The display name for the member receiving the email.
		USERNAME: The user name for the member receiving the email.
		PASSWORD: The password for the member.
		COPPALINK:  The URL link to the coppa form.
		FORGOTPASSWORDLINK: The URL to the "forgot password" page.
	@description:
*/
$txt['register_coppa_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['register_coppa_body'] = 'ขอขอบคุณสำหรับการลงทะเบียนที่ {FORUMNAME} ชื่อผู้ใช้ของคุณคือ {USERNAME} หากคุณลืมรหัสผ่าน คุณสามารถเปลี่ยนได้ที่ {FORGOTPASSWORDLINK}

ก่อนที่คุณจะเข้าสู่ระบบได้ ผู้ดูแลระบบต้องได้รับความยินยอมจากพ่อแม่/ผู้ปกครองของคุณจึงจะเข้าร่วมชุมชนได้ คุณสามารถรับข้อมูลเพิ่มเติมได้ที่ลิงค์ด้านล่าง:

{COPPALINK}

{REGARDS}';

/**
	@additional_params: register_immediate
		REALNAME: The display name for the member receiving the email.
		USERNAME: The user name for the member receiving the email.
		PASSWORD: The password for the member.
		FORGOTPASSWORDLINK: The URL to the "forgot password" page.
	@description:
*/
$txt['register_immediate_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['register_immediate_body'] = 'ขอขอบคุณสำหรับการลงทะเบียนที่ {FORUMNAME} ชื่อผู้ใช้ของคุณคือ {USERNAME} หากคุณลืมรหัสผ่าน คุณสามารถเปลี่ยนรหัสผ่านได้ที่ {FORGOTPASSWORDLINK}

{REGARDS}';

/**
	@additional_params: register_pending
		REALNAME: The display name for the member receiving the email.
		USERNAME: The user name for the member receiving the email.
		PASSWORD: The password for the member.
		FORGOTPASSWORDLINK: The URL to the "forgot password" page.
	@description:
*/
$txt['register_pending_subject'] = 'ยินดีต้อนรับสู่ {FORUMNAME}';
$txt['register_pending_body'] = 'สวัสดี {REALNAME} คำขอลงทะเบียนของคุณที่ {FORUMNAME} ได้รับแล้ว

ชื่อผู้ใช้ที่คุณต้องการลงทะเบียนคือ {USERNAME} หากคุณลืมรหัสผ่าน คุณสามารถเปลี่ยนได้ที่ {FORGOTPASSWORDLINK}

ก่อนที่คุณจะเข้าสู่ระบบและเริ่มใช้ฟอรัมได้ คำขอของคุณจะได้รับการตรวจสอบและอนุมัติ

{REGARDS}';

/**
	@additional_params: notification_reply
		TOPICSUBJECT:
		POSTERNAME:
		TOPICLINK:
		UNSUBSCRIBELINK:
	@description:
*/
$txt['notification_reply_subject'] = 'หัวข้อตอบกลับ: {TOPICSUBJECT}';
$txt['notification_reply_body'] = 'ในหัวข้อที่คุณกำลังดูอยู่ มีการโพสต์การตอบกลับโดย {POSTERNAME}

ดูการตอบกลับได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notification_reply_body
		TOPICSUBJECT:
		POSTERNAME:
		TOPICLINK:
		UNSUBSCRIBELINK:
		MESSAGE:
	@description:
*/
$txt['notification_reply_body_subject'] = 'หัวข้อตอบกลับ: {TOPICSUBJECT}';
$txt['notification_reply_body_body'] = 'ในหัวข้อที่คุณกำลังดูอยู่ มีการโพสต์การตอบกลับโดย {POSTERNAME}

ดูการตอบกลับได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

ข้อความตอบกลับแสดงอยู่ด้านล่าง:
{MESSAGE}

{REGARDS}';

/**
	@additional_params: notification_reply_once
		TOPICSUBJECT:
		POSTERNAME:
		TOPICLINK:
		UNSUBSCRIBELINK:
	@description:
*/
$txt['notification_reply_once_subject'] = 'หัวข้อตอบกลับ: {TOPICSUBJECT}';
$txt['notification_reply_once_body'] = 'ในหัวข้อที่คุณกำลังดูอยู่ มีการโพสต์การตอบกลับโดย {POSTERNAME}

ดูการตอบกลับได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

อาจมีการโพสต์การตอบกลับเพิ่มเติม แต่คุณจะไม่ได้รับการแจ้งเตือนสำหรับหัวข้อนี้อีกจนกว่าคุณจะเข้าชม

{REGARDS}';

/**
	@additional_params: notification_reply_body_once
		TOPICSUBJECT:
		POSTERNAME:
		TOPICLINK:
		UNSUBSCRIBELINK:
		MESSAGE:
	@description:
*/
$txt['notification_reply_body_once_subject'] = 'หัวข้อตอบกลับ: {TOPICSUBJECT}';
$txt['notification_reply_body_once_body'] = 'ในหัวข้อที่คุณกำลังดูอยู่ มีการโพสต์การตอบกลับโดย {POSTERNAME}

ดูการตอบกลับได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

ข้อความตอบกลับแสดงอยู่ด้านล่าง:
{MESSAGE}

อาจมีการโพสต์การตอบกลับเพิ่มเติม แต่คุณจะไม่ได้รับการแจ้งเตือนสำหรับหัวข้อนี้อีกจนกว่าคุณจะเข้าชม

{REGARDS}';

/**
	@additional_params: notification_sticky
	@description:
*/
$txt['notification_sticky_subject'] = 'ปักหมุดหัวข้อแล้ว: {TOPICSUBJECT}';
$txt['notification_sticky_body'] = 'หัวข้อที่คุณกำลังดูถูกทำเครื่องหมายว่าเป็นหัวข้อปักหมุด

ดูหัวข้อได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notification_lock
	@description:
*/
$txt['notification_lock_subject'] = 'หัวข้อถูกล็อก: {TOPICSUBJECT}';
$txt['notification_lock_body'] = 'หัวข้อที่คุณกำลังดูถูกล็อค

ดูหัวข้อได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notification_unlock
	@description:
*/
$txt['notification_unlock_subject'] = 'ปลดล็อคหัวข้อ: {TOPICSUBJECT}';
$txt['notification_unlock_body'] = 'หัวข้อที่คุณกำลังดูได้รับการปลดล็อกแล้ว

ดูหัวข้อได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notification_remove
	@description:
*/
$txt['notification_remove_subject'] = 'หัวข้อที่ถูกลบ: {TOPICSUBJECT}';
$txt['notification_remove_body'] = 'หัวข้อที่คุณกำลังดูถูกลบออก

{REGARDS}';

/**
	@additional_params: notification_move
	@description:
*/
$txt['notification_move_subject'] = 'หัวข้อที่ย้าย: {TOPICSUBJECT}';
$txt['notification_move_body'] = 'หัวข้อที่คุณกำลังดูถูกย้ายไปบอร์ดอื่น

ดูหัวข้อได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notification_merged
	@description:
*/
$txt['notification_merge_subject'] = 'รวมหัวข้อแล้ว: {TOPICSUBJECT}';
$txt['notification_merge_body'] = 'หัวข้อที่คุณกำลังดูถูกรวมเข้ากับหัวข้ออื่นแล้ว

ดูหัวข้อที่รวมใหม่ได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: notification_split
	@description:
*/
$txt['notification_split_subject'] = 'การแยกหัวข้อ: {TOPICSUBJECT}';
$txt['notification_split_body'] = 'หัวข้อที่คุณกำลังดูถูกแบ่งออกเป็นสองหัวข้อขึ้นไป

ดูหัวข้อที่เหลือได้ที่: {TOPICLINK}

ยกเลิกการสมัครจากหัวข้อนี้โดยใช้ลิงก์นี้: {UNSUBSCRIBELINK}

{REGARDS}';

/**
	@additional_params: admin_notify
		USERNAME:
		PROFILELINK:
	@description:
*/
$txt['admin_notify_subject'] = 'สมาชิกใหม่ได้เข้าร่วม';
$txt['admin_notify_body'] = '{USERNAME} เพิ่งสมัครเป็นสมาชิกใหม่ในฟอรัมของคุณ คลิกลิงค์ด้านล่างเพื่อดูโปรไฟล์ของพวกเขา
{PROFILELINK}

{REGARDS}';

/**
	@additional_params: admin_notify_approval
		USERNAME:
		PROFILELINK:
		APPROVALLINK:
	@description:
*/
$txt['admin_notify_approval_subject'] = 'สมาชิกใหม่ได้เข้าร่วม';
$txt['admin_notify_approval_body'] = '{USERNAME} เพิ่งสมัครเป็นสมาชิกใหม่ในฟอรัมของคุณ คลิกลิงค์ด้านล่างเพื่อดูโปรไฟล์ของพวกเขา
{PROFILELINK}

ก่อนที่สมาชิกรายนี้จะเริ่มโพสต์ได้ พวกเขาต้องได้รับอนุมัติบัญชีก่อน คลิกลิงก์ด้านล่างเพื่อไปที่หน้าจอการอนุมัติ
{APPROVALLINK}

{REGARDS}';

/**
	@additional_params: admin_attachments_full
		REALNAME:
	@description:
*/
$txt['admin_attachments_full_subject'] = 'ด่วน! ไดเร็กทอรีไฟล์แนบเกือบเต็ม';
$txt['admin_attachments_full_body'] = 'เรียน {REALNAME},

ไดเรกทอรีไฟล์แนบที่ {FORUMNAME} ใกล้เต็มแล้ว โปรดไปที่ฟอรัมเพื่อแก้ไขปัญหานี้

เมื่อไดเร็กทอรีไฟล์แนบถึงขนาดสูงสุดที่อนุญาต ผู้ใช้จะไม่สามารถโพสต์ไฟล์แนบหรืออัปโหลดอวาตาร์ที่กำหนดเองได้ (หากเปิดใช้งาน)

{REGARDS}';

/**
	@additional_params: paid_subscription_refund
		NAME: Subscription title.
		REALNAME: Recipients name
		REFUNDUSER: Username who took out the subscription.
		REFUNDNAME: User's display name who took out the subscription.
		DATE: Today's date.
		PROFILELINK: Link to members profile.
	@description:
*/
$txt['paid_subscription_refund_subject'] = 'การสมัครสมาชิกแบบชำระเงินที่คืนเงินแล้ว';
$txt['paid_subscription_refund_body'] = 'เรียน {REALNAME},

สมาชิกได้รับเงินคืนสำหรับการสมัครแบบชำระเงิน ด้านล่างนี้คือรายละเอียดของการสมัครสมาชิกนี้:

สมัครสมาชิก: {NAME}
ชื่อผู้ใช้: {REFUNDNAME} ({REFUNDUSER})
วันที่: {DATE}

คุณสามารถดูโปรไฟล์ของสมาชิกรายนี้ได้โดยคลิกที่ลิงค์ด้านล่าง:
{PROFILELINK}

{REGARDS}';

/**
	@additional_params: paid_subscription_new
		NAME: Subscription title.
		REALNAME: Recipients name
		SUBEMAIL: Email address of the user who took out the subscription
		SUBUSER: Username who took out the subscription.
		SUBNAME: User's display name who took out the subscription.
		DATE: Today's date.
		PROFILELINK: Link to members profile.
	@description:
*/
$txt['paid_subscription_new_subject'] = 'สมัครสมาชิกแบบชำระเงินใหม่';
$txt['paid_subscription_new_body'] = 'เรียน {REALNAME},

สมาชิกได้ทำการสมัครสมาชิกแบบชำระเงินใหม่ ด้านล่างนี้คือรายละเอียดของการสมัครสมาชิกนี้:

สมัครสมาชิก: {NAME}
ชื่อผู้ใช้: {SUBNAME} ({SUBUSER})
อีเมลผู้ใช้: {SUBEMAIL}
ราคา: {PRICE}
วันที่: {DATE}

คุณสามารถดูโปรไฟล์ของสมาชิกรายนี้ได้โดยคลิกที่ลิงค์ด้านล่าง:
{PROFILELINK}

{REGARDS}';

/**
	@additional_params: paid_subscription_error
		ERROR: Error message.
		REALNAME: Recipients name
	@description:
*/
$txt['paid_subscription_error_subject'] = 'เกิดข้อผิดพลาดในการสมัครแบบชำระเงิน';
$txt['paid_subscription_error_body'] = 'เรียน {REALNAME},

เกิดข้อผิดพลาดต่อไปนี้ขณะประมวลผลการสมัครสมาชิกแบบชำระเงิน
---------------------------------------------------------------
{ERROR}

{REGARDS}';

/**
	@additional_params: new_pm
		SUBJECT: The personal message subject.
		SENDER:  The user name for the member sending the personal message.
		READLINK:  The link to directly access the read page.
		REPLYLINK:  The link to directly access the reply page.
	@description: A notification email sent to the receivers of a personal message
*/
$txt['new_pm_subject'] = 'ข้อความส่วนตัวใหม่: {SUBJECT}';
$txt['new_pm_body'] = 'คุณเพิ่งได้รับข้อความส่วนตัวจาก {SENDER} ใน {FORUMNAME}

สำคัญ: จำไว้ว่านี่เป็นเพียงการแจ้งเตือน โปรดอย่าตอบกลับอีเมลนี้

อ่านข้อความส่วนตัวนี้ที่นี่: {READLINK}

ตอบกลับข้อความส่วนตัวนี้ที่นี่: {REPLYLINK}

{REGARDS}';

/**
	@additional_params: new_pm_body
		SUBJECT: The personal message subject.
		SENDER:  The user name for the member sending the personal message.
		MESSAGE:  The text of the personal message.
		REPLYLINK:  The link to directly access the reply page.
	@description: A notification email sent to the receivers of a personal message
*/
$txt['new_pm_body_subject'] = 'ข้อความส่วนตัวใหม่: {SUBJECT}';
$txt['new_pm_body_body'] = 'คุณเพิ่งได้รับข้อความส่วนตัวจาก {SENDER} ใน {FORUMNAME}

สำคัญ: จำไว้ว่านี่เป็นเพียงการแจ้งเตือน โปรดอย่าตอบกลับอีเมลนี้

ข้อความที่พวกเขาส่งถึงคุณคือ:

{MESSAGE}

ตอบกลับข้อความส่วนตัวนี้ที่นี่: {REPLYLINK}

{REGARDS}';

/**
	@additional_params: new_pm_tolist
		SUBJECT: The personal message subject.
		SENDER:  The user name for the member sending the personal message.
		READLINK:  The link to directly access the read page.
		REPLYLINK:  The link to directly access the reply page.
		TOLIST:  The list of users that will receive the personal message.
	@description: A notification email sent to the receivers of a personal message
*/
$txt['new_pm_tolist_subject'] = 'ข้อความส่วนตัวใหม่: {SUBJECT}';
$txt['new_pm_tolist_body'] = 'คุณและ {TOLIST} เพิ่งได้รับข้อความส่วนตัวจาก {SENDER} ใน {FORUMNAME}

สำคัญ: จำไว้ว่านี่เป็นเพียงการแจ้งเตือน โปรดอย่าตอบกลับอีเมลนี้

อ่านข้อความส่วนตัวนี้ที่นี่: {READLINK}

ตอบกลับข้อความส่วนตัวนี้ (ถึงผู้ส่งเท่านั้น) ที่นี่: {REPLYLINK}

{REGARDS}';

/**
	@additional_params: new_pm_body_tolist
		SUBJECT: The personal message subject.
		SENDER:  The user name for the member sending the personal message.
		MESSAGE:  The text of the personal message.
		REPLYLINK:  The link to directly access the reply page.
		TOLIST:  The list of users that will receive the personal message.
	@description: A notification email sent to the receivers of a personal message
*/
$txt['new_pm_body_tolist_subject'] = 'ข้อความส่วนตัวใหม่: {SUBJECT}';
$txt['new_pm_body_tolist_body'] = 'คุณและ {TOLIST} เพิ่งได้รับข้อความส่วนตัวจาก {SENDER} ใน {FORUMNAME}

สำคัญ: จำไว้ว่านี่เป็นเพียงการแจ้งเตือน โปรดอย่าตอบกลับอีเมลนี้

ข้อความที่พวกเขาส่งถึงคุณคือ:

{MESSAGE}

ตอบกลับข้อความส่วนตัวนี้ (ถึงผู้ส่งเท่านั้น) ที่นี่: {REPLYLINK}

{REGARDS}';

/**
	@additional_params: msg_quote
		CONTENTSUBJECT: The post subject.
		QUOTENAME:  The user name for the member creating the quote
		MEMBERNAME:  The user name for the member being quoted
		CONTENTLINK:  The post's link
	@description: A notification email sent to the members who've been quoted in a post
 */
$txt['msg_quote_subject'] = 'คุณได้ถูกอ้างถึงในกระทู้: {CONTENTSUBJECT}';
$txt['msg_quote_body'] = 'สวัสดี {MEMBERNAME}

คุณได้ถูกอ้างถึงในกระทู้ชื่อ "{CONTENTSUBJECT}" โดย {QUOTENAME} คุณสามารถดูโพสต์ได้ที่นี่:
{CONTENTLINK}

{REGARDS}';

/**
	@additional_params: msg_mention
		CONTENTSUBJECT: The post subject.
		MENTIONNAME:  The user name for the member creating the mention
		MEMBERNAME:  The user name for the member being mentioned
		CONTENTLINK:  The post's link
	@description: A notification email sent to the members who've been mentioned in a post
 */
$txt['msg_mention_subject'] = 'คุณได้ถูกกล่าวถึงในกระทู้: {CONTENTSUBJECT}';
$txt['msg_mention_body'] = 'สวัสดี {MEMBERNAME}

คุณได้ถูกอ้างถึงในกระทู้ชื่อ "{CONTENTSUBJECT}" โดย {MENTIONNAME} คุณสามารถดูโพสต์ได้ที่นี่:
{CONTENTLINK}

{REGARDS}';

/**
	@additional_params: happy_birthday
		REALNAME: The real (display) name of the person receiving the birthday message.
	@description: A message sent to members on their birthday.
*/
$txtBirthdayEmails['happy_birthday_subject'] = 'สุขสันต์วันเกิดจาก {FORUMNAME}';
$txtBirthdayEmails['happy_birthday_body'] = 'เรียน {REALNAME}

พวกเราที่ {FORUMNAME} ต้องการอวยพรวันเกิดให้คุณ ขอให้วันนี้และปีต่อ ๆ ไปเต็มไปด้วยความสุข

{REGARDS}';
$txtBirthdayEmails['happy_birthday_author'] = '<a href="https://www.simplemachines.org/community/?action=profile;u=2676">Thantos</a>';

$txtBirthdayEmails['karlbenson1_subject'] = 'ในวันเกิดของคุณ...';
$txtBirthdayEmails['karlbenson1_body'] = 'เราสามารถส่งการ์ดวันเกิดให้คุณได้ เราอาจส่งดอกไม้หรือเค้กให้คุณ

แต่เราไม่ได้

เราอาจส่งข้อความที่สร้างขึ้นโดยอัตโนมัติถึงคุณเพื่ออวยพรวันเกิดให้คุณ โดยที่เราไม่ต้องเปลี่ยน INSERT NAME ด้วยซ้ำ

แต่เราไม่ได้

เราเขียนคำอวยพรวันเกิดนี้เพื่อคุณโดยเฉพาะ

เราต้องการอวยพรวันเกิดที่พิเศษมากให้คุณ

{REGARDS}

//:: ข้อความนี้ถูกสร้างขึ้นโดยอัตโนมัติ :://';
$txtBirthdayEmails['karlbenson1_author'] = '<a href="https://www.simplemachines.org/community/?action=profile;u=63186">karlbenson</a>';

$txtBirthdayEmails['nite0859_subject'] = 'สุขสันต์วันเกิด!';
$txtBirthdayEmails['nite0859_body'] = 'เพื่อนของคุณที่ {FORUMNAME} ต้องการใช้เวลาสักครู่เพื่ออวยพรวันเกิดให้คุณ {REALNAME} หากคุณไม่ได้ทำเมื่อเร็ว ๆ นี้ โปรดเยี่ยมชมชุมชนของเราเพื่อให้ผู้อื่นมีโอกาสได้แสดงความเคารพอย่างอบอุ่น

แม้ว่าวันนี้จะเป็นวันเกิดของคุณ {REALNAME} เราขอเตือนคุณว่าการเป็นสมาชิกของคุณในชุมชนของเราเป็นของขวัญที่ดีที่สุดสำหรับเราจนถึงตอนนี้

ด้วยความปรารถนาดี
เจ้าหน้าที่ของ {FORUMNAME}';
$txtBirthdayEmails['nite0859_author'] = '<a href="https://www.simplemachines.org/community/?action=profile;u=46625">nite0859</a>';

$txtBirthdayEmails['zwaldowski_subject'] = 'อวยพรวันเกิดให้ {REALNAME}';
$txtBirthdayEmails['zwaldowski_body'] = 'เรียน {REALNAME},

ผ่านไปอีกปีในชีวิตของคุณ พวกเราที่ {FORUMNAME} หวังว่าจะเต็มไปด้วยความสุข และหวังว่าคุณจะโชคดีในครั้งต่อไป

{REGARDS}';
$txtBirthdayEmails['zwaldowski_author'] = '<a href="https://www.simplemachines.org/community/?action=profile;u=72038">zwaldowski</a>';

$txtBirthdayEmails['geezmo_subject'] = 'สุขสันต์วันเกิด {REALNAME}!';
$txtBirthdayEmails['geezmo_body'] = 'รู้ไหมว่าวันนี้วันเกิดใคร {REALNAME}

เรารู้... คุณ!

สุขสันต์วันเกิด!

ตอนนี้คุณแก่ขึ้นอีกหนึ่งปี แต่เราหวังว่าคุณจะมีความสุขมากกว่าปีที่แล้วมาก

สนุกกับวันของคุณวันนี้ {REALNAME}!

- จากครอบครัว {FORUMNAME} ของคุณ';
$txtBirthdayEmails['geezmo_author'] = '<a href="https://www.simplemachines.org/community/?action=profile;u=48671">geezmo</a>';

$txtBirthdayEmails['karlbenson2_subject'] = 'คำอวยพรวันเกิดของคุณ';
$txtBirthdayEmails['karlbenson2_body'] = 'เราหวังว่าคุณจะเป็นวันเกิดที่ดีที่สุด มีเมฆมาก แดดจัด หรือสภาพอากาศใดก็ตาม
มีเค้กวันเกิดและความสนุกสนานมากมาย แล้วบอกเราว่าคุณทำอะไรไปบ้าง

เราหวังว่าข้อความนี้จะทำให้คุณมีกำลังใจ และทำให้มันคงอยู่ต่อไปจนถึงที่เดิมในปีหน้า

{REGARDS}';
$txtBirthdayEmails['karlbenson2_author'] = '<a href="https://www.simplemachines.org/community/?action=profile;u=63186">karlbenson</a>';

?>