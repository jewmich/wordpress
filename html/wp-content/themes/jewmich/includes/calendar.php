<?php

function get_wordpress_date($format, $unixtime) {
	return get_date_from_gmt(date('r', $unixtime), $format);
}

function passoverDates() {
	$currentJewishCal = cal_from_jd(unixtojd(time()), CAL_JEWISH);
	$currentJewishYear = $currentJewishCal['year'];

	$dates = [];
	foreach ([
		'start' => 14,
		'firstSeder' => 15,
		'secondSeder' => 16
	] as $name => $day) {
		$dates[$name] = jdtounix_with_timezone(jewishtojd(8, $day, $currentJewishYear));
	}

	return $dates;
}

