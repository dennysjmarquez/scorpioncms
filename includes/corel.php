<?php

class Corel {

	private $is_404 = false;
	private $is_front_page = false;
	private $is_post = false;
	private $is_single = false;
	private $is_not_admin = false;

	private $suf_post;
	private $suf_category;

	public $Query;

	private $structura;

	private function Load_Class_Theme(){

		require( BASEDIR . INCLUDEDIR . DS . 'theme.php' );

	}

	public function is_front_page() {
		$this->is_not_admin = false;
		return (bool) $this->is_front_page;
	}

	public function is_single() {
		$this->is_not_admin = false;
		return (bool) $this->is_single;
	}

	public function is_404() {
		header( "HTTP/1.1 404 Not Found", true, 404 );
		$this->is_not_admin = false;
		return (bool) $this->is_404;
	}

	public function is_admin() {
		return (bool) $this->is_not_admin;
	}


	public function __construct() {

		global $Corel, $Cache, $dbh, $Query;

		$Corel = $this;
		$Cache->Check();
		$this->Query = $Query;
		$this->suf_post = get_config("suf_post");
		$this->suf_category = get_config("suf_category");
		$router = new router;

		$EstructuraSegmentada = $router->GetEstructura(

			(strstr($_SERVER['REQUEST_URI'], '?', true)) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI']

		);

		$this->Resgistrar_estructura();
		$this->Check_Estructura($EstructuraSegmentada);

	}

	private function Resgistrar_estructura(){

		/*  aqui lo que se permite si no esta aqui error 404 */

	    $this->structura[] =  array( "modulo" => "admin", "template" => null);
		$this->structura[] =  array("modulo" => $this->suf_post, "template" => null);
		$this->structura[] =  array("modulo" => $this->suf_category, "template" => null);
		$this->structura[] =  array("modulo" => null, "template" => null);
		$this->structura[] =  array("modulo" => "page", "template" => null);


	}


	/* aqui se ve si es un post pagina o si existe */
	private function Check_Estructura($EstructuraSegmentada){


			$modulo = isset($EstructuraSegmentada[0]) ? $EstructuraSegmentada[0] : '';

			$adondeVoy = null;

			foreach ($this->structura as $clave => $fila) {

				if($fila['modulo'] == $modulo){

					if(null == $fila['template']){

						$adondeVoy['modulo'] = $fila['modulo'];

					}else{

						$adondeVoy['modulo'] = $fila['modulo'];
						$adondeVoy['template'] = $fila['template'];

					}

				}

			}

			if (null == $adondeVoy){

				$this->is_404 = true;
				$this->Load_Class_Theme();
				$themes = new themes();
				$themes->GetThemes();
				exit;

			}else{


				if (count($adondeVoy) == 1 && $adondeVoy['modulo'] == "admin"){

					$this->is_not_admin = true;
					$cargar = BASEDIR . $adondeVoy['modulo'].DS;

					require($cargar."index.php");
					exit;

				}else if (count($EstructuraSegmentada) == 2 && $adondeVoy['modulo'] == "page"){

					if(is_numeric($EstructuraSegmentada[1])){

						if ($this->Query->GetPost($EstructuraSegmentada[1])){

							$this->is_front_page = true;
							$this->Load_Class_Theme();
							$themes = new themes();
							$themes->GetThemes();
							exit;

						}else{

							$this->is_404 = true;
							$this->Load_Class_Theme();
							$themes = new themes();
							$themes->GetThemes();
							exit;

						}

					}else{

						$this->is_404 = true;
						$this->Load_Class_Theme();
						$themes = new themes();
						$themes->GetThemes();
						exit;

					}




				}else if (count($adondeVoy) == 1 ){


					if( $adondeVoy['modulo'] == null ){

						$this->Query->GetPost();
						$this->is_front_page = true;
						$this->Load_Class_Theme();
						$themes = new themes();
						$themes->GetThemes();
						exit;

//					}else if(count($EstructuraSegmentada) == 2 && $adondeVoy['modulo'] == $this->suf_category){


					}else if(count($EstructuraSegmentada) == 2 && $adondeVoy['modulo'] == $this->suf_post){

						if($this->Query->GetPost($EstructuraSegmentada[1], "single")){

							$this->is_single = true;
							$this->Load_Class_Theme();
							$themes = new themes();
							$themes->GetThemes();
							exit;

						}else{

							$this->is_404 = true;
							$this->Load_Class_Theme();
							$themes = new themes();
							$themes->GetThemes();
							exit;

						}

					}else{

						$this->is_404 = true;
						$this->Load_Class_Theme();
						$themes = new themes();
						$themes->GetThemes();
						exit;

					}

				}

			}


	}


}
