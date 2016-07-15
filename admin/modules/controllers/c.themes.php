<?php

global $Globals, $CorelAdmin;
$Globals->add("controller_title", lang_s('_THEMES', true));

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