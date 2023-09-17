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

	// Don't show toolbar for subscribers
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
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
	if( !is_admin() && !session_id() && !headers_sent() ) { session_start(); }
});

// Semi-hack alert: Evaluate inline PHP inside posts. Normally, this would be a huge security hole,
// but since posts are only every edited by a handful of admins (Alter/Mendel), and we don't do
// comments, this isn't a big issue.
//
// Priority set to 7 because we need this to run before the autoembed filter, which is at
// priority 8.
add_filter('the_content', function($html) {
	if(strpos($html, '<?php') !== false) {
		if (!defined('DONOTCACHEPAGE')) {
			// For wp-super-cache
			define('DONOTCACHEPAGE', true);
		}
		ob_start();
		eval('?>' . $html);
		$html = ob_get_clean();
	}
	return $html;
}, 7);

function handle_error($errstr) {
	$message = 'Error at URL ' . $_SERVER['REQUEST_URI'] . ': ' . $errstr;
	if (WP_DEBUG_DISPLAY || ini_get('display_errors')) {
		echo '<br />' . $message . '<br />';
	}
	if (WP_DEBUG_LOG || ini_get('log_errors')) {
		error_log($message);
	}
}

set_error_handler(function($errno, $errstr, $errfile, $errline) {
	// handle @
	if (0 === error_reporting()) {
		return false;
	}
	handle_error($errstr . ', backtrace: ' . wp_debug_backtrace_summary(null, 1, true));
	return true;
}, error_reporting());

set_exception_handler(function($exception) {
	handle_error((string) $exception);
});

// Need to disable the block editor because it conflicts with above
add_filter('use_block_editor_for_post_type', '__return_false', 6);

add_filter('tiny_mce_before_init', function($in) {
	$in['protect'] = '[ /<\?php[\s\S]*?(?:$|\?>)/g  ]';
	return $in;
});

define('JEWMICH_USER_META_FIELDS', [
	'Cell Phone' => 'phone',
	'U of M School Year' => 'student_year',
	'Address' => 'address',
	'City' => 'city',
	'State' => 'state',
	'Zip' => 'zip',
]);

function jewmich_show_profile_fields($user) { ?>
	<h2>Jewmich-specific Data</h3>
	<table class="form-table">
		<?php foreach (JEWMICH_USER_META_FIELDS as $label => $field): ?>
		<tr>
			<th><label for="<?= $field ?>"><?= $label ?></label></th>
			<td><input type="text" name="<?= $field ?>" id="<?= $field ?>" value="<?= esc_attr(get_user_meta($user->ID, $field, true)) ?>" class="regular-text" /></td>
		</tr>
		<?php endforeach ?>
	</table>
<?php
}

add_action('show_user_profile', 'jewmich_show_profile_fields', 10);
add_action('edit_user_profile', 'jewmich_show_profile_fields', 10);

function jewmich_save_profile_fields($user_id) {
	if (!current_user_can('edit_user', $user_id)) {
		return false;
	}

	foreach (JEWMICH_USER_META_FIELDS as $label => $field) {
		update_user_meta($user_id, $field, $_POST[$field]);
	}
}

add_action('personal_options_update', 'jewmich_save_profile_fields', 10);
add_action('edit_user_profile_update', 'jewmich_save_profile_fields', 10);

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
require_once('gf_functions.php');