<?php
global $CorelAdmin, $QueryAdmin;

if(isset($action) && is_numeric($action)){
		
	$Globals->add("modulo", null);
	$Globals->add("menu_active", $controller);

	if($QueryAdmin->GetPost($action, 'post')) return;
	
}

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;