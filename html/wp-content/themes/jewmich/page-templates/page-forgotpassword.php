<?php
/**
 * Template Name: forgotpassword Template
 */

if (!defined('DONOTCACHEPAGE')) define(DONOTCACHEPAGE, true);

$error = false;
$success = false;
if (!empty($_POST['email'])) {
	$user = User::getByEmail($_POST['email']);
	if (!$user) {
		$error = "Email is not registered";
	} else {
		$expireTime = time() + (24 * 60 * 60);
		$token = $user->generatePasswordResetToken($expireTime);
		$encodedEmail = urlencode($user->person->email);
		$mailer = getMailer();
		$mailer->Subject = "Password Reset";
		$mailer->Body = "Dear {$user->getName()},

We received a request to reset your password. If you did not make such a request, ignore this e-mail. Otherwise, click the link below:
https://{$_SERVER['HTTP_HOST']}/resetpassword?email=$encodedEmail&expire=$expireTime&token=$token

If you need additional help, please contact the Chabad House. See the following link for contact details:
http://jewmich.com/contact
";
		$mailer->AddAddress($user->person->email);
		$mailer->SetFrom('umchabad@jewmich.com', 'Chabad House at UM');
		$mailer->Send();
		$success = true;
	}
}
get_header();
?>
<?php if ($error): ?>
<font color='red'><?= $error ?></font>
<br><br>
<?php elseif ($success): ?>
<span class="successmsg">An e-mail has been sent with instructions on resetting your password.</span>
<br><br>
<?php endif ?>
<form action="/forgotpassword" method="post" name="form" class="chabad">
<div style="background-image: url(/pic/chabad-bg.gif); width: 100%; padding: 5px 0" align="center">
	<table border="0">
		<tr>
			<td colspan="2" align="center">
				<span class="chabad-header">Forgot your password?</span>
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">Email:</p>
			</td>
			<td>
				<input name="email" type="text" size="24" style="width: 150px"/>
			</td>
		</tr>
	</table>
	<p align="center">
		<input class="login" width="50" type="submit" value="Submit">
	</p>
</div>
</form>
<?php
get_footer();
?>
