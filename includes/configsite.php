<?php

function get_config($value){
	
	global $ConfigSite;
	
	return $ConfigSite->get_config($value);
	
}

class ConfigSite {
	
	private $items = array();
	
	public function __construct() {
	
		$this->Cargar();
	
	}
	
	private function Cargar(){
		
		global $dbh;
				
		$result = $dbh->prepare("SELECT `name`, `value` FROM `config`");
		$result->execute();
		$result = $result->fetchall();
			
		foreach ($result as $key){
			
			$this->items[$key['name']] = $key['value'];		
				
		}

	}	
	
	public function get_config($value){
	
		if(null == $value) return;

		if(array_key_exists($value, $this->items)){
			
			return $this->items[$value];
		
		}else{
			
			return;
		}

	}
	
	
}