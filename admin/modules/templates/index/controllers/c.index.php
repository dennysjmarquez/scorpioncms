<?php

$Globals->add("controller_title", lang_s('_ADMINISTRATOR', true));
	
	/* carrga el controlador si existe */
	load(admin . DS . 'modules' . DS . 'controllers' .  DS . 'c.'.$controller.'.php');
	/* carrga el modulo del index y sub modulos */
	load(admin . DS . 'modules' . DS .'templates'. DS .'index'. DS .'models' . DS .'m.index.php');
	/* carrga la vista y sub vistas */
	load(admin . DS . 'modules' . DS .'templates'. DS .'index'. DS .'views' . DS . 'v.index.php', true);
	