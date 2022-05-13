<?php

class MediaManager {

	public $storage = null;
	public $storagetree = null;
	public $currentpath;
    private $TypeExtensions = [
        'image' => ['gif', 'png', 'jpg', 'jpeg', 'bmp'],
        'video' => ['mp4', 'avi', 'mov', 'mpg', 'mpeg', 'mkv', 'webm'],
        'audio' => ['mp3', 'wav', 'wma', 'm4a', 'ogg']
    ];

	private $Regex = 'all';

	public function __construct(){

		//if(!isset($_SESSION)){session_start();}

	}

	public function GetRegex(){

		return $this->Regex;

	}

	public function filter($value){

		$this->Regex = $value;

	}

    private function validateFileName($name) {
        if (!preg_match('/^[0-9a-z\.\s_\-]+$/i', $name)) {
            return false;
        }

        if (strpos($name, '..') !== false) {
            return false;
        }

        return true;

	} public function makedir($location, $name){

		if( !$this->validateFileName($name) ){

			return lang_s("folder_name_not_valid", true);

		}

		$umask = umask(0);

		$location = './'.$this->storage . $location. '/'. $name . '/';

        if (file_exists($location) || !is_dir($location) && !mkdir($location, 0777, true)) {

			$return = lang_s("failed_to_create_folders", true);
			umask($umask);

        } else {

            $return = null;
			umask($umask);
        }

		return $return;

	} public function Load($path = null) {

		$this->backfolder = $this->path_segments($path);
		$this->currentpath = $path;

		if ( ! is_dir($this->storage.$path)) return $this->storagetree = array();

			$newRegex = '';
			$newRegexglob = '';

			if (array_key_exists($this->Regex, $this->TypeExtensions)){

				foreach ($this->TypeExtensions[$this->Regex] as $Regex) {

					$newRegex .= $Regex . '|';
					$newRegexglob .= $Regex . ',';

				}

				$newRegexglob = rtrim($newRegexglob, ',');

			}elseif($this->Regex !== 'all'){

				return;

			}

			$foldersTree  = array();
			$filesTree = array();

			$flags = FilesystemIterator::SKIP_DOTS;
			$glob = '';
			if($this->Regex === 'all'){

				$files = new FilesystemIterator($this->storage . $path, $flags);

			}else{

				$files = new FilesystemIterator($this->storage . $path, $flags);
				$files = new RegexIterator($files, '#(?<!/)\.(?:'.$newRegex.')$|^[^\.]*$#i');
				$glob = '.{'.$newRegexglob.'}';
			}



		foreach ($files as $fileInfo) {

			if ($fileInfo->isDir()){

				$files = glob($fileInfo->getPath() .'/'. $fileInfo->getFilename() . '/*'.$glob, GLOB_BRACE );

				$Sub_Dir_count_Items = ($files) ? count( $files ) : 0;

				$foldersTree[] = array(

					'path' => utf8_encode(str_ireplace($this->storage, '', $fileInfo->getPath()) .'/'. $fileInfo->getFilename()),
					'name' => utf8_encode($fileInfo->getFilename()),
					'lastModified' => date("M d, Y", $fileInfo->getMTime()) ,
					'type' => $fileInfo->getType(),
					'items' => $Sub_Dir_count_Items
				);

			}else{

				$extension = pathinfo($fileInfo->getPath() .'/'. $fileInfo->getFilename(), PATHINFO_EXTENSION);

				$filesTree[] = array(

					'path' =>  utf8_encode(str_ireplace($this->storage, '', $fileInfo->getPath()) .'/'. $fileInfo->getFilename()),
					'name' => utf8_encode($fileInfo->getFilename()),
					'size' => ($fileInfo->isFile()) ? $this->sizeToString($fileInfo->getSize()) : null,
					'lastModified' => date("M d, Y", $fileInfo->getMTime()) ,
					'type' => $fileInfo->getType(),
					'extension' => $extension,
					'publicUrl' => utf8_encode($fileInfo->getPath() .'/'. $fileInfo->getFilename())

				);

			}
		}

		$this->storagetree = array_merge($foldersTree, $filesTree);

	} private function get_tree_path_html($value) {

		if (count($value) <= 0){

			$html = '<ul class="tree-path">';
			$html .='<li class="root">
			<div id="tree-media-item" data-path="/" >' . lang_s("_root", true) .': ' . $this->storage . '</div>
			</li>';

		}else{

			$html = '<ul class="tree-path">';
			$html .='<li class="tree root">
			<div id="tree-media-item" data-path="/" >' . lang_s("_root", true) .': ' . $this->storage . '</div>
			</li>';

		}

		$count = count($value);

		foreach($value as $key=>$value) {

			$class = (($key + 1)  < $count  ) ? ' class="tree"' : '';
			$html .='<li'.$class.'>
			<a href="#" id="tree-media-item" data-path="'.$value['path'].'" >'.$value['name'].'</a>
			</li>';

		}

		$html .= '</ul>';

		return $html;

	} public function get_tree_path() {

		$path = explode('/', ltrim($this->currentpath, '/'));

		$result = [];
		$i = 0;

        while (count($path) > 0) {

			$folder = array_pop($path);

			$result[$i] = ['name' => $folder, 'path' => implode('/', $path).'/'.$folder];

            if (substr($result[$i]['path'], 0, 1) != '/')
				$result[$i] = ['name' => $folder, 'path' => $result[$i]['path']];

			++$i;

		}

		$count_folders_r = count($result) -1;
		$count_folders  = count($result) -1;
		$Reverse_Array = [];
		$i = 0;

		while ($i <= $count_folders) {

			$Reverse_Array[$i] = $result[$count_folders_r];
			--$count_folders_r;
			++$i;

		}

		foreach($Reverse_Array as $item=>$key) {

			$html[] = array('name'=>$key['name'], 'path'=>$key['path']);
		}

		return $this->get_tree_path_html($html);

	} public function path_segments($path) {

        $path = explode('/', ltrim($path, '/'));

		$i = 0;
		while ($i <= 1) {

			$folder = array_pop($path);
            $result[$i] = implode('/', $path).'/'.$folder;
			++$i;
		}

        return str_replace('//', '/', '/'.array_reverse($result)[0]);

	} private function validatePath($path, $normalizeOnly = false) {

		$path = str_replace('\\', '/', $path);
        $path = '/'.trim($path, '/');

        if ($normalizeOnly)
            return $path;

        if (strpos($path, '..') !== false)
			throw new Exception('Invalid Path. ' . $path);

        if (strpos($path, './') !== false || strpos($path, '//') !== false)
            throw new Exception('Invalid Path. ' . $path);


        return $path;

	} private function GetSession($key) {

		return isset($_SESSION[$key]) ? $_SESSION[$key] : false;

	} private function SetSession($key, $value) {

		$_SESSION[$key] = $value;

	} public function get_list_items_html() {

		if($this->storagetree === null) return;

		global $QueryAdmin;
		$html = '<table class="media-manager data">';

		if($this->currentpath !== '/') {

			$html .= '<tr id="media-item" class="unselectable selected" data-backfolder="'.$this->backfolder.'" data-type="dir">
                    <td><i class="fa media folder margin-right fa-folder"></i>..</td>
					<td width="130">&nbsp;</td>
					<td width="130">&nbsp;</td>
                </tr>';

		}

		foreach ($this->storagetree as $items) {

			$items1 = '';
			$items2 = '';
			$publicUrl = '';

			if ($items['type'] === 'file'){


				$items1 = $items['size'];
				$items2 = $items['lastModified'];
				$publicUrl = ' data-public-Url="' . get_config("siteurl").'/'.$items["publicUrl"] . '"';


				switch ($this->get_type_extension($items['extension'])) {

					case "image":

						$mime = ' data-mime="imagen"';
						$icon = '<i class="fa media margin-right fa-picture-o"></i>';
						break;
					case "video":

						$mime = ' data-mime="video"';
						$icon = '<i class="fa media margin-right fa-video-camera"></i>';
						break;

					case "audio":

						$mime = ' data-mime="audio"';
						$icon = '<i class="fa media margin-right fa-volume-up"></i>';
						break;

					case "document":

						$mime = ' data-mime="document"';
						$icon = '<i class="fa media margin-right fa-file"></i>';
						break;

				}

			}elseif($items['type'] === 'dir'){

				$mime = '';
				$icon = '<i class="fa media folder margin-right fa-folder"></i>';
				$number_items = $items['items'];
				$text_items = ($items['items'] > 1) ? lang_s('_items', true) : lang_s('_item',true);
				$result_items = $number_items .' '. $text_items;
				$items1 = ($items['type'] === 'dir') ? $result_items : '';

			}

			$html .= '<tr 
			
						class="unselectable"
						id="media-item"
						data-path="'.$items['path']. '" 
						data-type="'.$items['type'].'"'
						. $mime . $publicUrl . '
						data-name="'.$items['name'].'" 
						data-size="'.$items1.'" 
						data-last-Modified="'.$items2.'"
						
						>
					
					<td width="30%">
				
					<div class="item-title no-wrap-text">'
					.$icon.' '.$items['name'].'
						<i data-rename-control="" class="icon-terminal"></i>
					</div>
				
				</td>
				<td width="10%">'.$items1.'</td>
				<td width="10%">'.$items2.'</td>
				</tr>';
		}

		$html .= '</table>';

		return $html;

	} private function get_type_extension($extension = null) {

		$extension = strtolower($extension);

		if(null == $extension ) return;

        if (!strlen($extension)) {
            return 'document';
        }

        if (in_array($extension, $this->TypeExtensions['image'])) {
            return 'image';
        }


        if (in_array($extension, $this->TypeExtensions['video'])) {
            return 'video';
        }

        if (in_array($extension, $this->TypeExtensions['audio'])) {
            return 'audio';
        }

        return 'document';

	} public function sizeToString($bytes) {

		if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }

        if ($bytes >= 1024) {
            return $bytes = number_format($bytes / 1024, 2) . ' KB';
        }

        if ($bytes > 1) {
            return $bytes = $bytes . ' bytes';
        }

        if ($bytes == 1) {
            return $bytes . ' byte';
        }

        return '0 bytes';
    }

}
