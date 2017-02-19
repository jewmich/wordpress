<?php
/**
 * Template Name: form-process-highholiday Template
 */

if (empty($_POST['subject'])) {
	header('Location: /highholidayregister');
	die;
}
get_header();
?>
            <p><br>
           <div width="485" style="width: 500px; height: 18px"> &nbsp;</div> <br>
			<div align="center">
              <table border="0" width="93%" id="table1" background="/pic/chabad-bg.gif" height="118">
                <tr>
                  <td>
                  
                  
 <p align="center" class="chabad-header">
                  <?php
$paramKeys = array('firstname', 'lastname', 'email', 'phone', 'year', 'attending', 'comment', '1ntser', '1ntmel', '1dyser', '1dymel', 'shfr1', '2ntser', '2ntmel', '2dyser', '2dymel', 'shfr2', '3ntser', '3ntmel', 'yk1nt', 'ykdy', 'yk2nt', 'address', 'city', 'state', 'zip');
$placeholders = array_fill(0, count($paramKeys), '?');
$query = 'INSERT INTO `High Holiday` VALUES (' . implode(',', $placeholders) . ', DATE_ADD(NOW(), INTERVAL 2 HOUR))';

$params = array();
foreach ($paramKeys as $paramKey) $params[] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';
getDb()->prepare($query)->execute($params);

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = "'".$_POST['firstname']."', '".$_POST['lastname']."'\n
Email:'".$_POST['email']."'\n
Phone:'".$_POST['phone']."'\n
Attending:', '".$_POST['attending']."'\n
Address:', '".$_POST['address']."'\n 
City/State/Zip:', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['zip']."'\n
Comment:'".$_POST['comment']."'  ";
$mailer->AddAddress('goblue18@gmail.com');
$mailer->AddReplyTo($_POST['email'], "{$_POST['firstname']} {$_POST['lastname']}");
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

$mailer = getMailer();
$mailer->Subject = "High Holiday Reservation";
$mailer->Body = "Hey ".$_POST['firstname'].",

This is to confirm that your High Holiday Reservation was received.

Looking forward to see you at the Chabad House.

For directions please click here
http://www.jewmich.com/map
";
$mailer->AddAddress($_POST['email']);
$mailer->SetFrom('umchabad@jewmich.com', 'Chabad House at UM');
$mailer->Send();
?>
Thank you, <br>You are all set for the High Holidays<br>Looking forward to see you at the Chabad House.

<br><p class=chabad-header align="center"><br>One more thing!<br>Please help Chabad continue making these <br>services possible this and many more High Holiday seasons.<br>
<a href="/donate">Donate</a></p>
               
                  </td>
                </tr>
              </table>
            </div>
<?php
get_footer();
?>