<?php
/**
 * Template Name: successredirect Template
 */

if (!defined('DONOTCACHEPAGE')) define('DONOTCACHEPAGE', true);

?>
<html>
<head>
	<meta http-equiv="refresh" content="0;url=http://<?= $_SERVER['SERVER_NAME'] ?>/success?type=<?= $_REQUEST['type'] ?>">
</head>
<body></body>
</html>
