<?php

class utilities {

	public function randomsal($length = 42) {
        
		if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length * 2);

            if ($bytes === false)
                throw new RuntimeException('Unable to generate a random string');

            return substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    
	} public function get_post_values($requiredFields){
       
	   $formData['values'] = array();
	   $formData = array();
       $formData['valid'] = true;

		for($a = 0; $a < count($requiredFields); $a++){
			
			$field = $requiredFields[$a];
			   
			$formData['values'][$field] = isset($_POST[$field]) ? $_POST[$field] : '';
			   
			if(isset($_POST[$field])){
			
				$value = $_POST[$field];
			
				if(empty($value)){
                
					$formData['valid'] = false;
                    $formData['notValidFields'][] = $field;
                    
				}else{
					
					if (is_array($value)){
					
						$value = array_map('trim',$value);
						$value = array_map('stripslashes',$value);
						$value = array_map('htmlspecialchars',$value);
						$formData['fields'][$field] = $value;
						
					}else{
						
						$value = trim($value);
						$value = stripslashes($value);
						$value = htmlspecialchars($value);
						$formData['fields'][$field] = $value;
					
					}

                }

			}else{
                     
				$formData['valid'] = false;
				$formData['notValidFields'][] = $field;
               
			}

		}

		return $formData;
	   
	} public function validateUrl($value) {
	
		return filter_var($value, FILTER_VALIDATE_URL) !== false;
	
	} 
	
}