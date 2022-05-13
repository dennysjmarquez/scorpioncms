<?php

global $MediaManager;
$Globals->add("MediaManager", $MediaManager);

	$ajax_popup_modal = isset($ajax_popup_modal) ? true : false;

	$router = new router();
	
	
	if(strtoupper($router->getMethod()) === "POST"){
	
		$utilities = new utilities();
		$action = array('action');
		$action = $utilities->get_post_values($action);
		
		$types_files = array('types_files');
		$types_files = $utilities->get_post_values($types_files);
		
		if($types_files['valid']){
			
			$MediaManager->filter($types_files['fields']['types_files']);

		}else{
				
			exit;
				
		}
		
		if(!$action['valid']){
			
			$MediaManager->Load('/');
			
		}else{
		
			switch ($action['fields']['action']) {
            
				case 'opendir':
					
					$utilities = new utilities();
					$value = array('open_dir');
					$open_dir = $utilities->get_post_values($value);
					
					if(!$open_dir['valid']) {

						$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> str_replace("%text%", $open_dir['notValidFields'][0], lang_s("FIELD_IS_REQUIRED", true))];
						$Globals->add("msg", $msg);

					
					}else{
						
						$MediaManager->Load($open_dir['fields']['open_dir']);
						
					}
					
					break;
				
				case 'makedir':
					
					$utilities = new utilities();
					$values = array('current_path', 'name_dir');
					$values = $utilities->get_post_values($values);
					
					if(!$values['valid']) {
						
						$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> str_replace("%text%", $values['notValidFields'][0], lang_s("FIELD_IS_REQUIRED", true))];
						$Globals->add("msg", $msg);
						
						if($ajax === true) ajaxMsg(str_replace("%text%", $values['notValidFields'][0], lang_s("FIELD_IS_REQUIRED", true)));
					
					}else{
						
						$dir = $values['fields']['current_path'];
						$name = $values['fields']['name_dir'];
						
						$result = $MediaManager->makedir($dir, $name);
						
						if(null !== $result) {
							
							$msg = ['type'=> 'danger', 'title'=> lang_s("MSG_TITLE_ALERT", true).'!', 'msg'=> $result];
							$Globals->add("msg", $msg);
							if($ajax === true) ajaxMsg($result);
						
						}
						
						$MediaManager->Load($dir);
						
					}					
					
					break;
			
			}
		
		
		}
	
	}else{
	
		$MediaManager->Load('/');
		
	}

$script_footer .= '	
	<template id="new-folder-template">

		<div class="modal-header">
            <button type="button" class="close" data-dismiss="popup">&times;</button>
            <h4 class="modal-title">'.lang_s('NEW_FOLDER', true).'</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>'.lang_s('FOLDER_NAME', true).'</label>
                <input type="text" class="form-control" id="name-folder" name="name-folder" value="" />
            </div>
        </div>
        <div class="modal-footer">
            <button
                type="button"
                class="btn btn-primary"
				data-dismiss="create-folder">
                '.lang_s('_OK', true).'</button>
            <button
                type="button"
                class="btn btn-default"
                data-dismiss="popup">
                '.lang_s('_CANCEL', true).'</button>
        </div>
    
</template>';
	
	$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/popup.js"></script>';

	
	if(!$ajax_popup_modal){
		$script_footer .= '<script type="text/javascript" src="'.get_template_directory_uri_admin(true).'/js/mediamanager.js"></script>'."\n";
	}



//$Globals->add("script_and_style", $script_and_style);
$Globals->add("script_footer", $script_footer);