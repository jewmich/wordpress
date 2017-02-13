<?php
/**
 * Template Name: passovercom Template
 */

$currentJewishYear = cal_from_jd(unixtojd(time()), CAL_JEWISH);
$currentJewishYear = $currentJewishYear['year'];
$firstSeder = jdtounix(jewishtojd(8, 15, $currentJewishYear));
$secondSeder = jdtounix(jewishtojd(8, 16, $currentJewishYear));
$sunsetTimeOnFirstSeder = date_sunset($firstSeder, SUNFUNCS_RET_TIMESTAMP, LATITUDE_ANNARBOR, LONGITUDE_ANNARBOR);
// round to nearest quarter-hour
$sunsetTimeOnFirstSeder = round($sunsetTimeOnFirstSeder / (15 * 60)) * (15 * 60);

get_header();
?>
<link href="files/chabad.css" rel="stylesheet" type="text/css" />

<div align="center">
<table border="0" id="table5" width="600">
 <tbody>
  <tr>
   <td bgcolor="#FFD246">
    <p align="center">
     <b>
      <a class="linknoline" href="/chometz">
       Sell your Chametz
      </a>
     </b>
    </p>
   </td>
  </tr>
  <tr>
   <td>
   </td>
  </tr>
  <tr>
   <td background="homepic/chabad-bg.gif">
    <p align="center">
     <span class="chabad">
      <span class="chabad-header">
       ON-LINE PASSOVER COMMUNITY RESERVATIONS FORM
      </span>
      <br/>
		<?= date('F j', $firstSeder) ?> - <?= date('F j', $secondSeder) ?>, <?= idate('Y', $firstSeder) ?> <?= date('g:i A', $sunsetTimeOnFirstSeder) ?>
     </span>
    </p>
   </td>
  </tr>
  <tr>
   <td>
    <p align="left" class="chabad-header">
     There is a seat waiting for you at our Seder table...
    </p>
   </td>
  </tr>
  <tr>
   <td>
    <p class="chabad">
     Come celebrate 
				the Passover seder at Chabad.
     <br/>
     Enjoy a festive, homemade meal, with new and old friends. 
				Experience the true meaning of Passover, transcend time and 
				space and leave Egypt with our ancestors.
    </p>
   </td>
  </tr>
  <tr>
   <td class="chabad">
    <span class="chabad-header" onclick="openClose('a1')" style="cursor:hand; cursor:pointer">
     Seder Frequantly Asked Questions
    </span>
   </td>
  </tr>
  <tr>
   <td class="chabad">
    <span class="texter" id="a1">
     <b>
      Do only orthodox people participate in the Chabad Seder?
     </b>
     <br/>
     Absolutely not! In fact, the majority of our participants are either reform, conservative or just Jewish.
     <br/>
     <br/>
     <b>
      What should one wear to the Seder?
     </b>
     <br/>
     Clothes!!! You are free to dress in whatever you wish, although most people will be wearing business casual attire.
     <br/>
     <br/>
     <b>
      How long does the Seder generally last?
     </b>
     <br/>
     We usually spend about an hour to an hour and a half reading and discussing various parts of the Hagadah. Then, we follow with the 
Matzah and a delicious, festive meal.
     <br/>
     <br/>
     <b>
      What types of food will be served?
     </b>
     <br/>
     Everything from Gefiltah Fish to Chicken soup to Potatoes to Chicken and much much more! Plus, almost all the food served is homemade!!
    </span>
   </td>
  </tr>
 </tbody>
</table>

