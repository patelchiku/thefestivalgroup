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
define( 'DB_HOST', '127.0.0.1:10011' );

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
define( 'AUTH_KEY',          'k@CeBf7q:-Kk&8%J&[j?;.#YT:|b`S?asybC5CU5u:-br{&o1**f<z:x+U/-(R67' );
define( 'SECURE_AUTH_KEY',   '/oG7HHVVfnn?:Y[pQ@<o[4L+yZt}<VV0gWHUlrgrl{l3;!V)3^-]G91 p(?B[%@Y' );
define( 'LOGGED_IN_KEY',     '52F}pkcj_ToyPkcx {m;ol7(t@KAOzamNo==,8oe :7Tfr7=m]cIo#=G6;9ATBt ' );
define( 'NONCE_KEY',         'wWN[l0!Pj8~3;CfC){[V=;Z_p)3m4@4CiTpY(Q!YwC#Tf{HUL#zB+o!;(v(FfWF5' );
define( 'AUTH_SALT',         'cnJUeS:;c3iGpteu-]%74W8WVaB)1[o&;}Mq.)E`LCH<G]9gFY&1c,U6}md[0>D(' );
define( 'SECURE_AUTH_SALT',  '0FYD1BJ(v+E#$P1iPNL%2=vM9c7?)y!w7S326b$D/AKp3Y9[Fq)lA8EE,vrOS/sw' );
define( 'LOGGED_IN_SALT',    'Tjo7K3ECv.17<Q!$J]LBMdL_-S!<w9L8|@1_0Ho^c6|s@B#smUt2L&RUiH4ycWg~' );
define( 'NONCE_SALT',        'p=HT UUyI`{A^obA9`tc Z6z/.vsp^#]aRTGEbS!Ya3}P~UEx>Bg(q:rAq^K?]QV' );
define( 'WP_CACHE_KEY_SALT', 'WN%zk*VKDi&<~?1RL],JE[p|T5r)RH=v(@!oq{s<fOuG^79SayPmMC>3bRdBkbE1' );


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
ini_set( 'display_errors', '0' );
error_reporting( E_ERROR | E_PARSE );

define( 'WP_ENVIRONMENT_TYPE', 'local' );
define( 'WP_MEMORY_LIMIT', '512M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
