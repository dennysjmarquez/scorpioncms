<?php

	$utilities = new utilities();
	$ajax_popup = array('ajax_popup_modal');
	$ajax_popup = $utilities->get_post_values($ajax_popup);

	if(!$ajax_popup['valid']){
		
		$Globals->add("ajax_popup_modal", true);
	
	}

	// carga el controlador //
	load(admin . DS . 'modules' . DS . 'controllers' .  DS . 'c.'. $controller.'.php');
	
	/// carga el modulo ///
	
	if (null == $modulo){

		load(admin . DS . 'modules' . DS . 'models' . DS . 'm.'. $controller . '.php');

	}elseif(null !== $modulo){

		load(admin . DS . 'modules' . DS . 'models' . DS . 'm.' . $controller . '.' . $modulo . '.php');
		
	
	}
	
	
	
	/// carga la vista ///
	
	if ($modulo && $controller){
		
		/* carga la vista del modulo */
		load(admin . DS . 'modules' . DS . 'views' . DS . 'v.'. $controller . '.' . $modulo.'.php', true);
	
	}elseif($controller){
		
		/* carga las vistas de los sub modulos como en un iframe */
		load(admin . DS . 'modules' . DS .'views'. DS .'v.'.$controller.'.php', true);
				
	}