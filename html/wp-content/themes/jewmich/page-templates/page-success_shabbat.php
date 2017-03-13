<?php 
/**
 * Template Name: success_shabbat Template
 */

define('DONOTCACHEPAGE', true);

$user = User::getLoggedInUser();
if (!$user && empty($_SESSION['person_id'])) {
	header("Location: /success");
	exit;
}

$person = $user ? $user->person : Person::getFromId($_SESSION['person_id']);

$error = '';
if (!$user && !empty($_POST['password'])) {
	if ($_POST['password'] != $_POST['reenter_password']) {
		$error = "Passwords do not match";
	} else {
		$user = User::create($person, $_POST['password']);
		$_SESSION['user'] = $user;
		header('Location: /success?type=registered');
	}
}

get_header();
?>
<p class="chabad">
	<span class="chabad-header">Thank you</span>
	<br>
	Your reservation has been submitted.
<?php if(!$user && !User::isEmailTaken($person->email)): ?>
If you'd like to make make future reservations simpler, register an account below:
</p>
<br>
<form action="/success_shabbat" method="post">
	<input type="hidden" name="person_id" value="<?= $person->id ?>">
<div style="background-image: url(/pic/chabad-bg.gif); width: 100%; padding: 5px 0" align="center">
   <p align="center" class="chabad-header">Register an account (optional)</p>
   <?php if ($error): ?>
   <font color='red'><?= $error ?></font>
   <?php endif ?>
   <table border="0" id="logintable">
      <tr>
         <td>
            <p class="chabad">Email:</p>
         </td>
         <td>
            <input name="email" type="text" size="24" value="<?= $person->email ?>" disabled/>
         </td>
      </tr>
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
