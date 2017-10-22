<?php
/**
 * Template Name: form-process-highholiday Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

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
$params = array('date_time' => date('Y-m-d H:i:s', strtotime('+2 hours')));
$paramKeys = array('firstname', 'lastname', 'email', 'phone', 'styear', 'attending', 'comment', '1ntser', '1ntmel', '1dyser', '1dymel', 'shfr1', '2ntser', '2ntmel', '2dyser', '2dymel', 'shfr2', '3ntser', '3ntmel', 'yk1nt', 'ykdy', 'yk2nt', 'address', 'city', 'state', 'zip');
foreach ($paramKeys as $paramKey) $params[$paramKey] = isset($_POST[$paramKey]) ? $_POST[$paramKey] : '';
$GLOBALS['wpdb']->insert('High Holiday', $params);

$mailer = getMailer();
$mailer->Subject = $_POST['subject'];
$mailer->Body = "".$params['firstname'].", ".$params['lastname']."\n
Email: ".$params['email']."\n
Phone: ".$params['phone']."\n
Attending: ".$params['attending']."\n
School_Year: ".$params['styear']."\n
Address: ".$params['address']."\n 
City/State/Zip:, ".$params['city'].", ".$params['state'].", ".$params['zip']."\n
Attending:

1stnightser: ".$params['1ntser'].", 1stntml: ".$params['1ntmel']."\n
1stdayserv: ".$params['1dyser'].", 1stdashofr: ".$params['shfr1'].", 1stdayml: ".$params['1dymel']."\n
2ntser: ".$params['2ntser'].", 2ntmeal: ".$params['2ntmel']."\n
2nddayserv: ".$params['2dyser'].", 1stdashofr: ".$params['shfr2'].", 2nddayml: ".$params['2dymel']."\n
3rdnightser: ".$params['3ntser'].", 3rdntmeal: ".$params['3ntmel']."\n
yomkiprnight: ".$params['yk1nt'].", yomkipurday: ".$params['ykdy'].", yomkipur2ndnight: ".$params['yk2nt']."\n
Comment:".$params['comment']." ";
$mailer->AddAddress('goblue18@gmail.com');
$mailer->AddReplyTo($_POST['email'], "{$params['firstname']} {$params['lastname']}");
$mailer->SetFrom(WEBFORM_EMAIL);
$mailer->Send();

$mailer = getMailer();
$mailer->Subject = "High Holiday Reservation";
$mailer->Body = "Hey ".$params['firstname'].",

This is to confirm that your High Holiday Reservation was received.

Looking forward to see you at the Chabad House.

For directions please click here
http://www.jewmich.com/map
";
$mailer->AddAddress($_POST['email']);
$mailer->SetFrom('umchabad@jewmich.com', 'Chabad House at UM');
$mailer->Send();
?>

<div class="row col-xs-12 col-sm-9">
<div class="col-xs-12">
<h1>Thank you,</h1>
<br />
<h2> You are all set for the High Holidays. Looking forward to see you at the Chabad House.</h2><br />
<h1>One more thing!</h1>
<h2>Please help Chabad continue making these services possible this and many more High Holiday seasons.</h2><br />
<h1><a href="/donate">Donate Via Credit Card</a> or <a href="http://www.venmo.com/umchabad">Venmo</a> </h1>

</div>
</div>


              
                  </td>
                </tr>
              </table>
            </div>
<?php
get_footer();
?>
