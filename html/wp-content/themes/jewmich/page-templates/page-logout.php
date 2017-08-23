<?php
/**
 * Template Name: logout Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

unset($_SESSION['user']);
session_regenerate_id(true);
header('Location: ' . $_GET['return']);
?>
