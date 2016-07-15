	<?php
	
	
	if ($modulo && $controller){
		
			/* carga la vista del modulo */
			load(admin . DS . 'modules' . DS . 'views' . DS . 'v.'. $controller . '.' . $modulo.'.php', true);
	
	}else if($controller){

		if(null !== $controller && $template == "parent_index"){
		
			/* carga las vistas de los sub modulos como en un iframe */
			load(admin . DS . 'modules' . DS .'views'. DS .'v.'.$controller.'.php', true);
		
		}	
		
	}
	
	
	?>