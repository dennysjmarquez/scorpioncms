<?php
global $QueryAdmin;
$Globals->add("title", lang_s('all_posts',true));
$Globals->add("menu_active", $controller);
$QueryAdmin->GetPost(null, 'post');
