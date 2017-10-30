<?php 
/**
 * Template Name: form-process-shabbat Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

if (empty($_POST['subject']) || empty($_POST['people'])) {
	header("Location: /shabbat");
	exit;
}

if ($user = User::getLoggedInUser()) {
	$person = $user->person;
} elseif (!empty($_POST['person_id'])) {
	$person = Person::getFromId($_POST['person_id']);
	if (!$person) {
		echo "ERROR: Couldn't locate person #{$_POST['person_id']}";
		exit;
	}
} else {
	if (empty($_POST['realname']) && empty($_POST['email']) || empty($_POST['phone'])) {
		header("Location: /shabbat");
		exit;
	}
	$person = Person::getOrCreate('', '', $_POST['realname'], $_POST['email'], $_POST['phone'], 1, $_POST['student']);
	// this is an intermediary variable that tells success_shabbat.php to give the user the option 
	// to create an account, which should be tied to $person
	$_SESSION['person_id'] = $person->id;
}

$params = array(
	'person_id' => $person->id,
	'people'=> $_POST['people'],
	'week' => $_POST['week'],
	'suggestion' => $_POST['suggestion'],
	'signedup' => get_wordpress_date('Y-m-d H:i:s', strtotime('+3 hours')),
);
$GLOBALS['wpdb']->insert('Shabbat', $params);

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = "Name: ". $person->getName().", Email: ". $person->email.", Phone: ". $person->phone.", People: ".$_POST['people'].", Year: ".$person->studentYear.", Week: ".$_POST["week"].", Note: ".$_POST['suggestion']."";
$mailer->AddAddress(WEBFORM_EMAIL);
$mailer->AddReplyTo($person->email, $person->getName());
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

$mailer = getMailer();
$mailer->Subject = "Shabat Dinner Confirmation";
$mailer->Body = "Hey ".$person->getName().",

This is to confirm that your Shabbat @ Chabad Dinner Reservation was received.

Looking forward to see you at the Chabad House.

For directions please click here
http://www.jewmich.com/map
";
$mailer->AddAddress($person->email);
$mailer->SetFrom('umchabad@jewmich.com', 'Chabad House at UM');
$mailer->Send();

header('Location: /success_shabbat');
