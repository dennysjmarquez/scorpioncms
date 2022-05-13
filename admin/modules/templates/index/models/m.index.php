<?php

if ($controller !== "index" && null == $modulo){

	load(admin . DS . 'modules' . DS . 'models' . DS . 'm.'. $controller . '.php');

}elseif($controller !== "index" && null !== $modulo){
	
	load(admin . DS . 'modules' . DS . 'models' . DS . 'm.' . $controller . '.' . $modulo . '.php');
	
}else{
	
	$Globals->add("title", "Panel de control");
	$Globals->add("menu_active", $controller);
	
}