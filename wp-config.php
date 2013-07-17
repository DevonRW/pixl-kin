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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pixlKin');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'A03xH>3g)F([*3{Mi&U=g9h<`cI)i67U`Uf}7gonDV=4+@a*<`jg&%_9vyCoq7p*');
define('SECURE_AUTH_KEY',  'R:^ ^Sxq-QH,OJ<JfhHWixl!E7jx1/Y=HRR]Eh@As-q;/VZC}#r=ongI^Wnrt&!u');
define('LOGGED_IN_KEY',    'b<iuI2?M#Mu|SmIA*e$|5?`%+!4b#mL%yP&q0[7cuGrNV&#^x4nZ-G.=,YEL]:dX');
define('NONCE_KEY',        'hd,T7Zkz9NWT9p<Ikb1%d`ls%hlzAMY}|aeh[bKJB!GScZ`QViiz8X{,3D2;MFU!');
define('AUTH_SALT',        'AxsMCvb@+PtAZF4;a<159@H0^b-KekJ2GiU1b-W|O%&3K]FiDp-i%E?12M$6y1H=');
define('SECURE_AUTH_SALT', ']1zy0fk60XU@1(4EBcsRx~fV.)R@>qRV{{@ppGc45[3[-pm7VP-,PoUSO#)G[(*z');
define('LOGGED_IN_SALT',   ')8>,Bek}1TF19W!ci.Fyuci7`RXTV(8qv{(U;h7B.:|5*`Ht/3ileRyBR>_ufcI{');
define('NONCE_SALT',       'OGh30!<XYMsQs{QJ2(U|XQI:}hmxkaLHz=$/rt])x|keR.9ut7Cu},|)`xh/;Fw&');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to Canadian English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * en_CA.mo to wp-content/languages and set WPLANG to 'en_CA' to enable Canadian
 * English language support.
 */
define('WPLANG', 'en_CA');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
