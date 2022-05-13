<?php
global $QueryAdmin, $CorelAdmin;
$Globals->add("title", lang_s("delete_this_post", true));
$Globals->add("menu_active", null);

if(isset($action) && is_numeric($action) && $QueryAdmin->GetPostsSingle($action)){
			
	/*

		Aqui los del post Where id = 1 ajemplo 
				
		y puede tener multiples condiciones
				
		Where id = 1 and lala = 2 ejemplo
				
		se agrega en el array de abaja ok ;)
				
			
	*/
			
	$ins_array = [ 
							 	
		'id'	=> $action
							
				];
						
	$loop[] = [
		
		"action" => 'deleted',
		"table"	 => 'post',
		"type"	 => null,
		"sql"	 => $ins_array
			
			  ];
			
	// tag //
			
			
	$tag = $QueryAdmin->get_tag();
			
	if($tag){
			
		foreach ($tag as $vars){
					
			$ins_array = [ 
											
				'taxonomy'	=> 'post_tag',
				'object_id'	=> $action,
				'name'		=> $vars['name']
											
						 ];
										
			$loop[] = [
		
				"action" => 'deleted',
				"table"	 => null,
				"type"	 => 'relation',
				"sql"	 => $ins_array
			
					  ];		
					
			
		}
			
			
	}
			
	// fin tag //
			
	$ins_array = [ 
							 	
		'post_id'	=> $action
							
				];
						
	$loop[] = [
		
		"action" => 'deleted',
		"table"	 => 'postmeta',
		"type"	 => null,
		"sql"	 => $ins_array
			
			  ];			
					  
			
	$QueryAdmin->SetQuery($loop);
			
	redirect(get_config("siteurl").'/admin/'.get_config('suf_post').'/', false, null, null);
	
}

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;