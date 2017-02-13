<?php
/**
 * Template Name: kiddushreserve Template
 */

if (!isset($_POST['originalJd'])) {
	// shouldn't be here. Redirect back to kiddushmain.php
	header('Location: /kiddushmain');
	die;
}
require_once(get_template_directory() . '/includes/kiddush.php');
get_header();
?>
<script LANGUAGE="JavaScript" type="text/javascript">
function verify() {
	var themessage = "You are required to complete the following fields: ";
	if (document.form.realname.value=="") {
		themessage = themessage + " - Your full name";
	}
	if (document.form.email.value=="") {
		themessage = themessage + " -  Your E-mail";
	}
	if (document.form.readRules.checked==false) {
		themessage = themessage + " -  Checkbox that you read the rules";
	}
	//alert if fields are empty and cancel form submit
	if (themessage == "You are required to complete the following fields: ") {
		document.form.submit();
	}
	else {
		alert(themessage);
		return false;
	}
}
</script>
<div align="left">
<form name="form" action="/kiddushreserve" method="post" action="">
	<input type=hidden name="originalJd" value="<?= $_POST['originalJd'] ?>">
	<input type=hidden name="form" value="submitted">
	<table align="left" border="0" width="100%" id="table1" background="pic/chabad-bg.gif" height="118">
		<tr>
			<td>
<? if (isset($_POST['form']) && $_POST['form'] == "submitted"): ?>
	<p align="center" class="chabad-header"><?= reserveDate($_POST) ?><br></p>
<?
//if they need to fill out the form to sign up for a Kiddush
elseif(!isset($_POST['change'])): ?>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2" bgcolor="#FFFFFF">
				<p class="chabad-header">Simply fill out this form&nbsp;
				<font color="#FF0000"><br>*Required Fields </font>
			</td>
		</tr>
		<tr>
			<td width="50%" colspan="2"><span class="chabad">
				<p align="center" class="chabad-header">You are reserving the week of <?= date("M j, Y", jdtounix($_POST['originalJd'] + 1)) ?></p></span>
			</td>
		</tr>
		<tr>
			<td><span class="chabad"><font color="#FF0000">*</font> Your
					Full Name
			</td>
			<td><span class="chabad">
					<font color="#FFFFFF"><input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="realname"></font>
			</td>
		</tr>
		<tr>
			<td><span class="chabad"><font color="#FF0000">*</font> Your
						Email</span> 
			</td>
			<td><span class="chabad">
					<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="email"></span>
			</td>
		</tr>
		<tr>
			<td>
				<p class="chabad"><font color="#FF0000">*</font> Re-type Email</p></td>
			<td>
				<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="elll0">
			</td>
		</tr>
		<tr>
			<td class="chabad"><font color="#FF0000">*</font> Phone</td>
			<td class="chabad">
				<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="phone"></td>
		</tr>
		<tr>
			<td class="chabad">In Honor Of</td>
			<td class="chabad">
				<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="honor"></td>
		</tr>
		<tr>
			<td><span class="chabad">How did you find us?
				</font>
			</td>
			<td><span class="chabad">
					<font color="#FFFFFF"><select size="1" name="foundus">
							<option>Chose one</option>
							<option>Advertisement</option>
							<option>Friend</option>
							<option>Search engine</option>
							<option>Family member</option>
							<option>Other</option>
				</select></font>
			</td>
		</tr>
		<tr>
			<td class="chabad" colspan="2">
				Comment: 
				(Additional names)</td>
		</tr>
		<tr>
			<td colspan="2">
				<p align="center"><span class="chabad">
					<textarea rows="4" name="suggestion" cols="30"></textarea></td>
		</tr>
		<tr>
			<td class="chabad" colspan="2">
				<font color="#FF0000">*</font> I have read and agree to follow all the rules
				of sponsoring a Kiddush (last page)</td>
		</tr>
		<tr>
			<td width="95%" colspan="2">
				<p align="center"><span class="chabad">
					<input type="checkbox" name="readRules"></input></td>
		</tr>
		<tr>
			<td colspan="2">
				<p align="center">
				<input type="button" value="Reserve Kiddush" onclick="verify();"> 
<? else: // if the "Change" button was clicked
	$reservation = getReservation($_POST['originalJd']);
	if ($reservation): ?>
			</td>
		</tr>
		<tr>
			<td width="54%" colspan="2" align="center" bgcolor="#FFFFFF">
			<p align="left" class="chabad-header">Simply fill out this form&nbsp;
			<font color="#FF0000"><br>
			*Required Fields </font> </td>
		</tr>
		<tr>
			<td><span class="chabad"><font color="#FF0000">*</font> Your
						Email</span> 
			</td>
			<td><span class="chabad">
					<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="email"></span>
			</td>
		</tr>
		<tr>
			<td width="43%" class="chabad"><font color="#FF0000">*</font> New Date</td>
			<td width="51%" class="chabad">
				<select NAME="newJd">
					<? foreach(getAllowedChangeDays($_POST['originalJd']) as $day): ?>
					<option value="<?= $day ?>"><?= date("M j, Y", jdtounix($day + 1)) ?></option>
					<? endforeach ?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<p align="center">
				<input type="submit" name="change" value="Reserve Kiddush"> 
	<? else: ?>
				<font color='red'>Could not find reservation</font>
	<? endif ?>
<? endif ?>
			</td>
		</tr>
	</table>
</form>
</div>
<?php
get_footer();
