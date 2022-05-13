<?php

global $QueryAdmin, $CorelAdmin, $Tree;

$Globals->add("title", lang_s('DELETE_CATEGORY', true));
$Globals->add("menu_active", null);
$cate_root_id = $Tree->get_root_node('categories')['id'];

if(
	
	isset($action) && 
	is_numeric($action) && 
	$Tree->GetNode('categories', $action) && 
	(int)$cate_root_id !== (int)$action
	
	) {
	
	$ins_array = [ 
			
		'category_id'	=> (int)$Tree->get_root_node('categories')['id']
							
				 ];
						
	$loop[] = [
		
		"action" => 'update',
		"table"	 => 'post',
		"type"	 => null,
		"field_id"	=> 'category_id',
		"where" 	=> (int)$action,
		"sql"	 => $ins_array
			
			  ];
			  
	$Tree->Delete('categories', $action);
	$QueryAdmin->SetQuery($loop);
		
	redirect(get_config("siteurl").'/admin/'.get_config('suf_category').'/', false, null, null);

	return;

}

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;