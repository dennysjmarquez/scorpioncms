<?php

require( BASEDIR . INCLUDEDIR . DS .'authmanager.php' );

require( admin . DS . INCLUDEDIR . DS . 'function-theme.php' );
require( admin . DS . INCLUDEDIR . DS .'themesadmin.php' );

require( BASEDIR . INCLUDEDIR . DS . 'theme.php' );

require( admin . DS . INCLUDEDIR . DS . 'function.php');
require( admin . DS . 'coreladmin.php');


$GLOBALS['themes'] = new ThemesAdmin();
$GLOBALS['themes_front'] = new themes();

require( admin . DS . INCLUDEDIR . DS .'registermu.php' );
$GLOBALS['registermu'] = new RegisterMU();

$GLOBALS['CorelAdmin'] = new CorelAdmin();