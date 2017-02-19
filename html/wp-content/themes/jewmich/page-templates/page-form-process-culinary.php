<?php 
/**
 * Template Name: form-process-culinary Template
 */

$paramKeys = array('firstname', 'lastname', 'email', 'phone', 'student', 'year', 'foundus', 'involvedwith', 'suggestion');
$placeholders = array_fill(0, count($paramKeys), '?');
$query = "
	INSERT INTO `Culinary` (firstname, lastname, email, phone, student, year, ` foundus`, ` involvedwith`, suggestion, signed_up_at)
	VALUES (" . implode(', ', $placeholders) . ", DATE_ADD(NOW(), INTERVAL 3 HOUR))
";

$params = array();
foreach ($paramKeys as $paramKey) $params[] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';

global $wpdb;
$wpdb->query($wpdb->prepare($query, $params));

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = "".$_POST['firstname']."  ".$_POST['lastname']."\n Email:".$_POST['email']."\n Phone: ".$_POST['phone']."\n UM Student: ".$_POST['student']."\n Year: ".$_POST['year']."\n Found Us: ".$_POST['foundus']."\n Involved with: ".$_POST['involvedwith']."\n Suggestion: ".$_POST['suggestion']."";
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
