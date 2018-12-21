<?php
class Auth_Controller extends Controller
{
	public function main($args){
		if(isset($args['2'])){
			$user = db_find('users', 'login', array($args['2']) , 1);
			$user['avatar'] = 'https://www.gravatar.com/avatar/'.md5($user['email']).'?s=200';
			$vars['profile'] = $user;
		}else {
			$user = db_find('users', 'login', array($_SESSION['login']) , 1);
			$user['avatar'] = 'https://www.gravatar.com/avatar/'.md5($user['email']).'?s=200';
			$vars['profile'] = $user;
		}

		if(!isset($vars['profile']['login'])){
			$message = array('text'=>'Пользователь стаким логином не найден!','type'=>'alert-danger');
					
		}
		if(isset($message)){
			$vars['message'] = $message;
		}
		render('main', $vars);
	}


	public function login($args){
		if(isset($_POST['log'])){
			$login = $_POST['login'];
			$pass = $_POST['pass'];
			$user = db_find('users', 'login', array($login) , 1);
			if(isset($user['login'])){
				if(password_verify($pass,$user['password'])){
					$_SESSION['login'] = $login;
					redirect('/');
				}
				else {
					$message = array('text'=>'Пароль неверный!','type'=>'alert-danger');
				}
			}else {
				$message = array('text'=>'Пользователь с логином ' . $login . ' не найден','type'=>'alert-danger');
			}
			if(isset($message)){
				$vars['message'] = $message;
			}
		}
		render('login', $vars);
	}


	public function logout($args){
		unset($_SESSION['login']);
		redirect('/');
	}

	public function register($args){
		if(isset($_POST['reg'])){
			$messages = array();
			$users = db_find('users', 'login', array($_POST['login']) , 1);
			$mails = db_find('users', 'email', array($_POST['email']) , 1);
			if (isset($users['login'])) {
				$messages[] = array('text'=>'Пользователь с таким логином  существует!','type'=>'alert-danger');
			}
			if (isset($mails['email'])){
				$messages[] = array('text'=>'Пользователь с такой почтой существует!','type'=>'alert-danger');
				
			}

			if (empty($messages)){
			db_dispense('users',array(
				'login'=>$_POST['login'],
				'password'=>password_hash($_POST['pass'],PASSWORD_DEFAULT),
				'email'=>$_POST['email'],
				'regdate'=>today(),
				'type'=>0
			));
			$messages[] = array('text'=>'Регистрация завершена!','type'=>'alert-success','alias'=>'alias_login','link'=>'Войти!');
			}
		}
		if(isset($messages['0'])){
			$vars['message'] = $messages['0'];			
		}
		render('register', $vars);
	}
	public function edit($args){
		
	}
}

?>