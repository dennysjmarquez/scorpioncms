<?php

/***
 *       _____  _____ ____  _____  _____ _____ ____  _   _     _____ __  __  _____ 
 *      / ____|/ ____/ __ \|  __ \|  __ \_   _/ __ \| \ | |   / ____|  \/  |/ ____|
 *     | (___ | |   | |  | | |__) | |__) || || |  | |  \| |  | |    | \  / | (___  
 *      \___ \| |   | |  | |  _  /|  ___/ | || |  | | . ` |  | |    | |\/| |\___ \ 
 *      ____) | |___| |__| | | \ \| |    _| || |__| | |\  |  | |____| |  | |____) |
 *     |_____/ \_____\____/|_|  \_\_|   |_____\____/|_| \_|   \_____|_|  |_|_____/ 
 *                                                                                 
 *   	Dennys José Márquez Reyes                                                                              
 *		email: dennysjmarquez@gmail.com
 *		linkedin: https://ve.linkedin.com/in/dennysjmarquez
 */

global $Cache, $Query, $lang;

/* para composer */
require('vendor/autoload.php');
	
/* carga los defines y el config de la db */
require( dirname( __FILE__ ) . '/settings.php' );

/* Carga la configuracion de la db */
$configDB = require( BASEDIR . 'config.php' );

/* carga las funciones a la db y conecta */
require( BASEDIR . INCLUDEDIR . DS .'db.php' );

/* Carga la clase GLOBALS del script */
require( BASEDIR . INCLUDEDIR . DS .'globals.php' );
$GLOBALS['Globals'] = new Globals();


/* Carga las Configuraciones del script que estan en la DB */
require( BASEDIR . INCLUDEDIR . DS .'configsite.php' );
$GLOBALS['ConfigSite'] = new ConfigSite();

/* carga class para menejo de los lenguajes */
require( BASEDIR . INCLUDEDIR . DS .'classlang.php' );

/* carga el query par info de la db*/

require( BASEDIR . INCLUDEDIR . DS . 'query.php' );
$Query = new Query();

/* carga las class de los lenguajes */
$lang = new lang();


/* carga las funciones generales */
require( BASEDIR . INCLUDEDIR . DS .'function.php' );
require( BASEDIR . INCLUDEDIR . DS .'cacheurl.php' );


require( BASEDIR . INCLUDEDIR . DS . 'router.php' );

/* carga la class corel y la class cache */
require( BASEDIR . INCLUDEDIR . DS .'corel.php' );
$Cache = new Cache();
$GLOBALS['Corel'] = new Corel();
