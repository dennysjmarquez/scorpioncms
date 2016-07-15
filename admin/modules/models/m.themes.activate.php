<?php

global $QueryAdmin, $CorelAdmin, $themes;
$Globals->add("title", null);
$Globals->add("menu_active", null);

if(isset($action) && $themes->check_exists_theme($action)){
		
	$ins_array1 = [ 
			
		'value'	=> 'themes' . '/' . $action
							
				];
		
	$ins_array2 = [ 
			
		'value'	=> $action
							
				 ];				 
										
	$loop[] = [
		
		"action" => 'update',
		"table"	 => 'config',
		"type"	 => null,
		"field_id"	=> 'name',
		"where" 	=> 'theme_root',
		"sql"	 => $ins_array1
			
			  ];		
			  
	$loop[] = [
		
		"action" => 'update',
		"table"	 => 'config',
		"type"	 => null,
		"field_id"	=> 'name',
		"where" 	=> 'current_theme',
		"sql"	 => $ins_array2
			
			  ];
			  
		
		$QueryAdmin->SetQuery($loop);	
	

	redirect(get_config("siteurl").'/admin/'.$controller.'/', false, null, null);	

}

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;