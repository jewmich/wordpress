							</div>
							<?php if (!get_post_meta(get_the_ID(), 'no_sidebar', true)): ?>
							<div class="col col-xs-1 sidebar">
								<? if (is_plugin_active('wp-super-cache/wp-cache.php')): ?>
									<!-- DYNAMIC_CACHE_SIDEBAR -->
								<? else: ?>
									<?= do_shortcode('[user_welcome][sidebar]') ?>
								<? endif ?>
								<script type="text/javascript" language="javascript" src="//beta.chabad.org/tools/shared/candlelighting/candlelighting.js.asp?z=48104"></script>
								<br>&nbsp;</p>
							</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Site footer -->
	<div class="container-fluid">
		<div class="row">
			<div class="col col-xs-12 bottom" role="footer">
				<div class="row">
					<!-- <div class="col col-xs-10 col-xs-offset-2"> -->
						<p><a href="/studentcenter">Student Center</a> | <a href="/cong">Congregation Chabad</a> | <a href="/chs">CHS Chabad Hebrew School</a> | <a href="/studycenter">Study Center</a><br><a href="/camp">Camp Gan Israel</a> | <a href="/donation">Donate</a> | <a href="/faq">Faq</a> | <a href="/contact">Contact Us</a><br><a href="">Chabad House at the University of Michigan</a><br>715 Hill • Ann Arbor, MI • 48104<br>734-99- LEARN (5-3276)
					</div>
				<!-- </div> -->
			</div>
		</div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>
