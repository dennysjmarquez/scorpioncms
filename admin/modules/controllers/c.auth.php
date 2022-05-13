<?php

$AuthManager = new AuthManager();

if($action !== null) {
	
	$this->is_404 = true;
	$themes = new themesAdmin(true);
	$themes->GetThemes();						
	exit;
	
}

if($AuthManager->check_is_login() && $modulo !== "signout") {
								
	global $Query;
	redirect(get_config("siteurl")."/admin/", false, null, null);

	
}elseif($modulo == null){
	
	global $Query;
	redirect(get_config("siteurl")."/admin/auth/signin/", false, null, null);

	
}
		
		
	/* carga el models si existe */
	load(admin . DS . 'modules' . DS . 'models' . DS . 'm.'.$modulo.'.php');
	/* carga la vista de la platilla si existe */
	load(admin . DS . 'modules' . DS . 'views' . DS . 'v.'.$modulo.'.php', true);


