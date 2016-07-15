<?php

global $Tree;
$Globals->add("Tree", $Tree);
$Globals->add("menu_active", $controller);
$full = $Tree->Full('categories');
$cate_root_id = $Tree->get_root_node('categories')['id'];
$Globals->add("full", $full);
$Globals->add("cate_root_id", $cate_root_id);