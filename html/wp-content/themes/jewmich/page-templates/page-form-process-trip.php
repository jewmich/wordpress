<?php 
/**
 * Template Name: form-process-trip Template
 */

global $wpdb;
$paramKeys = array('firstname', 'midlename', 'lastname', 'email', 'phone', 'dob', 'year', 'citizen', 'passnum', 'pissue', 'passdate', 'fatname', 'fatcell', 'fatemail', 'motname', 'motcell', 'motemail', 'othname', 'othcell', 'othemail', 'extend', 'trip');
$placeholders = array_fill(0, count($paramKeys), '?');
$query = "
	INSERT INTO `Trips`
	VALUES (" . implode(', ', $placeholders) . ", DATE_ADD(NOW(), INTERVAL 2 HOUR))
";

$params = array();
foreach ($paramKeys as $paramKey) $params[] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';
$wpdb->query($wpdb->prepare($query, $params));

#mail(WEBFORM_EMAIL . ", alter@jewmich.com", $_POST['subject'], "'".$_POST['firstname']."', '".$_POST['lastname']."'\n Email:'".$_POST['email']."'\n Phone:'".$_POST['phone']."'\n UM Student:'".$_POST['student']."'\n Year:'".$_POST['year']."'\n Found Us:'".$_POST['foundus']."'\n Involved with:'".$_POST['involvedwith']."'\n Suggestion:'".$_POST['suggestion']."'", "From: ".$_POST['firstname']." ".$_POST['lastname']." <".$_POST['email'].">");

#mail($_POST['email'], "Culinary Shabbat Registration", "Hey ".$_POST['realname'].",

#This is to confirm that your Culinary Shabbat Registration was received.

#Looking forward to see you at this great program.

#For directions please click here
#http://www.jewmich.com/map
#", "From: Chabad House at UM<umchabad@jewmich.com>");

header("Location: /success");
