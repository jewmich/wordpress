#!/usr/bin/env php
<?php

require(__DIR__ . '/../html/wp-load.php');

function update_meta($user_id, $person) {
	if ($person->phone) {
		update_user_meta($user_id, 'phone', $person->phone);
	}
	update_user_meta($user_id, 'is_student', $person->is_student);
	update_user_meta($user_id, 'student_year', $person->student_year);
}

$people = $GLOBALS['wpdb']->get_results('SELECT * FROM People LEFT JOIN Users ON (Users.person_id = People.id)');
foreach ($people as $person) {
	echo "\nProcessing person #{$person->id} '{$person->email}'";

	$user = get_user_by('email', $person->email);
	if ($user) {
		echo "\n\tUser exists";
		$user_id = $user->ID;
	} else {
		echo "\n\tNo user, creating";
		$user_details = [
			'display_name' => $person->fullname,
			'user_login' => $person->email,
			'user_email' => $person->email,
			'role' => 'Subscriber',
			'user_pass' => wp_generate_password(),
		];
		if ($person->created !== '0000-00-00 00:00:00') {
			$user_details['user_registered'] = $person->created;
		}
		$user_id = wp_insert_user($user_details);
		if ($person->password) {
			$GLOBALS['wpdb']->update(
				$GLOBALS['wpdb']->users,
				['user_pass' => $person->password],
				['ID' => $user_id]
			);
		}
	}
	update_meta($user_id, $person);
	$GLOBALS['wpdb']->update('Shabbat', ['person_id' => $user_id], ['person_id' => $person->id]);
}
