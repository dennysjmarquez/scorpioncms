<?php

global $Tree, $QueryAdmin;
$Globals->add("title", lang_s('ADD_POST', true	));
$Globals->add("menu_active", $controller.'-'.$modulo);
$Globals->add("Tree", $Tree);
$full = $Tree->Full('categories',null, false);
$cate_root_id = $Tree->get_root_node('categories')['id'];
$Globals->add("full", $full);
$Globals->add("cate_root_id", $cate_root_id);

	$router = new router();

	if(strtoupper($router->getMethod()) === "POST"){
	
		$utilities = new utilities();
		$loop = null;
	
		$values = array(
						
			'post_title', 
			'post-slug', 
			'post_type', 
			'post_status', 
			'post-content', 
			'post_category',
			'featured_image_new'
					
					);
	
		$inputs = $utilities->get_post_values($values);
		
		if ($inputs['values']['post_title'] === '' && $inputs['values']['post-slug'] === ''){
							
			$slug = makeSlugs('not title');
							
		}elseif ($inputs['values']['post_title'] !== '' && $inputs['values']['post-slug'] === ''){
							
			$slug = makeSlugs($inputs['values']['post_title']);
							
		}elseif ($inputs['values']['post-slug'] !== ''){
							
			$slug = (checkSlug($inputs['values']['post-slug'])) ? $inputs['values']['post-slug'] : makeSlugs($inputs['values']['post-slug']);

		}

		$slug = $QueryAdmin->SlugExist($slug, null);

		$ins_array = null;
		
		$tile = ($inputs['values']['post_title']) ? $inputs['values']['post_title'] : $slug;
		
		$ins_array = [ 
							
			'title' 		=> trim($tile),
			'name'			=> $slug,
			'post_type'		=> $inputs['values']['post_type'],
			'status'		=> $inputs['values']['post_status'],
			'content'		=> minify_html($inputs['values']['post-content']),
			'category_id'	=> $inputs['values']['post_category'],
			'date'			=> current_time('mysql2'),
			'author_id'		=> (int)$QueryAdmin->get_user()['id']
							
					];		
	
		$loop[] = [
		
			"action" => 'insert',
			"table"	 => 'post',
			"type"	 => null,
			"sql"	 => $ins_array
			
				  ];

		
		$return = $QueryAdmin->SetQuery($loop);
		
		$post_id =  $return['table']['post']['lastInsertId'];
		
		$loop = null;				  
				  
	
		if ($inputs['values']['featured_image_new'] !== '') {
						 
			$ins_array = [ 
							 	
				'post_id'	=> $post_id,
				'name'		=> '_attached_image',
				'value'		=> $inputs['values']['featured_image_new']
							
						 ];
						
			$loop[] = [
		
				"action" => 'insert',
				"table"	 => 'postmeta',
				"type"	 => null,
				"sql"	 => $ins_array
			
					  ];
		
		}
	
	
		/// los tag ///
		
		$values = array('tags');
		$tags = $utilities->get_post_values($values);	
		
		if($tags['values']['tags'] === '') $tags['fields']['tags'] = array();
						
		$tag_check = tag_check(array(), $tags['fields']['tags']);
		
		if(array_key_exists('add', $tag_check) && !is_null($tag_check['add'])){
		
		
			$tags_add = $tag_check['add'];
									
			foreach ($tags_add as $key => $value) {
										
					$ins_array = [ 
											
						'taxonomy'	=> 'post_tag',
						'object_id'	=> $post_id,
						'name'		=> $value
											
			     				 ];
										
					$loop[] = [
		
						"action" => 'insert',
						"table"	 => null,
						"type"	 => 'relation',
						"sql"	 => $ins_array
			
							  ];
										
			}
									
		}
		
		$return = $QueryAdmin->SetQuery($loop);
		
		/// fin de los tag ///
	
		redirect(get_config("siteurl").'/admin/'.get_config('suf_post').'/edit/'.$post_id.'/', false, null, null);
	
	}




	$script_and_style = '<link rel="stylesheet" href="'.get_template_directory_uri_admin(true).'/css/select2.min.css">';
	$script_footer = '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/ckeditor/ckeditor.js"></script>';
	$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/select2.full.min.js"></script>';
	$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/popup.js"></script>';
	$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/mediamanager-insertt.js"></script>';

	$script_footer .= '<script type="text/javascript">

			CKEDITOR.config.title = false;
		
			
		
			var dd = CKEDITOR.replace( "post-content", {
				contentsCss : [ "'.get_template_directory_uri_admin(true).'/css/style.css'.'","'.get_template_directory_uri(true).'/css/bootstrap.css'.'","'.get_template_directory_uri(true).'/css/style.css'.'" ],
				language: "' . GetCurrLang('SYSLANG') . '"
				
			} );
			

			$(".post_status").select2({minimumResultsForSearch: Infinity});

			$("#tags").select2({
				tags: "true",
				dropdownCssClass: "no-dropdown",
				containerCssClass: "no-dropdown",
				tokenSeparators: [",", " "],
				allowClear:true,
				placeholder: ""
			
			});

			function format(icon) {
			
				var originalOption = icon.element;
				var d1 = $("<i class=\'fa " + $(originalOption).data("icon") + "\' style=\'width: 20px; font-size: 20px; margin-right: 7px;\'></i>")		
				var d2 = $("<span />").text(icon.text)
				var $icon = $("<div />").append(d1).append(d2);
				return $icon;			
			}

			$(".post_type").select2({
				width: "100%",
				templateResult: format,
				templateSelection: format,
				minimumResultsForSearch: Infinity	
			});

			</script>';
			
			$Globals->add("script_and_style", $script_and_style);
			$Globals->add("script_footer", $script_footer);
			