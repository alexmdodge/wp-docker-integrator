<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

/** The name of the database for WordPress */

define('DB_NAME', 'wordpress');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'mysql');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         '8da144ff94a3c8b3a77616f4a6f7274f764ef44b');
define('SECURE_AUTH_KEY',  '91f87dc69d56df23017903602785bfe5fa342b4b');
define('LOGGED_IN_KEY',    '9fb7f2e07e8db8fdd924097dbb52bb1a6041c6ec');
define('NONCE_KEY',        '5d621f7fc703f41269c5d2fb04b584735ab12b1e');
define('AUTH_SALT',        'e4cbd3f31f1e256b01e7aed022dd73382975335b');
define('SECURE_AUTH_SALT', '2067e6503954e51c6bbe12ae699d5b6250134721');
define('LOGGED_IN_SALT',   'ab63a7f6e1e199ca0942856da29dfe852569356c');
define('NONCE_SALT',       '8e50d12248daa188b19e2dffafe49e47f1e43224');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
  $_SERVER['HTTPS'] = 'on';
}

/* Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/* Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/* Auto Update without FTP */
define('FS_METHOD','direct');