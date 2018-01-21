<?php 
/**
 * Template Name: form-process-birthright Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

if (!empty($_POST['username'])) {
	// Honeypot triggered! This must've been submitted by a spam bot, because 
	// the "username" input is hidden by CSS.
	die;
}	
if (empty($_POST['subject'])) {
	header("Location: /birthright");
	exit;
}

$params = array('signed_up_at' => datetime_annarbor('+3 hours')->format('Y-m-d H:i:s'));
$paramKeys = array(
	'firstname' => 'firstname',
	'lastname' => 'lastname',
	'email' => 'email',
	'phone' => 'phone',
	'foundus' => 'foundus',
	'styear' => 'styear',
	'isstudent' => 'isstudent',
	'datpref' => 'datpref',
	'suggestion' => 'suggestion',
);
foreach ($paramKeys as $dbKey => $postKey) {
	$params[$dbKey] = isset($_POST[$postKey]) ? $_POST[$postKey] : '';
}
$GLOBALS['wpdb']->insert('Birthright', $params);

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = $_POST['firstname']." ".$_POST['lastname']."\n Email: ".$_POST['email']."\n Phone: ".$_POST['phone']."\n Found us: ".$_POST['foundus']."\n Year: ".$_POST['styear']."\n Mich Student:".$_POST['isstudent']."\n Date Pref: ".$_POST['datpref']."\n Suggestion:".$_POST['suggestion'];
$mailer->AddAddress(WEBFORM_EMAIL);
$mailer->AddReplyTo($_POST['email'], "{$_POST['firstname']} {$_POST['lastname']}");
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

$mailer = getMailer();
$mailer->Subject = "Mayanot - Blue Goes to Israel Pre-Reg Confirmation";
$mailer->Body = "Hey ".$_POST['firstname'].",

This email is to confirm that your Mayanot 'Blue Goes To Israel' pre-registration was received. 

You have taken the first step towards an incredible adventure to the Holy Land.

STEP TWO: 
Begin your official registration TODAY and be able to access your registration a day earlier.
http://www.mayanotisrael.com 

Official registration open Jan. 30th.

Please watch for emails from Mayanot  Blue Goes to Israel.

If you have any further question, please reply to this email or visit http://www.mayanotisrael.com
 
Thank you,

Blue Goes to Israel Staff
";
$mailer->AddAddress($_POST['email']);
$mailer->SetFrom('birthrightisrael@jewmich.com',  'Mayanot - Birthright Israel');
$mailer->Send();

header("Location: /success_birthright");
