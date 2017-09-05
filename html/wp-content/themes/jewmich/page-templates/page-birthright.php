<?php
/**
 * Template Name: birthright Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

if (time() < strtotime('Aug 25')) {
	define('NEXT_TRIP_DATE', strtotime('May 1'));
} else {
	define('NEXT_TRIP_DATE', strtotime('May 1, +1 Year'));
}
define('PREREG_CUTOFF_DATE', strtotime('feb 1', NEXT_TRIP_DATE));

?>
<html>
<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<meta name="GENERATOR" content="Microsoft FrontPage 6.0">
	<meta name="ProgId" content="FrontPage.Editor.Document">
	<title>Taglit-Birthright Israel: Mayanot</title>
	<style type="text/css">
		table#main { margin: 0 auto; }
		#image1 { height: 320px; width: 800px; background-image: url(birthpic/anigif.gif); }
		BODY, TD {
			font-family: verdana,arial,helvetica,sans-serif;
			font-size: 14px;
			color: #000000;
		}
		LI {line-height: 120%;}
		UL.ppsmallborder {margin:10px 5px 10px 20px;}
		LI.ppsmallborderli {margin:0px 0px 5px 0px;}
		UL.pp_narrow {margin:10px 5px 0px 40px;}
		.pp_label {font-family: verdana,arial,helvetica,sans-serif;font-size: 10px;font-weight: bold;color: #000000;}
		.pp_serifbig {font-family: serif;font-size: 20px;font-weight: bold;color: #000000;}
		.pp_serif{font-family: serif;font-size: 16px;color: #000000;}
		.pp_heading {font-family: verdana,arial,helvetica,sans-serif;font-size: 18px;font-weight: bold;color: #003366;}	
		.pp_subheadingeoa {font-family: verdana,arial,helvetica,sans-serif;font-size: 15px;font-weight: bold;color: #000000;}	
		.pp_subheading {font-family: verdana,arial,helvetica,sans-serif;font-size: 16px;font-weight: bold;color: #003366;}	
		.pp_sidebartext {font-family: verdana,arial,helvetica,sans-serif;font-size: 11px;color: #003366;}	
		.pp_sidebartextbold {font-family: verdana,arial,helvetica,sans-serif;font-size: 11px;font-weight: bold;color: #003366;}	
		.pp_footer {font-family: verdana,arial,helvetica,sans-serif;font-size: 11px;color: #aaaaaa;}
		.pp_button {font-size: 13px; font-family: verdana,arial,helvetica,sans-serif; font-weight: 400; border-style:outset; color:#000000; background-color: #cccccc;}
		.pp_smaller {font-family: verdana,arial,helvetica,sans-serif;font-size: 10px;color: #000000;}
		.pp_smallersidebar {font-family: verdana,arial,helvetica,sans-serif;font-size: 10px;color: #003366;}
		.ppem106 {font-weight: 700;}
		/* honeypot for spam bots */
		form[name="form"] input[name="username"] {
			display: none;
		}
	</style>
	<script language="JavaScript" type="text/javascript">
 <!-- Begin make sure to insert correct header and footer into form
