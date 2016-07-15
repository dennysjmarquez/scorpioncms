<?php
	

	function get_uri(){
		
		global $Query;
		$siteurl = get_config("siteurl");
		return $siteurl.'/admin';
	}
	
	function GetTitle_Admin(){
		
		global $Globals;
		
		return $Globals->get('title');
		
	}
	
	function get_template_directory_uri_admin($value = false){
		
		global $Query;
		
		$siteurl = get_config("siteurl");
		
		if($value){
			
			return $siteurl . "/admin/modules/templates/index/assets";
			
		}elseif($value == false){

			echo $siteurl . "/admin/modules/templates/index/assets";		
		
		}
		
		
			
	}
	
	function menu($value = null){
	
		global $registermu;
		$menu = "";
	
		if(strtoupper ($value) == "H"){
		
			echo $registermu->GetM("h");
		
		}elseif(strtoupper ($value) == "V"){
		
			echo $registermu->GetM("v");
		}else{
		
			return;
		}
	
		echo $menu;

	}