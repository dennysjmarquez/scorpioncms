<?php

class QueryAdmin {

	private $PostTotal = 0;
	private $have_posts;
	private $bucle = -1;
	private $totalbuche;
	private $result = null;
	private $post;
	private $ActualPaginaPost = null;
	private $ActualPaginaComment;
	private $custom_post_type = array();
	private $system_post_type = array();

	public function get_user($value = null){

		$value = (null == $value) ? '*' : $value;

		if(isset($_COOKIE[KeyAuth])){

			list($user, $token) = explode(':', $_COOKIE[KeyAuth]);

			if(ctype_alnum($user) && ctype_alnum($token)){

				global $dbh;
				$result = $dbh->prepare("SELECT {$value} FROM `users` WHERE `identifier` = :user ");
				$result->bindParam(':user', $user, PDO::PARAM_STR);
				$result->execute();
				$result = $result->fetchall();

				if($result){

					return $result[0];

				}else{

					return;
				}
			}

		}

	} private function get_post_type_theme() {


		$post_type = ($this->post("post_type")) ? $this->post("post_type") : 'standard';


		/* Aquí los tipos de formatos predeterminados para los post */

		$this->system_post_type = null;
		$this->custom_post_type = null;

		$this->system_post_type[] = array("type" => "standard", "text" => lang_s("_standard", true), "icon" =>"fa fa-pencil" );
		$this->system_post_type[] = array("type" => "image", "text" => lang_s("_image", true), "icon" =>"fa fa-image" );
		$this->system_post_type[] = array("type" => "audio", "text" => lang_s("_audio", true), "icon" =>"fa fa-music" );
		$this->system_post_type[] = array("type" => "video", "text" => lang_s("_video", true), "icon" =>"fa fa-video-camera" );
		$this->system_post_type[] = array("type" => "quote", "text" => lang_s("_quote", true), "icon" =>"fa fa-quote-left" );
		$this->system_post_type[] = array("type" => "link", "text" => lang_s("_link", true), "icon" =>"fa fa-link" );

		/**********************************/

		$theme_function = include_function_theme();

		if ($theme_function){

			require($theme_function);

		}

		if(function_exists('add_post_format')){

			/* aqui los formatos de los post que permite el theme */

			$this->custom_post_type = add_post_format();


			if (!is_array($this->custom_post_type)) return $this->custom_post_type = $this->system_post_type;

			/**********************************/

			$index = array_search('standard', array_column($this->custom_post_type, 'type'));
			$index2 = array_search('standard', array_column($this->system_post_type, 'type'));

			if (false === $index && false !== $index2){

				$this->custom_post_type[] = $this->system_post_type[$index2];

			}

			$index = array_search($post_type, array_column($this->custom_post_type, 'type'));
			$index2 = array_search($post_type, array_column($this->system_post_type, 'type'));

			if(false === $index && false !== $index2){

				$this->custom_post_type[] = array("type" => $post_type, "text" => $post_type, "icon" =>"fa-question" );

			}elseif(false === $index && false == $index2){

				$this->custom_post_type[] = array("type" => $post_type, "text" => $post_type, "icon" =>"fa-question" );

			}

		}else{

			$this->custom_post_type = $this->system_post_type;

		}

		asort($this->custom_post_type);

	} public function get_post_type(){

		$this->get_post_type_theme();
		return $this->custom_post_type;

	} public function GetTitle($Value = null) {

		global $CorelAdmin;

		if($CorelAdmin->is_404()){

			return lang_s("page_not_found");

		}

	} private function PostTotal() {

		global $dbh;

		$var1 = "post";
		$var2 = "publish";
		$result = $dbh->prepare("SELECT COUNT(*) total FROM `post` WHERE `type` = :var1 AND `status` = :var2");

		$result->bindParam(':var1', $var1, PDO::PARAM_STR);
		$result->bindParam(':var2', $var2, PDO::PARAM_STR);
		$result->execute();
		$result = $result->fetch();
		$result = $result["total"];

		return (int)$result;

	} public function get_date() {

		global $lang;

		$date = $this->post['date'];

		$i = strtotime( $date );

		$dia = date("d", $i);

		$mes = lang_s(date("F", $i), true);

		$año = date("Y", $i);

		$hora = date("h", $i);
		$minutos = date("m", $i);
		$segundos = date("s", $i);
		$dn = date("A", $i);
		$formato = $dia ."  ". $mes .", " . $año .'  '.$hora.':'.$minutos.':'.$segundos.' '.$dn;

		echo $formato;

	} public function get_tag($html = false) {

		global $dbh;

			$var = $this->post["id"];

			$result = $dbh->prepare("SELECT `data_id` FROM `relation` WHERE `object_id` = :var AND `taxonomy` = 'post_tag' ORDER BY `id` ASC");
			$result->bindParam(':var', $var, PDO::PARAM_STR);
			$result->execute();
			$result = $result->fetchall();

			$i = 0;
			$tag = array();
			$outhtml = null;
			$coma = ', ';

			while ( count($result)-1 >= $i ) {

				$var = $result[$i]['data_id'];
				$result_tag = $dbh->prepare("SELECT `name`, `id` FROM `data` WHERE `id` = :var ");
				$result_tag->bindParam(':var', $var, PDO::PARAM_STR);
				$result_tag->execute();
				$result_tag = $result_tag->fetch();
				$tag[] = $result_tag;
				++$i;

				if($html){

					if(count($result) == $i)$coma = '';
					$outhtml .= '<a href="'.get_config("siteurl").'/admin/tag/edit/'. $result_tag['id'] . '/">'.$result_tag['name'].'</a>'. $coma;

				}
			}


			if(!$tag) $outhtml = "—";

			if($html){

				echo $outhtml;

			}else{

				if(!$result) return null;
				return $tag;

			}

	} public function get_author($value = null, $html = false) {

		global $dbh;

		if(null == $value) $value = 'user_login';

		$var = $this->post["author_id"];

		$result = $dbh->prepare("SELECT {$value} FROM `users` WHERE `id` = :var ");
		$result->bindParam(':var', $var, PDO::PARAM_STR);
		$result->execute();
		$result = $result->fetch();

		if($html){

			echo $result[$value];

		}else{

			return $result[$value];

		}

	} public function  get_category_name($value = null, $html = false) {

		global $dbh;

		if(null == $value){

			$var = $this->post["category_id"];
			$result = $dbh->prepare("SELECT `level`, `name`  FROM `categories` WHERE `id` = :var");
			$result->bindParam(':var', $var, PDO::PARAM_STR);
			$result->execute();
			$result = $result->fetchall();

			if($result){

				$level = (int)$result[0]['level'];

				if ( $level=== 0){

					$name = ('_'.$result[0]['name'] === lang_s('_'.$result[0]['name'],true)) ? $result[0]['name'] : lang_s('_'.$result[0]['name'],true);

				}else{

					$name = $result[0]['name'];

				}

			}else{

				$name = '—';

			}


			if($html){

				echo $name;

			}else{

				return $name;

			}

		}else{

			$var = $value;
			$result = $dbh->prepare("SELECT `name`  FROM `categories` WHERE `id` = :var");
			$result->bindParam(':var', $var, PDO::PARAM_STR);
			$result->execute();
			$result = $result->fetch();

			if($html){

				echo $result['name'];

			}else{

				return $result['name'];

			}

		}

	} public function get_comments_number($value = null) {

		global $dbh;

		if(null == $value){

			$var = $this->post["id"];
			$result = $dbh->prepare("SELECT COUNT(*) total FROM `comment` WHERE `post_id` = :var");
			$result->bindParam(':var', $var, PDO::PARAM_STR);
			$result->execute();
			$result = $result->fetch();
			$result = $result["total"];

			echo $result;

		}else{

			$var = $value;
			$result = $dbh->prepare("SELECT COUNT(*) total FROM `comment` WHERE `post_id` = :var");
			$result->bindParam(':var', $var, PDO::PARAM_STR);
			$result->execute();
			$result = $result->fetch();
			$result = $result["total"];

			echo $result;

		}

	} public function the_title() {

		if(array_key_exists("title", $this->result[$this->bucle])){

			echo $this->result[$this->bucle]["title"];

		}

	} public function get_views() {

		if(array_key_exists("views", $this->result[$this->bucle])){

			echo $this->result[$this->bucle]["views"];

		}else{

			echo null;

		}

	} public function get_post_format() {

		if(array_key_exists("post_type", $this->result[($this->bucle)])){

			return $this->result[$this->bucle]["post_type"];

		}

	} public function the_permalink() {

		if(array_key_exists("name", $this->result[($this->bucle)])){

			echo get_config("siteurl")."/".get_config("suf_post")."/".$this->result[$this->bucle]["name"];

		}

	} public function have_posts() {

		if($this->result){

			if ( $this->bucle + 1 < $this->totalbuche ) {

				$this->bucle++;
				return true;

			} elseif ( $this->bucle + 1 == $this->totalbuche && $this->totalbuche >  0) {

				return false;
				$this->bucle -1;

			}

		}

	} public function the_post() {

		$post_id = $this->result[$this->bucle]["id"];
        $post_meta = $this->GetPostsMeta($post_id, '_views');
		$this->result[$this->bucle]["views"] = ($post_meta) ? $post_meta['value'] : 0;
		$this->post = $this->result[$this->bucle];

	} public function post($value = null) {

		if(null == $value){
			return $this->post;

		}else{

			return $this->post[$value];

		}

	} public function Pagination($ActualPagina = null, $cuantas = null, $url = null, $total = null) {


		if(null == $cuantas) {
			$cuantas = 5;
		}

		if(null == $ActualPagina) $ActualPagina = 1;

		if(null === $url  ) {

			return false;

		}elseif(null == $this->ActualPaginaPost && null != $ActualPagina && null !== $total){

			$this->ActualPaginaPost = $ActualPagina;
			$this->PostTotal = $total;

		}elseif(null == $this->ActualPaginaPost && null == $ActualPagina || $this->PostTotal === 0){

			return false;

		}




		$page = $this->ActualPaginaPost;
		$numPages = (int)ceil($this->PostTotal / get_config("posts_per_page"));
		$neHalf = ceil($cuantas / 2);
		$upperLimit = $numPages - $cuantas;
		$start = $page > $neHalf ? max(min($page - $neHalf, $upperLimit), 0) : 0;
		$end = $page > $neHalf ? min($page + $neHalf - ($cuantas % 2 > 0 ? 1 : 0), $numPages) : min($cuantas, $numPages);

		if($cuantas > $numPages && $numPages !== 1 ) {
			$cuantas = $numPages;
		} elseif($numPages == 1) {
			return null;
		}

		$p["current"] = $this->ActualPaginaPost;

		if($page == $numPages){
			$p["next"]["active"] = false;
			$p["next"]["link"] = null;
		}else{
			$p["next"]["active"] = true;
			$p["next"]["link"] = get_config("siteurl").'/admin/'.$url."/page/".($page + 1)."/";
		}

		if($page > 1){
			$p["previous"]["active"] = true;
			if(($page - 1) !== 1){
				$p["previous"]["link"] = get_config("siteurl").'/admin/'.$url."/page/".($page - 1)."/";
			}else{
				$p["previous"]["link"] = get_config("siteurl").'/admin/'.$url."/";
			}

		}else{
			$p["previous"]["active"] = false;
			$p["previous"]["link"] = null;
		}

		$p["pages"] = array();

		for ($i = 1; $i <= $cuantas; $i++) {

			if($page >= $cuantas && $i == 1 && ($start + $i) !==1 && $cuantas +1 != $numPages){

				$p["pages"][count($p["pages"])]["texto"] = "1";
				$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/";
				$p["pages"][count($p["pages"])]["texto"] = "...";
				$p["pages"][count($p["pages"])-1]["link"] = null;
				$p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
				$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/page/".strval($start + $i)."/";

			}elseif($page + 1 >= $cuantas && $i == 1 && ($start + $i) !== 1){

				$p["pages"][count($p["pages"])]["texto"] = "1";
				$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/";
				$p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
				$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/page/".strval($start + $i)."/";

			}else{

				if($i == $cuantas && $end+1 !== $numPages && $end +1 < $numPages){

					$p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
					$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/page/".strval($start + $i)."/";
					$p["pages"][count($p["pages"])]["texto"] = "...";
					$p["pages"][count($p["pages"])-1]["link"] = null;
					$p["pages"][count($p["pages"])]["texto"] = strval($numPages);
					$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/page/".strval($numPages)."/";

				}elseif($i == $cuantas && $end !== $numPages){

					$p["pages"][count($p["pages"])]["texto"] = strval($start + $i);
					$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/page/".strval($start + $i)."/";
					$p["pages"][count($p["pages"])]["texto"] = strval($numPages);
					$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/page/".strval($numPages)."/";

				}else{

					$p["pages"][count($p["pages"])]["texto"] = strval($start + $i);

					if($start + $i !== 1){

						$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/page/".strval($start + $i)."/";

					}else{

						$p["pages"][count($p["pages"])-1]["link"] = get_config("siteurl").'/admin/'.$url."/";

					}

				}

			}

        }

		return $p;

	} public function GetPostsMeta($value = null, $value2 = null, $value3 = null) {

		global $dbh;
		if($value === null || $value === null) return false;

		if($value3 === 'all'){

			$var = $value;
			$result = $dbh->prepare("SELECT * FROM `postmeta` WHERE `post_id` = :var");
			$result->bindParam(':var', $var);
			$result->execute();

			$fetch = $result->fetchall();


		}else{


			$var1 = $value;
			$var2 = $value2;
			$result = $dbh->prepare("SELECT `value` FROM `postmeta` WHERE `post_id` = :var1 AND `name` = :var2 ");
			$result->bindParam(':var1', $var1, PDO::PARAM_STR);
			$result->bindParam(':var2', $var2, PDO::PARAM_STR);
			$result->execute();

			$fetch = $result->fetch();
		}



		return $fetch;

	} public function GetPostsSingle($value = null) {

		global $dbh;

		if($value === null) return false;

			$var1 = $value;
			$result = $dbh->prepare("SELECT * FROM `post` WHERE `id` = :var1");
			$result->bindParam(':var1', $var1, PDO::PARAM_STR);
			$result->execute();
			$this->result = $result->fetchall();

			if($this->result){

				$this->result[0]['_attached_image'] = $this->GetPostsMeta($var1, '_attached_image')['value'];
				$this->post = $this->result[0];
				return true;

			}else{
				return false;
			}

	} public function GetPost($value = null, $type = null) {

		global $dbh;

		if(null == $type) return false;

		if(null == $value) $value = 1;

			$this->PostTotal = $this->PostTotal();
			@$totaldepaginas = ceil( $this->PostTotal / get_config("posts_per_page") );

			if($value > $totaldepaginas) return false;

			$offset = ( ( $value - 1 ) * (int)get_config("posts_per_page") );
			$limit = (int)get_config("posts_per_page");

			$var1 = $type;

			$result = $dbh->prepare("SELECT * FROM `post` WHERE `type` = :var1 ORDER BY `id` ASC LIMIT :offset, :limit");
			$result->bindParam(':var1', $var1, PDO::PARAM_STR);
			$result->bindParam(':offset', $offset, PDO::PARAM_INT);
			$result->bindParam(':limit', $limit, PDO::PARAM_INT);

			$result->execute();
			$this->result = $result->fetchall();
			$this->totalbuche = (count($this->result));
			$this->ActualPaginaPost = $value;

			return true;

	} public function PDOValueList($fields) {

		$set = '';

		foreach ($fields as $field => $item) {
			$set .= ":".$field.",";
		}

		return rtrim($set, ',');

	} private function PDOFieldListUpdate($fields) {

		$set = 'SET ';

		foreach ($fields as $field => $item) {

			$set .= "".$field." = :".$field.',';
		}
		return rtrim($set, ',');



	} public function PDOFieldList($fields) {

		$set = '';

		foreach ($fields as $field => $item) {
			$set .= "`".$field."`,";
		}
		return rtrim($set, ',');

	} private function PDOWhereCondition($fields) {

		$set = 'WHERE ';

		foreach ($fields as $field => $item) {
			$set .= "".$field." = :".$field.' AND ';
		}

		return rtrim($set, ' AND ');

	}public function SetQuery($loop = null) {

		if(null === $loop && !is_array($loop)) return;
		global $dbh;
		$return = [];


			foreach ($loop as $key => $value) {

				switch ($value['action']) {

					case 'update':

						$table = $value['table'];
						$id = $value['where'];
						$insert_array = $value['sql'];

						$SQLInsert = "UPDATE `{$table}` ".$this->PDOFieldListUpdate($insert_array) . " WHERE {$value['field_id']} = :id";

						$result = $dbh->prepare($SQLInsert);

						foreach ($insert_array as $field => $item) {

							$result->bindValue(':'.$field, $item);

						}

						$result->bindValue(':id', $id);

						$result->execute();

					break;

					case 'insert':

						if($value['type'] === 'relation'){

							$ins_array = $value['sql'];

							if($ins_array['name']){

								$result = $dbh->prepare("SELECT `id`, `name` FROM `data` WHERE `name` = :name");
								$result->bindParam(':name', $ins_array['name']);
								$result->execute();
								$result = $result->fetchall();

								if($result){

									// si existe ya //

									$data_id = $result[0]['id'];

									$result = $dbh->prepare("SELECT `id` FROM `relation` WHERE `object_id` = :object_id AND `data_id` = :data_id");
									$result->bindParam(':object_id', $ins_array['object_id']);
									$result->bindParam(':data_id', $data_id);
									$result->execute();
									$result = $result->fetchall();

									if(!$result) {

										$insert_array = [

											'object_id'	=> $ins_array['object_id'],
											'data_id'	=> $data_id,
											'taxonomy'	=> $ins_array['taxonomy']

														];

										$SQLInsert = "INSERT INTO `relation` (".$this->PDOFieldList($insert_array)
										.") VALUES (".$this->PDOValueList($insert_array).")";

										$result = $dbh->prepare($SQLInsert);

										foreach ($insert_array as $field => $item) {

											$result->bindValue(':'.$field, $item);

										}

										$result->execute();

									}

								}else{

									// si no existe //

									$insert_array = [

										'name'	=> $ins_array['name'],
										'slug'	=> makeSlugs($ins_array['name'])

													];

									$SQLInsert = "INSERT INTO `data` (".$this->PDOFieldList($insert_array)
									.") VALUES (".$this->PDOValueList($insert_array).")";

									$result = $dbh->prepare($SQLInsert);

									foreach ($insert_array as $field => $item) {

										$result->bindValue(':'.$field, $item);

									}

									$result->execute();

									$insert_array = [

										'object_id'	=> $ins_array['object_id'],
										'data_id'	=> $dbh->lastInsertId(),
										'taxonomy'	=> $ins_array['taxonomy']
													];

									$SQLInsert = "INSERT INTO `relation` (".$this->PDOFieldList($insert_array)
									.") VALUES (".$this->PDOValueList($insert_array).")";

									$result = $dbh->prepare($SQLInsert);

									foreach ($insert_array as $field => $item) {

										$result->bindValue(':'.$field, $item);

									}

									$result->execute();

								}

							}

						}elseif(null === $value['type']){

							$table = $value['table'];
							$insert_array = $value['sql'];

							$SQLInsert = "INSERT INTO `{$table}` (".$this->PDOFieldList($insert_array)
							.") VALUES (".$this->PDOValueList($insert_array).")";

							$result = $dbh->prepare($SQLInsert);

							foreach ($insert_array as $field => $item) {

								$result->bindValue(':'.$field, $item);

							}

							$result->execute();




							$return = array(

								'table' =>	array($table => array(

									'lastInsertId' => $dbh->lastInsertId()

																 )
												 )

											);




						}

					break;

					case 'deleted':

						if($value['type'] === 'relation'){

							$ins_array = $value['sql'];
							$object_id = $ins_array['object_id'];

							if($ins_array['name']){

								$result = $dbh->prepare("SELECT `id` FROM `data` WHERE `name` = :name");
								$result->bindParam(':name', $ins_array['name'], PDO::PARAM_STR);
								$result->execute();
								$result = $result->fetch();

								if($result){

									$result = $dbh->prepare("SELECT `id` FROM `data` WHERE `name` = :name");
									$result->bindParam(':name', $ins_array['name'], PDO::PARAM_STR);
									$result->execute();
									$result = $result->fetch();

									$data_id = $result['id'];

									$result = $dbh->prepare("SELECT `id` FROM `relation` WHERE `object_id` = :object_id AND `data_id` = :data_id");
									$result->bindParam(':object_id', $object_id);
									$result->bindParam(':data_id', $data_id);
									$result->execute();
									$result = $result->fetchall();

									if($result){

										$result = $dbh->prepare("SELECT count(*) FROM `relation` WHERE `data_id` = :data_id");
										$result->bindParam(':data_id', $data_id);
										$result->execute();
										$count = $result->fetchColumn();

										if ($count < 2){

											$result = $dbh->prepare("DELETE FROM `data` WHERE id = :data_id");
											$result->bindParam(":data_id", $data_id);
											$result->execute();

											$result = $dbh->prepare("DELETE FROM `relation` WHERE data_id = :data_id");
											$result->bindParam(":data_id", $data_id);
											$result->execute();

										}elseif($count > 1){

											$result = $dbh->prepare("DELETE FROM `relation` WHERE object_id = :object_id AND data_id = :data_id");
											$result->bindParam(":object_id", $ins_array['object_id']);
											$result->bindParam(":data_id", $data_id);
											$result->execute();

										}


									}

								}else{

								}


							}




						}elseif(null === $value['type']){


							$table = $value['table'];
							$insert_array = $value['sql'];

							$SQLInsert = "DELETE FROM `{$table}` ".$this->PDOWhereCondition($insert_array);

							$result = $dbh->prepare($SQLInsert);

							foreach ($insert_array as $field => $item) {

								$result->bindValue(':'.$field, $item);

							}

							$result->execute();


						}





					break;

					default:
					return;


				}



			}


		return $return;


	} private function post_Slug_check($name, $id){

		global $dbh;

		if(null === $id) {

			$result = $dbh->prepare("SELECT `name`, `id` FROM `post` WHERE name = :name LIMIT 1");
			$result->bindParam(':name', $name);

		}else{

			$result = $dbh->prepare("SELECT `name`, `id` FROM `post` WHERE name = :name AND id != :id LIMIT 1");
			$result->bindParam(':name', $name);
			$result->bindParam(':id', $id);

		}

		$result->execute();
		$result = $result->fetch();

		if($result) {
			return true;
		}else{
			return false;
		}

	} public function SlugExist($name, $id = null){

		if($this->post_Slug_check($name, $id)){

			$num = 2;

			do {

				$name_check = $name . "-{$num}";
				$check = $this->post_Slug_check($name_check, $id);
				$num++;

			} while ( $check );

			return $name_check;

		}else{

			return $name;

		}

	}

}
