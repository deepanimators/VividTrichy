<?php
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wevividtrichy_web' );

/** Database username */
define( 'DB_USER', 'wevividtrichy_root' );

/** Database password */
define( 'DB_PASSWORD', 'pthpthpth@27' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY', 'z4(2UFX@kZ6][c-el[z]V@LOxBU922L)71&[T2_S7:e+/#oRzTUW8&%XIqu2f94@');
define('SECURE_AUTH_KEY', '];dv|uVD5-Z2(~)kTwiT88I/9o!1%13z54+g:[u(P;H[fu7pz5Zi#@+7SDXO:1O)');
define('LOGGED_IN_KEY', '#N~*11UhZp7]htS760Ag2aDH+tA95n/hUh_Mg//1:GQ+Hoeu~B_mg_H6*ZlULq*:');
define('NONCE_KEY', '16~|U32z4Z)toEa*3&:54)58/1#Ho*(22J%~!L7#5gd501H5yK3(BZ_MY836%6J7');
define('AUTH_SALT', 'sx2n;Z0e77k&e[070z7]~X(t)GthCl+760(aS(N3tx!tuZR_9QLll0MTaN0#3JZL');
define('SECURE_AUTH_SALT', 'h6)m|D89R&8:+1[gFvOB&218uG30~a+A%3fiE|:0udGL6/;VeB-eizEb7P_Q3@2t');
define('LOGGED_IN_SALT', '1IG|[1Xg&V[3oyz!CZWW&W#v3c*15p*TIIM9:33!2[ex-)xRiOYb!*5!7hz:/LM0');
define('NONCE_SALT', '|Zy291![6i22%_o8A%feHMlA6*seK(KLpnS!un0|:v[ZAHLl0t1RY2r]j2M4SP)4');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpnh_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}

define( 'WP_DEBUG_LOG', true );
define( 'SCRIPT_DEBUG', false );
define( 'SAVEQUERIES', false );
define( 'WP_DEBUG_DISPLAY', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'CONCATENATE_SCRIPTS', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
