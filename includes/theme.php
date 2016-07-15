<?php

class themes {
	
	public function __construct() {
	
		require( BASEDIR . INCLUDEDIR . DS . 'function-theme.php' );
	
	}

	private function get_front_page_template(){
		
		global $Cache;
		
		$folder = get_config("theme_root");
		$cargar = BASEDIR . $folder .DS;
		
		$theme_function = include_function_theme();
		
		if ($theme_function){
				
			require($theme_function);
			
		}
		
		require($cargar.'home.php');
		
		
		
	}
	
	private function get_404_template(){
		
		global $Query;
		
		$folder = get_config("theme_root");
		$cargar = BASEDIR . $folder .DS;
		
		if (file_exists( $cargar . 'functions.php' )){
		
			require($cargar . 'functions.php');
		
		}
		
		@require($cargar . '404.php');
		
		
	}
	
	private function get_single_template(){
		
		global $Query;
		
		$folder = get_config("theme_root");
		$cargar = BASEDIR . $folder .DS;
		
		if (file_exists( $cargar . 'functions.php' )){
		
			require($cargar . 'functions.php');
		
		}
		
		@require($cargar . 'single.php');		
		
		
	}

	public function GetThemes(){
		
		global $Corel;
		$template = false;
		
		if( $Corel->is_404() ) {
		
			$this->get_404_template();
		
		}else if ( $Corel->is_front_page() ){

			$this->get_front_page_template();
	
		}else if ( $Corel->is_single() ){
	
			$this->get_single_template();
	
		}
	
/*
		elseif ( is_search         && $template = get_search_template()         ) :
		
		elseif ( is_home           && $template = get_home_template()           ) :
		elseif ( is_post_type_archive && $template = get_post_type_archive_template() ) :
		elseif ( is_tax            && $template = get_taxonomy_template()       ) :
		elseif ( is_attachment     && $template = get_attachment_template()     ) :
		elseif ( is_single         && $template = get_single_template()         ) :
		elseif ( is_page           && $template = get_page_template()           ) :
		elseif ( is_category       && $template = get_category_template()       ) :
		elseif ( is_tag            && $template = get_tag_template()            ) :
		elseif ( is_author         && $template = get_author_template()         ) :
		elseif ( is_date           && $template = get_date_template()           ) :
		elseif ( is_archive        && $template = get_archive_template()        ) :
		elseif ( is_comments_popup && $template = get_comments_popup_template() ) :
		elseif ( is_paged          && $template = get_paged_template()          ) :
		else :
*/	
		//$template = get_index_template();
	
	
	
	}
	
}	