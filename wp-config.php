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
define( 'AUTH_KEY',          '[2N<3mvu$V/36mXor^Fp+QwV.b<6jUp-1+BCj{Xpk!BnN5Ac@qSBANOL?}Gv!znW' );
define( 'SECURE_AUTH_KEY',   'YdeUP8x#Dm)@NthWI7!Bw %>8vPU!HE}07Si[N&E`n#8^Sh&Skvk/Dk2QP5>2-g%' );
define( 'LOGGED_IN_KEY',     'riOuwjSE5;f#`0`&ly}q |C*81;vt&6+W6uL2LJl{9GnZ<1BEtkCTV0F}V:2S9=u' );
define( 'NONCE_KEY',         '8H!2e`Qt$;=U7@.4Mae9+>-K<#Y3v]x5t/6NoLtHdrF?33&!a8LO)gHUCq%<S#>_' );
define( 'AUTH_SALT',         '@MApzxM#6YU1$$iod[n*xoMizv3om>W><r9v?jcb*{MKE|M@:c8T<W])LEeo~`u7' );
define( 'SECURE_AUTH_SALT',  '}BSQPvb!RxK7!L(>}&6U;5W[ChHK$[E[Fl&_ !klZV!yReM~X(#mL!hnM~+idWm[' );
define( 'LOGGED_IN_SALT',    'A)y{c?Ic]{UBdA)aGX/R@Jmv&b=dD-:y0+Sr=zO~a-3S|*ZSlJ[DOQv<%8z.qofY' );
define( 'NONCE_SALT',        'jK;4}XXW}a[j<JhNf zmpi;ODdOe?Q1ITT>qy+8mtB!?YHQx9@cy$Vp1WU$& He,' );
define( 'WP_CACHE_KEY_SALT', 'K)G$Dk3q/lin}W61])>t$7sLLQnBsC:hhg&b9_p~l*AFr_Fy|:`9:Uly3R6`IOFL' );


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
