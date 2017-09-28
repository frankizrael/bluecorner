<?php
ini_set("include_path", '/home/seekdev/php:' . ini_get("include_path") );
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'seekdev_bluewp');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'seekdev_frank');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'frank2017root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'l,&(UI}b&gefZi<C?5sB#& ,*edUFt3pg[eBD7OA3/+!]Kqhr5z%$w;>Ym. ]B5{');
define('SECURE_AUTH_KEY', 'I~;1]d7SY-BQCjV?abA6GK$pA$JUTOHB@1?HztzW.yWSX1z)pwz=BQXE3ajcj(1q');
define('LOGGED_IN_KEY', 'ZR_nx`D]L=AvKic/ar}]r6Bm{rjsi4i+<#d#6y3]#uI,Uj;NbE<S3*]+(evU yra');
define('NONCE_KEY', ']6Xw-ix@%bd>83*K!xRvg[4{YnL0&iiVKe}.w)4gr#XvNWJH)=g?ioB5MTB,.l+n');
define('AUTH_SALT', 'a{OI%[P5u49(^C>[hH8_Qt6]I;+.]EuFFr 6W.HfttHv6[nM]6jI`R<9{I9KrMZp');
define('SECURE_AUTH_SALT', '`Vy*..{7mfgvutS&LiWJ@,6)t^xEb95z2kf6`ut#N~X`b!{BRaH^ab):Q,O*[Xvv');
define('LOGGED_IN_SALT', 'mL6s`Cv<~;S/V KkNx>kHK{Z1Cci_pD*wL(m;Uzr+~e!<}L57S<jipM!rpr@>F*{');
define('NONCE_SALT', 'pOYZHABF%g).c9bb:<I1ymC)bg5w H Y0gYrfIlyx-]khEcl!OF [C=v+i#;;qDJ');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

