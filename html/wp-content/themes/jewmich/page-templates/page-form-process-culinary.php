<?php 
/**
 * Template Name: form-process-culinary Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

$paramKeys = array('firstname', 'lastname', 'email', 'phone', 'student', 'styear', 'foundus', 'involvedwith', 'suggestion');
$params = array('signed_up_at' => date('Y-m-d H:i:s', strtotime('+3 hours')));
foreach ($paramKeys as $paramKey) $params[$paramKey] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';
$GLOBALS['wpdb']->insert('Culinary', $params);

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = "".$_POST['firstname']."  ".$_POST['lastname']."\n Email:".$_POST['email']."\n Phone: ".$_POST['phone']."\n UM Student: ".$_POST['student']."\n Year: ".$_POST['styear']."\n Found Us: ".$_POST['foundus']."\n Involved with: ".$_POST['involvedwith']."\n Suggestion: ".$_POST['suggestion']."";
$mailer->AddAddress(WEBFORM_EMAIL);
$mailer->AddAddress('chanchi@jewmich.com');
$mailer->AddReplyTo($_POST['email'], "{$_POST['firstname']} {$_POST['lastname']}");
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

$mailer = getMailer();
$mailer->Subject = "Culinary Shabbat Registration";
$mailer->Body = "Hey ".$_POST['firstname'].",

This is to confirm that your Culinary Shabbat Registration was received.

Looking forward to see you at this great program.

For directions please click here
http://www.jewmich.com/map
";
$mailer->AddAddress($_POST['email']);
$mailer->SetFrom('umchabad@jewmich.com', 'Chabad House at UM');
$mailer->Send();

header("Location: /success");
