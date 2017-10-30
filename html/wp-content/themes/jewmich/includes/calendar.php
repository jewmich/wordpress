<?php

function get_wordpress_date($format, $unixtime) {
	return get_date_from_gmt(date('r', $unixtime), $format);
}

function currentJewishYear() {
	$currentJewishCal = cal_from_jd(unixtojd(time()), CAL_JEWISH);
	return $currentJewishCal['year'];
}

function jewishtojdunix($month, $day, $year = null) {
	if ($year == null) {
		$year = currentJewishYear();
	}
	return jdtounix(jewishtojd(8, $day, $year));
}

function passoverDates() {
	$dates = [];
	foreach ([
		'start' => 14,
		'firstSeder' => 15,
		'secondSeder' => 16,
	] as $name => $day) {
		$dates[$name] = jewishtojdunix($month, $day);
	}

	return $dates;
}

