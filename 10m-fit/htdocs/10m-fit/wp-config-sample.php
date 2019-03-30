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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_10m_fit' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'L7w_?Tj6B`(<,XkC<lC@uC?%[W}F!{6(E-jrTcVSu3t&/dk;ycC~Ru[y*t>vx0w(' );
define( 'SECURE_AUTH_KEY',  '-s%7Fz#PZ U:_h2:k`J<K^hhWA}@`*R<%2{M|=%/7FLuVa6`MlQ96biuhM-*SOh1' );
define( 'LOGGED_IN_KEY',    ' `5 Sr*u)Nm&{>H}~S=[[XKh4M*KZ|E38lM=`3)u%kk:M}%KS9oY/S.xSx=xEzSe' );
define( 'NONCE_KEY',        ';(uqC9jT]|a2(0EfF^@TMU3xxx{`0BFq]<j[i#_YWX9FD:6pr]u&aW-/p$8.2B?g' );
define( 'AUTH_SALT',        'Emw&ik7S7@wLRg7Ek40S7NLH33eK5ye:|9t[O2Jsy9{QaWn3$?MbVcl[7xL)]sE<' );
define( 'SECURE_AUTH_SALT', 'lxma8uhG-@K1ZKo|<=6xfAfmQ3K#)18DigW+hX1~PNCtHl3CbUa6]?[Nq5kOp:0x' );
define( 'LOGGED_IN_SALT',   '*j8t~@o}arIMig<(:VUKz]}AP*qGIh|/)Ou6FpKBv`(ub!YTiefMZXsEcGS]}ZiB' );
define( 'NONCE_SALT',       '^Mv^ta1SsE,41;M~>tJkY v.=ve`!(-v{;%@ar )QSrH:Xb@W@8ViE7 &%>NMJ0a' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );