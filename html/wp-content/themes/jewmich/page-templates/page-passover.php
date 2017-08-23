<?php
/**
 * Template Name: passover Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

$passoverDates = passoverDates();
$sunsetTimeOnFirstSeder = date_sunset($passoverDates['firstSeder'], SUNFUNCS_RET_TIMESTAMP, LATITUDE_ANNARBOR, LONGITUDE_ANNARBOR);
// round to nearest quarter-hour
$sunsetTimeOnFirstSeder = round($sunsetTimeOnFirstSeder / (15 * 60)) * (15 * 60);

get_header();
?>
<link href="files/chabad.css" rel="stylesheet" type="text/css" />

<div align="center">
  <form method="post" action="https://pay1.plugnpay.com/payment/annarborchapay.cgi">
    <table border="0" id="table5" width="600">
      <tbody>
        <tr>
          <td bgcolor="#FFD246"><p align="center"> <b> <a class="linknoline" href="/chometz"> Sell your Chametz </a> </b> </p></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td background="pic/chabad-bg.gif"><p align="center"> <span class="chabad"> <span class="chabad-header"> ON-LINE PASSOVER RESERVATIONS FORM </span> <br/>
            <?= date('F j', $passoverDates['firstSeder']) ?>
            -
            <?= date('F j', $passoverDates['secondSeder']) ?>
            ,
            <?= idate('Y', $passoverDates['firstSeder']) ?>
            <?= date('g:i A', $sunsetTimeOnFirstSeder) ?>
          </span> </p></td>
        </tr>
        <tr>
          <td><p align="left" class="chabad-header"> There is a seat waiting for you at our Seder table... </p></td>
        </tr>
        <tr>
          <td><p class="chabad"> Come celebrate 
            the Passover seder at Chabad. <br/>
            Enjoy a festive, homemade meal, with new and old friends. 
            Experience the true meaning of Passover, transcend time and 
            space and leave Egypt with our ancestors. </p></td>
        </tr>
        <tr>
          <td class="chabad"><span class="chabad-header" onclick="openClose('a1')" style="cursor:hand; cursor:pointer"> Seder Frequantly Asked Questions </span></td>
        </tr>
        <tr>
          <td class="chabad"><span class="texter" id="a1"> <b> Do only orthodox people participate in the Chabad Seder? </b> <br/>
            Absolutely not! In fact, the majority of our participants are either reform, conservative or just Jewish. <br/>
            <br/>
            <b> What should one wear to the Seder? </b> <br/>
            Clothes!!! You are free to dress in whatever you wish, although most people will be wearing business casual attire. <br/>
            <br/>
            <b> How long does the Seder generally last? </b> <br/>
            We usually spend about an hour to an hour and a half reading and discussing various parts of the Hagadah. Then, we follow with the 
            Matzah and a delicious, festive meal. <br/>
            <br/>
            <b> What types of food will be served? </b> <br/>
            Everything from Gefiltah Fish to Chicken soup to Potatoes to Chicken and much much more! Plus, almost all the food served is homemade!! </span></td>
        </tr>
      </tbody>
    </table>
    <table border="0" width="600" id="table3">
    <tr>
      <td width="442" align="center" background="pic/chabad-bg.gif" class="chabad-header">
         <a name="form" >Passover Seder On-line form</a>
      </td>
   </tr>
      <tr>
         <td class="chabad">
            <div align="center">
               <table border="0" width="88%" id="table4">
                  <tr>
                     <td align="center"><p>&nbsp;</p>
                     <p>&nbsp;</p>
                     <p><a href="/passoverum"><img src="/wp-content/uploads/2017/02/sederum.gif" width="300" height="96" /> </a></p>
                     <p>&nbsp;</p>
                     <p><a href="/passovercom"><img src="/wp-content/uploads/2017/02/sedercom.gif" width="300" height="96"/></a></p>
                     <p>&nbsp;</p></td>
                  </tr>
               </table>
            </div>
         </td>
      </tr>
      <tr>
         <td class="chabad" >
            <p align="center" class="chabad-header">You can&nbsp; also place 
            your reservation <br>
            by calling 734-995-3276.</td>
      </tr>
</table>
</form>
</div>
<?php
get_footer();
?>
