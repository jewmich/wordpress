#!/usr/bin/env php
<?php

require(__DIR__ . '/../html/wp-load.php');

$user = get_user_by('email', 'mason.malone@gmail.com');
var_dump(
	$user->display_name,
	$user->user_email,
	$user->is_student,
	$user->phone
);
