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

/**
 * Sets up theme defaults and registers the various WordPress features that
 * the Jewmich theme supports.
 */
function jewmich_setup() {
   // This theme uses wp_nav_menu() in one location.
   register_nav_menu( 'primary', __( 'Primary Menu', 'jewmich' ) );
}
add_action( 'after_setup_theme', 'jewmich_setup' );

/**
 * Enqueues scripts and styles for front-end.
 */
function jewmich_scripts_styles() {
	// Loads Bootstrap CSS and our CSS
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// Loads Bootstrap JS and Jewmich-custom JS
	wp_deregister_script('jquery'); // we have our own version of jQuery
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-2.1.0.min.js', [], '2.1.0', true);
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], '3.3.6', true);
	wp_enqueue_script( 'kdate', get_template_directory_uri() . '/js/kdate.js', ['jquery'], '1', true);
	wp_enqueue_script( 'chabad', get_template_directory_uri() . '/js/chabad.js', ['jquery'], '1', true);
}
add_action( 'wp_enqueue_scripts', 'jewmich_scripts_styles' );

// Don't automatically insert <br> and <p> tags
remove_filter( 'the_content', 'wpautop' );

// No RSS/RDS feed
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'noindex', 1 );

// No emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

//whether or not we're running on the live webroot
define('PRODUCTION_MODE', $_SERVER['SERVER_NAME'] !== 'test.jewmich.com');

if (PRODUCTION_MODE) {
	define('WEBFORM_EMAIL', 'webform@jewmich.com');
	define('CHABAD_EMAIL', 'chabad@jewmich.com');
	define('USER1_EMAIL', 'ar7gold@gmail.com');
	define('USER2_EMAIL', 'umchabad@jewmich.com');
	define('ERROR_EMAIL_RECIPIENTS', 'mason.malone@gmail.com,alter@jewmich.com');
} else {
	define('WEBFORM_EMAIL', 'webform@jewmich.com');
	define('CHABAD_EMAIL', 'chabad@jewmich.com');
	define('USER1_EMAIL', 'ar7gold@gmail.com');
	define('USER2_EMAIL', 'umchabad@jewmich.com');
	define('ERROR_EMAIL_RECIPIENTS', 'mason.malone@gmail.com');
}

// used for sunset calculations
define('LATITUDE_ANNARBOR', 42.22);
define('LONGITUDE_ANNARBOR', -83.75);

require_once('common_functions.php');
require_once('Person.php');
require_once('User.php');
