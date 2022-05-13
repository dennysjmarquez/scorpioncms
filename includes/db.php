<?php

global $dbh;
use Doctrine\DBAL\Cache\QueryCacheProfile;

$config = new \Doctrine\DBAL\Configuration();



$connections = $configDB["connections"];
$default = $configDB["default"];
$connection = $connections[$default];
$dbh = \Doctrine\DBAL\DriverManager::getConnection($connection, $config);


/*  

	Esto de aquí abajo es un posible para cachear la DB en archivos en el disco Duro 
	
	A desarrollar en un futuro :)
 

*/

/*
$sth = $dbh->query("SELECT * FROM post");
$lifetime = 1800;
$cache = new \Doctrine\Common\Cache\FilesystemCache(__DIR__ . "\post");
new QueryCacheProfile($lifetime, "", $cache);
$tabla1 = $sth->fetchAll();
$sth->closeCursor();



if ($cache->contains('SELECT * FROM post')) {
    echo 'cache exists';
} else {
    echo 'cache does not exist';
	$cache->save('SELECT * FROM wp_posts', $tabla1, 0);
}

$ggg =  $cache->getDirectory();
echo $ggg;

deleteDir($ggg);

function deleteDir($path) {
    return is_file($path) ?
            @unlink($path) :
            array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
}


var_dump($tabla1);

var_dump($cache);
*/
?>