



<?php
/**
 * Template Name: shabbat Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

if (isset($_GET['wronguser'])) {
  unset($_SESSION['phone']);
}

$phoneNotFound = false;
$user = wp_get_current_user();
if (!$user->exists()) {
    $user = null;
    if (!empty($_POST['phone'])) {
        $toReplace = array('-', ' ', '(', ')', '.');
        $phone = str_replace($toReplace, array(), $_POST['phone']);
        $fieldName = 'meta_value';
        foreach ($toReplace as $char) $fieldName = "REPLACE($fieldName, '$char', '')";
        $sql = $wpdb->prepare("SELECT user_id, meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'phone' AND {$fieldName} = %s LIMIT 1", $phone);
        $results = $wpdb->get_row($sql);

        if (!$results) {
            $phoneNotFound = true;
        } else {
            $user = new WP_User($results->user_id);
            $_SESSION['phone'] = $results->meta_value;
        }
    } elseif (!empty($_SESSION['phone'])) {
        $user = get_users([
            'meta_key' => 'phone',
            'meta_value' => $_SESSION['phone'],
            'number' => 1,
        ])[0];
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
<script LANGUAGE="JavaScript" type="text/javascript"> function verify() {
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

  if (document.register_form.email.value !=
document.register_form.elll0.value) {
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

<div class="page-header">
 <h1>Shabbat Dinner for U of M Students</h1>  <h4>Experience the most amazing Shabbat Dinner you have ever experienced.<br>  Every Friday evening of the U of M academic school year.</h4> </div>

<div class="row">
<h4>Schedule for this week:</h4>
<h5>Shabbat Services: <font color="#FF0000"><?php echo serviceTime(); ?></font><br> Shabbat Dinner: <font color="#FF0000"><?php echo dinnerTime(); ?></font></h5> <a class="btn btn-danger" href="/candlelighting/">Candle Lighting Times</a> </div> <br>


<div class="row">
<p>
&quot;You'll never forget Shabbat at Chabad!&quot; <br> The weekly Shabbat dinners at Chabad provide Jewish students from the freshman to the MBA an intimate and elegant setting to eat, meet new friends from every niche of the campus, and celebrate Shabbat in a warm and enjoyable manner.<br> <br> Shabbat dinner features five courses of traditional classics and updated favorites. You don't have to dress up for the occasion and you don't have to recite your Bar-Mitzvah speech.<br> <br> There is <b>no charge</b> for the Shabbat Dinner thanks to our wonderful sponsors.<br> <br> If you would like to be a proud sponsor of a Shabbat dinner <a href="/sponsorshabbat">please use our Secure on-line from</a>.
  </p>
</div>

<br>

<div class="row">
<?php if (!$user): ?>
<form class="form-inline" name="login_form" method="post">

<div class="form-group">

<label for="email">Have you RSVP'd in the past? Enter your phone number here!</label><br> <input class="form-control" type="text" size="24" maxsize="50" name="phone"
id="phone" placeholder="Phone number"/>
<input class="login btn btn-info" width="50" type="submit" value="Continue
>">
<br>
</div>

<?php if ($phoneNotFound): ?>
<p style="color: red">Your phone number isn't in our system yet. Please fill out the form below to add it.</p>
    <?php endif ?>



</form>
<?php endif ?>
</div>


<form  name="register_form" action="/form-process-shabbat" method="post">

<input type=hidden name="subject" value="Shabbat Dinner Web Submission">


<?php if (!$user): ?>
<h3>  Don't have an account yet? <br>
  Fill out this form to reserve a space at our Shabbat Dinner!</h3> <?php else: ?>

 <h3> Welcome <?= $user->display_name ?>! <a href="/shabbat?wronguser">Not you?</a>
  <?php if (wp_get_current_user()->exists()): ?>(<a href="/shabbat?wronguser">Not you?</a>)<?php endif ?>
  <br>

  Fill out this form to reserve a space at our Shabbat Dinner,<br> or <a href="/myaccount">click here to change your contact information</a>.</h3>
  <input type=hidden name="user_id" value="<?= $user->ID ?>"> <?php endif ?> <div class="row col-md-6"> <?php if (!$user): ?>

<div class="form-group">
      <label for="realname">Full Name *</label>
      <input class="form-control" type="text" size="24" maxsize="50"
name="realname" id="realname" required="required"> </div>

  <div class="form-group">
      <label for="email">Email *</label>
      <input class="form-control" type="text" size="24" maxsize="50"
name="email" id="email" required="required"> </div>

  <div class="form-group">
      <label for="elll0">Retype Email *</label>
      <input class="form-control" type="text" size="24" maxsize="50"
name="elll0" id="elll0" data-match="#email" data-match-error="Whoops, Emails don't match">
  </div>

    <div class="form-group">
      <label for="phone">Phone Number *</label>
       <input class="form-control" TYPE="TEXT" SIZE="24" MAXSIZE="50"
NAME="phone" id="phone" required="required"
VALUE="<?=isset($_POST['phone']) ? $_POST['phone'] : ''?>"/>
  </div>

  <!--
<div class="form-group">
<label>U of M School year</label>
  <span class="form-control"><?= do_shortcode('[um_school_year_dropdown]')
?></span>
 </div>
-->
<div class="form-group">
<label for="form_year">Year you intend to graduate: *</label> <select class="form-control" name="student" required="required"> <option value="">Choose one</option> <script>
  var myDate = new Date();
  var year = myDate.getFullYear();
  for(var i = year; i < year+5; i++){
          document.write('<option value="'+i+'">'+i+'</option>');
        }
  for(var i = year; i < year+5; i++){
          document.write('<option value="Grad '+i+'">Grad '+i+'</option>');
  }
</script>
</select>
</div>
<?php endif ?>

<div class="form-group">
<label for="people">How many people intend to come? * (Including You)</label> <select class="form-control"  size="1" name="people">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option> </select> </div>

<div class="form-group">
<label for="week">For which week?</label> <select class="form-control" size="1" name="week" required="required">
              <option value="">Chose one</option><br />
              <option>This Week</option>
              <option>Next Week</option>
              <option>Parents Weekend</option>
              <option>Graduation Weekend</option>
              <option>Other (*Describe in Comment)</option> </select> </div>

<div class="form-group">
<label for="suggestion">Comment: (Additional Names)</label> <textarea class="form-control" rows="4" name="suggestion"></textarea> </div>

<p align="center">
 <font size=small color="#FF0000">Please be advised the Shabbat dinner on-line <br>  reservation service is only available to U of M students. <br> All others please call <a href="tel:7349953276">734-995-3276</a>.</font>
</p>

<input class="btn btn-success btn-block" type="submit" value="Reserve Shabbat Dinner"> <!--<input class="btn btn-sucsess btn-block" type="submit" value="Reserve Shabbat Dinner" <?= $user ? '' : ' onclick="return verify();"'?>>-->

    </div>
</form>

<?php
get_footer();
?>
