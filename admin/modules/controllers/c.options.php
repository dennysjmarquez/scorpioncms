<?php

global $CorelAdmin;

if ($modulo && $controller){

	if(!is_file(admin . DS . 'modules' . DS . 'models' . DS . 'm.'. $controller . '.' . $modulo.'.php')){
		
		$CorelAdmin->set_404();
		$CorelAdmin->themesG->GetThemes(true);
		exit;
	
	}
	
}elseif($controller){
	
	if(!is_file(admin . DS . 'modules' . DS . 'models' . DS . 'm.'. $controller . '.php')){
		
		$CorelAdmin->set_404();
		$CorelAdmin->themesG->GetThemes(true);
		exit;
	
	}	
	
}

