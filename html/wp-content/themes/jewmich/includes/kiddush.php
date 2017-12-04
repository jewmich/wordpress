<?php
function jdToDb($julianDay) {
	$d = cal_from_jd($julianDay, CAL_GREGORIAN);
	return $d['year'] . '-' . str_pad($d['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($d['day'], 2, '0', STR_PAD_LEFT);
}

function getReservation($julianDay) {
	//echo "$julianDay = " . jdToDb($julianDay) . "<br>";
	global $wpdb;
	$sql = $wpdb->prepare("SELECT * FROM `Kiddush` WHERE `date` = %s AND name != '' LIMIT 1", jdToDb($julianDay));
	return $wpdb->get_row($sql, ARRAY_A);
}

define('NUM_DAYS_TO_SHOW', 50);

function getDaysToShow() {
	$days = array();
	$lastSaturday = datetime_annarbor('last saturday');
	for ($i = 1; $i <= NUM_DAYS_TO_SHOW; $i++) {
		$day = $lastSaturday->modify("+$i weeks");
		$day = unixtojd($day->getTimestamp());
		$dayDetails = cal_from_jd($day, CAL_JEWISH);
		if ($dayDetails['monthname'] === 'Tishri' && $dayDetails['day'] === 10) {
			// no kiddush on Yom Kippur: http://www.chabad.org/holidays/JewishNewYear/template_cdo/aid/1644723/jewish/Do-We-Recite-the-Sabbath-Kiddush-on-Yom-Kippur.htm
			continue;
		} elseif ($dayDetails['monthname'] === 'Nisan' && $dayDetails['day'] >= 15 && $dayDetails['day'] <= 22) {
			// no kiddush during Passover
			continue;
		}
		$days[] = $day;
	}
	return $days;
}

function getAllowedChangeDays($oldJd) {
	$daysToShow = getDaysToShow();
	$allowedChangeDays = array();
	foreach ($daysToShow as $day) {
		// not very efficient, but the performance hit of doing ~50 selects should be minor
		if (getReservation($day)) continue;
		if ($day === $oldJd) continue;
		$allowedChangeDays[] = $day;
	}
	return $allowedChangeDays;
}

function reserveDate($params) {
	global $wpdb;
	$originalJd = $params['originalJd'];
	if (isset($params['newJd'])) { //change was submitted by user that previously reserved the date
		$reservation = getReservation($originalJd);
		if ($reservation['email'] !== $params['email']) {
			return "Error<br>The e-mail address you entered doesn't match the one we have on record";
		}

		$reservedJd = $params['newJd'];
		$reservedDate = jdToDb($reservedJd);
		if ($reservedJd < unixtojd()) {
			return "Error<br>The date \"$reservedDate\" is in the past. Please choose a date in the future";
		} elseif (getReservation($reservedJd)) {
			return "Error<br>The date \"$reservedDate\" is already reserved. Please choose a different date";
		} elseif (!in_array($reservedJd, getDaysToShow())) {
			return "Error<br>Kiddush is not held on \"$reservedDate\". Please choose a different date";
		}
		$message = "Thank you<br><br>Your kiddush change has been submitted.";
		$emailSubject = "Kiddush Change Web Submission";

		$originalDate = jdToDb($params['originalJd']);
		$sql = $wpdb->prepare('UPDATE `Kiddush` SET `date` = %s WHERE `date` = %s', $reservedDate, $originalDate);
	} else { // comes here after signing up for the first time (i.e. not a change)
		$reservedJd = $originalJd;
		$message = "Thank you<br><br>Your kiddush reservation has been submitted.";
		$emailSubject = "Kiddush Web Submission";
		$sql = $wpdb->prepare(' 
			INSERT INTO `Kiddush` (`date`, `phone`, `email`, `name`, `inhonorof`, `foundus`, `added`)
			VALUES (%s, %s, %s, %s, %s, %s, DATE_ADD(NOW(), INTERVAL 2 HOUR))
		', jdToDb($reservedJd), $params['phone'], $params['email'], $params['realname'], $params['honor'], $params['foundus']);
	}
	$wpdb->query($sql);

	$details = getReservation($reservedJd);
	$mailer = getMailer();
	$mailer->Subject = $emailSubject;
	$mailer->Body = "'".$details['phone']."', '".$details['email']."'\n" .
		" Date: '".$details['date']."'\n" . 
		" Name: '".$details['name']."'\n" .
		" Honor: '".addslashes($details['inhonorof'])."'\n" .
		" Found Us: '".$details['foundus']."'";
	$mailer->AddAddress(WEBFORM_EMAIL);
	$mailer->AddAddress('aharon@jewmich.com');
	$mailer->AddAddress('esther@jewmich.com');
	$mailer->AddReplyTo($details['email'], $details['name']);
	$mailer->SetFrom(WEBFORM_EMAIL);
	$mailer->Send();

	$mailer = getMailer();
	$mailer->Subject = "Chabad Kiddush Confirmation";
	$mailer->Body = "Dear ".$details['name'].", \n\n" .
		"Thank you for sponsoring a kiddush at chabad.\n\n" .
		"Your kiddush has been reserved for: ".datetime_annarbor($details['date'])->format("M j, Y")." \n\n" .
		"Sincerely,\n\n" .
		"Kiddush Coordinator";
	$mailer->AddAddress($details['email']);
	$mailer->SetFrom('chabad@jewmich.com');
	$mailer->Send();

	return $message;
}
