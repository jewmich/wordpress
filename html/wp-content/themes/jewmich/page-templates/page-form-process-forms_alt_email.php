<?php
/**
 * Template Name: form-process-forms Template
 */

define('DONOTCACHEPAGE', true);

if (!empty($_POST['username'])) {
	// Honeypot triggered! This must've been submitted by a spam bot, because 
	// the "username" input is hidden by CSS.
	die;
}	
unset($_POST['username']);
get_header();
?>
<p><br>
<div width="485" style="width: 500px; height: 18px"> &nbsp;</div> <br>
<div align="center">
  <table border="0" width="93%" id="table1" background="/pic/chabad-bg.gif" height="118">
	<tr>
	  <td>
	  
	  
	  <?php
			print "<p align=\"center\" class=\"chabad-header\"";
			if($_POST['email'] != "" && $_POST['email']==$_POST['elll0']){
				$message="";

				foreach ($_POST as $key => $value) {
					$message .= "$key: $value\n";
				}

				$mailer = getMailer();
				$mailer->Subject = $_POST['subject'];
				$mailer->Body = $message;
				$mailer->AddAddress(USER2_EMAIL);
				$mailer->AddReplyTo($_POST['email'], $_POST['realname']);
				$mailer->SetFrom(WEBFORM_EMAIL, $_POST['realname']);
				$mailer->Send();
			
				print ">";
				print $_POST['message'];
										
			}
			else{
				print "style='color: red;'>";
				print "Please go back and fill in both emails.";
			}

		?>
	  
	  </td>
	</tr>
  </table>
</div>
<?php
get_footer();
?>
