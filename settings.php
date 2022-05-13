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
 
define( 'INCLUDEDIR', 'includes' );
define( 'DS', DIRECTORY_SEPARATOR );
define( 'BASEDIR', dirname(__FILE__) . DIRECTORY_SEPARATOR );

define('KeyAuth', 'escorpio_auth');

/* se especifica en minutos porque se multiplica este valor por 60 segundos OK */
define('KeyAuthExpire', (24*30));

/* constantes para la fecha */
define( 'MINUTE_IN_SECONDS', 60 );
define( 'HOUR_IN_SECONDS',   60 * MINUTE_IN_SECONDS );
define( 'DAY_IN_SECONDS',    24 * HOUR_IN_SECONDS   );
define( 'WEEK_IN_SECONDS',    7 * DAY_IN_SECONDS    );
define( 'YEAR_IN_SECONDS',  365 * DAY_IN_SECONDS    );