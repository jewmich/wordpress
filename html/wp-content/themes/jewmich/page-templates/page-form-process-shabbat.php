<?php 
/**
 * Template Name: form-process-shabbat Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

if (empty($_POST['subject']) || empty($_POST['people'])) {
	header("Location: /shabbat");
	exit;
}

$user = wp_get_current_user();
if (!$user->exists()) {
	if (!empty($_POST['user_id'])) {
		$user = new WP_User($_POST['user_id']);
		if (!$user->exists()) {
			echo "ERROR: Couldn't locate user #{$_POST['user_id']}";
			exit;
		}
	} else {
		if (empty($_POST['realname']) && empty($_POST['email']) || empty($_POST['phone'])) {
			header("Location: /shabbat");
			exit;
		}
		$user = get_user_by('email', $_POST['email']);
		if (!$user) {
			$user_details = [ 
				'user_login' => $_POST['email'],
				'user_email' => $_POST['email'],
				'user_pass' => wp_generate_password(),
				'display_name' => $_POST['realname'],
				'role' => 'Subscriber',
			]; 
			$result = wp_insert_user($user_details);
			if (is_wp_error($result)) {
				throw new Exception($result->get_error_message());
			}
			update_user_meta($result, 'phone', $_POST['phone']);
			update_user_meta($result, 'is_student', 1);
			update_user_meta($result, 'student_year', $_POST['student']);
			$user = new WP_User($result);

			// this is an intermediary variable that tells success_shabbat.php to give the user the option 
			// to set their password, activating the account
			$_SESSION['user_id'] = $result;
		}
	}
}

$params = array(
	'person_id' => $user->ID,
	'people'=> $_POST['people'],
	'week' => $_POST['week'],
	'suggestion' => $_POST['suggestion'],
	'signedup' => datetime_annarbor('+3 hours')->format('Y-m-d H:i:s'),
);
$GLOBALS['wpdb']->insert('Shabbat', $params);

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = "Name: ". $user->display_name.", Email: ". $user->user_email.", Phone: ". get_user_meta($user->ID, 'phone', true) .", People: ".$_POST['people'].", Year: ".get_user_meta($user->ID, 'student_year', true).", Week: ".$_POST["week"].", Note: ".$_POST['suggestion']."";
$mailer->AddAddress(WEBFORM_EMAIL);
$mailer->AddReplyTo($user->user_email, $user->display_name);
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

$mailer = getMailer();
$mailer->Subject = "Shabat Dinner Confirmation";
$mailer->Body = "Hey ".$user->display_name.",

This is to confirm that your Shabbat @ Chabad Dinner Reservation was received.

Looking forward to see you at the Chabad House.

For directions please click here
http://www.jewmich.com/map
";
$mailer->AddAddress($user->user_email);
$mailer->SetFrom('umchabad@jewmich.com', 'Chabad House at UM');
$mailer->Send();

header('Location: /success_shabbat');
