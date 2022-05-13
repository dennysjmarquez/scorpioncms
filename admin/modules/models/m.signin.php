<?php

	if(!isset($_SESSION)){session_start();}
	
	$router = new router;
	global $utilities;
	
	if(strtoupper($router->getMethod()) === "POST"){
		
		$utilities = new utilities();
		$value = array('login','password', 'token', 'session_key');
		$getv = $utilities->get_post_values($value);
		$Globals->add("getv", $getv);
							
			if($getv['valid']){
								
				if (isset($_SESSION['token']) && $getv['fields']['token'] == $_SESSION['token']){
									
					$tokentime = time() - $_SESSION['token_time'];
									
					if($tokentime < 25){
					
						$AuthManager = new AuthManager();
						$validoUser = $AuthManager->login($getv['fields']['login'], $getv['fields']['password']);
						
						if($validoUser){
							
							if(isset($_SESSION['backURL']) && !empty($_SESSION['backURL'])){
								
								$backURL = empty($_SESSION['backURL']) ? '/' : $_SESSION['backURL'];
								unset($_SESSION['backURL']);	
								redirect($backURL, false, null, null);
							
							}else{
								
								global $Query;
								redirect(get_config("siteurl")."/admin/", false, null, null);
								
							}
							
						}else{
							
							if ($AuthManager->ErrCode == 1){

								$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!',  'msg'=> lang_s("USER_PASSWORD_NOT MATCH", true) . '.'];
								$Globals->add("msg", $msg);
								$Globals->add("session_key", $utilities->randomsal());
								$token = $utilities->randomsal();
								$Globals->add("token", $token);
								$_SESSION['token'] = $token;
								$_SESSION['token_time'] = time();								
								
							}elseif ($AuthManager->ErrCode == 2){

								$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=>lang_s("USER_NOT_FOUND", true) . '.'];
								$Globals->add("msg", $msg);
								$Globals->add("session_key", $utilities->randomsal());
								$token = $utilities->randomsal();
								$Globals->add("token", $token);
								$_SESSION['token'] = $token;
								$_SESSION['token_time'] = time();
								
							}
							
						}
										
					}else{
											
						$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> lang_s("EXPIRED_TOKEN", true) . '.'];
						$Globals->add("msg", $msg);
						$Globals->add("session_key", $utilities->randomsal());
						$token = $utilities->randomsal();
						$Globals->add("token", $token);
						$_SESSION['token'] = $token;
						$_SESSION['token_time'] = time();
											
					}
										
				}elseif(isset($_SESSION['token']) && $getv['fields']['token'] !== $_SESSION['token']){
					
					$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> lang_s("INVALID_TOKEN",true) . '.'];
					$Globals->add("msg", $msg);
					$Globals->add("session_key", $utilities->randomsal());
					$token = $utilities->randomsal();
					$Globals->add("token", $token);
					$_SESSION['token'] = $token;
					$_SESSION['token_time'] = time();
									
				}
								
			}else{
				
				$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> str_replace("%text%", lang_s($getv['notValidFields'][0] . '_PLACEHOLDER', true), lang_s("FIELD_IS_REQUIRED", true)) . '.'];
				$Globals->add("msg", $msg);
				$Globals->add("session_key", $utilities->randomsal());
				$token = $utilities->randomsal();
				$Globals->add("token", $token);
				$_SESSION['token'] = $token;
				$_SESSION['token_time'] = time();
							
			}
							
	}else{

		$utilities = new utilities();
		$Globals->add("session_key", $utilities->randomsal());
		$token = $utilities->randomsal();
		$Globals->add("token", $token);
		$Globals->add("getv", null);
		$_SESSION['token'] = $token;
		$_SESSION['token_time'] = time();
		
	}