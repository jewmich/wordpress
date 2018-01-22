<?php
/**
 * Template Name: logout Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

wp_logout();
header('Location: ' . $_GET['return']);
?>
