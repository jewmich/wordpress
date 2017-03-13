<?php
/**
 * Template Name: shabbat Template
 */

define('DONOTCACHEPAGE', true);

if (isset($_GET['wronguser'])) {
	unset($_SESSION['phone']);
}

$phoneNotFound = false;
$user = User::getLoggedInUser();
if (!is_null($user)) {
	$person = $user->person;
	unset($user);
} else {
	if (!empty($_POST['phone'])) {
		$person = Person::getByPhone($_POST['phone']);
		if (is_null($person)) {
			$phoneNotFound = true;
		} else {
			$_SESSION['phone'] = $_POST['phone'];
		}
	} elseif (!empty($_SESSION['phone'])) {
		$person = Person::getByPhone($_SESSION['phone']);
	}
}

function serviceTime(){
   $nextFridayDaysAway = 5-idate('w');
   $nextFridayUNIXTime = time() + 3600*24*$nextFridayDaysAway;
   $nextFridayDayOfYear = idate('z',$nextFridayUNIXTime);
   $nextFridayDayOfMonth = idate('d',$nextFridayUNIXTime);
   $nextFridayMonth = idate('m',$nextFridayUNIXTime);
   
   if( $nextFridayMonth==1 ){ // january
      if($nextFridayDayOfMonth <= 22){ 
         return '5:30pm';}
      else{return '5:45pm';}
   }
   else if( $nextFridayMonth==2 ){ // February
      if($nextFridayDayOfMonth <= 9){ return '5:50pm';}
      else if($nextFridayDayOfMonth >= 10 && $nextFridayDayOfMonth <= 19){ return '5:55pm'; }
      else{return '6:05pm';}
   }
   else if( $nextFridayMonth==3 && idate('I',$nextFridayUNIXTime)==0 ){ // If March and NOT DST
      return '6:45pm';
   }
   else if( $nextFridayMonth==3 && idate('I',$nextFridayUNIXTime)==1 ){ // If March and DST
      return '7:15pm';
   }
   else if( $nextFridayMonth==4 ){ // April
      return '7:20pm';
   }
   else if( $nextFridayMonth>=5 && $nextFridayMonth<=9 ){ // May to September
      return '7:20pm';
   }
   else if( $nextFridayMonth==10 ){ // October
      if($nextFridayDayOfMonth <= 9){ return '7:15pm';}
      else if($nextFridayDayOfMonth >= 10 && $nextFridayDayOfMonth <= 19){ return '7:00pm'; }
      else{return '7:00pm';}
   }
   else if( $nextFridayMonth==11 && idate('I',$nextFridayUNIXTime)==1 ){ // If November and NOT DST
      return '6:30pm';
   }
   else if( $nextFridayMonth==11 && idate('I',$nextFridayUNIXTime)==0 ){ // If November and DST
      return '5:30pm';
   }
   else if( $nextFridayMonth==12 ){ // December
      return '5:15pm';
   }
}
function dinnerTime(){
   $nextFridayDaysAway = 5-idate('w');
   $nextFridayUNIXTime = time() + 3600*24*$nextFridayDaysAway;
   $nextFridayDayOfYear = idate('z',$nextFridayUNIXTime);
   $nextFridayDayOfMonth = idate('d',$nextFridayUNIXTime);
   $nextFridayMonth = idate('m',$nextFridayUNIXTime);
   
   if( $nextFridayMonth==1 ){ // january
      if($nextFridayDayOfMonth <= 22){ 
         return '6:00pm';}
      else{return '6:15pm';}
   }
   else if( $nextFridayMonth==2 ){ // February
      if($nextFridayDayOfMonth <= 10){ 
         return '6:30pm';}
      else{return '6:45pm';}
   }  else if( $nextFridayMonth==3 && idate('I',$nextFridayUNIXTime)==0 ){ // If March and NOT DST
      return '7:15pm';
   }
   else if( $nextFridayMonth==3 && idate('I',$nextFridayUNIXTime)==1 ){ // If March and DST
      return '7:45pm';
   }
   else if( $nextFridayMonth==4 ){ // April
      return '7:45pm';
   }
   else if( $nextFridayMonth>=5 && $nextFridayMonth<=7 ){ // May to july
         return 'Please Call Chabad';  
   }
   else if( $nextFridayMonth==8 ){ // Auguest
      if($nextFridayDayOfMonth <= 19){ return 'Please Call Chabad';}
      else if($nextFridayDayOfMonth >= 10 && $nextFridayDayOfMonth <= 19){ return '7:50pm'; }
      else{return '7:45pm';}
   }
   else if( $nextFridayMonth==9 ){ // September
      return '7:45pm';
   }
   else if( $nextFridayMonth==10 ){ // October
      if($nextFridayDayOfMonth <= 9){ return '7:45pm';}
      else if($nextFridayDayOfMonth >= 10 && $nextFridayDayOfMonth <= 19){ return '7:30pm'; }
      else{return '7:30pm';}
   }
   else if( $nextFridayMonth==11 && idate('I',$nextFridayUNIXTime)==1 ){ // If November and NOT DST
      return '7:00pm';
   }
   else if( $nextFridayMonth==11 && idate('I',$nextFridayUNIXTime)==0 ){ // If November and DST
      return '6:00pm';
   }
   else if( $nextFridayMonth==12 ){ // December
      return '5:45pm';
   }
}
get_header();
?>
<script LANGUAGE="JavaScript" type="text/javascript">
function verify() {
	var themessage = "You are required to complete the following fields: ";
	if (document.register_form.realname.value=="") {
		themessage = themessage + " - Your full name";
	}
	if (document.register_form.email.value=="") {
		themessage = themessage + " -  Your E-mail";
	}
	if (document.register_form.phone.value=="") {
		themessage = themessage + " -  Your Phone Number";
	}

	if (document.register_form.email.value != document.register_form.elll0.value) {
		themessage = "Emails do not match";
	}

	//alert if fields are empty and cancel form submit
	if (themessage == "You are required to complete the following fields: ") {
		document.register_form.submit();
	}
	else {
		alert(themessage);
		return false;
   }
}
</script>
<style type="text/css">
#registertable td:first-child {
   padding-left: 20px;
   width: 70px;
}
#shabatContainer {
	background-image: url(/pic/chabad-bg.gif);
	width: 100%;
	padding: 5px 0
}
</style>

