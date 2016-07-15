<?php

/* 
	Aquí se registran los menús del admin predeterminados y dinámicos 
	al igual que las URL dinámicas, lo dinámico quiere decir
	que no está escrita de forma predeterminada esto sirve para 
	el futuro que se creen pluging u otras cosas sin tocar el 
	Sistema en si :)

*/

class RegisterMU {
	
	private $menusV = array();
	private $menusH = array();
	
	public function __construct(){
		
		global $QueryAdmin;
		
		
		// Menu Horizontal

		$this->menusH[lang_s("_dashboard", true)] = array("name" => lang_s("_dashboard",true), "link" => get_config('siteurl').'/admin/', "menu_active" => "index");
		
		$this->menusH[lang_s("_posts", true)]['sub-menu'][] = array("name" => lang_s("all_posts", true), "link" => get_config('siteurl').'/admin/'.get_config("suf_post").'/', "menu_active" => "post");
		$this->menusH[lang_s("_posts", true)]['sub-menu'][] = array("name" => lang_s("add_Post", true), "link" => get_config('siteurl').'/admin/'.get_config("suf_post").'/add/', "menu_active" => "post-add");
		
		$this->menusH[lang_s("_categories", true)]['sub-menu'][] = array("name" => lang_s("all_categories", true), "link" => get_config('siteurl').'/admin/'.get_config("suf_category").'/', "menu_active" => "categorias");
		$this->menusH[lang_s("_categories", true)]['sub-menu'][] = array("name" => lang_s("add_category", true), "link" => get_config('siteurl').'/admin/'.get_config("suf_category").'/add/', "menu_active" => "categorias-add");
		
		// Fin Menu Horizontal


		// Menu Vertical	

		$menuV["name"] = lang_s("_dashboard",true);
		$menuV["icon"] = "fa fa-dashboard";
		$menuV["link"] = get_config('siteurl').'/admin/';
		$menuV["menu_active"] = "index";
		
		$this->menusV[] = $menuV;
		
		$menuV = null;
		
		$menuV["name"] = lang_s("_content", true);
		$menuV["icon"] = "fa fa-edit";
		$menuV["link"] = null;
		$menuV["menu_active"] = null;


			$mp[] = array("name" => lang_s("all_posts", true), "icon" =>"fa fa-circle-o", "link" => get_config('siteurl').'/admin/'.get_config("suf_post").'/', "menu_active" => "post");
			$mp[] = array("name" => lang_s("add_post", true), "icon" =>"fa fa-circle-o", "link" => get_config('siteurl').'/admin/'.get_config("suf_post").'/add/', "menu_active" => "post-add");
			$menuV["children"][] = array("name" => lang_s("_posts", true), "icon" =>"fa fa-circle-o", "link" =>"", "menu_active" =>null, "children" => $mp);

			$mc[] = array("name" => lang_s("all_categories", true), "icon" =>"fa fa-circle-o", "link" => get_config('siteurl').'/admin/'.get_config("suf_category").'/', "menu_active" => "categorias");
			$mc[] = array("name" => lang_s("add_category", true), "icon" =>"fa fa-circle-o", "link" => get_config('siteurl').'/admin/'.get_config("suf_category").'/add/', "menu_active" => "categorias-add");
				
			$menuV["children"][] = array("name" => lang_s("_categories", true), "icon" =>"fa fa-circle-o", "link" =>"", "menu_active" =>null, "children" => $mc);
		
		
		
		$this->menusV[] = $menuV;
		
		$menuV = null;
		
		$menuV["name"] = lang_s("_appearance", true);
		$menuV["icon"] = "fa fa-paint-brush";
		$menuV["link"] = null;
		$menuV["menu_active"] = null;
		$menuV["children"][] = array("name" => lang_s("_themes", true), "icon" =>"fa fa-circle-o", "link" => get_config('siteurl').'/admin/themes/', "menu_active" => "themes");
		
		$this->menusV[] = $menuV;
		
		$menuV = null;
		
		$menuV["name"] = lang_s("_media", true);
		$menuV["icon"] = "glyphicon glyphicon-folder-open";
		$menuV["link"] = get_config('siteurl').'/admin/media/';
		$menuV["menu_active"] = "media";
		
		$this->menusV[] = $menuV;
		
		$menuV = null;
		
		$menuV["name"] = lang_s("_CONFIGURATION", true);
		$menuV["icon"] = "fa fa-cog";
		$menuV["link"] = null;
		$menuV["menu_active"] = null;
		$menuV["children"][] = array("name" => lang_s("GLOBAL_CONFIGURATION", true), "icon" =>"fa fa-circle-o", "link" => get_config('siteurl').'/admin/options/general/', "menu_active" => "options-general");
		
		$this->menusV[] = $menuV;
		
		
		
		// Fin menu Vertical

	
	}
	
