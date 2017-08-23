<?php 
/**
 * Template Name: form-process-trip Template
 */

if (!defined('DONOTCACHEPAGE')) define(DONOTCACHEPAGE, true);

$params = array('signed_up_at' => date('Y-m-d H:i:s', strtotime('+2 hours')));
$paramKeys = array('firstname', 'midlename', 'lastname', 'email', 'phone', 'dob', 'year', 'citizen', 'passnum', 'pissue', 'passdate', 'fatname', 'fatcell', 'fatemail', 'motname', 'motcell', 'motemail', 'othname', 'othcell', 'othemail', 'extend', 'trip');
foreach ($paramKeys as $paramKey) $params[] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';
$GLOBALS['wpdb']->insert('Trips', $params);

#mail(WEBFORM_EMAIL . ", alter@jewmich.com", $_POST['subject'], "'".$_POST['firstname']."', '".$_POST['lastname']."'\n Email:'".$_POST['email']."'\n Phone:'".$_POST['phone']."'\n UM Student:'".$_POST['student']."'\n Year:'".$_POST['year']."'\n Found Us:'".$_POST['foundus']."'\n Involved with:'".$_POST['involvedwith']."'\n Suggestion:'".$_POST['suggestion']."'", "From: ".$_POST['firstname']." ".$_POST['lastname']." <".$_POST['email'].">");

#mail($_POST['email'], "Culinary Shabbat Registration", "Hey ".$_POST['realname'].",

#This is to confirm that your Culinary Shabbat Registration was received.

#Looking forward to see you at this great program.

#For directions please click here
#http://www.jewmich.com/map
#", "From: Chabad House at UM<umchabad@jewmich.com>");

header("Location: /success");
