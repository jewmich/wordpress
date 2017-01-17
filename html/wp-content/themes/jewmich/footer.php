							</div>
							<? if (!get_post_meta(get_the_ID(), 'no_sidebar', true)): ?>
							<div class="col-xs-1 sidebar">
								<? if ($user = User::getLoggedInUser()): ?>
								<div class="chabad" style="text-align: center; padding-bottom: 5px;">
									Welcome, <?= $user->getName() ?> <br>
									<a href="myaccount">My Account</a> &ndash; <a href="logout?return=<?= $_SERVER['PHP_SELF'] ?>">Logout</a>
								</div>
								<? endif ?>
								<?= do_shortcode('[sidebar]') ?>
								<script type="text/javascript" language="javascript" src="//beta.chabad.org/tools/shared/candlelighting/candlelighting.js.asp?z=48104"></script>
								<br>&nbsp;</p>
							</div>
							<? endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Site footer -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 bottom" role="footer">
				<div class="row">
					<div class="col-xs-8 col-xs-offset-2">
						<p><a href="/studentcenter">Student Center</a> | <a href="/cong">Congregation Chabad</a> | <a href="/tep">Torah Enrichment Program</a> | <a href="/studycenter">Study Center</a><br><a href="/camp">Camp Gan Israel</a> | <a href="/donation">Donate</a> | <a href="/faq">Faq</a> | <a href="/contact">Contact Us</a><br><a href="">Chabad House at the University of Michigan</a><br>715 Hill • Ann Arbor, MI • 48104<br>734-99- LEARN (5-3276)
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Include jQuery and bootstrap JS plugins -->
	<script src="<?= get_template_directory_uri() ?>/js/jquery-2.1.0.min.js"></script>
	<script src="<?= get_template_directory_uri() ?>/js/bootstrap.min.js"></script>
	<!-- Include Chabad-specific JS -->
	<script src="<?= get_template_directory_uri() ?>/js/kdate.js"></script>
	<script src="<?= get_template_directory_uri() ?>/js/chabad.js"></script>
	<?php wp_footer(); ?>
</body>
</html>
