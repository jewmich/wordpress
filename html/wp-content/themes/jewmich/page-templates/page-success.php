<?php
/**
 * Template Name: success Template
 */

get_header();
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
?>
<div style="background-color: #e6e7e8; margin-top: 70px">
<br>
<p align="center" class="chabad-header"><? 
switch ($type):
   case 'donate': ?>
Thank you<br>
<br> 
Your contribution has been submitted. <br>
May you and your loved ones be blessed with a <br>
healthy, happy and prosperous life.<br>

<? break; case 'order': ?>
Your order has been submitted. 
<br><br>
Thank you for shopping <br>
at <br> Chabad Virtual Judaic Shop<br>
<br>
You will be receiving an e-mail confirmation shortly.

<? break; case 'paid': ?>
Thank you<br>
<br> 
Your payment has been submitted. <br>
<br>
You should be receiving a confirmation email shortly.

<? break; case 'passover': ?>
Thank you<br>
<br> 
Your reservation has been submitted.
<br/>
<br/>
Looking forward see you at Chabad House
<br/>
For directions please
<a href="/map">click here</a>

<? break; case 'shabbat': ?>
Thank you<br>
<br> 
Your reservation has been submitted.
<br/>
<br/>
Hope to see you at Chabad House this weekend.
<br/>
For directions please
<a href="/map">click here</a>

<? break; case 'registerd': ?>
Thank you<br>
<br> 
Your account has been created successfully.

<? break; default: ?>
Thank you<br>
<br> 
Your form has been submitted. 
<?
endswitch
?>
<br><br>
</p>
</div>
<?php
get_footer();
?>
