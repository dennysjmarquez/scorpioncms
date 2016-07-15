<?php

class CorelAdmin {
	
	private $is_404 = false;
	private $is_front_page = false;
	private $is_post = false;
	private $is_single = false;
	private $structura;
	
	public $Query;
	public $themesG;
	
	public function set_404() {
		
		header( "HTTP/1.0 404 Not Found", true, 404 );
		$this->is_404 = true;
		
	}
	
	public function is_404() {
		
		return (bool) $this->is_404;
	}	
	
	public function __construct() {

		global $CorelAdmin, $Cache, $Query, $lang, $themes;
		
		$CorelAdmin = $this;
		
		$this->themesG = $themes;
		$Cache->Check();
		$this->Query = $Query;
                
		$url = $_SERVER['REQUEST_URI'];
		
		$router = new router;
		$EstructuraSegmentada = $router->GetEstructura($url, "admin");
		
		if (count($EstructuraSegmentada) >= 4) {
			
			$this->set_404();
			$this->themesG->GetThemes();						
			exit;					
			
		}
		
		$this->Resgistrar_estructura();
		$this->Check_Estructura($EstructuraSegmentada);

	}

	private function Resgistrar_estructura(){
		
		global $QueryAdmin;
		
		/*  aqui lo que se permite si no esta aqui error 404 */ 
		
	    $this->structura[] =  array( "controller" => "auth", "alias" => null, "template" => null);
		$this->structura[] =  array( "controller" => get_config('suf_post'), "alias" => "post", "template" => "parent_index");
		$this->structura[] =  array( "controller" => get_config('suf_category'), "alias" => "category", "template" => "parent_index");
		$this->structura[] =  array( "controller" => "themes", "alias" => null, "template" => "parent_index");
		$this->structura[] =  array( "controller" => "options", "alias" => null, "template" => "parent_index");
		$this->structura[] =  array( "controller" => "media", "alias" => null, "template" => "parent_index");
		$this->structura[] =  array("controller" => "index", "alias" => null, "template" => "index");
		$this->structura[] =  array( "controller" => "ajax", "alias" => null, "template" => "ajax");
		
		
	}
	
	
	/* aqui se ve si es un post pagina o si existe */
	private function Check_Estructura($EstructuraSegmentada){
			
			global $Globals, $QueryAdmin;
			
			$template = null;
			$modulo = isset($EstructuraSegmentada[1]) ? $EstructuraSegmentada[1] : null;
			$controller = isset($EstructuraSegmentada[0]) ? $EstructuraSegmentada[0] : 'index';
			$action = isset($EstructuraSegmentada[2]) ? $EstructuraSegmentada[2] : null;

			if($controller === 'ajax'){
				
				$modulo = isset($EstructuraSegmentada[2]) ? $EstructuraSegmentada[2] : null;
				$action = isset($EstructuraSegmentada[3]) ? $EstructuraSegmentada[3] : null;
				
			}
	
			$adondeVoy = null;
		
			foreach ($this->structura as $clave => $fila) {
					
			
				if($fila['controller'] == $controller){
					
					$controller = ($fila['alias'] === null) ? $fila['controller'] : $fila['alias'];
					
					
					if(null == $fila['template']){
						
						$adondeVoy['controller'] = $controller;
						
					}else{
						
						$adondeVoy['controller'] = $controller;
						$adondeVoy['template'] = $fila['template'];
						$template = $adondeVoy['template'];
						
						
					}
					
				}
			
			}
			
			if (null == $adondeVoy){
				
				$this->set_404();
				$this->themesG->GetThemes(true);
				exit;
				
			}else{
				
				
				$ajax = (count($adondeVoy) == 2 && $adondeVoy['template'] == "ajax") ? true : false;
				$cargar = '';
			
				if(count($adondeVoy) == 1){
				
					$cargar = admin . DS . 'modules' . DS . 'controllers' . DS . 'c.'.$adondeVoy['controller'] . '.php';
				
				}elseif(count($adondeVoy) == 2 && $adondeVoy['template'] == "index"){
				
					$cargar = admin . DS . 'modules' . DS .'templates'. DS .$template. DS .'controllers' . DS . 'c.'.$adondeVoy['controller'] . '.php';
					
				}elseif(count($adondeVoy) == 2 && $adondeVoy['template'] == "parent_index"){
			
					$cargar = admin . DS . 'modules' . DS .'templates'. DS .'index'. DS .'controllers' . DS . 'c.index.php';
					
				}elseif(count($adondeVoy) == 2 && $adondeVoy['template'] == "ajax"){
			
					$controller = isset($EstructuraSegmentada[1]) ? $EstructuraSegmentada[1] : 'index';
					$cargar = admin . DS . 'modules' . DS .'templates'. DS .'ajax'. DS . 'ajax.loader.php';
				
				}
				
				$Globals->add("script_footer", '');
				$Globals->add("script_and_style", '');
				$Globals->add("modulo", $modulo);
				$Globals->add("controller", $controller);
				$Globals->add("action", $action);
				$Globals->add("template", $template);
				$Globals->add("ajax", $ajax);
				
				$AuthManager = new AuthManager();
				$AuthManager->check_is_login($ajax);
				
				
				if(is_file($cargar)){
					
					require($cargar);
				
				}else{
					
					$this->set_404();
					$this->themesG->GetThemes();						
					exit;					
					
				}
			
			}
		
	}
	
	
}

?>
