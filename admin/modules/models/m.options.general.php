<?php

global $QueryAdmin, $CorelAdmin;

if($action){

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;
	
}

$Globals->add("title", lang_s('GENERAL_SETTINGS', true	));
$Globals->add("menu_active", $controller.'-'.$modulo);

$router = new router();	

if(strtoupper($router->getMethod()) === "POST"){
	
	$utilities = new utilities();
	
	$values = array(
						
			'site-name', 
			'site-description', 
			'site-lang'
						
						);
	
	$inputs = $utilities->get_post_values($values);
	
	$install_lang = get_lang_installer();
	$site_lang	= '';
	
	
	
	if($install_lang){
			
		foreach ($install_lang as $key){
    
			$selected = ($inputs['values']['site-lang'] == GetCurrLang('SYSLANG')) ? ' selected="selected"' : '';
			$site_lang .= '<option'.$selected.' value='.$key['tag'].' >'.$key['name'].'</option>'."\n";
				
		}
		
	}

// Solapa Site (Tab)  //	

$site = [

	'site_name' => $inputs['values']['site-name'],
	'site_description' => $inputs['values']['site-description'],
	'site_lang' => $site_lang

		];

		
$data_config_site[] = [

	'name' => 'sitename',
	'value' => $inputs['values']['site-name']

];

$data_config_site[] = [

	'name' => 'site_description',
	'value' => $inputs['values']['site-description']

];

$data_config_site[] = [

	'name' => 'SYSLANG',
	'value' => $inputs['values']['site-lang']

];


/// fin solapa site ///	

	foreach ($data_config_site as $key) {
		
		
		
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
	
	redirect(get_config("siteurl").'/admin/'. $controller . '/'. $modulo .'/', false, null, null);
	
	
}else{


$install_lang = get_lang_installer();
$site_lang	= '';
	if($install_lang){
			
		foreach ($install_lang as $key){
    
			$selected = ($key['tag'] == GetCurrLang('SYSLANG')) ? ' selected="selected"' : '';
			$site_lang .= '<option'.$selected.' value='.$key['tag'].' >'.$key['name'].'</option>'."\n";
				
		}
		
	}

// Solapa Site (Tab)  //	

$site = [

	'site_name' => get_config("sitename"),
	'site_description' => get_config("site_description"),
	'site_lang' => $site_lang

		];



/// fin solapa site ///		
	
}


	
	
$optios_input = [
	
	'site' => $site,

				];

$Globals->add("optios_input", $optios_input);

	$script_and_style = '<link rel="stylesheet" href="'.get_template_directory_uri_admin(true).'/css/select2.min.css">' . "\n";
	$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/select2.full.min.js"></script>' . "\n";

	$script_footer .= '<script type="text/javascript">
			
			$("#site-lang").select2({
				width: "100%",
				minimumResultsForSearch: Infinity	
			});

			</script>'."\n";
			
$Globals->add("script_and_style", $script_and_style);
$Globals->add("script_footer", $script_footer);
			
	
