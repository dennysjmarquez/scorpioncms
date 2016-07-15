<?php

class Cache {
	
	
	private $cachedir = 'cache/';
    private $cachetime = 3600;
    private $cacheext = 'cache';
    private $cachepage;
	private $cachefile;

	
	public function Check(){
		
		
		
		$this->cachepage = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	
		
		$this->cachefile = $this->cachedir.md5($this->cachepage).'.'.$this->cacheext;
		
		if (@file_exists($this->cachefile)) {
			$cachelast = @filemtime($this->cachefile);
		} else {
			$cachelast = 0;
		}
		
		@clearstatcache();
    
		if (time() - $this->cachetime < $cachelast) {
			@readfile($this->cachefile);
			exit();
		}
	
		ob_start();
		
	}

	public function Create(){
		
		$filepath = pathinfo($this->cachefile, PATHINFO_DIRNAME);

        if ( ! $this->createPathIfNeeded($filepath)) {
            return false;
        }

        if ( ! is_writable($filepath)) {
            return false;
        }
		
        $tmpFile = tempnam($filepath, 'swap');
        @chmod($tmpFile, 0666 & (~0002));
		
        if (file_put_contents($tmpFile, ob_get_contents()) !== false) {
            if (@rename($tmpFile, $this->cachefile)) {
                return true;
            }

            @unlink($tmpFile);
        }	
	
		ob_end_flush();
		
	}	
	

	private function createPathIfNeeded($path)
    {
        if ( ! is_dir($path)) {
            if (false === @mkdir($path, 0777 & (~0002), true) && !is_dir($path)) {
                return false;
            }
        }

        return true;
    }    	
	
	
	
}