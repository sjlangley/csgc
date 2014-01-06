<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define ('DISABLE_WP_CRON', 'true');
define ('WP_CACHE', false);

$in_production = false;

if (strpos($_SERVER["SERVER_NAME"], "localhost") !== false) {
  define('DB_NAME', 'cscg_blog');
  define('DB_HOST', ':/opt/local/var/run/mysql55/mysqld.sock');
} else {
  define('DB_NAME', 'cscg_blog');
  define('DISALLOW_FILE_MODS', 'true');
  $in_production = true;
}

/** MySQL database username */
define('DB_USER', 'gscg_user');
define('DB_PASSWORD', 'h@ckerz!37737');

if (!defined('DB_HOST')) {
  define('DB_HOST', ':/cloudsql/langleyclan.com:socgolf:socgolf');
}
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '(oy&/Aw On&+:CMxrd7L-ecR%Ip~sKtYNV/KrLjaahtpw.%2d5cG}Yk72 r5*8UZ');
define('SECURE_AUTH_KEY',  '.f}k_0H;&xmM2%w]`EN.i|(X 5:pg!49:ijLnMQp,Za:KI-1|s~3@@a8.SHr!n]$');
define('LOGGED_IN_KEY',    ',^$hCZztP<U/1yXi_6 33%@Vg=KL+vMw9>p[*g~6.*P[7r`8:3DLzNK${BOw JZ ');
define('NONCE_KEY',        'zD:M[LKE[(,*@z-TBp@) !inU{HtP+J?+3Aq|_=mB|Ow !oByJK-|8-Pq:=#V./I');
define('AUTH_SALT',        'WCB2c3cXd7FMTbdp]w9.)C@-)3*AZAz@#z8)5J JTV^r[4r}A -&kGUqUg/&4}i>');
define('SECURE_AUTH_SALT', '[}4t9o:oB$FBDj[yN98;<+:>FRDT}`FI n9Su_2R21%{B;JkxFFr6+$W:O[*m<|M');
define('LOGGED_IN_SALT',   '_4o(k,3`4#x-{h*-i}SvOk1)p9i}-niErAynp2}Qsl^)Sh<ezlzt!PhgKqr0{bsI');
define('NONCE_SALT',       'qhJ*7zB4(L#anKQH0CF%Z*<Ybq[iIuvo]Dr$B!ss67xf~[Bvg4.W/:jaX_~+^Z:y');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

$batcache = [
    'seconds' => 0,
    'times' => 0,
    'debug' => !$in_production,
    'max_age' => 60 * 30,
];

/* That's
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
