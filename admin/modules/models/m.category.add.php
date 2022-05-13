<?php

global $CorelAdmin, $QueryAdmin, $Tree;

$Globals->add("title", lang_s('ADD_CATEGORY', true));
$Globals->add("menu_active", $controller.'-'.$modulo);

	$data = [
				
		'category_name' 	=> '',
		'category_slug'		=> '',
		'category_parent'	=> ''
				
			];


	$router = new router();

	if(strtoupper($router->getMethod()) === "POST"){
	
		$id_parent = -1;
		$utilities = new utilities();
	
		$values = array(
						
			'category-name', 
			'category-slug', 
			'category-parent'
						
						);
	
		$inputs = $utilities->get_post_values($values);
	
		if ($inputs['values']['category-name'] === ''){
			
			$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> str_replace("%text%", lang_s('_NAME', true), lang_s("FIELD_IS_REQUIRED", true))];
			$Globals->add("msg", $msg);
		
		}elseif($inputs['values']['category-parent'] === '' && (int)$inputs['values']['category-parent'] !== -1){
			
			$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> str_replace("%text%", 'category-parent', lang_s("FIELD_IS_REQUIRED", true))];
			$Globals->add("msg", $msg);
							
		}elseif($inputs['values']['category-name'] !== '' ){
			
			$result = $Tree->checkExitsName('categories', $id_parent, $inputs['values']['category-name']);
			
			if($result){
				
				$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> lang_s('CATEGORY_EXISTS_IN_PARENT', true)];
				$Globals->add("msg", $msg);
				
			}else{
				
				$slug = (checkSlug($inputs['values']['category-slug'])) ? $inputs['values']['category-slug'] : makeSlugs($inputs['values']['category-name']);
				
				$array = [
					
					'slug' => $slug,
					'name' => $inputs['values']['category-name']
					
				
				];
				
				
				$id_parent = (int)  $inputs['values']['category-parent'];
				
				$category_id = $Tree->insert('categories', $id_parent, $array);
				
				redirect(get_config("siteurl").'/admin/'. get_config('suf_category') .'/edit/'. $category_id .'/', false, null, null);
				
			}
			
			
			
		}

			$slug = (checkSlug($inputs['values']['category-slug'])) ? $inputs['values']['category-slug'] : makeSlugs($inputs['values']['category-name']);
			
			$data = [
				
				'category_name' 	=> $inputs['values']['category-name'],
				'category_slug'		=> $slug,
				'category_parent'	=> $id_parent
				
					];
	
	
	}
	
	
		$Globals->add("cate", $data);
		
	
		$script_and_style = '<link rel="stylesheet" href="'.get_template_directory_uri_admin(true).'/css/select2.min.css">';
		$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/select2.full.min.js"></script>';
		
		$script_footer .= '<script type="text/javascript">


			$("#category-parent").select2({
				width: "100%"
			});

			</script>';	
		
		/*  saca las categorias para los parent */
		
		$cates = $Tree->Full('categories',null , false, true);
		
	
		$catsehtml = '<option value="-1" >'.lang_s('_NONE',true).'</option>'."\n";
			
		if($cates){
			
			foreach ($cates as $vars){
				
				$selected = (isset($id_parent)) ? (((int)$vars['id'] === (int)$id_parent) ? ' selected="selected"' : '') : '';
				
				$name = (($vars['level'] - 1 ) > 0) ? str_repeat('&#160;&#160;&#160;', ($vars['level'] - 1)) . $vars['name'] : "".$vars['name'];
				$catsehtml .= '<option'.$selected.' value='.$vars['id'].' >'.$name.'</option>'."\n";
				
			}
		
		}
		
			
		/*  fin de las categorias para los parent */
		
		$Globals->add("catsehtml", $catsehtml);
		$Globals->add("script_and_style", $script_and_style);
		$Globals->add("script_footer", $script_footer);
		
		