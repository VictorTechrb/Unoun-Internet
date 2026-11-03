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
define( 'AUTH_KEY',          ':y_P0t-)I3P@GeO;f~;wjO]lNhj g3:!ygd,SxqP/+}3]Yo=+Uh+Wa>D~E/oJ}G,' );
define( 'SECURE_AUTH_KEY',   '.0+Q}^a,.>*`02I@3qO!dMzSU=5o/&>!rJO`u%{O<m}HqryVU,Lq&<R[l`X|#ru~' );
define( 'LOGGED_IN_KEY',     'w3x?-+5##D1n{4oGRLJ%]4Y=M$*]QY6FTA(s<J@v <,E{dWb&ynf=TXL(>1*OB>6' );
define( 'NONCE_KEY',         'Z&megIXO3siR/Z=%JO~JqN0cR}R]fEu)4g@c>nLiIUx&Cp#Der 1vODiiO{[+=#%' );
define( 'AUTH_SALT',         't5Rd,8M4qv2*~P+/8a:}S!i3PDT4x DH@KeylI8}i:XS|s}~?:,v;R*Z6[/{Z?M3' );
define( 'SECURE_AUTH_SALT',  '9+8{3+_`fcywW4*`V=5Gv1IAs-n{+RmQ_=D}J,0}U0J+0k/wX1 rP2qd-|2MCT7W' );
define( 'LOGGED_IN_SALT',    'P[4@<Ece_A:1IR#yP7@3N?>pEv_EyBc3w3.G)gRB3u^IQ,iShp-ZfWsO)?;**q8q' );
define( 'NONCE_SALT',        '4eSQE&zl_![VACT0$GG~BkzEX8::7b:,JB.); _k2eRUy4v>manl !;XWwj~K(Y9' );
define( 'WP_CACHE_KEY_SALT', 'M@lXI,sJ+j^Hrj&Gv9(&ze:_$~T:q:j<R00-u2b:eXK^;BnKZ,3#Yd>V}A[j:b[^' );


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
