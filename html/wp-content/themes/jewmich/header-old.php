<!DOCTYPE html>
<html>
	<head>
		<title><?= get_post_meta(get_the_ID(), 'title', true) ?></title>
      <?php wp_head(); ?>
		<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/css/old.css" type="text/css" />
		<script type="text/javascript" src="<?= get_template_directory_uri() ?>//kdate.js"></script>
		<script type="text/javascript" src="<?= get_template_directory_uri() ?>/js/kdate.js"></script>
		<script type="text/javascript" src="<?= get_template_directory_uri() ?>/js/chabad.js"></script>
	</head>
	<body <?php body_class(); ?> topmargin="0" marginwidth="0" marginheight="0" background="<?= get_template_directory_uri() ?>/images/chabad-bg.gif">
		<div align="center">
			<table width="44%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				<tr>
					<td align="center" valign="top">
						<table width="726" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
							<tr align="left" valign="top">
								<td width="7">
									<img src="<?= get_template_directory_uri() ?>/images/spacer.gif" width="7" height="11">
								</td>
								<td>
									<a href="/"><img border="0" src="<?= get_template_directory_uri() ?>/images/header.gif" width="711" height="33"></a>
								</td>
								<td width="7">
									<img src="<?= get_template_directory_uri() ?>/images/spacer.gif" width="7" height="11">
								</td>
							</tr>
							<tr align="left" valign="top">
								<td>&nbsp;</td>
								<td>
									<? if ($bannerLink = get_post_meta(get_the_ID(), 'banner_link', true)): ?><a href="<?= $bannerLink ?>"><? endif ?>
									<img border="0" src="<?= get_post_meta(get_the_ID(), 'banner', true) ?>" width="711" height="210">
									<? if ($bannerLink): ?></a><? endif ?>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr align="left" valign="top">
								<td>&nbsp;</td>
								<td align="left" valign="top">
									<ul id="nav">
										<li><a href="/studentcenter">Student Center</a>
											<div><ul>
													<li><a href="/aboutstu">About U of M Chabad</a></li>
													<li><a href="/birthright" target="_blank">Free Trip to Israel</a></li>
													<li><a href="/mythandfact">Myths &amp; Facts</a></li>
													<li><a href="/ask">Ask the Rabbi</a></li>
													<li><a href="/studycenter">Judaic Classes</a></li>
													<li><a href="/shabbat">Shabbat Dinner</a></li>
													<li><a href="http://www.chabad.org/calendar/CandleLighting2.asp?PlaceID=23&amp;imageField4.x=15&amp;imageField4.y=10" target="_blank">Candle Lighting Times</a></li>
													<li><a href="/kosher">Kosher in Ann Arbor</a></li>
													<li><a href="/map">Map</a></li>
													<li><a href="/visiting&living">Visiting & Living</a></li>
											</ul></div>
										</li>
										<li><a href="/cong">Congregation Chabad</a>
											<div><ul>
													<li><a href="/cong">About Congregation Chabad</a></li>
													<li><a href="/studycenter">Adult Education</a></li>
													<li><a href="/tep">Youth Education</a></li>
													<li><a href="/mikvah">Mikvah</a></li>
                                                    <li><a href="/kiddush">Sponsor a Shabbat Lunch</a></li>
                                                    <li><a href="/jwc">Jewish Women's Circle</a></li>
													<li><a href="/kosher">Kosher in Ann Arbor</a></li>
													<li><a href="/candlelighting">Candle Lighting Times</a></li>
													<li><a href="/ask">Ask the Rabbi</a></li>
													<li><a href="/map">Map</a></li>
													<li><a href="/visiting&living">Visiting & Living</a></li>
											</ul></div>
										</li>
										<li><a href="/tep">TEP</a>
											<div><ul>
													<li><a href="/tep">About Torah Enrichment Program</a></li>
											</ul></div>
										</li>
										<li><a href="/studycenter">Study Center</a>
											<div><ul>
													<li><a href="/tep">Youth Education</a></li>
													<li><a href="/studycenter">Adult Education</a></li>
													<li><a href="http://www.chabad.org/dailystudy/default.asp" target="_blank">Daily Study</a></li>
													<li><a href="http://www.chabad.org/magazine/tftd/TFTDFrame2.asp" target="_blank">Daily Thought</a></li>
													<li><a href="http://www.chabad.org/library/article_cdo/aid/1911814/jewish/Audio-Video-Classes.htm" target="_blank">Audio & Video Classes</a></li>
													<li><a href="/ask">Ask the Rabbi</a></li>
													<li><a href="/map">Map</a></li>
													<li><a href="/visiting&living">Visiting & Living</a></li>
											</ul></div>
										</li>
										<li><a href="/camp">Camp Gan Israel</a>
											<div><ul>
													<li><a href="http://www.mycampganisrael.com">Home</a></li>
													<li><a href="http://www.mycampganisrael.com/about.htm">About Camp Gan Israel</a></li>
													<li><a href="http://www.mycampganisrael.com/regisration.htm">Registration</a></li>
											</ul></div>
										</li>
										<li><a href="/donate">Donate</a>
											<div><ul>
													<li><a href="/donation">About Donations</a></li>
													<li><a href="/donate">Donate Online</a></li>
													<li><a href="/wishlist">Chabad Wish List</a></li>
													<li><a href="/charitybox">Request a Charity Box</a></li>
													<li><a href="/chaiclub">Chai Club</a></li>
											</ul></div>
										</li>
										<li><a href="/contact">Contact Us</a>
											<div><ul>
													<li><a href="/contact">Contact Information</a></li>
													<li><a href="/map">Map</a></li>
													<li><a href="/aboutus">About Us</a></li>
                                                    <li><a href="/visiting&living">Visiting & Living</a></li>
											</ul></div>
										</li>
									</ul>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr align="left" valign="top">
								<td>&nbsp;</td>
								<td align="left">
									<img src="<?= get_template_directory_uri() ?>/images/mid-spacer.gif" width="32" height="24">
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr align="left" valign="top">
								<td>&nbsp;</td>
								<td align="left">
									<table border="0" width="100%" >
										<tr>
											<td valign="top" class="main-content">