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
define('DB_NAME', 'demodb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[9wwuf-EV~8t<qrL6(]~Ud8gZK=<sn{X`Yi!*bn?a*X]=3CUgn*M7[ec-_n^5_nb');
define('SECURE_AUTH_KEY',  '_oA6#*79}ABQYWh(?!!k|XlA18U~ns45KDjVDa>z@A9[!:O}*S,zPhF$bn+<k%KW');
define('LOGGED_IN_KEY',    'E  fjpVX5c})dX7N1*]W{eW#|8Sb)kk1_7X{ayNJVvG9~fa&y__TGC-Okhl| gHc');
define('NONCE_KEY',        ')&`PEe?mKi4@<@hN]7~!.&(k|(*YCn$M;$Gr-fRC]y~ yT>3:59. 1L>4A 0}C_x');
define('AUTH_SALT',        'S^_TJA9IgExzMY>@8@h{eQKk5=~4rs1^9!maQv(-iTG_/;1_%;oz%/ uR>.xg?Zh');
define('SECURE_AUTH_SALT', '_nceGYvXDPpX@>C|MW9$> (F?2O{<k]lM*lL_E`{[HF3=V7ZpA,}gZmx#Ws_Vcpy');
define('LOGGED_IN_SALT',   'OEhrq*e;BE:dZs.qEB=Oc1rVob;%=D;D=?[}h_}OZKf ~P{U4%aWfpjK97fMZ-TZ');
define('NONCE_SALT',       '1G]Ky1k1z]khm_763HZWIH{#/U`tx<)tdl;`to+pV2r(vBg_qH70Z#qOrmV6FGk`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'demo_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
