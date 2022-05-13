<?php
global $CorelAdmin, $QueryAdmin, $Tree;

if(isset($action) && is_numeric($action)){
		
	$Globals->add("modulo", null);
	$Globals->add("menu_active", $controller);
	$full = $Tree->Full('categories', $action);
	$cate_root_id = $Tree->get_root_node('categories')['id'];
	
	$Globals->add("cate_root_id", $cate_root_id);
	$Globals->add("full", $full);
	$Globals->add("Tree", $Tree);
	if($full) return;
		
}

	$CorelAdmin->set_404();
	$CorelAdmin->themesG->GetThemes(true);
	exit;
