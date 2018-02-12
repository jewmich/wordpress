#!/usr/bin/env php
<?php

require(__DIR__ . '/../html/wp-load.php');

$wpdb->query('START TRANSACTION');
$post_rows = $wpdb->get_results('SELECT ID, post_content FROM wp_posts where post_content like "This page cannot be edited in Wordpress%" and post_type = "page"');
foreach ($post_rows as $post) {
	echo "Processing post #{$post->ID}\n";
	preg_match('@page-templates/(.*)$@', $post->post_content, $matches);
	$template = file_get_contents('../html/wp-content/themes/jewmich/page-templates/' . $matches[1]);
	if (!$template) { throw new Exception("Failed with {$post->ID}"); }
	$template = preg_replace('@/\*\*.*?Template Name[^*]*\*/[\n\r]*@sm', '', $template);
	$template = preg_replace('@if \(!defined\(\'DONOTCACHEPAGE.*?[\n\r]+@m', '', $template);
	$template = preg_replace('@get_header\(\);.*?[\n\r]+@m', '', $template);
	$template = preg_replace('@<\?php[\n\r]get_footer\(\);([\n\r]\?>)?@ms', '', $template);
	$template = trim($template);
	if (!$wpdb->update('wp_posts', ['post_content' => $template], ['ID' => $post->ID])) {
		throw new Exception("Failed to update {$post->ID}");
	}
	if (!$wpdb->update('wp_postmeta', ['meta_value' => 'default'], ['post_id' => $post->ID, 'meta_key' => '_wp_page_template'])) {
		throw new Exception("Failed to update {$post->ID}");
	}
}
$GLOBALS['wpdb']->query('COMMIT');
