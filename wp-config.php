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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'Tbxt.+6LE}p#PSE.md_1NxnHzo]2>I/m8V]1Uff1I4,=V:5<f-;Q@fNl5/&.v}ld' );
define( 'SECURE_AUTH_KEY',   'nU@e0v~6feL,{DeS>_&#[85Z$|`imm6F9U%w9g2#PqTFlmZG.Sy[&2/b8;3k4`63' );
define( 'LOGGED_IN_KEY',     ';xEpO~0.}:qLS%BOVQKKJ99FVp lT@.MP!$x$kLNl`@x&&oI~n${>lI7>#|DK3l{' );
define( 'NONCE_KEY',         'w:-NuMaY.7K?q*R_;Chd2zz@-XA4A1D|zu7B/yzG^TJUF.EHz&N<$);*wM[)><YU' );
define( 'AUTH_SALT',         '6^pz[M.$h;2KOadI^cLB~:yLn>h*^[u@<rRK,%hDlh<8L;O&&x}q!Fc583mJ:3H ' );
define( 'SECURE_AUTH_SALT',  'r)2+`OE/;)S,XVfY5/9#XthtC~]<V;y&P_W`FYibPq,8.b_RWfCk>&lLpcqvttNH' );
define( 'LOGGED_IN_SALT',    '*`2_%<DahH%V:GL{C@YGS*HI^ >XxA7`*7SH!b?2xevX8!N/$|,Gpu#XgZI8-5sj' );
define( 'NONCE_SALT',        'XM(hj.O=S7Pu@-;#>SAWQ=Xft)^uN72uhR5gNrhR6/M2(18A%JfQPb*WPzi(xVTD' );
define( 'WP_CACHE_KEY_SALT', 'I{GiXNHmp9Zxlj [u$:x~[cqZQO@zM..uvIe]1ycfgp wT4Psa 112P4ctHhq$kr' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
