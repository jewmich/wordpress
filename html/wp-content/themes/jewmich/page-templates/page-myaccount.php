<?php
/**
 * Template Name: myaccount Template
 */

$user = User::getLoggedInUser();
if (!$user) {
	header("Location: /login");
	exit;
}

$errors = array();
$success = false;
if (!empty($_POST['email'])) {
	if ($_POST['email'] != $user->person->email && User::isEmailTaken($_POST['email'])) {
		$errors[] = "Email is already registered";
	}
	if (!empty($_POST['password']) && $_POST['password'] !== $_POST['reenter_password']) {
		$errors[] = 'Passwords do not match';
	}
	if (empty($errors)) {
		$user->person->fullName = $_POST['fullname'];
		$user->person->phone = $_POST['phone'];
		$user->person->studentYear = $_POST['student'];
		if ($_POST['email'] != $user->person->email) {
			$user->person->email = $_POST['email'];
		}
		if (!empty($_POST['password'])) {
			$user->updatePassword($_POST['password']);
		}
		$success = $user->person->save();
	}
}

get_header();
?>
<?php if (!empty($errors)): ?>
Please correct the errors below:
<ul class="errors">
	<?php foreach ($errors as $error): ?>
	<li><font color='red'><?= $error ?></font></li>
	<?php endforeach ?>
</ul>
<?php endif ?>
<?php if ($success): ?>
<span class="successmsg">Your account has been updated successfully</span>
<br><br>
<?php endif ?>
<form action="/myaccount" method="post" name="form" class="chabad">
	<table background="./pic/chabad-bg.gif" border="0" id="table2" width="98%">
		<tr>
			<td colspan="2" align="center">
				<span class="chabad-header">My account</span>
				<br>
				Use this form to update your account
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">Email:</p>
			</td>
			<td>
				<input name="email" type="text" size="24" value="<?= $user->person->email ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">Full Name:</p>
			</td>
			<td>
				<input name="fullname" type="text" size="24" value="<?= $user->getName() ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">Cell Phone</p>
			</td>
			<td>
				<input type="text" size="24" maxsize="50" name="phone" value="<?= $user->person->phone ?>">
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">U of M School year</p>
			</td>
			<td>
				<?= do_shortcode("[um_school_year_dropdown value={$user->person->studentYear}]") ?>
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
	<br>
	<p align="center">
	<input class="login" width="50" type="submit" value="Update">
	</p>
</form>
<?php
get_footer();
?>
