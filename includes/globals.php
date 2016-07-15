<?php

class Globals {
	
	private $values = array();
	
	public function Add($name, $value){
	
		$this->values[$name] = $value;
		
	} public function GetAll(){
		
		return $this->values;
	
	} public function Get($name){
		
		if( array_key_exists($name, $this->values) ){
				
			return $this->values[$name];
			
		}else{
			
			return null;
			
		}  
		
	}
	
}