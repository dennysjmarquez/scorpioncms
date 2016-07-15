<?php

$Globals->add("controller_title", lang_s('_post', true));
$Globals->add("title", lang_s('all_posts',true));

if ($modulo && $controller){

	if(!is_file(admin . DS . 'modules' . DS . 'models' . DS . 'm.'. $controller . '.' . $modulo.'.php')){
		
		$CorelAdmin->set_404();
		$CorelAdmin->themesG->GetThemes(true);
		exit;
	
	}
	
}elseif($controller){
	
	if(!is_file(admin . DS . 'modules' . DS . 'models' . DS . 'm.'. $controller . '.php')){
		
		$CorelAdmin->set_404();
		$CorelAdmin->themesG->GetThemes(true);
		exit;
	
	}	
	
}

$script_and_style = '<link rel="stylesheet" href="'.get_template_directory_uri_admin(true).'/css/dataTables.bootstrap.css">';
$script_footer = '<script src="'.get_template_directory_uri_admin(true).'/js/jquery.dataTables.min.js"></script>
<script src="'.get_template_directory_uri_admin(true).'/js/dataTables.bootstrap.min.js"></script>
';

$script_footer .= '	
	<script>
      $(function () {
        $("#all_post").DataTable({
		  "order": [],
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": false,
		  "autoWidth": false,
		  "sDom": "",
		  "columnDefs": [
          { "orderable": false, "targets": 0 }
          ]		  
        });
      });
    </script>
	';

$Globals->add("script_footer", $script_footer);
$Globals->add("script_and_style", $script_and_style);
