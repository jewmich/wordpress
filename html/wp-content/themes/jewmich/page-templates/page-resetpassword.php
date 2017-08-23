<?php
/**
 * Template Name: resetpassword Template
 */

if (!defined('DONOTCACHEPAGE')) define(DONOTCACHEPAGE, true);

if (empty($_REQUEST['expire']) || empty($_REQUEST['email']) || empty($_REQUEST['token'])) {
	header("Location: /");
	exit;
}

$user = User::getByEmail($_REQUEST['email']);
if (!$user ||
	$user->generatePasswordResetToken($_REQUEST['expire']) !== $_REQUEST['token'] ||
	time() > intval($_REQUEST['expire'])
) {
	header("Location: /");
	exit;
}

$error = false;
$success = false;
if (!empty($_POST['password'])) {
	if ($_POST['password'] !== $_POST['reenter_password']) {
		$error = "Passwords do not match";
	} else {
		$user->updatePassword($_POST['password']);
		$_SESSION['user'] = $user;
		$success = true;
	}
}

get_header();
?>
<?php if ($error): ?>
<font color='red'><?= $error ?></font>
<br><br>
<?php elseif ($success): ?>
<span class="successmsg">Your password has been reset</span>
<br><br>
<?php endif ?>
<form action="/resetpassword" method="post" name="form" class="chabad">
	<input type="hidden" name="token" value="<?= $_REQUEST['token'] ?>">
	<input type="hidden" name="expire" value="<?= $_REQUEST['expire'] ?>">
	<input type="hidden" name="email" value="<?= htmlspecialchars($_REQUEST['email']) ?>">

	<div style="background-image: url(/pic/chabad-bg.gif); width: 100%; padding: 5px 0" align="center">
		<table border="0">
			<tr>
				<td colspan="2" align="center">
					<span class="chabad-header">Reset password</span>
				</td>
			</tr>
			<tr>
				<td>
					<p class="chabad">New Password:</p>
				</td>
				<td>
					<input name="password" type="password" size="24"/>
				</td>
			</tr>
			<tr>
				<td>
					<p class="chabad">Re-enter Password:</p>
				</td>
				<td>
					<input name="reenter_password" type="password" size="24"/>
				</td>
			</tr>
		</table>
		<p align="center">
			<input class="login" width="50" type="submit" value="Reset Password">
		</p>
	</div>
</form>
<?php
get_footer();
?>
