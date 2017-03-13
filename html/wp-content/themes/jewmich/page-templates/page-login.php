<?php
/**
 * Template Name: login Template
 */

define('DONOTCACHEPAGE', true);

$loginError = '';
if (!empty($_POST['email']) && !empty($_POST['password'])) {
	if (!User::login($_POST['email'], $_POST['password'])) {
		$loginError = "Invalid email and/or password";
	} else {
		header('Location: /myaccount');
		die;
	}
}
get_header();
?>
<form name="form" action="/login" method="post" class="chabad">
<div style="background-image: url(/pic/chabad-bg.gif); width: 100%; padding: 5px 0" align="center">
	<p class="chabad-header">Login here</p>
	<?php if ($loginError): ?>
	<font color='red'><?= $loginError ?></font>
	<?php endif ?>
	<table border="0" id="logintable">
		<tr>
			<td>
				<p class="chabad">Email:</p>
			</td>
			<td>
				<input name="email" type="text" size="24"/>
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">Password:</p>
			</td>
			<td>
				<input name="password" type="password" size="24"/>
				<br>
				<a href="/forgotpassword">Forgot your password?</a>
			</td>
		</tr>
	</table>
	<p align="center">
		<input class="login" width="50" type="submit" value="Login">
		<br>
	</p>
</div>
</form>
<?php
get_footer();
?>
