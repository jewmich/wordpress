<?php

//can't use the mail() function, because the server jewmich is on (tablot.dreamhost.com)
//is in some spam blacklists. The SMTP server (mail.jewmich.com) is not, though.
function getMailer() {
	require_once ABSPATH . WPINC . '/class-phpmailer.php';
	require_once ABSPATH . WPINC . '/class-smtp.php';
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


