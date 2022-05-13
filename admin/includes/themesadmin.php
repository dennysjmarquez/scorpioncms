<?php

class themesAdmin {
	
	private function get_404_template(){
		
		$folder = get_config("theme_root");
		$cargar = BASEDIR . $folder .DS;
		
		if (file_exists( $cargar . 'functions.php' )){
		
			require($cargar . 'functions.php');
		
		}
		
		require($cargar . '404.php');
		
		
	}

	public function GetThemes(){
	
		global $CorelAdmin;
		
		if( $CorelAdmin->is_404() ) {
		
			$this->get_404_template();
			
		}

	}
	
	public function check_exists_theme($value){
		
		return file_exists('./themes/'.$value.'/'.$value.'Details.xml') ? true : false;
		
	}
	
	public function themes_installer(){
		
		$flags = FilesystemIterator::SKIP_DOTS;
		
		$dir = new FilesystemIterator('./themes/', $flags);
		$current_theme = get_config('current_theme');
		
		// primero el theme activo :) //
		
		$xml_lang_info = @simplexml_load_file('./themes/' . $current_theme . '/' . $current_theme . 'Details.xml');
		
		if (file_exists('./themes/' . $current_theme . '/' . $current_theme . 'Preview.png')){
					
			$themepreview = get_config("siteurl") . '/themes/'. $current_theme .'/'. $current_theme . 'Preview.png';
					
		}else{
					
			$themepreview = get_config("siteurl") . '/admin/modules/templates/index/assets/images/admin-theme-none-preview.png';
					
		}		
		
		$themes_install[] = [
				
			'name' => $xml_lang_info->name,
			'tag' => $current_theme,
			'description' => $xml_lang_info->description,
			'author' => $xml_lang_info->author,
			'authorUrl' => $xml_lang_info->authorUrl,
			'themepreview' => $themepreview,
			'version' => $xml_lang_info->version,
			'active' => true
					
							];
					
					
		///
		
		foreach ($dir as $dirInfo) {
			
			if ($dirInfo->isDir()){
				//defaultDetails
				
				if (
					
					file_exists($dirInfo->getPath() .'/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . 'Details.xml')
					&& is_dir($dirInfo->getPath() .'/'. $dirInfo->getFilename())){
				
				
					if (strtolower($current_theme) !== strtolower($dirInfo->getFilename())) {
				
						$xml_lang_info = @simplexml_load_file($dirInfo->getPath() .'/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . 'Details.xml');
				
						if (file_exists($dirInfo->getPath() .'/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . 'Preview.png')){
					
							$themepreview = get_config("siteurl") . '/themes/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . 'Preview.png';
					
						}else{
					
							$themepreview = get_config("siteurl") . '/admin/modules/templates/index/assets/images/admin-theme-none-preview.png';
					
						}
				
						$themes_install[] = [
				
							'name' => $xml_lang_info->name,
							'tag' => $dirInfo->getFilename(),
							'description' => $xml_lang_info->description,
							'author' => $xml_lang_info->author,
							'authorUrl' => $xml_lang_info->authorUrl,
							'themepreview' => $themepreview,
							'version' => $xml_lang_info->version,
							'active' => false
					
											];
				
					}
				
				}
			
			}
				
		}
	
			
		return $themes_install;		
		
		
	}	
	
}	