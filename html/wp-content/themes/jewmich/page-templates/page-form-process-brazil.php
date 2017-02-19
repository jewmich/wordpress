<?php 
/**
 * Template Name: form-process-brazil Template
 */

$paramKeys = array('realname', 'email', 'cellphone', 'address', 'year', 'major', 'interest', 'involvement', 'experience', 'whythistrip', 'idealday', 'bringback', 'medical', 'otherprogram', 'extend');
$placeholders = array_fill(0, count($paramKeys), '?');
$query = "
	INSERT INTO `BrazilTrips` (" . implode(', ', $paramKeys) . ", signed_up_at)
	VALUES (" . implode(', ', $placeholders) . ", NOW())
";

$params = array();
foreach ($paramKeys as $paramKey) $params[] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';
getDb()->prepare($query)->execute($params);

$mailer = getMailer();
$mailer->Subject = "Brazil Spring Break Application";
$mailer->Body = "Name: {$_POST['realname']}
Email: {$_POST['email']}
Cellphone: {$_POST['cellphone']}
Address: {$_POST['address']}
School year: {$_POST['year']}
Major: {$_POST['major']}
Level of interest: {$_POST['interest']}
Interested in extending?: {$_POST['extend']}

Extent of Jewish involvement:
{$_POST['involvement']}

Past volunteer experiences:
{$_POST['experience']}

Why this trip?:
{$_POST['whythistrip']}

Ideal day:
{$_POST['idealday']}

What would you bring back?:
{$_POST['bringback']}

Medical conditions:
{$_POST['medical']}

Other Jewish spring break?:
{$_POST['otherprogram']}
";
$mailer->AddAddress(WEBFORM_EMAIL);
$mailer->AddReplyTo($_POST['email'], $_POST['realname']);
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

header("Location: /success");
