<?php
/**
 * Template Name: highholidayregister Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

$currentJewishCal = cal_from_jd(unixtojd(time()), CAL_JEWISH);
$curJewishYear = $currentJewishCal['year'];
$nextRoshHoshanahStart = jewishtojd(1, 1, $curJewishYear);
$nextRoshHoshanahEnd = jewishtojd(1, 2, $curJewishYear);
$nextRoshHoshanahUnix = jdtounix($nextRoshHoshanahStart);
$nextYomKippurStart = jdtounix(jewishtojd(1, 10, $curJewishYear));
$nextYomKippurEnd = $nextYomKippurStart + (24 * 60 * 60);
if ($nextYomKippurEnd < time()) {
	// Yom Kippur has already passed for the current year. Get next year.
	$nextYomKippurStart = jdtounix(jewishtojd(1, 10, $curJewishYear + 1));
	$nextYomKippurEnd = $nextYomKippurStart + (24 * 60 * 60);
	$nextRoshHoshanahStart = jewishtojd(1, 1, $curJewishYear + 1);
	$nextRoshHoshanahEnd = jewishtojd(1, 2, $curJewishYear + 1);
	$nextRoshHoshanahUnix = jdtounix($nextRoshHoshanahStart);
}
//echo "CUR JEWISH YEAR: $curJewishYear<br>NEXT ROSH HASHANAH: " . date('r', $nextRoshHoshanahUnix). "<br>NEXT YOM KIPPUR: " . date('r', $nextYomKippurStart) . "<br>";
get_header();
?>
<script language="JavaScript" type="text/javascript">
 <!-- Begin make sure to insert correct header and footer into form
function verify() {
var themessage = "You are required to complete the following fields: ";
if (document.form.lastname.value=="") {
themessage = themessage + " - Your last name";
}
if (document.form.email.value=="") {
themessage = themessage + " -  Your E-mail";
}
if (document.form.phone.value=="") {
themessage = themessage + " -  Your Phone Number";
}

if (document.form.email.value!=document.form.elll0.value) {
themessage = "Emails do not match";
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
//  End -->
</script>
<form action="/page-form-process-highholiday" method="post" name="form">
	<input name="subject" type="hidden" value="High holiday Reservation"/>
	<table background="pic/chabad-bg.gif" border="0" class="chabad" id="table11" width="448">
		<tbody>
			<tr>
				<td colspan="4">
					<strong>
						Kindly please fill out this form:
						<br/>
					</strong>
					NOTE: 
					(We do NOT share or sell   				this info with anyone)
					<br/>
					<div width="427">
						*Required fields
					</div>
				</td>
			</tr>
			<tr>
				<td width="22%">
					*First Name
				</td>
				<td colspan="3">
					<input maxsize="50" name="firstname" size="11" type="TEXT"/>
					*Last name:
					<input maxsize="50" name="lastname" size="17" type="TEXT"/>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" colspan="4" height="22">
					<p>
					Your permanent home address:
					</p>
				</td>
			</tr>
			<tr>
				<td width="22%">
					*Home Address
				</td>
				<td colspan="3">
					<input cols="37" name="address" rows="2" size="45"/>
				</td>
			</tr>
			<tr>
				<td width="22%">
					*Home City
				</td>
				<td colspan="3">
					<input maxsize="50" name="city" size="45" type="TEXT"/>
				</td>
			</tr>
			<tr>
				<td width="22%">
					*Home State
				</td>
				<td width="31%">
					<select name="state">
						<option value="">
						</option>
						<option value="AL">
						Alabama
						</option>
						<option value="AK">
						Alaska
						</option>
						<option value="AZ">
						Arizona
						</option>
						<option value="AR">
						Arkansas
						</option>
						<option value="CA">
						California
						</option>
						<option value="CO">
						Colorado
						</option>
						<option value="CT">
						Connecticut
						</option>
						<option value="DE">
						Delaware
						</option>
						<option value="FL">
						Florida
						</option>
						<option value="GA">
						Georgia
						</option>
						<option value="HI">
						Hawaii
						</option>
						<option value="ID">
						Idaho
						</option>
						<option value="IL">
						Illinois
						</option>
						<option value="IN">
						Indiana
						</option>
						<option value="IA">
						Iowa
						</option>
						<option value="KS">
						Kansas
						</option>
						<option value="KY">
						Kentucky
						</option>
						<option value="LA">
						Louisiana
						</option>
						<option value="ME">
						Maine
						</option>
						<option value="MD">
						Maryland
						</option>
						<option value="MA">
						Massachusetts
						</option>
						<option value="MI">
						Michigan
						</option>
						<option value="MN">
						Minnesota
						</option>
						<option value="MS">
						Mississippi
						</option>
						<option value="MO">
						Missouri
						</option>
						<option value="MT">
						Montana
						</option>
						<option value="NE">
						Nebraska
						</option>
						<option value="NV">
						Nevada
						</option>
						<option value="NH">
						New Hampshire
						</option>
						<option value="NJ">
						New Jersey
						</option>
						<option value="NM">
						New Mexico
						</option>
						<option value="NY">
						New York
						</option>
						<option value="NC">
						North Carolina
						</option>
						<option value="ND">
						North Dakota
						</option>
						<option value="OH">
						Ohio
						</option>
						<option value="OK">
						Oklahoma
						</option>
						<option value="OR">
						Oregon
						</option>
						<option value="PA">
						Pennsylvania
						</option>
						<option value="RI">
						Rhode Island
						</option>
						<option value="SC">
						South Carolina
						</option>
						<option value="SD">
						South Dakota
						</option>
						<option value="TN">
						Tennessee
						</option>
						<option value="TX">
						Texas
						</option>
						<option value="UT">
						Utah
						</option>
						<option value="VT">
						Vermont
						</option>
						<option value="VA">
						Virginia
						</option>
						<option value="WA">
						Washington
						</option>
						<option value="DC">
						Washington D.C.
						</option>
						<option value="WV">
						West Virginia
						</option>
						<option value="WI">
						Wisconsin
						</option>
						<option value="WY">
						Wyoming
						</option>
					</select>
				</td>
				<td width="17%">
					<p align="right">
					*Home Zip
					</p>
				</td>
				<td width="30%">
					<input maxsize="50" name="zip" size="12" type="TEXT"/>
				</td>
			</tr>
			<tr>
				<td width="22%">
					*Email
				</td>
				<td colspan="3">
					<input maxsize="50" name="email" size="28" type="TEXT"/>
				</td>
			</tr>
			<tr>
				<td width="22%">
					*Re-type Email
				</td>
				<td colspan="3">
					<input maxsize="50" name="elll0" size="28" type="TEXT"/>
				</td>
			</tr>
			<tr>
				<td width="22%">
					*Phone
				</td>
				<td colspan="3">
					<input maxsize="50" name="phone" size="28" type="TEXT"/>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<table border="0" id="table15" width="91%">
						<tbody>
							<tr>
								<td class="chabad" width="145">
									Are you a U of M Student
								</td>
								<td>
									<input name="attending" type="radio" value="student"/>
								</td>
								<td class="chabad">
									Year
								</td>
								<td class="chabad">
                           <?= do_shortcode('[um_school_year_dropdown name=year]') ?>
								</td>
							</tr>
							<tr>
								<td class="chabad" width="145">
									<p align="left">
									or a Community Member
									</p>
								</td>
								<td>
									<input name="attending" type="radio" value="community"/>
								</td>
								<td>
								</td>
								<td>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<div align="center">
						<table border="0" class="chabad" id="table14" width="94%">
							<tbody>
								<tr>
									<td bgcolor="#FFFFFF" width="53%" valign="middle">
										<strong>
											Rosh Hashanah Services:
										</strong>
									</td>
									<td bgcolor="#FFFFFF" width="19%">
									</td>
									<td align="center" bgcolor="#FFFFFF" width="14%">
										Attending
										<br/>
										Services
									</td>
									<td align="center" bgcolor="#FFFFFF" width="14%">
										Attending
										<br/>
										Meal*
									</td>
								</tr>
								<tr>
									<td width="53%">
										<?= date('l, F j', $nextRoshHoshanahUnix) ?>
									</td>
									<td width="19%">
										7:30 pm
									</td>
									<td width="14%">
										<input name="1ntser" type="checkbox" value="y"/>
									</td>
									<td width="14%">
										<input name="1ntmel" type="checkbox" value="y"/>
									</td>
								</tr>
								<tr>
									<td width="53%">
									</td>
									<td width="19%">
									</td>
									<td width="14%">
									</td>
									<td width="14%">
									</td>
								</tr>
<?php
$firstMorningRoshHashanah = strtotime('tomorrow 9:45 AM', $nextRoshHoshanahUnix);
?>
								<tr>
									<td width="53%">
										<?= date('l, F j', $nextRoshHoshanahUnix + (24 * 60 * 60)) ?>
									</td>
									<td width="19%">
										9:45 am
									</td>
									<td width="14%">
										<input name="1dyser" type="checkbox" value="y"/>
									</td>
									<td width="14%">
										<input name="1dymel" type="checkbox" value="y"/>
									</td>
								</tr>
<?php
// check if it's on shabbat. If so, skip shofar blowing
$nextRoshHoshanahStartInfo = cal_from_jd($nextRoshHoshanahStart, CAL_JEWISH);
if ($nextRoshHoshanahStartInfo['dow'] !== 6): ?>
								<tr>
									<td width="53%">
										Shofer Blowing
									</td>
									<td width="19%">
										12:00 pm
									</td>
									<td width="14%">
										<input name="shfr1" type="checkbox" value="y"/>
									</td>
									<td width="14%">
									</td>
								</tr>
<?php  endif ?>
								<tr>
									<td width="53%">
										Evening Services
									</td>
									<td width="19%">
										7:45 pm
									</td>
									<td width="14%">
										<input name="2ntser" type="checkbox" value="y"/>
									</td>
									<td width="14%">
										<input name="2ntmel" type="checkbox" value="y"/>
									</td>
								</tr>
<?php
$finalRoshHashanahService = strtotime('tomorrow	9:45AM', jdtounix($nextRoshHoshanahEnd));
?>
								<tr>
									<td width="53%">
										<?= date('l, F j', $finalRoshHashanahService) ?>
									</td>
									<td width="19%">
										<?= date('g:i a', $finalRoshHashanahService) ?>
									</td>
									<td width="14%">
										<input name="2dyser" type="checkbox" value="y"/>
									</td>
									<td width="14%">
										<input name="2dymel" type="checkbox" value="y"/>
									</td>
								</tr>
<?php
// check if it's on shabbat. If so, skip shofar blowing
$nextRoshHoshanahEndInfo = cal_from_jd($nextRoshHoshanahEnd, CAL_JEWISH);
if ($nextRoshHoshanahEndInfo['dow'] !== 6): ?>
								<tr>
									<td width="53%">
										Shofer Blowing
									</td>
									<td width="19%">
										12:00 pm
									</td>
									<td width="14%">
										<input name="shfr2" type="checkbox" value="y"/>
									</td>
									<td width="14%">
									</td>
								</tr>
<?php endif ?>
								<tr>
									<td bgcolor="#FFFFFF" colspan="4" height="31" valign="middle">
										<strong>
											Yom Kippur Services:
										</strong>
									</td>
								</tr>
								<tr>
									<td width="53%">
										<?= date('l, F j', $nextYomKippurStart) ?> - Kol   								Nidrei
									</td>
									<td width="19%">
										7:00 pm
									</td>
									<td width="14%">
										<input name="yk1nt" type="checkbox" value="y"/>
									</td>
									<td width="14%">
									</td>
								</tr>
								<tr>
									<td width="53%">
										<?= date('l, F j', $nextYomKippurEnd) ?>
									</td>
									<td width="19%">
										9:45 am
									</td>
									<td width="14%">
										<input name="ykdy" type="checkbox" value="y"/>
									</td>
									<td width="14%">
									</td>
								</tr>
								<tr>
									<td width="53%">
										Evening services
									</td>
									<td width="19%">
										5:30 pm
									</td>
									<td width="14%">
										<input name="yk2nt" type="checkbox" value="y"/>
									</td>
									<td width="14%">
									</td>
								</tr>
								<tr>
									<td colspan="4">
										*All meals are   								following the holiday services.
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<p>
										Additional info or comments
										<br/>
										<font face="arial, helvetica, sans-serif" size="1">
											( You may enter up to 250 characters. )
											<br/>
											<textarea cols="43" name="comment" onkeydown="textCounter(this.form.comment,this.form.remLen,250);" onkeyup="textCounter(this.form.comment,this.form.remLen,250);" rows="4" wrap="physical"></textarea>
											<br/>
											<input maxlength="3" name="remLen" readonly="" size="3" type="text" value="250"/>
											characters left
										</font>
										</p>
									</td>
								</tr>
								<tr>
									<td align="center" colspan="4">
									</td>
								</tr>
								<tr>
									<td align="center" colspan="4">
										<input onclick="verify();" type="button" value="Submit form"/>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
get_footer();
?>
