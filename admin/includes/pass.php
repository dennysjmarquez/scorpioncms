<?php


$options = array('cost' => 10);
$hash = password_hash("demo", PASSWORD_BCRYPT, $options)."\n";

echo $hash;
$hash = '$2y$10$6vlfeIvRd68vrUFzDmb93ue80jf3emkATLGQgFzSX0r/T8rBo1vKO';


if( password_verify('demo', $hash)){
	echo "ok";
}else{
	echo "no";
}