<p class="chabad"> 
<span class="chabad-header">Shabbat Dinner&nbsp;for 
U of M Students</span>
<br>
<span class="chabad">
Experience the most amazing Shabbat Dinner you have ever 
experienced.&nbsp; Every Friday evening of the U of M academic school 
year.<br>
<br>
<b>Schedule for this week:&nbsp; </b><br>
Shabbat Services: <font color="#FF0000"><?php echo serviceTime(); ?></font> <br  />
     Shabbat Dinner: <font color="#FF0000"><?php echo dinnerTime(); ?></font>

</span><a href="http://www.chabad.org/calendar/CandleLighting2.asp?PlaceID=23&imageField4.x=15&imageField4.y=10">
</a><br>
<br>
&quot;You'll never forget Shabbat at Chabad!&quot; <br>
The weekly Shabbat dinners at Chabad provide Jewish 
students -- from the freshman to the MBA -- an intimate and elegant 
setting to eat, meet new friends from every niche of the campus, and 
celebrate Shabbat in a warm and enjoyable manner.<br>
<br>
Shabbat dinner features five courses of traditional classics and 
updated favorites. You don't have to dress up for the occasion and 
you don't have to recite your Bar-Mitzvah speech.<br>
<br>
There is&nbsp; <span class="chabad-header">no charge</span> for the Shabbat 
Dinner thanks to our wonderful sponsors.<br>
<br>
If 
you know someone who would like to be a proud sponsor of a Shabbat dinner <a href="/sponsorshabbat">please use our 
Secure on-line from</a>.&nbsp;
<br>
<?php if (!isset($person)): ?>
<form name="login_form" method="post">
<div style="background-image: url(/pic/chabad-bg.gif); width: 100%; padding: 5px 0">
	<p class="chabad-header">
		Have you RSVP'd in the past? <br />
     Enter your phone number here!
