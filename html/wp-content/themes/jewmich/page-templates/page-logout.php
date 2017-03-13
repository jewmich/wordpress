<?php
/**
 * Template Name: logout Template
 */

define('DONOTCACHEPAGE', true);

unset($_SESSION['user']);
session_regenerate_id(true);
header('Location: ' . $_GET['return']);
?>
