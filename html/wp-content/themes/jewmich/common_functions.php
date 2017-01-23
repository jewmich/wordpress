<?php
// Common functions shared by PHP pages

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
