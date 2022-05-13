<?php

	function include_function_theme(){

		$folder = get_config("theme_root");
		$cargar = BASEDIR . DS . $folder .DS;

		if (file_exists( $cargar . 'functions.php' )){

			return $cargar . 'functions.php';

		}
	}

	function Pagination($value = null, $cuantas = null){

		global $Query;

		return $Query->Pagination($value, $cuantas);

	}

	function get_comments_number($value = null) {

		global $Query;

		if(null == $value){

			$Query->get_comments_number();

		}else{

			$Query->get_comments_number($value);

		}

	}

	function have_posts(){

		global $Query;
		return $Query->have_posts();

	}

	function the_title(){

		global $Query;
		$Query->the_title();

	}

	function the_permalink(){

		global $Query;
		$Query->the_permalink();

	}

	function the_post(){

		global $Query;
		return $Query->the_post();

	}

	function get_template_directory_uri($return = false){

		$folder	 = get_config("theme_root");
		$siteurl = get_config("siteurl");

		if($return === false){

			echo $siteurl . '/' . str_replace(DS, "/", $folder);

		}elseif($return === true){

			return $siteurl . '/' . str_replace(DS, "/", $folder);

		}



	}

	function GetTitle($value = null){

		global $Query;
		return $Query->GetTitle($value);

	}

	function get_template_part($dir, $name = null ) {

		$folder = get_config("theme_root");
		$cargar = BASEDIR . $folder . DS . str_replace("/",DS, $dir) . ".php";

		if (file_exists( $cargar )){

			require $cargar;

		}

	}

	function get_views(){

		global $Query;
		$Query->get_views();

	}

	function the_content($value = null){

		global $Query;
		echo $Query->the_content($value);

	}

	function get_post_format(){

		global $Query;
		return $Query->get_post_format();

	}
