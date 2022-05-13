<?php

require( admin . DS . INCLUDEDIR . DS . 'utilities.php');

	$GLOBALS['utilities'] = new utilities();

require( admin . DS . INCLUDEDIR . DS . 'queryadmin.php');

	$GLOBALS['QueryAdmin'] = new QueryAdmin();

require(admin . DS . INCLUDEDIR . DS . 'dbtree.class.php');
require(admin . DS . INCLUDEDIR . DS . 'dbtreeext.class.php');

	$GLOBALS['Tree'] = new DbTreeExt();

require( admin . DS . INCLUDEDIR . DS .'mediamanager.php' );

	$GLOBALS['MediaManager'] = new MediaManager();
	$GLOBALS['MediaManager']->storage = 'storage';
