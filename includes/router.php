<?php

class router {
	
	public $request = null;

	
	public function __construct(){
		
		$this->ini();
		
	}
    
	private function ini(){
		
		$this->iniRequest();
		
	}

	public function GetEstructura($url, $modulo = null){
		
		$i = 'index.php';
		$root = $_SERVER['SCRIPT_NAME'];
		$url = str_contains($root, $i) ? str_replace(str_replace('/'.$i, '', $root), '', $url) : $root;

		return $this->ProcsesarUrl($url, $modulo);
		
	}
	
	private function iniRequest(){
		
		//$this->request = Request::createFromGlobals();
		
	}
	
	public function Request(){
		
		return $this->request;
		
	}
	
	public function getMethod(){
	
		return $_SERVER['REQUEST_METHOD'];
	
	}
	
	private function ProcsesarUrl($url, $modulo){
		
		if(null !== $modulo){
			
			$url = str_replace('/'.$modulo.'', '', $url);
		}
		
		$UrlProcesada = $this->segmentizeUrl(strtolower($url));
		
		return $UrlProcesada;
		
	}

    private function segmentizeUrl($url) {

		$url = $this->normalizeUrl($url);
		
        $segments = explode('/', $url);

        $result = [];
        foreach ($segments as $segment) {
            if (strlen($segment)) {
                $result[] = $segment;
            }
        }

        return $result;
    }	

	private function normalizeUrl($url) {
        if (substr($url, 0, 1) != '/')
            $url = '/'.$url;

        if (substr($url, -1) == '/')
            $url = substr($url, 0, -1);

        if (!strlen($url))
            $url = '/';
		
        return $url;
    }

}