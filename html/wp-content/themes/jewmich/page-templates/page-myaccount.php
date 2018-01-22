<?php
/**
 * Template Name: myaccount Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

$user = wp_get_current_user();
if (!$user->exists()) {
	header("Location: /login");
	exit;
}

$errors = array();
$success = false;
if (!empty($_POST['email'])) {
	if ($_POST['email'] != $user->user_email && !empty(get_user_by('email', $_POST['email']))) {
		$errors[] = "Email is already registered";
	}
	if (!empty($_POST['password']) && $_POST['password'] !== $_POST['reenter_password']) {
		$errors[] = 'Passwords do not match';
	}
	if (empty($errors)) {
		$userData = [
			'ID' => $user->ID,
			'display_name' => $_POST['fullname'],
		];
		update_user_meta($user->ID, 'phone', $_POST['phone']);
		update_user_meta($user->ID, 'student_year', $_POST['student']);
		if ($_POST['email'] != $user->user_email) {
			$GLOBALS['wpdb']->update(
				$GLOBALS['wpdb']->users,
				[ 'user_login' => $POST['email'] ],
				['ID' => $user->ID]
			);
			$userData['user_email'] = $_POST['email'];
		}
		if (!empty($_POST['password'])) {
			$userData['user_pass'] = $_POST['password'];
		}
		$result = wp_update_user($userData);
		if (is_wp_error($result)) {
			throw new Exception($result->get_error_message());
		}
		$success = true;
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
				<input name="email" type="text" size="24" value="<?= $user->user_email ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">Full Name:</p>
			</td>
			<td>
				<input name="fullname" type="text" size="24" value="<?= $user->display_name ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">Cell Phone</p>
			</td>
			<td>
				<input type="text" size="24" maxsize="50" name="phone" value="<?= get_user_meta($user->ID, 'phone', true) ?>">
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad">U of M School year</p>
			</td>
			<td>
				<?= do_shortcode("[um_school_year_dropdown value=" . get_user_meta($user->ID, 'student_year', true) . "}]") ?>
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