<?php if ($phoneNotFound): ?>
		<br>
		<font color='red'>
		Your phone number isn't in our system yet. Please fill out the form below to add it.
		</font>
		<?php endif ?>
	</p>
   <p align="center">
		<label for="phone" class="chabad">*</label>
		<input type="text" size="24" maxsize="50" name="phone" id="phone"/>
		<br>
      <input class="login" width="50" type="submit" value="Continue >">
		<br>
   </p>
</div>
<br>
</form>
<?php endif ?>

<form name="register_form" action="/form-process-shabbat" method="post">
<input type=hidden name="subject" value="Shabbat Dinner Web Submission">

<div id="shabatContainer">
	<p class="chabad-header">
<?php if (!isset($person)): ?>
	Don't have an account yet? <br />
	Fill out this form to reserve a space at our Shabbat Dinner!
<?php else: ?>
	Welcome <?= $person->getName() ?>!
	<?php if (is_null(User::getLoggedInUser())): ?>(<a href="/shabbat?wronguser">Not you?</a>)<?php endif ?>
	<br>
	Fill out this form to reserve a space at our Shabbat Dinner, or <a href="/myaccount">click here to change your contact information</a>.
	<input type=hidden name="person_id" value="<?= $person->id ?>">
<?php endif ?>
	</p>
   <table border="0" width="72%" id="registertable">
<?php if (!isset($person)): ?>
      <tr>
         <td width="43%" class="chabad">* Your Full Name</td>
			<td width="51%">
				<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="realname">
			</td>
      </tr>
      <tr>
         <td width="43%" class="chabad">* Your Email</td>
			<td width="51%">
				<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="email">
			</td>
      </tr>
      <tr>
         <td width="43%" class="chabad">* Re-type Email</td>
			<td width="51%">
				<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="elll0">
			</td>
      </tr>
      <tr>
         <td width="43%" class="chabad">* Cell Phone</td>
			<td width="51%" class="chabad">
				<input TYPE="TEXT" SIZE="24" MAXSIZE="50" NAME="phone" VALUE="<?=
					isset($_POST['phone']) ? $_POST['phone'] : ''
				?>"/>
			</td>
      </tr>
      <tr>
         <td width="43%" class="chabad">
            <p class="chabad-small"><font color="#FF0000">*Required Fields </font>
         </td>
         <td width="16%" class="chabad">&nbsp;</td>
      </tr>
      <tr>
         <td width="43%" class="chabad">U of M School year</td>
         <td width="52%" class="chabad">
					<?= do_shortcode('[um_school_year_dropdown]') ?>
         </td>
      </tr>
<?php endif ?>
      <tr>
        <td width="43%" class="chabad">How many people ?</td>
        <td width="51%">
           <select size="1" name="people">
              <option selected value="1">1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
           </select>
        </td>
      </tr>
      <tr>
        <td width="43%"><span class="chabad">For which week?</font></td>
        <td width="51%"><span class="chabad">
           <select size="1" name="week">
              <option>Chose one</option><br />
              <option>This Week</option>
              <option>Next Week</option>
              <option>Other</option>
              <option>Parents Weekend</option>
              <option>Graduation Weekend</option>
           </select>
        </td>
      </tr>
      <tr>
        <td width="95%" class="chabad" colspan="2">Comment: (Additional names)</td>
      </tr>
      <tr>
         <td width="95%" colspan="2">
            <p align="center"><textarea rows="4" name="suggestion" cols="30"></textarea></p>
         </td>
      </tr>
      <tr>
        <td width="95%" class="chabad" colspan="2">
            <p class="chabad-med" align="center">
               <font color="#FF0000">Please be advised the Shabbat 
               dinner on-line <br>
               reservation service is only available to U of M 
               students. <br>
               All others will need to call&nbsp; 734-995-3276.</font>
            </p>
         </td>
      </tr>
   </table>
	<p align="center">
		<input type="submit" value="Reserve Shabbat Dinner" <?= isset($person) ? '' : ' onclick="return verify();"'?>>
	</p>
</div>
</form>
<?php
get_footer();
?>