<form method="post" action="https://pay1.plugnpay.com/payment/annarborchapay.cgi"> 
<input type="hidden" name="description1" value="1st seder night student">
<input type="hidden" name="description2" value="1st seder night Community member">
<input type="hidden" name="description3" value="2nd seder night student">
<input type="hidden" name="description4" value="2nd seder night Community member">
<input type="hidden" name="description5" value="Lunch Shabbat. April 4">
<input type="hidden" name="description7" value="Lunch Sun. April 5">
<input type="hidden" name="description8" value="Dinner Sun. April 5">
<input type="hidden" name="description9" value="Lunch & Dinner Sun. April 5">
<input type="hidden" name="description10" value="Lunch . Mon April 6">
<input type="hidden" name="description11" value="Dinner Mon. April 6">
<input type="hidden" name="description12" value="Lunch & Dinner Mon. April 6">
<input type="hidden" name="description13" value="Lunch Tue. April 7">
<input type="hidden" name="description14" value="Dinner Tue. April 7">
<input type="hidden" name="description15" value="Lunch & Dinner Tue. April 7">
<input type="hidden" name="description16" value="Lunch Wed. April 8">
<input type="hidden" name="description17" value="Dinner Wed. April 8">
<input type="hidden" name="description18" value="Lunch & Dinner Wed. April 8">
<input type="hidden" name="description19" value="Lunch Thurs. April 9">
<input type="hidden" name="description20" value="Dinner Thurs. April 9">
<input type="hidden" name="description21" value="Lunch & Dinner Thurs. April 9">
<input type="hidden" name="description22" value="Lunch Fri. April 10">
<input type="hidden" name="description23" value="Dinner Shabbat April 10">
<input type="hidden" name="description24" value="Lunch Shabbat. April 11">
<input type="hidden" name="description50" value="Donation">
<input type="hidden" name="item1" value="1stsederstu">
<input type="hidden" name="item2" value="1stsedercom">
<input type="hidden" name="item3" value="2ndsederstu">
<input type="hidden" name="item4" value="2ndsedercom">
<input type="hidden" name="item5" value="1stdday">
<input type="hidden" name="item7" value="2nddday">
<input type="hidden" name="item8" value="2ndnight">
<input type="hidden" name="item9" value="2nddaynight">
<input type="hidden" name="item10" value="3rdday">
<input type="hidden" name="item11" value="3rdnight">
<input type="hidden" name="item12" value="3rddaynight">
<input type="hidden" name="item13" value="4thdday">
<input type="hidden" name="item14" value="4thnight">
<input type="hidden" name="item15" value="4thdaynight">
<input type="hidden" name="item16" value="5thdday">
<input type="hidden" name="item17" value="5thnight">
<input type="hidden" name="item18" value="5thdaynight">
<input type="hidden" name="item19" value="6thday">
<input type="hidden" name="item20" value="6thnight">
<input type="hidden" name="item21" value="6thdaynight">
<input type="hidden" name="item22" value="7thday">
<input type="hidden" name="item23" value="7thnight">
<input type="hidden" name="item24" value="8thday">
<input type="hidden" name="item50" value="donation"> 
<input type="hidden" name="cost1" value="18.00">
<input type="hidden" name="cost2" value="36.00">
<input type="hidden" name="cost3" value="18.00">
<input type="hidden" name="cost4" value="36.00">
<input type="hidden" name="cost5" value="5.50">
<input type="hidden" name="cost7" value="5.50">
<input type="hidden" name="cost8" value="8.50">
<input type="hidden" name="cost9" value="13.00">
<input type="hidden" name="cost10" value="5.50">
<input type="hidden" name="cost11" value="8.50">
<input type="hidden" name="cost12" value="13.00">
<input type="hidden" name="cost13" value="5.50">
<input type="hidden" name="cost14" value="8.50">
<input type="hidden" name="cost15" value="13.00">
<input type="hidden" name="cost16" value="5.50">
<input type="hidden" name="cost17" value="8.50">
<input type="hidden" name="cost18" value="13.00">
<input type="hidden" name="cost19" value="5.50">
<input type="hidden" name="cost20" value="8.50">
<input type="hidden" name="cost21" value="13.00">
<input type="hidden" name="cost22" value="5.50">
<input type="hidden" name="cost23" value="0.00">
<input type="hidden" name="cost24" value="5.50">
<input type="hidden" name="quantity50" value="1">
<input type="hidden" name="publisher-name" value="annarborcha"> 
<input type="hidden" name="order-id" value="chabadpassoverseder"> 
<input type="hidden" name="card-allowed" value="Visa,Mastercard"> 
<input type="hidden" name="shipinfo" value="0"> 
<input type="hidden" name="easycart" value="1"> 
<input name="success-link" type="hidden" value="http://<?= $_SERVER['SERVER_NAME'] ?>/successredirect?type=passover"/>
<input type=hidden name="subject" value="Seder reservation">
<input type="hidden" name="subacct" value="seder">

