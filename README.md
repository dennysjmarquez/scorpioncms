
       _____  _____ ____  _____  _____ _____ ____  _   _     _____ __  __  _____ 
      / ____|/ ____/ __ \|  __ \|  __ \_   _/ __ \| \ | |   / ____|  \/  |/ ____|
     | (___ | |   | |  | | |__) | |__) || || |  | |  \| |  | |    | \  / | (___  
      \___ \| |   | |  | |  _  /|  ___/ | || |  | | . ` |  | |    | |\/| |\___ \ 
      ____) | |___| |__| | | \ \| |    _| || |__| | |\  |  | |____| |  | |____) |
     |_____/ \_____\____/|_|  \_\_|   |_____\____/|_| \_|   \_____|_|  |_|_____/ 


Scorpion CMS-Blogger
====================

Demo: <http://www.scorpioncms.webdeveloperes.ml/>

Área del administrador: <http://www.scorpioncms.webdeveloperes.ml/admin/>

Instalación e instrucción
-------------------------

		A:
	
		
			------------------------------------------
			LA CONFIGURACION DE LA DB SE ENCUENTRA EN:
			------------------------------------------

			>>----->	config.php
   
			-----------------------------------------
		
		
		B:
		
		
			-----------------------------------------
			EL ARCHIVO A IMPORTAR EN PHPMYADMIN
			-----------------------------------------

				cambiar en la tabla "config" el valor
				de "siteurl" por la URL en que se
				va a instalar el Script
				
				NOTA: Borrar este archivo luego de ser
				usado por seguridad :)
		
			-----------------------------------------
		
			>>----->	scorpioncms.sql
				
			------------------------------------------
			
			
		C:
		
			-------------------------------------------
			EL USUARIO Y EL PASSWORD DEL ADMIN
			-------------------------------------------
				
				Usuario  : demo
				password : demo
    
				NOTA: En este archivo se puede generar
				un password diferente si así se
				necesitara
				
				córrase fuera del script :)
			
			-------------------------------------------
		
			>>----->	admin/includes/pass.php
		
			-------------------------------------------
			
			
		D:
		
		
			-------------------------------------------	
			LA URL DEL ADMINISTRADOR ES:
			-------------------------------------------
			
			/admin/
			
			-------------------------------------------
			
			
		E:
	
		
			------------------------------------------
			LA CONFIGURACION DE MOD_REWRITE:
			------------------------------------------
			
				NOTA:	En algunos hosting gratis hay problemas
				con los subdominios y el uso de sin www. 
				si es asi activar estas lineas
				
				## RewriteCond %{HTTPS} off
				## RewriteCond %{HTTP_HOST} !^www\.
				## RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [L,R=301]
				
				RewriteCond %{HTTPS} off
				RewriteCond %{HTTP_HOST} !^www\.
				RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [L,R=301]				

			-------------------------------------------			
			
			>>----->	.htaccess
   
			-----------------------------------------
		
