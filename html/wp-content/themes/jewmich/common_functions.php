<?php
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