<table border="0" width="600" id="table3">
   <tr>
      <td class="chabad-header" align="center" background="homepic/chabad-bg.gif">
         <a name="form" >Passover Seder On-line form</a>
      </td>
   </tr>


   <tr>
     <td class="chabad" bgcolor="#FFFFFF">
       <p class="chabad-small" align="center">
         Indicate bellow the number of people
         attending
         then click the <br>
         proceed to our secure web-site button</td>
   </tr>


   <tr>
      <td class="chabad">
         <div align="center">
            <table border="0" width="465" id="table8">
               <tr>
                  <td class="chabad" colspan="2">
							<p class="chabad-header">1st Seder <?= date('D F j, Y', $firstSeder) ?></p>
						</td>
                  <td class="chabad" colspan="2">
							<p class="chabad-header">2nd Seder <?= date('D F j, Y', $secondSeder) ?></p>
						</td>
               </tr>
               
               <tr>
                  <td class="chabad" width="13%">

                     <select name="quantity2" size="1">
                        <option></option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option></select></td>
                  <td class="chabad" width="37%">

                     $36</td>
                  <td class="chabad" width="11%">

                     <select name="quantity4" size="1">
                        <option></option>
                        <option>1</option>
                        <option>2</option>

                        <option>3</option>
                        <option>4</option></select></td>
                  <td class="chabad" width="39%">

                     $36 </td>
               </tr>
               <tr>
                 <td colspan="4" valign="top" class="chabad"><table width="432" border="0">
                   <tr>
                     <td width="141" class="chabad">&nbsp;</td>
                     <td width="275" class="chabad">&nbsp;</td>
                   </tr>
                   <tr>
                     <td class="chabad">How did you find us? </font></td>
                     <td class="chabad"><select class="chabad" size="1" name="foundus">
                       <option>Chose one</option>
                       <option>Facebook AD</option>
                       <option>Friend</option>
                       <option>Mailer</option>
                       <option>Search engine</option>
                       <option>Family member</option>
                       <option>Email</option>
                       <option>Other</option>
                       </select>
                      </td>
                   </tr>
                   <tr>
                     <td>&nbsp;</td>
                     <td><span class="chabad-header"> Reservation names and Comments:</span></td>
                   </tr>
                   <tr>
                     <td>&nbsp;</td>
                     <td><textarea rows="2" name="names2" cols="31"></textarea></td>
                   </tr>
                 </table></td>
               </tr>
               
            </table>
         </div>
      </td>
   </tr>

      <tr>
         <td width="442" class="chabad"> 
            &nbsp;<div align="center">
               <table border="1" width="86%" id="table9">
                  <tr>
                     <td bgcolor="#FFFFFF">
                        <p align="center">


                        <span align="center" class="chabad-header">
                           
                              (optional) </span><span align="center" class="chabad-header">
                           I also wish to join in offering a helping hand <br>
                              to those 
                              in need in our community for the holiday<br/>
of Passover and&nbsp; make a contribution of<br>
                           &nbsp;<input type="text" name="cost50" value="0.00" size="6"></span><br>
                        <span class="chabad-small">It is with this contribution that will enable Chabad at 
                           U of M		<br>			to continue servicing&nbsp; the Jewish community.</span></td>
                  </tr>
               </table>
            </div>
         </td>

      </tr>


      <tr>
         <td width="442" align="center" class="chabad"><div align="right"><strong>All reservations are non-refundable
      </strong></div></td>              </tr>


      <tr>
         <td width="442" class="chabad">
            <p align="center">
            <input type="submit" name="return" value="Proceed to our Secure Web Page >" style="float: right"></td>
      </tr>
      <tr>
         <td class="chabad">
            <div align="center">
               <table border="0" width="72%" id="table4">
                  <tr>
                     <td width="149">
                        <img border="0" src="pic/plugnpay.gif" align="center"></td>
                     <td>
                        <img border="0" src="pic/visamaster.gif" width="78" height="24" align="right"></td>
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
