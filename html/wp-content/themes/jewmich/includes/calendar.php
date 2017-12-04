<?php

// used for sunset calculations
define('LATITUDE_ANNARBOR', 42.22);
define('LONGITUDE_ANNARBOR', -83.75);

function datetime_annarbor($time = 'now') {
	return new DateTimeImmutable($time, new DateTimeZone('America/New_York'));
}

function datetime_from_jd($jd, $time = null) {
	$cal = cal_from_jd($jd, CAL_GREGORIAN);
	$timeString = $cal['date'];
	return datetime_annarbor($timeString);
}

function datetime_from_jewish($month, $day, $year = null) {
	if (!$year) {
		$year = currentJewishYear();
	}
	$jd = jewishtojd($month, $day, $year);
	return datetime_from_jd($jd);
}

function datetime_sunset_annarbor(DateTimeInterface $dateTime) {
	$sunsetTime = date_sunset(
		$dateTime->getTimestamp(),
		SUNFUNCS_RET_TIMESTAMP,
		LATITUDE_ANNARBOR,
		LONGITUDE_ANNARBOR,
		ini_get("date.sunset_zenith"),
		$dateTime->getOffset() / 3600
	);
	// round to nearest quarter-hour
	$sunsetTime = round($sunsetTime / (15 * 60)) * (15 * 60);
	return $dateTime->setTimestamp($sunsetTime);
}

function currentJewishYear() {
	$currentJewishCal = cal_from_jd(unixtojd(time()), CAL_JEWISH);
	return $currentJewishCal['year'];
}

function passoverDates() {
	$dates = [];
	foreach ([
		'firstSeder' => 14,
		'secondSeder' => 15,
	] as $name => $day) {
		$dates[$name] = datetime_from_jewish(8, $day);
		$dates[$name] = datetime_sunset_annarbor($dates[$name]);
	}

	return $dates;
}

