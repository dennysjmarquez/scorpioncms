<?php

global $QueryAdmin, $CorelAdmin, $themes;
$Globals->add("title", lang_s('THEME_OPTIONS', true));
$Globals->add("menu_active", $controller);

if(isset($action) && $themes->check_exists_theme($action)){

$theme_lang_install = get_lang_installer_theme($action);
$theme_lang	= '';

if(!$theme_lang_install) redirect(get_config("siteurl").'/admin/'. $controller . '/', false, null, null);	




	if($theme_lang_install){
			
		foreach ($theme_lang_install as $key){
	
			$selected = ($key['tag'] == GetCurrLang('TLANG')) ? ' selected="selected"' : '';
			
			$theme_lang .= '<option'.$selected.' value='.$key['tag'].' >'.$key['name'].'</option>'."\n";
				
		}
		
	}



// Solapa General (Tab)  //	

$general = [

	'theme_lang' => $theme_lang

		];



/// fin solapa site //

$optios_input = [
	
	'general' => $general,

				];

$Globals->add("optios_input", $optios_input);



$router = new router();
if(strtoupper($router->getMethod()) === "POST"){

	$utilities = new utilities();

	$values = array(
						
			'theme-lang'
						
						);
	
	$inputs = $utilities->get_post_values($values);

$data_config_general[] = [

	'name' => 'TLANG',
	'value' => $inputs['values']['theme-lang']

];


foreach ($data_config_general as $key) {
		
		$ins_array = [ 
			
			'value'	=> $key['value']
							
				 ];
										
		$loop[] = [
		
		"action" => 'update',
		"table"	 => 'config',
		"type"	 => null,
		"field_id"	=> 'name',
		"where" 	=> $key['name'],
		"sql"	 => $ins_array
			
			  ];		
			  
		
		
	}
	
	$QueryAdmin->SetQuery($loop);
	
	redirect(get_config("siteurl").'/admin/'. $controller . '/', false, null, null);

}

	
return;	
}

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;