function verify() {
var themessage = "You are required to complete the following fields: ";
if (document.form.firstname.value=="") {
themessage = themessage + " - Your full name";
}
			if (document.form.lastname.value=="") {
				themessage = themessage + " - Last name";
			}
			if (document.form.email.value=="") {
				themessage = themessage + " -  E-mail";
			}
if (document.form.phone.value=="") {
				themessage = themessage + " -  Cell number";
			}
			if (document.form.datpref.value=="") {
				themessage = themessage + " -  Depart Date";
			}
			if (document.form.year.value=="") {
themessage = themessage + " -  School Year";
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
		function popUp(URL) {
			day = new Date();
			id = day.getTime();
			eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=380,height=346');");
		}
	</script>
	<link rel="shortcut icon" href="/favicon.ico" >
</head>
<body>
	<table id="main" border="0" width="53%" cellpadding="6" height="913" cellspacing="0">
		<tr>
			<td width="88%" bgcolor="#9900CC" height="31" valign="top" colspan="2">
				<table align="center" border="0" width="93%">
					<tr>
					  <td align="center" bgcolor="#FFFFFF"><table width="877" border="0">
						    <tr>
							    <td width="50%"><a href="http://www.birthrightisrael.com"><img src="/wp-content/uploads/2017/02/britelgohorz.jpg" border="0"></a></td>
							    <td align="right" valign="top" width="10%"><a href="http://www.mayanotisrael.com"><img src="/wp-content/uploads/2017/02/maya.png" border="0"></a></td>
						      </tr>
				      </table></td>
					</tr>
					<tr>
					  <td >
                      
                      <p align="center"><b><font color="#FFFFFF" size="2">Taglit-Birthright Israel: Mayanot
								Blue Goes to Israel 
                        <?= date("M 'y", NEXT_TRIP_DATE) ?>
                      
									<a href="http://mayanotisrael.com">	<font color="#FFFFFF">www.mayanotisrael.com</font></a>
                      
                      </td>
				  </tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="45%" bgcolor="#9900CC" height="579" valign="top">
			  <table border="0" width="98%" id="table3">
					<tr>
						<td>
							<p align="center"><b><font size="4" color="#FFFFFF">THE TRIP IS FREE <br>
									AND THE EXPERIENCE
									IS PRICELESS<br>
									&nbsp;</font></b>
							<?php if (time() > PREREG_CUTOFF_DATE): ?>
								<br>
								<span class="pp_heading"><a href="http://register.birthrightisrael.com/index.cfm?org=63&ref=rabbialter">Apply for the trip</a></span><br>&nbsp;</font>
							<?php endif ?>
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<p align="left"><SPAN class=text><font color="#FFFFFF">If you are Jewish, 
									ages 18 through 26 and have never been on a group tour to Israel then you are eligible for this gift!!<br>
									<br>
									This great trip is scheduled to leave in the beginning of <?= date('M Y', NEXT_TRIP_DATE) ?>
									 for 10 
								   days. Exact dates to be announced late March.</font></SPAN><P class=blackSmall><font color="#FFFFFF">
								Taglit-Birthright Israel is an innovative partnership
								between the people of Israel through the Government
								of Israel, private philanthropists through the Birthright
								Israel Foundation and Jewish communities around the
								world (North American Jewish Federations; the Jewish
								Agency for Israel; and Keren Hayesod). </font> </P>
							<P class="blackSmall"><SPAN class=text><font color="#FFFFFF">Travel 
									with students from your local campus at University of Michigan:</font></SPAN></P>
							<UL>
								<LI>
								<p class="blackSmall"><font color="#FFFFFF">Tour, Hike and Kayak 
									throughout Israel</font> 
								<LI>
								<p class="blackSmall"><SPAN class=text><font color="#FFFFFF">
										Float in the Dead Sea&nbsp;</font></SPAN> 
								<LI>
								<p class="blackSmall"><font color="#FFFFFF">Climb the ancient 
									fortress of Masada</font> 
								<LI>
								<p class="blackSmall"><SPAN class=text><font color="#FFFFFF">
										Enjoy free time</font></SPAN> 
								<LI>
								<p class="blackSmall"><SPAN class=text><font color="#FFFFFF">
										Interact with REAL Israelis</font></SPAN><LI>
								<p class="blackSmall"> <font color="#FFFFFF"> Enjoy the music, 
									culture, nightlife and excitement of Jerusalem and Tel Aviv.</font> </LI></UL>
							<P class="blackSmall"><SPAN class=text><font color="#FFFFFF">Your Taglit-Birthright Israel gift includes round-trip airfare from a New York 
									Airport, land accommodations at quality hotels, and two meals a day. 
									Participants will be responsible for travel to the gateway city.</font></SPAN></P>
							<P class="blackSmall">
							<font color="#FFFFFF">
								A $250 fully refundable deposit, returned after complition of the program, is 
								required. 
								<br>
								<br>
								<SPAN class=text>What's the catch? None at 
									all. Taglit-Birthright Israel: Mayanot offers you this 
									extraordinary gift because we believe a trip to Israel is your 
									birthright.<br>
									<br>
									Got more questions please visit <a href="http://mayanotisrael.com">
										<font color="#FFFFFF">www.mayanotisrael.com</font></a></SPAN><br>
					  &nbsp;</font></td>
					</tr>
				</table></td>
			<?php if (time() < PREREG_CUTOFF_DATE): ?>
			<td width="25%" bgcolor="#9900CC" height="579" valign="top">
				<table border="0" width="90%" id="table4">
					<tr>
						<td bgcolor="#FFFF00">
							<form name="form" action="/form-process-birthright" method="post">
								<input type="text" name="username" size="20" maxsize="30"/>
								<input type=hidden name="subject" value="pre app birth">
								<div align="center">
									<table border="0" width="81%" id="table5">
										<tr>
											<td align="center" colspan="2">
												<font size="4" color="#ff0000">Hurry! 
													
													Pre-Register
													now<br>
												</font>
												<font color="#000000">for <?= date("M 'y", NEXT_TRIP_DATE) ?> trip </font></td>
										</tr>
										<tr>
											<td align="center" colspan="2">
												<p class="pp_smaller"><font color="#000000">
													Scheduled to leave in the beginning of <?= date('M Y', NEXT_TRIP_DATE) ?> for 10 days. 
													
													
													&nbsp;</font></td>
										</tr>
										<tr>
											<td align="center" colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td align="left">First Name</td>
											<td align="left">Last Name</td>
										</tr>
										<tr>
											<td align="left"> 
												<span class="chabad">
													<font color="#FFFFFF">
														<input TYPE="TEXT" SIZE="14" MAXSIZE="50" NAME="firstname" style="float: left"></font>
											</td>
											<td align="left"> 
													<span class="chabad">
														<font color="#FFFFFF">
															<input TYPE="TEXT" SIZE="14" MAXSIZE="50" NAME="lastname" style="float: left"></font></td>
										</tr>
										<tr>
											<td align="center" colspan="2">Email Address</td>
										</tr>
										<tr>
											<td align="center" colspan="2"> 
												<span class="chabad">
													<input TYPE="TEXT" SIZE="29" MAXSIZE="50" NAME="email"></td>
										</tr>
										<tr>
											<td align="center" colspan="2">Cell number</td>
										</tr>
										<tr>
										  <td align="center" colspan="2"><input type="TEXT" size="29" maxsize="50" name="phone"></td>
									  </tr>
										<tr>
											<td  colspan="2" align="center" valign="top"><p>Date preference:<br>
										      <font color="#ff0000">
										    (Graduation this year April 29)</font><span class="pp_smaller"><br>
										    </span></p></td>
										</tr>
										
                                        
                                        
                                        <tr>
											<td align="center" colspan="2">  
                                          </td>
										</tr>
                                        
                                        
                                        <tr>
											<td align="center" colspan="2">
												<table border="0" width="100%" id="table7">
													<tr>
													  <td>I can depart:</td>
													  <td><select size="1" name="datpref">
													    <option></option>
													    <option>May 1</option>
													                                                       
                                                        <option>June or july</option>
                                                        <option>Any date</option>
												      </select></td>
												  </tr>
													<tr>
													  <td>&nbsp;</td>
													  <td>&nbsp;</td>
												  </tr>
													<tr>
														<td>Found us:</td>
														<td><select size="1" name="foundus">
																<option></option>
																<option>Flyer</option>
																<option>Facebook</option>
																<option>Email</option>
																<option>Friend</option>
																<option>Search engine</option>
																<option>Family member</option>
																<option>Other</option>
														</select></td>
													</tr>
													<tr>
														<td>Class of:</td>
														<td> <?= do_shortcode('[um_school_year_dropdown name=year]') ?>
        
                                                       </td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="center" colspan="2">Are you a student at U of M</td>
										</tr>
										<tr>
											<td align="center" colspan="2">
												<table border="0" width="68%" id="table8">
													<tr>
														<td width="18%">
															<input type="radio" value="yes" name="isstudent" ></td>
														<td width="15%">Yes</td>
														<td width="16%">
															<input type="radio" name="isstudent" value="no"></td>
														<td width="22%">No</td>
													</tr>
													<tr>
														<td colspan="4">
															<p class="pp_smaller">If not, please explain why you would like 
															to join the U of M trip</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="center" colspan="2">
												<p align="left">Comments, recruiter and  friend preference:
											</td>
										</tr>
										<tr>
											<td align="center" colspan="2">
												<textarea rows="2" name="suggestion" cols="24"></textarea></td>
										</tr>
									</table>
								</div>
								<p align="center">
								<input type="button" value="SUBMIT FORM" onClick="verify();"></p>
							</form>
						</td>
					</tr>
                    <tr> 
                    
                    
                    <td bgcolor="#FFFF00" width="26%">
				<p align="center">
                
                <br>
				<img border="0" src="/wp-content/uploads/2017/02/birthmarg.jpg" width="222" height="122"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birthhike2.jpg" width="223" height="102"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birthboys.jpg" width="222" height="122"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birthhike.jpg" width="223" height="124"><br>
				<br>
			</td>
                    
                    </tr>
				</table>
			</td>
			<?php else: ?>
			<td bgcolor="#FFFF00">
				<p align="center"><br>
                
                <br>
								<span class="pp_heading"><a href="http://register.birthrightisrael.com/index.cfm?org=63&ref=rabbialter">
                                Apply for the trip</a></span><br>&nbsp;</font><br>
                
				<img border="0" src="/wp-content/uploads/2017/02/birthmarg.jpg" width="222" height="122"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birthhike2.jpg" width="223" height="102"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birthboys.jpg" width="222" height="122"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birththegirls.jpg" width="222" height="122"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birthhike.jpg" width="223" height="124"><br>
				<br>
				<img border="0" src="/wp-content/uploads/2017/02/birthmarg1.jpg" width="225" height="125"><br>
				<br>
          </td>
			<?php endif ?>
		</tr>
		<tr>
			<td width="83%" bgcolor="#9900CC" height="237" valign="top" align="center" colspan="2">
				<div id="image1"></div>
			</td>
		</tr>
		<tr>
			<td width="88%" bgcolor="#9900CC" height="46" valign="top" colspan="2">
				<p class="pp_smaller" align="center"><font color="#FFFFFF">Chabad at UM are 
					the official representatives <br>
					of the Taglit-Birthright Israel: Mayanot trip on the UM campus.</font></td>
		</tr>
	</table>
</body>
</html>
