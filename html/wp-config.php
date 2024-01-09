<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// Determine environment
if (strpos(__DIR__, '/jewmich.com/') !== false) {
	define('ENVIRONMENT', 'production');
} elseif (strpos(__DIR__, '/test.jewmich.com/') !== false) {
	define('ENVIRONMENT', 'testing');
} else {
	define('ENVIRONMENT', 'development'); // inside docker
	define('SCRIPT_DEBUG', true);
}

ini_set('log_errors', 1);
ini_set('error_log', dirname(__DIR__) . '/php-errors.log');
ini_set('display_errors', (ENVIRONMENT === 'development') ? 1 : 0);

// Load sensitive data, which is stored outside the webroot for security.
require_once(__DIR__ . '/../secrets/secrets-' . ENVIRONMENT . '.php');

// Force SSL for all logins and wp-admin access, except in development/testing
define('FORCE_SSL_ADMIN', ENVIRONMENT === 'production');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* Autoupdate for everything - include major releases. May break things, but worth it for peace of mind */
define('WP_AUTO_UPDATE_CORE', true);

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', ENVIRONMENT === 'development');

define('WP_DEBUG_DISPLAY', WP_DEBUG);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');

define('WP_CACHE', true); //Added by WP-Cache Manager
define('WPCACHEHOME', ABSPATH . 'wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');