<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'developer_wordpress' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Kb<!60I^!){skZTCdFG+kI-dQ(]cT+A_FfC!bi|Fv:p%6Y ]e[WTkHl7O^R9$<L+' );
define( 'SECURE_AUTH_KEY',  '74>544j>$8}6*0W;!;#Q{NmbpZa1Z]t?iBgu}.P:M,?z6O:@8i`PYYOcbgl_{)pw' );
define( 'LOGGED_IN_KEY',    '4a]V{T9N0g>;m,< Yi{?s6j0%E!2nKMI`gLWc?7nUGc=vykqE_x]KPhM|p[<Q`ih' );
define( 'NONCE_KEY',        'AmNu_of-nfa&daj[4xmrOachC22unt.:jL(a,YAnE#v<&_J|g3K4}N]l=^{je%0%' );
define( 'AUTH_SALT',        ')dFFm%zo04[@PSQ<FIb[]*D%|C96rVmw3rHk}zRhGtp:vn&O}}wkg>FQ[umAdzo.' );
define( 'SECURE_AUTH_SALT', 'wShy{FYZFr>]<eKiY3;3HV=)!qjXl^%S,+IK|4K+OSDfj35G2*(cxNgm.r}lP/+N' );
define( 'LOGGED_IN_SALT',   'Rh$(g1[J8:IF#/c/Ks3U:| ?`ORo4[)v9:`ARB=omEj%(KXb>$sm.rV=L>/{8Vz6' );
define( 'NONCE_SALT',       'Sr<ja[n*^Y^+)v-GI.[DY7~^kJlg-]dK#Bexkp>_cWGB?O/q,_4n ]>xIUX9w<?-' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