	private function buildMenuH(){
		
		global $Globals;
		extract($Globals->GetAll());

		$menu = '';
		
		foreach ($this->menusH as $clave =>$file){
		
			if(array_key_exists('sub-menu', $file)){
		
				$menu .= '<li class="dropdown">';
				$menu .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
				$menu .= $clave;
				$menu .= '<span class="caret"></span>';
				$menu .= '</a>';		
		
				$menu .= '<ul class="dropdown-menu" role="menu">';
				$i=0;
		
				while ( count($file['sub-menu'])-1 >= $i ) {
					
					$active = ($menu_active == $file['sub-menu'][$i]['menu_active']) ? ' class="active"' : '';
					$menu .= '<li'.$active.'><a href="'.$file['sub-menu'][$i]['link'].'" title="'.$file['sub-menu'][$i]['name'].'">'.$file['sub-menu'][$i]['name'].'</a></li>';
					++$i;
					
				}
		
				$menu .= '</ul></li>';
	
			}else{
				
				$active = ($menu_active == $file['menu_active']) ? ' class="active"' : '';
				$menu .= '<li'.$active.'><a href="'.$file['link'].'" title="'.$file['name'].'">'.$file['name'].'</a></li>';
	
			}
		
		}		
		
		return $menu;
		
	}
	
	
	private function buildMenuV($menu_array = null) {
		
		global $Globals;
		extract($Globals->GetAll());
		
		$menu = '';
		
		$menu_array = ($menu_array == null) ? $this->menusV : $menu_array;
		  
		foreach($menu_array as $clave) {

			
			$active = ($menu_active == $clave['menu_active'] && $menu_active !== null) ? ' class="sub-active"' : ' class=""';
			
			
			$menu .= '<li'.$active.'>';
			$menu .= '<a href="'.$clave["link"].'">';
			
			$menu .= '<i class="'.$clave["icon"].'"></i>';
			$menu .= '<span>'.$clave["name"].'</span>';
			$menu .= (array_key_exists('children', $clave)) ? '<i class="fa fa-angle-left pull-right"></i>' : '';
			$menu .= '</a>';
			
			if(array_key_exists('children', $clave)) {
				
				$menu .= '<ul class="treeview-menu">';
				
				$menu .= $this->buildMenuV($clave['children']);
				$menu .= '</ul>';
			
			}
			
			$menu .= '</li>';
		
		}
		
		return $menu;
	}
	
	public function add_Menus($name, $link, $titulo, $keybase){
		
		if(array_key_exists($keybase, $this->menu)){
		
		}else{
			
			return false;
			
		}
		
	}
	
	public function GetM($value = null){
		
		if(strtoupper ($value) == "H"){
		
			return $this->buildMenuH();
		
		}elseif(strtoupper ($value) == "V"){
			
			return $this->buildMenuV();
			
		}else{
			
			return;
			
		}
		
	}
	
	public function add_URL(){return null;}

	public function GetU(){return null;}
	
}