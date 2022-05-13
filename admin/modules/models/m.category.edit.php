<?php

global $CorelAdmin, $QueryAdmin, $Tree;

$Globals->add("title", lang_s("EDIT_CATEGORY", true));
$Globals->add("menu_active", null);
$root_cate = $Tree->get_root_node('categories');
$cate = $Tree->get_single_to_id('categories', $action);

if(isset($action) && is_numeric($action) && $cate){

	$router = new router();

	if(strtoupper($router->getMethod()) === "POST"){
			
		$utilities = new utilities();
		
		$values = array(
				
			'category-parent-tree', 
			'category-slug',
			'category-name',
			'parent_id'
				
					   );
			
		$inputs = $utilities->get_post_values($values);
			
		if(
			
			$inputs['valid'] || 
			$inputs['values']['category-name'] !== '' &&
			$inputs['values']['parent_id'] !== '' &&
			is_numeric($inputs['values']['parent_id']) ||
			$inputs['values']['category-slug'] === ''
			
		){
				
				
			$slug = (checkSlug($inputs['values']['category-slug'])) ? $inputs['values']['category-slug'] : makeSlugs($inputs['values']['category-name']);

			if((int)$inputs['values']['parent_id'] !== (int)$inputs['values']['category-parent-tree']){
				
				$Tree->MoveAll('categories', (int)$action, (int)$inputs['values']['category-parent-tree']);
				
			}
			
			$loop = null;
			
				
				$ins_array = [ 
			
					'name'	=> $inputs['values']['category-name'],
					'slug'	=> $slug
							
							];
				
						
			$loop[] = [
		
				"action" => 'update',
				"table"	 => 'categories',
				"type"	 => null,
				"field_id"	=> 'id',
				"where" 	=> (int)$action,
				"sql"	 => $ins_array
			
					];			
			
			$QueryAdmin->SetQuery($loop);
				
			redirect(get_config("siteurl").'/admin/'. get_config('suf_category') .'/', false, null, null);

				
		}elseif(is_numeric($inputs['values']['parent_id']) && $inputs['values']['parent_id'] !== '' ){
				
			$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> str_replace("%text%", lang_s('_NAME', true), lang_s("FIELD_IS_REQUIRED", true))];
			$Globals->add("msg", $msg);
				
		}
			


	}
		
	$Globals->add("cate", $cate[0]);
		
	$script_and_style = '<link rel="stylesheet" href="'.get_template_directory_uri_admin(true).'/css/select2.min.css">';
	$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/select2.full.min.js"></script>';
		
	$script_footer .= '<script type="text/javascript">

			$("#category-parent-tree").select2({
				width: "100%"
			});

			</script>';
			
	/*  saca las categorias */
			
	
	$parent_id =  $Tree->GetParent('categories', $action);
			
	$cates = null;
			
	if( (int)$action !== (int)$root_cate) {
		$cates = $Tree->Full('categories',null , false, true);
	}
			
	$catsehtml = '<option value="-1" >'.lang_s('_NONE',true).'</option>'."\n";
			
	if($cates){
				
		foreach ($cates as $vars){
					
			if( (int)$vars['id'] !== (int)$action) {

				$selected = ((int)$vars['id'] === (int)$parent_id) ? ' selected' : '';
				$name = (($vars['level'] - 1 ) > 0) ? str_repeat('&#160;&#160;&#160;', ($vars['level'] - 1)) . $vars['name'] : "".$vars['name'];
				$catsehtml .= '<option'.$selected.' value='.$vars['id'].' >'.$name.'</option>'."\n";
					
			}
				
		}
			
	}
			
	/*  fin de las categorias  */ 			
	
	$cate_root_id = $Tree->get_root_node('categories')['id'];
	$Globals->add("cate_root_id", $cate_root_id);
	$Globals->add("parent_id", $parent_id);
	$Globals->add("category_id", $action);
	$Globals->add("catsehtml", $catsehtml);
	$Globals->add("script_and_style", $script_and_style);
	$Globals->add("script_footer", $script_footer);
	return;
	
}

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;
