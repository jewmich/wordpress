<?php 
/**
 * Template Name: form-process-birthright Template
 */

if (!empty($_POST['username'])) {
	// Honeypot triggered! This must've been submitted by a spam bot, because 
	// the "username" input is hidden by CSS.
	die;
}	
if (empty($_POST['subject'])) {
	header("Location: /birthright");
	exit;
}
$paramKeys = array('firstname', 'lastname', 'email', 'phone', 'foundus', 'year', 'isstudent', 'datpref', 'suggestion');
$placeholders = array_fill(0, count($paramKeys), '?');
$query = '
	INSERT INTO `Birthright` (' . implode(', ', $paramKeys) . ', signed_up_at)
	VALUES (' . implode(', ', $placeholders) . ', DATE_ADD(NOW(), INTERVAL 3 HOUR))
';
$params = array();
foreach ($paramKeys as $paramKey) $params[] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';
getDb()->prepare($query)->execute($params);

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = $_POST['firstname']." ".$_POST['lastname']."\n Email: ".$_POST['email']."\n Phone: ".$_POST['phone']."\n Found us: ".$_POST['foundus']."\n Year: ".$_POST['year']."\n Mich Student:".$_POST['isstudent']."\n Date Pref: ".$_POST['datpref']."\n Suggestion:".$_POST['suggestion'];
$mailer->AddAddress(WEBFORM_EMAIL);
$mailer->AddReplyTo($_POST['email'], "{$_POST['firstname']} {$_POST['lastname']}");
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

$mailer = getMailer();
$mailer->Subject = "Mayanot - Blue Goes to Israel Pre-Reg Confirmation";
$mailer->Body = "Hey ".$_POST['firstname'].",

This email is to confirm that your Mayanot  Blue Goes To Israel pre-registration was received. 

You have taken the first step towards an incredible adventure to the Holy Land.  

Please watch for emails from Mayanot  Blue Goes to Israel.

This great trip is scheduled to leave in the beginning of May for 10 days. Exact dates TBA.

Official registration for SPRING/SUMMER TBA. We will keep you posted.

If you have any further question, please reply to this email or 
visit http://www.mayanotisrael.com
 
Thank you,

Blue Goes to Israel Staff
";
$mailer->AddAddress($_POST['email']);
$mailer->SetFrom('birthrightisrael@jewmich.com',  'Mayanot - Birthright Israel');
$mailer->Send();

header("Location: /success_birthright");
