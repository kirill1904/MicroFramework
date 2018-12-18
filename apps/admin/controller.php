<?php
class Admin_Controller extends Controller
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
}




?>