<?php 
/**
 * Template Name: success_shabbat Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

$user = wp_get_current_user();
if (!$user->exists() && empty($_SESSION['user_id'])) {
	header("Location: /success");
	exit;
}

$error = '';
if (!$user->exists() && !empty($_POST['password'])) {
	if ($_POST['password'] != $_POST['reenter_password']) {
		$error = "Passwords do not match";
	} else {
		$result = wp_update_user([
			'ID' => $_SESSION['user_id'],
			'user_pass' => $_POST['password'],
		]);
		if (is_wp_error($result)) {
			throw new Exception($result->get_error_message());
		}
		wp_set_current_user($result);
		wp_set_auth_cookie($result);
		header('Location: /success?type=registered');
		exit();
	}
}

get_header();
?>
<p class="chabad">
	<span class="chabad-header">Thank you</span>
	<br>
	Your reservation has been submitted.
<?php if(!$user->exists()): ?>
If you'd like to make make future reservations simpler, register an account below:
</p>
<br>
<form action="/success_shabbat" method="post">
<div style="background-image: url(/pic/chabad-bg.gif); width: 100%; padding: 5px 0" align="center">
   <p align="center" class="chabad-header">Register an account (optional)</p>
   <?php if ($error): ?>
   <font color='red'><?= $error ?></font>
   <?php endif ?>
   <table border="0" id="logintable">
      <tr>
         <td>
            <p class="chabad">Password:</p>
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
      <input class="login" width="50" type="submit" value="Register">
   </p>
</div>
</form>
<br>
<p class="chabad">
<?php endif ?>
Hope to see you at Chabad House this weekend.
<br/>
For directions please <a href="/map">click here</a>
</p>
<?php
get_footer();
?>
