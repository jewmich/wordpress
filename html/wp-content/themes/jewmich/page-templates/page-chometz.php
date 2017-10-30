<?php
/**
 * Template Name: chometz Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

$year = currentJewishYear();
$openDate = strtotime('12:00AM America/New_York', jewishtojdunix(8, 24, $year - 1));
$closeDate = strtotime('12:00AM America/New_York', jewishtojdunix(8, 13, $year));
get_header();
?>

<span class="chabad-header">
	Sell Your Chametz Online !
</span>
<p class="chabad">
	Since it is prohibited to 
	possess chametz on Pesach, any Chametz left undisposed 
	must be sold to a non-Jew. Any chametz remaining in 
	the possession of a Jew during Pesach may not be used, eaten, bought 
	or sold even after Pesach.
	<br/>
	<br/>
	Therefore, all Chametz that will not be eaten or 
	burned before Pesach and all chametz utensils that 
	will not be thoroughly cleaned by then should be 
	stored away.
	<br/>
	<br/>
	The storage area should be locked or taped shut to be 
	leased to the non-Jew at the time of the Chametz sale.
	<br/>
	<br/>
	Since there are many legal intricacies in this sale, 
	only a competent rabbi should be entrusted with its 
	execution. The rabbi acts as our agent both to sell 
	the chametz to the non-Jew on the morning before 
	Pesach starts and also to buy it back the evening 
	after Pesach ends.
	<br/>
	<br/>
	Please fill out the form bellow.  If you are 
	unable to submit your form on-line you may do it in person until 
	<?= get_wordpress_date('l F j, Y h:iA', $closeDate) ?>.
</p>
<br/>
<?php if (time() < $openDate || time() > $closeDate): ?>
<p class="chabad">Sorry, we are closed</p>
<?php else: ?>
<form action="https://pay1.plugnpay.com/payment/annarborchapay.cgi" method="post">
	<input name="taxstate" type="hidden" value="all"/>
	<input name="publisher-email" type="hidden" value="info-nospam@jewmich.com"/>
	<input name="publisher-name" type="hidden" value="annarborcha"/>
	<input name="subacct" type="hidden" value="chometz"/>
	<input name="order-id" type="hidden" value="donation"/>
	<input name="card-allowed" type="hidden" value="Visa,Mastercard,amex"/>
	<input name="shipinfo" type="hidden" value="0"/>
	<input name="easycart" type="hidden" value="1"/>
	<?= do_shortcode('[plugnpay_success_link type=donate]'); ?>
          <input name="suppress_unpw" type="hidden" value="yes"/>
      <input name="currency_symbol" type="hidden" value="$"/>
              <input name="plan20" type="hidden" value="20"/>
      <input name="item20" type="hidden" value="chaimo"/>
      <input name="description20" type="hidden" value="Chai Club Monthly"/>
      <input name="cost20" size="7" type="hidden" value="18.00"/>
      <input name="plan21" type="hidden" value="21"/>
      <input name="item21" type="hidden" value="chaimo"/>
      <input name="description21" type="hidden" value="Chai Club Monthly"/>
      <input name="cost21" size="7" type="hidden" value="36.00"/>
      <input name="plan22" type="hidden" value="22"/>
      <input name="item22" type="hidden" value="chaimo"/>
      <input name="description22" type="hidden" value="Chai Club Monthly"/>
      <input name="cost22" size="7" type="hidden" value="54.00"/>
      <input name="plan23" type="hidden" value="23"/>
      <input name="item23" type="hidden" value="chaimo"/>
      <input name="description23" type="hidden" value="Chai Club Monthly"/>
      <input name="cost23" size="7" type="hidden" value="72.00"/>
      <input name="plan24" type="hidden" value="24"/>
      <input name="item24" type="hidden" value="chaimo"/>
      <input name="description24" type="hidden" value="Chai Club Monthly"/>
      <input name="cost24" size="7" type="hidden" value="108.00"/>
      <input name="plan25" type="hidden" value="25"/>
      <input name="item25" type="hidden" value="chaimo"/>
      <input name="description25" type="hidden" value="Chai Club Monthly"/>
      <input name="cost25" size="7" type="hidden" value="136.00"/>
      <input name="plan26" type="hidden" value="26"/>
      <input name="item26" type="hidden" value="chaimo"/>
      <input name="description26" type="hidden" value="Chai Club Monthly"/>
      <input name="cost26" size="7" type="hidden" value="154.00"/>
      <input name="plan27" type="hidden" value="27"/>
      <input name="item27" type="hidden" value="chaimo"/>
      <input name="description27" type="hidden" value="Chai Club Monthly"/>
      <input name="cost27" size="7" type="hidden" value="180.00"/>
      <input name="plan28" type="hidden" value="28"/>
      <input name="item28" type="hidden" value="chaibimo"/>
      <input name="description28" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost28" size="7" type="hidden" value="18.00"/>
      <input name="plan29" type="hidden" value="29"/>
      <input name="item29" type="hidden" value="chaibimo"/>
      <input name="description29" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost29" size="7" type="hidden" value="36.00"/>
      <input name="plan30" type="hidden" value="30"/>
      <input name="item30" type="hidden" value="chaibimo"/>
      <input name="description30" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost30" size="7" type="hidden" value="54.00"/>
      <input name="plan31" type="hidden" value="31"/>
      <input name="item31" type="hidden" value="chaibimo"/>
      <input name="description30" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost31" size="7" type="hidden" value="72.00"/>
      <input name="plan32" type="hidden" value="32"/>
      <input name="item32" type="hidden" value="chaibimo"/>
      <input name="description32" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost32" size="7" type="hidden" value="108.00"/>
      <input name="plan33" type="hidden" value="33"/>
      <input name="item33" type="hidden" value="chaibimo"/>
      <input name="description33" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost33" size="7" type="hidden" value="136.00"/>
      <input name="plan34" type="hidden" value="34"/>
      <input name="item34" type="hidden" value="chaibimo"/>
      <input name="description34" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost34" size="7" type="hidden" value="154.00"/>
      <input name="plan35" type="hidden" value="35"/>
      <input name="item35" type="hidden" value="chaibimo"/>
      <input name="description35" type="hidden" value="Chai Club Bi-Monthly"/>
      <input name="cost35" size="7" type="hidden" value="180.00"/>
      <input name="plan36" type="hidden" value="36"/>
      <input name="item36" type="hidden" value="chaitrimo"/>
      <input name="description36" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost36" size="7" type="hidden" value="18.00"/>
      <input name="plan37" type="hidden" value="37"/>
      <input name="item37" type="hidden" value="chaitrimo"/>
      <input name="description37" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost37" size="7" type="hidden" value="36.00"/>
      <input name="plan38" type="hidden" value="38"/>
      <input name="item38" type="hidden" value="chaitrimo"/>
      <input name="description38" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost38" size="7" type="hidden" value="54.00"/>
      <input name="plan39" type="hidden" value="39"/>
      <input name="item39" type="hidden" value="chaitrimo"/>
      <input name="description39" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost39" size="7" type="hidden" value="72.00"/>
      <input name="plan40" type="hidden" value="40"/>
      <input name="item40" type="hidden" value="chaitrimo"/>
      <input name="description40" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost40" size="7" type="hidden" value="108.00"/>
      <input name="plan41" type="hidden" value="41"/>
      <input name="item41" type="hidden" value="chaitrimo"/>
      <input name="description41" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost41" size="7" type="hidden" value="136.00"/>
      <input name="plan42" type="hidden" value="42"/>
      <input name="item42" type="hidden" value="chaitrimo"/>
      <input name="description42" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost42" size="7" type="hidden" value="154.00"/>
      <input name="plan43" type="hidden" value="43"/>
      <input name="item43" type="hidden" value="chaitrimo"/>
      <input name="description43" type="hidden" value="Chai Club Tri-Monthly"/>
      <input name="cost43" size="7" type="hidden" value="180.00"/>
    
	<table border="0" id="table4" width="448">
		<tr>
			<td background="pic/chabad-bg.gif" class="chabad" colspan="6">
				<p align="center" class="chabad-header">
				Delegation of Power to Sell Chametz On-line 
				form
				</p>
			</td>
		</tr>
		<tr>
			<td background="pic/chabad-bg.gif" class="chabad" colspan="6">
				<p class="chabad">
				Please note:  
				To validate your commitment to sell your Chametz on-line you will 
				need a credit card.  You are always welcome to come by the 
				Chabad House in person.
				</p>
			</td>
		</tr>
		<tr>
			<td class="chabad" colspan="6">
				<table border="0" id="table8" width="79%">
					<tr>
						<td>
							<span class="chabad">
								I&nbsp;(we)
							</span>
						</td>
						<td>
							<span class="chabad">
								<input maxsize="20" name="realname" size="33"/>
							</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="chabad" colspan="6">
				hereby
				authorize Rabbi Aharon Goldstein to dispose of all Chametz that may be
				in my (our) possession wherever it may be - at home, at my (our)
				place of business, or elsewhere - in accordance with the requirements of
				Jewish Law as incorporated in the contract for the sale of Chametz.
				<br/>
				<br/>
			</td>
		</tr>
		<tr>
			<td class="chabad" colspan="6">
				<b>
					Please use this area for your location 
					of Chametz home/business etc. :
				</b>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="6">
				<textarea cols="48" name="propertyaddress" rows="3" placeholder="Address, City, State and Zip"></textarea>
			</td>
		</tr>
		<tr>
			<td class="chabad" colspan="6">
				<br/>
			</td>
		</tr>
		<tr>
			<td background="pic/chabad-bg.gif" class="chabad" colspan="6">
				<p align="center">
				<span class="chabad">
					<i>
						"Whoever is 
						hungry, come and eat. Whoever is needy,
						<br/>
						come and celebrate Passover." Haggadah
					</i>
				</span>
				</p>
			</td>
		</tr>
		<tr>
			<td class="chabad" colspan="6">
				<p align="left">
				<b>
					I wish to join in offering a helping hand to those in 
					need in our community for the holiday of  Passover.  It is 
					with this contribution that will enable Chabad at U of M to continue 
					servicing  the Jewish community.
					<br/>
				</b>
				</p>
			</td>
		</tr>
		<tr>
			<td class="chabad" colspan="6">
				<span class="chabad">
					<p class="chabad-header">
					I want to make a contribution of:
					</p>
				</span>
			</td>
		</tr>
		<tr>
			<td class="chabad" width="23">
				<span class="chabad">
					<input name="quantity1" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="148">
				<input name="description1" type="hidden" value="Platinum Circle Patron"/>
				<span class="chabad">
					Platinum Circle Patron
				</span>
			</td>
			<td align="left" class="chabad" width="56">
				<input name="cost1" type="hidden" value="5,400"/>
				<span class="chabad">
					$5,400
				</span>
			</td>
			<td class="chabad" width="25">
				<span class="chabad">
					<input name="quantity2" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="134">
				<input name="description2" type="hidden" value="Triple Chai Patron"/>
				<span class="chabad">
					Triple Chai Patron
				</span>
			</td>
			<td align="left" class="chabad" width="36">
				<input name="cost2" type="hidden" value="540"/>
				<span class="chabad">
					$540
				</span>
			</td>
		</tr>
		<tr>
			<td class="chabad" width="23">
				<span class="chabad">
					<input name="quantity3" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="148">
				<input name="description3" type="hidden" value="Gold Circle Patron"/>
				<span class="chabad">
					Gold Circle Patron
				</span>
			</td>
			<td align="left" class="chabad" width="56">
				<input name="cost3" type="hidden" value="3,600"/>
				<span class="chabad">
					$3,600
				</span>
			</td>
			<td class="chabad" width="25">
				<span class="chabad">
					<input name="quantity4" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="134">
				<input name="description4" type="hidden" value="Double Chai Patron"/>
				<span class="chabad">
					Double Chai Patron
				</span>
			</td>
			<td align="left" class="chabad" width="36">
				<input name="cost4" type="hidden" value="360"/>
				<span class="chabad">
					$360
				</span>
			</td>
		</tr>
		<tr>
			<td class="chabad" width="23">
				<span class="chabad">
					<input name="quantity5" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="148">
				<input name="description5" type="hidden" value="Silver Circle Patron"/>
				<span class="chabad">
					Silver Circle Patron
				</span>
			</td>
			<td align="left" class="chabad" width="56">
				<input name="cost5" type="hidden" value="1,800"/>
				<span class="chabad">
					$1,800
				</span>
			</td>
			<td align="left" class="chabad" width="25">
				<span class="chabad">
					<input name="quantity6" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="134">
				<input name="description6" type="hidden" value="Chai Patron"/>
				<span class="chabad">
					Chai Patron
				</span>
			</td>
			<td align="left" class="chabad" width="36">
				<input name="cost6" type="hidden" value="180"/>
				<span class="chabad">
					$180
				</span>
			</td>
		</tr>
		<tr>
			<td class="chabad" width="23">
				<span class="chabad">
					<input name="quantity7" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="148">
				<input name="description7" type="hidden" value="Bronze Circle Patron"/>
				<span class="chabad">
					Bronze Circle Patron
				</span>
			</td>
			<td align="left" class="chabad" width="56">
				<input name="cost7" type="hidden" value="1080"/>
				<span class="chabad">
					$1,080
				</span>
			</td>
			<td class="chabad" width="25">
				<span class="chabad">
					<input name="quantity8" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="134">
				<input name="description8" type="hidden" value="Patron"/>
				<span class="chabad">
					Patron
				</span>
			</td>
			<td align="left" class="chabad" width="36">
				<input name="cost8" type="hidden" value="108"/>
				<span class="chabad">
					$108
				</span>
			</td>
		</tr>
		<tr>
			<td class="chabad" width="23">
				<span class="chabad">
					<input name="quantity9" type="checkbox" value="1"/>
				</span>
			</td>
			<td align="left" class="chabad" width="148">
				<input name="description9" type="hidden" value="Quadruple Chai Patron"/>
				<span class="chabad">
					Quadruple Chai Patron
				</span>
			</td>
			<td align="left" class="chabad" width="56">
				<input name="cost9" type="hidden" value="720"/>
				<span class="chabad">
					$720
				</span>
			</td>
			<input name="quantity10" type="hidden" value="1"/>
			<td align="left" class="chabad" colspan="2">
				<input name="description10" type="hidden" value="Other Amount"/>
				<span class="chabad">
					Other Amount
				</span>
			</td>
			<td align="left" class="chabad" width="36">
				<span class="chabad">
					<input name="cost10" size="6" type="text" value="0.00"/>
				</span>
			</td>
		</tr>
		<tr>
		  <td class="chabad" height="47"></td>
		  <td align="left" class="chabad" colspan="4" height="47" style="background-color: #FFFF99" valign="top"><p> <b> <span style="background-color: #FFFF99"> Join the <a href="/chaiclub"> Chai Club </a> with a monthly recuring donation: </span> </b> <br/>
		    Please charge my credit card
		    <select class="chabad" name="roption">
		      <option selected="selected"> </option>
		      <option value="20"> $18.00 - Monthly </option>
		      <option value="21"> $36.00 - Monthly </option>
		      <option value="22"> $54.00 - Monthly </option>
		      <option value="23"> $72.00 - Monthly </option>
		      <option value="24"> $108.00 - Monthly </option>
		      <option value="25"> $136.00 - Monthly </option>
		      <option value="26"> $154.00 - Monthly </option>
		      <option value="27"> $180.00 - Monthly </option>
		      <option value="28"> $18.00 - Bi-Monthly </option>
		      <option value="29"> $36.00 - Bi-Monthly </option>
		      <option value="30"> $54.00 - Bi-Monthly </option>
		      <option value="31"> $72.00 - Bi-Monthly </option>
		      <option value="32"> $108.00 - Bi-Monthly </option>
		      <option value="33"> $136.00 - Bi-Monthly </option>
		      <option value="34"> $154.00 - Bi-Monthly </option>
		      <option value="35"> $180.00 - Bi-Monthly </option>
		      <option value="36"> $18.00 - Tri-Monthly </option>
		      <option value="37"> $36.00 - Tri-Monthly </option>
		      <option value="38"> $54.00 - Tri-Monthly </option>
		      <option value="39"> $72.00 - Tri-Monthly </option>
		      <option value="40"> $108.00 - Tri-Monthly </option>
		      <option value="41"> $136.00 - Tri-Monthly </option>
		      <option value="42"> $154.00 - Tri-Monthly </option>
		      <option value="43"> $180.00 - Tri-Monthly </option>
	        </select>
		    </p></td>
		  <td align="left" class="chabad" height="47"></td>
	  </tr>
		<tr>
		  <td class="chabad"></td>
		  <td align="left" class="chabad" colspan="4"></td>
		  <td align="left" class="chabad"></td>
	  </tr>
		<tr>
		  <td class="chabad" valign="bottom"><span class="chabad">
		    <input name="emailreceipt" type="radio" value="email"/>
		    </span></td>
		  <td align="left" class="chabad" colspan="4"><b> <font color="#008000"> Go green! </font> </b> Please 
		    email me my receipt </td>
		  <td align="left" class="chabad"></td>
	  </tr>
		<tr>
		  <td class="chabad"><input name="emailreceipt" type="radio" value="Mail"/></td>
		  <td align="left" class="chabad" colspan="4"> Please mail me my 
		    receipt </td>
		  <td align="left" class="chabad"></td>
	  </tr>
		<tr>
			<td align="center" colspan="6">
				<span class="chabad">
					<br/>
					<input name="return" type="submit" value="Proceed to Secure Web Page&gt;"/>
				</span>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<p align="center">
				<span class="chabad">
					<img border="0" height="24" src="/wp-content/uploads/2017/02/visamaster.gif" width="78"/>
				</span>
				</p>
			</td>
			<td colspan="3">
				<span class="chabad">
					<img border="0" src="/wp-content/uploads/2017/02/plugnpay.jpg"/>
				</span>
			</td>
		</tr>
	</table>
</form>
<?php endif ?>
<?php
get_footer();
?>
