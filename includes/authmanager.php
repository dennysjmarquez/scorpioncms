<?php

class AuthManager {

	public $ErrCode;
	private $ajax_redirect;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function login($use, $pass, $remember = true){

			global $dbh;

			$result = $dbh->prepare("SELECT `user_pass`, `user_login`, `id` FROM `users` WHERE `user_login` = :use ");
			$result->bindValue(':use', $use, PDO::PARAM_STR);
            $result = $result->executeQuery()->fetchAllAssociative();

			if($result){

				if(password_verify($pass, $result[0]['user_pass'])){

					global $utilities;

					$identifier = md5($utilities->randomsal() . md5($use . $utilities->randomsal()));
					$token = $utilities->randomsal();
					$timeout = time() + (60 * KeyAuthExpire);

					//$_SESSION['session_key'] = $persist_code;

					$id = $result[0]['id'];
					$_SESSION['user_id'] = $id;


					$result = $dbh->prepare("UPDATE `users` SET `token` = :token, `identifier` = :identifier, `timeout` = :timeout WHERE `users`.`id` = :id");
					$result->bindValue(':identifier', $identifier, PDO::PARAM_STR);
					$result->bindValue(':timeout', $timeout, PDO::PARAM_STR);
					$result->bindValue(':token', $token, PDO::PARAM_STR);
					$result->bindValue(':id', $id, PDO::PARAM_STR);
					$result->executeQuery();

					setcookie(KeyAuth, "$identifier:$token", $timeout, "/");

					return true;

				}else{
					$this->ErrCode = 1;
					return false;

				}




			}else{
				$this->ErrCode = 2;
				return false;

			}


	}


	public function check_is_login($ajax_redirect = false){

		$this->ajax_redirect = $ajax_redirect;

		return $this->check();

	}

	private function redirect_signin(){

		global $Globals;

		if($Globals->Get('controller') !== "auth" && $Globals->Get('modulo') !== "signin"){

			redirect(get_config("siteurl")."/admin/auth/signin/", $this->ajax_redirect, 'SESSION_EXPIRED', 'location.reload(true)');

		}

	}

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    private function check(){

		if(isset($_COOKIE[KeyAuth])){

			list($user, $token) = explode(':', $_COOKIE[KeyAuth]);

			if(ctype_alnum($user) && ctype_alnum($token)){

				global $dbh;

				$result = $dbh->prepare("SELECT `identifier`, `token`, `timeout` FROM `users` WHERE `identifier` = :user ");
				$result->bindValue(':user', $user, PDO::PARAM_STR);
                $result = $result->executeQuery()->fetchAllAssociative();

				if($result){

					if($result[0]['token'] == $token && time() < $result[0]['timeout']){

						return true;

					}elseif($result[0]['token'] !== $token){

						$this->redirect_signin();

					}elseif(time() > $result[0]['timeout']){

						$this->redirect_signin();
					}

				}else{

					$this->redirect_signin();

				}


			}else{

				$this->redirect_signin();
			}

		}else{

			if(!isset($_SESSION)){session_start();}

			$_SESSION['backURL'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$this->redirect_signin();

		}







	}


}
