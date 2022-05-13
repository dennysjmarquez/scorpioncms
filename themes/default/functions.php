<?php

global $Query;

function add_post_format(){
	
	
	$post_formats[] = array("type" => "audio", "text" => lang_s("_audio", true), "icon" =>"fa fa-music" );
	$post_formats[] = array("type" => "video", "text" => lang_s("_video", true), "icon" =>"fa fa-video-camera" );
	$post_formats[] = array("type" => "quote", "text" => lang_s("_quote", true), "icon" =>"fa fa-quote-left" );
	$post_formats[] = array("type" => "link", "text" => lang_s("_link", true), "icon" =>"fa fa-link" );
	$post_formats[] = array("type" => "image", "text" => lang_s("_image", true), "icon" =>"fa fa-image" );
	
	
	return $post_formats;
	
}