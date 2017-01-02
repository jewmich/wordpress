</td>

<? if (!get_post_meta(get_the_ID(), 'no_sidebar', true)): ?>
<td class="sidebar" width="203" valign="top" align="right">
	<? if ($user = User::getLoggedInUser()): ?>
	<div class="chabad" style="text-align: center; padding-bottom: 5px;">
		Welcome, <?= $user->getName() ?> <br>
		<a href="myaccount">My Account</a> &ndash; <a href="logout?return=<?= $_SERVER['PHP_SELF'] ?>">Logout</a>
	</div>
	<? endif ?>
	<? foreach (getSidebarImages() as $image): ?>
	<p><a href="<?= $image['url'] ?>"><img border="0" src="<?= $image['img_src'] ?>" alt="<?= $image['description'] ?>"/></a></p>
	<? endforeach ?>
	<script type="text/javascript" language="javascript" src="//beta.chabad.org/tools/shared/candlelighting/candlelighting.js.asp?z=48104"></script>
	<br>&nbsp;</p>
</td>
<? endif ?>
			</tr>
			</table>
		</td>
        <td>&nbsp;</td>
      </tr>
	  <tr align="left" valign="top">
		<td>&nbsp;</td>
		<td align="left" class="chabad-sub-info">
		<p align="center">
		<a href="/studentcenter">Student Center</a> l 
		  <a href="/cong">Congregation Chabad</a> l 
		  <a href="/tep">Torah Enrichment Program</a> l 
		  <a href="/studycenter">Study Center</a><br> 
		  <a href="/camp">Camp Gan Israel</a> l 
		  <a href="/donation">Donate</a> l 
		  <a href="/faq">Faq</a> l
		  <a href="/contact">Contact Us</a><br>
		  </p>
			<p align="center">Chabad House at the University of Michigan 
			  <br>
			  715 Hill              &#8226; Ann Arbor, MI &#8226; 48104<br>
			734-99- LEARN (5-3276)
			</p>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  </table>


</td>
	  </tr>
	</table>
</div>
<?php wp_footer(); ?>
</body>
</html>
