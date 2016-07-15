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

return [


  /* aqui se seleciona el motor que es predeterminado */  
  'default' => 'mysql',

  
  
  
	/*  aqui los motores y se usa y configura mysql */
	
    'connections' => [

        'sqlite' => [
            'driver'   => 'pdo_sqlite',
            'dbname' => 'storage/database.sqlite',
        ],

        'mysql' => [
            'driver'    => 'pdo_mysql',
            'host'      => 'localhost',
            'port'      => 3306,
            'dbname'  => 'scorpioncms',
            'user'  => 'root',
            'password'  => '',
            'charset'   => 'utf8'
        ],

        'pgsql' => [
            'driver'   => 'pdo_pgsql',
            'host'     => 'localhost',
            'port'     => '',
            'dbname' => 'ejemplotablas',
            'user' => 'root',
            'password' => ''
        ],

        'sqlsrv' => [
            'driver'   => 'pdo_sqlsrv',
            'host'     => 'localhost',
            'port'     => '',
            'dbname' => 'dbname',
            'user' => 'root',
            'password' => ''
        ],

    ]

];