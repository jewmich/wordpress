<?
// Common functions shared by PHP pages

function turnErrorsIntoExceptions($code, $message, $file, $line) {
	if (0 == error_reporting()) return; // 0 means the error was suppressed by the @ operator
	throw new ErrorException($message, 0, $code, $file, $line);
}

function emailExceptionDetails($exception) {
	echo "Sorry, an error occurred while processing this page.";
	$subject = "Uncaught exception at {$_SERVER['SERVER_NAME']}{$_SERVER['PHP_SELF']}";
	$message = "Exception: {$exception}\n\nServer: " . print_r($_SERVER, true);
	if (!PRODUCTION_MODE) {
		echo "$message";
		die;
	}
	try {
		$mailer = getMailer();
		$mailer->Subject = $subject;
		$mailer->Body = $message;
		foreach (explode(',', ERROR_EMAIL_RECIPIENTS) as $recipient) {
			$mailer->AddAddress($recipient);
		}
		$mailer->SetFrom(WEBFORM_EMAIL);
		$mailer->Send();
		echo " The site administrators have been notified.";
	} catch (Exception $e) {
		echo " Please notify " . CHABAD_EMAIL;
	}
	die;
}

// helper function for getSidebarImages() and getUpcomingEvents()
function filterRowsByDate($rows) {
	$ordered = array();
	foreach ($rows as $row) {
		if (is_null($row['date_end'])) {
			// default row
		  	if (isset($ordered[$row['position']])) {
				// position already taken
				continue;
			}
		} else {
			// non-default row. Check that today is in the date range 
			list($startYear, $startMonth, $startDay) = explode('-', $row['date_start']);
			list($endYear, $endMonth, $endDay) = explode('-', $row['date_end']);
			$calendar = ($row['date_type'] === 'Gregorian') ? CAL_GREGORIAN : CAL_JEWISH;
			$curYear = ($row['date_type'] === 'Gregorian') ? idate('Y') : getCurrentJewishYear();
			if ($startYear === '0000') $startYear = $curYear;
			if ($endYear === '0000') $endYear = $curYear;
			if ($endMonth < $startMonth || ($endMonth === $startMonth && $endDay < $startDay)) {
				// end date is before start date, which must mean the date range spans a year (e.g. Dec 1st to Feb 15th)
				// need to figure out if we need to subtract 1 from the startDate or add 1 to the endDate.
				// do that by checking both cases
				if (isCurrentDateBetween(
					cal_to_jd($calendar, $startMonth, $startDay, $startYear-1),
					cal_to_jd($calendar, $endMonth, $endDay, $endYear)
				)) {
					$startYear--;
				} else {
					$endYear++;
				}
			}
			$startJd = cal_to_jd($calendar, $startMonth, $startDay, $startYear);
			$endJd = cal_to_jd($calendar, $endMonth, $endDay, $endYear);
			if (!isCurrentDateBetween($startJd, $endJd)) continue; // today is outside date range
		}
		// if we got here, then row is valid
		$ordered[$row['position']] = $row;
	}
	return $ordered;
}

function isCurrentDateBetween($startJd, $endJd) {
	$curJd = unixtojd();
	return $startJd <= $curJd && $curJd <= $endJd;
}

function getSidebarImages() {
	global $wpdb;
	$query = "SELECT position, description, url, img_src, date_type, date_start, date_end FROM Sidebar ORDER BY position ASC";
	return filterRowsByDate($wpdb->get_results($query, ARRAY_A));
}

function getUpcomingEvents() {
	global $wpdb;
	$query = "SELECT position, link_text, url, date_type, date_start, date_end FROM UpcomingEvents ORDER BY position ASC";
	return filterRowsByDate($wpdb->get_results($query, ARRAY_A));
}

//can't use the mail() function, because the server jewmich is on (tablot.dreamhost.com)
//is in some spam blacklists. The SMTP server (mail.jewmich.com) is not, though.
function getMailer() {
	require_once('phpmailer/class.phpmailer.php');
	require_once('phpmailer/class.smtp.php');
	$mailer = new PHPMailer(true);
	$mailer->IsSMTP();
	$mailer->XMailer = ' '; // don't include X-Mailer for security
	$mailer->Host = 'mail.jewmich.com';
	$mailer->SMTPAuth = true;
	$mailer->Port = 25;
	$mailer->Username = SMTP_USERNAME;
	$mailer->Password = SMTP_PASSWORD;
	return $mailer;
}

function getCurrentJewishYear() {
	$currentJewishCal = cal_from_jd(unixtojd(time()), CAL_JEWISH);
	return $currentJewishCal['year'];
}

function getStartOfPassover() {
	return jdtounix(jewishtojd(8, 14, getCurrentJewishYear()));
}

function generateUmSchoolYearDropDown($selectedValue = null, $selectName = 'student') {
	$options = array('');
	for ($i = 0; $i < 5; $i++) {
		$options[] = date('Y') + $i;
	}
	for ($i = 0; $i < 4; $i++) {
		$options[] = 'Grad ' . (date('Y') + $i);
	}
	$options[] = 'Other';

	$html = "<select size='1' name='$selectName'>";
	foreach ($options as $option) {
		$html .= "\n<option" . (($option == $selectedValue) ? ' selected' : '') . ">$option</option>\n";
	}
	$html .= '</select>';
	return $html;
}
