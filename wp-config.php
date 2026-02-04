<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_main' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'admin123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );


define('FS_METHOD', 'direct'); 


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
define( 'AUTH_KEY',         'g9{5{_#MIf:N(Q+4 RVNKlmU`<ttU6uZd-;!0Z7vS%>qulxtZ3bm :LPB95AVF~0' );
define( 'SECURE_AUTH_KEY',  '`C(IXS%pn/Iyi&q =nkZ}7E~^Hah<CF_V.0C>p]Yzb*.],1@,[g2m/$.Vuvu*1ii' );
define( 'LOGGED_IN_KEY',    '(HfLlXI/2D; i17MB+L#6aB)XE0nk!@YohlY2.Wlmq8?{,Kt2c3$A[ZMu~gVl~T;' );
define( 'NONCE_KEY',        'FVYK-AEUg/+x|XY:ZFYy5 ?{SHfNz?A,9soG2B$i#=-=J}:gJ-WW45B8e`5j5rt-' );
define( 'AUTH_SALT',        't`Wy/=Jugy)S}XTd2|)>4#eC4VK20_iVo+mgsj_fE:HTtwrH$]45Jy^V&z0)[[:r' );
define( 'SECURE_AUTH_SALT', 'pR lz}^z`JqFE%!0gE HE1@QD7=R|O9<tR4Y8}.:$6}_-<V GL)/?JFCZ*Vvt<,D' );
define( 'LOGGED_IN_SALT',   '6HUB{bB[4#RO;Ml%*%x0G?9]L)6~3ynSm$aX<+:9O(n;|!.UGR LF=2TR[t-uv.R' );
define( 'NONCE_SALT',       'us[Sw:_n-9+]-tJ8,P_Ak!k%ziz}{}:QidU5E?3qxf_QzA}hggu{@3(:2g%BOP.;' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wpmain_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
