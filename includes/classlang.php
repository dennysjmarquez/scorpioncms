<?php

	function lang_s($value, $return = false){
		
		global $lang;
		return $lang->_s($value, $return);
	}
	
	function lang_t($value, $return = false ){
		
		global $lang;
		return $lang->_t($value, $return);
	
	}

	function GetCurrLang($value = null){
		
		global $lang;
		return $lang->GetCurrLang($value);
		
	}	
	
	function get_lang_installer(){
		
		global $lang;
		return $lang->get_lang_installer();
	
	}
	
	function get_lang_installer_theme($value = null){
		
		global $lang;
		return $lang->get_lang_installer_theme($value);
	
	}	

class Lang {

	private $systemkeys = null;
	private $themekeys = null;
	private $SYSLANG;
	private $TLANG;
	
	public function __construct() {
		
		$this->SYSLANG = ($this->SYSLANG) ? $this->SYSLANG : get_config("SYSLANG");
		$this->TLANG = ($this->TLANG) ? $this->TLANG : get_config("TLANG");
		
	}
	
	public function GetCurrLang($value = null){
	
		if($value === null) return;
		
		if(strtolower($value) === 'tlang'){
		
			return $this->TLANG;
		
		}elseif(strtolower($value) === 'syslang'){
			
			return $this->SYSLANG;
			
		}
		
		return;
	
	}

	private function add($file = null, $control = null, $lang = null){

		if(null !== $control){

			if($control == "s"){

				$this->systemkeys[$lang] = require($file);

			}else if($control == "t"){

				$this->themekeys = require($file);

			}

		}

	}

	public function _t($value, $return = false){
		
		if(null === $this->themekeys){
		
			global $Query;
			$ThemelangFolder = get_config("theme_root");
			
			$file = BASEDIR .  $ThemelangFolder .DS . 'lang' . DS . $this->TLANG . DS . $this->TLANG .  '.php';
			
			if (file_exists( $file )){
			
				$this->add($file, 't');	
			
			}else{
				
				return $value;
				
			}
			
			
			if($return){
				
				return $this->check_lang($value, null, 't');
				
			}else if($return === false){
			
				echo $this->check_lang($value, null, 't');
				
			}
			
			
		}else{
			
			
			if($return){
				
				return $this->check_lang($value, null, 't');
				
			}else if($return === false){
			
				echo $this->check_lang($value, null, 't');
				
			}
			
			
		}

	}
	
	private function check_lang($value, $lang, $control){

		if($control === 's'){
	
			if(array_key_exists(strtolower($value), array_change_key_case($this->systemkeys[$lang]))){

				return array_change_key_case($this->systemkeys[$lang])[strtolower($value)];
				
			}else{
				
				return $value;
			
			}
		
		}elseif($control === 't'){
			
			if(array_key_exists(strtolower($value), array_change_key_case($this->themekeys))){
				
				return array_change_key_case($this->themekeys)[strtolower($value)];
					
			}else{
					
				return $value;
			
			}
			
		}
		
	}
	
	public function _s($value, $return = false){
		
		global $Corel;
		$lang = (!$Corel->is_admin()) ? $this->TLANG : $this->SYSLANG;
		
		if(null === $this->systemkeys){
			
			$file = BASEDIR . 'lang' . DS . 'lang_system' . DS . $lang . DS . $lang .  '.php';
			
			if (file_exists( $file )){
			
				$this->add($file, 's' , $lang);
				
				if($return){
				
					return $this->check_lang($value, $lang, 's');
				
				}else if($return === false){
			
					echo $this->check_lang($value, $lang, 's');
				
				}				
			
			}else{
				
				if($return){
				
					return $value;
				
				}elseif($return === false){
					
					echo $value;
					
				}
				
			}
			

			
		}else{
			
			if($return){
				
				return $this->check_lang($value, $lang, 's');
				
			}else if($return === false){
			
				echo $this->check_lang($value, $lang, 's');
				
			}
			
		}

	}
	
	public function get_lang_installer_theme($value){
		
		if(null === $value || !file_exists('./themes/' . $value . '/lang/') ) return false;
		
		$flags = FilesystemIterator::SKIP_DOTS;
		$lang_theme_install = [];
		$dir = new FilesystemIterator('./themes/' . $value . '/lang/' , $flags);
		
		foreach ($dir as $dirInfo) {
			
			if ($dirInfo->isDir()){
			
				if (
					
					file_exists($dirInfo->getPath() .'/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . '.xml')
					&& is_dir($dirInfo->getPath() .'/'. $dirInfo->getFilename())){
					
					$xml_lang_info = simplexml_load_file	($dirInfo->getPath() .'/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . '.xml');
				
					$lang_theme_install[] = [
				
						'name' => $xml_lang_info->name,
						'tag' => $xml_lang_info->tag
					
						];

					
					
					}
			
			
			}
			
		}
		
		return $lang_theme_install;
		
	}
	
	public function get_lang_installer(){
		
		$flags = FilesystemIterator::SKIP_DOTS;
		$lang_install = [];
		$dir = new FilesystemIterator('./lang/lang_system/', $flags);
		
		foreach ($dir as $dirInfo) {
			
			if ($dirInfo->isDir()){
				
				if (
					
					file_exists($dirInfo->getPath() .'/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . '.xml')
					&& is_dir($dirInfo->getPath() .'/'. $dirInfo->getFilename())){
				
				
					$xml_lang_info = simplexml_load_file	($dirInfo->getPath() .'/'. $dirInfo->getFilename().'/'.$dirInfo->getFilename() . '.xml');
				
					$lang_install[] = [
				
						'name' => $xml_lang_info->name,
						'tag' => $xml_lang_info->tag
					
						];
				
				}
			
			}
				
		}
	
			
		return $lang_install;
			
	}
	
}