<?php

	if(!isset($_SESSION)){session_start();}

	if(isset($_COOKIE[KeyAuth])){

		unset($_COOKIE[KeyAuth]);
		setcookie(KeyAuth, null, -1, '/');
		
	}
	
	session_destroy();
	
	redirect(get_config("siteurl")."/admin/auth/signin/", false, null, null);
