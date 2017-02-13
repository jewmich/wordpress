<?php
/**
 * Template Name: kiddushmain Template
 */

require_once(get_template_directory() . '/includes/kiddush.php');

$curMonth = jdmonthname(unixtojd(), CAL_MONTH_JEWISH);
$isCoordinator = isset($_POST['coordinatorpassword']) && $_POST['coordinatorpassword'] == "terry" . strftime("%d");
get_header();
?>
<div align="center">
<table width="96%" background="pic/chabad-bg.gif">
	<tr class="chabad-header">
		<td class="chabad-small" width="171">
			<p class="chabad-header"><span style="font-weight: 400"><b>Availability</b></span>
		</td>
		<td class="chabad-small" width="59">
			<p class="chabad-header"><span style="font-weight: 400"><b>Date</b></span>
		</td>
		<td class="chabad-small">
			<p class="chabad-header"><span style="font-weight: 400"><b>Hebrew Date</b></span>
		</td>
		<? if ($isCoordinator): ?>
		<td class="chabad-small"><p class="chabad-header"><span style="font-weight: 400"><b>E-mail</b></span></td>
		<td class="chabad-small"><p class="chabad-header"><span style="font-weight: 400"><b>Name</b></span></td>
		<? endif ?>
	</tr>
<? foreach(getDaysToShow() as $jd): ?>
	<? $reservation = getReservation($jd) ?>
	<tr class="chabad" bgcolor="<?= $reservation ? '#fbc080' : '#7cfc00' ?>">
		<td align="center" class="chabad-small" width="83">
			<form action="/kiddushreserve" method=post>
				<input type="hidden" name="originalJd" value="<?= $jd ?>">
			<? if ($reservation): ?>
				<b>Kiddush Taken</b>
				<br>
				<input type="submit" name="change" value="Change">
			<? else: ?>
				<input type="submit" name="reserveButton" caption="Available" value="Reserve">
				<input type="hidden" name="date" value="<?= $reservation['date'] ?>">
			<? endif ?>
			</form>
		</td>
		<td class="chabad-small" width="140"><?= date("M j, Y", jdtounix($jd + 1)) ?></td>
		<? $jewishDetails = cal_from_jd($jd, CAL_JEWISH) ?>
		<td class="chabad-small"><?= $jewishDetails['day'] . " " . $jewishDetails['monthname'] . ", " . $jewishDetails['year'] ?></td>
		<? if ($isCoordinator): ?>
		<td class="chabad-small"><?= $reservation ? $reservation['email'] : ''?></td>
		<td class="chabad-small"><?= $reservation ? $reservation['name'] : ''?></td>
		<? endif ?>
	</tr>
	<!-- spacer row between months -->
	<? if ($curMonth !== jdmonthname($jd, CAL_MONTH_JEWISH)): ?>
		<tr><td colspan="5"></td></tr>
		<? $curMonth = jdmonthname($jd, CAL_MONTH_JEWISH); ?>
	<? endif ?>
<? endforeach ?>
</table>
<form action="kiddushmain.php" method="post" name="coordinatorform">
	<p>Coordinator Password: <input type="text" name="coordinatorpassword"><br></p>
</form>
</div>
<?php
get_footer();
?>
