<!DOCTYPE html>
<html lang="en">
<head>
	<?php wp_head(); ?>
	<meta charset="utf-8">
	<!-- Set the viewport so this responsive site displays correctly on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chabad House of Ann Arbor</title>
	<!-- Include bootstrap CSS -->
	<link href="<?= get_template_directory_uri() ?>/css/redesign.css" rel="stylesheet" />
	<link href="<?= get_template_directory_uri() ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Alef" rel='stylesheet' type='text/css'>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<div class="jumbotron text-center">
			<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="6000">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel" data-slide-to="0" class="active"></li>
					<li data-target="#carousel" data-slide-to="1"></li>
					<li data-target="#carousel" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="<?= get_template_directory_uri() ?>/images/carousel/header.jpg" alt="chabad house">
					</div>
					<div class="item">
						<img src="<?= get_template_directory_uri() ?>/images/carousel/header2.jpg" alt="chabad house 2">
					</div>
					<div class="item">
						<img src="<?= get_template_directory_uri() ?>/images/carousel/header3.jpg" alt="chabad house 3">
					</div>
				</div>

				<!-- Controls -->
				<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div> <!-- Carousel -->
		</div>
	</div><!-- end wrapper -->
	<header>
		<h1><a href="/">C<small>HABAD OF</small> A<small>NN</small> A<small>RBOR</small></a></h1>
	</header>
	<nav class="navbar navbar-inverse navbar-static-top" role="navigaton">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				</button>
		   </div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navBar">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a class="dropdown-toggle" id="students" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">STUDENTS <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">About U of M Chabad</a></li>
							<li><a href="#">Free Trip to Israel</a></li>
							<li><a href="#">Myths & Facts</a></li>
							<li><a href="#">Judaic Classes</a></li>
							<li><a href="#">Shabbat Dinner</a></li>
							<li><a href="#">Candle Lighting Times</a></li>
							<li><a href="#">Ask the Rabbi</a></li>
							<li><a href="#">Kosher in Ann Arbor</a></li>
							<li><a href="#">Map</a></li>
							<li><a href="#">Visiting & Living</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" id="adults" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ADULTS <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/cong">About Congregation Chabad</a></li>
							<li><a href="/studycenter">Adult Education</a></li>
							<li><a href="/mikvah">Mikvah</a></li>
							<li><a href="/kiddush">Sponsor a Shabbat Lunch</a></li>
							<li><a href="/jwc">Jewish Women's Circle</a></li>
							<li><a href="/kosher">Kosher in Ann Arbor</a></li>
							<li><a href="/candlelighting">Candle Lighting Times</a></li>
							<li><a href="/ask">Ask the Rabbi</a></li>
							<li><a href="/map">Map</a></li>
							<li><a href="/visiting&living">Visiting & Living</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" id="youth" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">YOUTH <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/tep">Torah Enrichment Program</a></li>
							<li><a href="/tep">Programs</a></li>
							<li><a href="http://www.mycampganisrael.com/about.htm">Camp Gan Israel</a></li>
							<li><a href="/ask">Ask the Rabbi</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" id="events" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EVENTS <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/highholiday">High Holiday Reservation</a></li>
							<li><a href="/kiddush">Sponsor a Kiddush Lunch</a></li>
							<li><a href="/shabbat">RSVP for a Student Shabbat Dinner</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" id="contact_us" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CONTACT US <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/contact">Contact Information</a></li>
							<li><a href="/map">Map</a></li>
							<li><a href="/aboutus">About Us</a></li>
							<li><a href="/visiting&living">Visiting & Living</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" id="donate" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DONATE <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/donation">About Donations</a></li>
							<li><a href="/donate">Donate Online</a></li>
							<li><a href="/wishlist">Shabbat Wish List</a></li>
							<li><a href="/charitybox">Request a Charity Box</a></li>
							<li><a href="/chaiclub">Chai Club</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav>
