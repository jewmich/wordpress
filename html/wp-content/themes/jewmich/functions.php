<?php
/**
 * Jewmich.com functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 */

add_action('after_setup_theme', function() {
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu('primary', __('Primary Menu', 'jewmich'));
	add_theme_support('title-tag');
	add_theme_support('custom-header', [
		'default-image' => get_template_directory_uri() . '/assets/images/default_subpage_header.jpg',
		'default-text-color' => '000',
		'header-text' => false,
		'height' => 300,
		'flex-width' => false,
		'flex-height' => false,
	]);
});

add_action('wp_enqueue_scripts', function() {
	// Loads Bootstrap CSS and our CSS
	wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style('style', get_stylesheet_uri(), [], '1.1');

	// Loads Bootstrap JS and Jewmich-custom JS
	wp_deregister_script('jquery'); // we have our own version of jQuery
	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-2.1.0.min.js', [], '2.1.0', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', ['jquery'], '3.3.6', true);
	wp_enqueue_script('kdate', get_template_directory_uri() . '/assets/js/kdate.js', ['jquery'], '1', true);
	wp_enqueue_script('chabad', get_template_directory_uri() . '/assets/js/chabad.js', ['jquery'], '1', true);
});

// Session needed for user handling
add_action('init', function() {
	if( !session_id() ) { session_start(); }
});

// Add WP-Super-Cache cache filter to dynamically generate the sidebar for the footer
// See example 1 at http://svn.wp-plugins.org/wp-super-cache/trunk/plugins/dynamic-cache-test.php
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('wp-super-cache/wp-cache.php') && function_exists('add_cacheaction')) {
	add_cacheaction( 'wpsc_cachedata', function($cachedata) {
		return str_replace('<!-- DYNAMIC_CACHE_SIDEBAR -->', do_shortcode('[user_welcome][sidebar]'), $cachedata);
	});
	add_cacheaction( 'wpsc_cachedata_safety', function() { return 1; });
}

// Don't automatically insert <br> and <p> tags
remove_filter('the_content', 'wpautop');

// No RSS/RDS feed
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'noindex', 1);

// No emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

define('WEBFORM_EMAIL', 'webform@jewmich.com');
define('CHABAD_EMAIL', 'chabad@jewmich.com');
define('USER1_EMAIL', 'ar7gold@gmail.com');
define('USER2_EMAIL', 'umchabad@jewmich.com');
define('ERROR_EMAIL_RECIPIENTS', 'mason.malone@gmail.com,alter@jewmich.com');

require_once('includes/calendar.php');
require_once('includes/mailer.php');
require_once('includes/shortcodes.php');
