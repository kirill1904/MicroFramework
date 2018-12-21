<?php
class Admin_Controller extends Controller
{
	
	public function main($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			render('main', $vars);
			}else{
			render('denied', $vars);
			}

		}
		else{
			//$arr = ,
			redirect('/login');
		}
	
	}
	public function apps($args){

		if(isset($_POST['app'])){
			$apps = db_find('apps','`system`',array(1), 2);
			$sys_apps = array();
			foreach ($apps as $app) {
				$sys_apps[] = $app['appname'];
			}		
			$app = $_POST['app'];
			$state = $_POST['state'];
			if(in_array($app, $sys_apps)){
				$vars['message'] = array('text'=>'Системные приложения нельзя отключить!','type'=>'alert-danger');
			}else if($state!=2){
			db_exec("UPDATE `apps` SET `state` = ? WHERE `appname` = ?", array($state,$app));
			}else{
			rmdir(APPS_DIR.'/forum');
			rmdir(TEMPLATES_DIR.'/apps/'.$app);
			db_exec("DELETE FROM `apps`  WHERE `appname` = ?", array($app));
			}
		}
		$apps=db_find('apps');
		foreach ($apps as $app) {
			$app['state']= (int)$app['state'];
		}
		$vars['apps'] = $apps;
		render('apps', $vars);
	}


	public function settings($args){
		render('settings', $vars);
	}
	public function pages($args){
		render('pages', $vars);
	}
	public function users($args){
		$users=db_find('users');
		foreach ($users as $user) {
			$app['type']= (int)$app['type'];
		}
		$vars['users'] = $users;
		render('users', $vars);
	}
}
?>