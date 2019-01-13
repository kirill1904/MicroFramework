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
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
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
			$vars['message'] = array('text'=>'Настройки сохранены!','type'=>'alert-success');
			}else{
			rmdir(APPS_DIR.'/'.$app);
			rmdir(TEMPLATES_DIR.'/apps/'.$app);
			db_exec("DELETE FROM `apps`  WHERE `appname` = ?", array($app));
			$vars['message'] = array('text'=>'Приложение удалено!','type'=>'alert-info');
			}
			if($app=='search'){
				if($_POST['search']=='on'){
					$search=1;
				}else{
					$search=0;
				}
				db_exec("UPDATE `apps` SET `state` = ? WHERE `appname` = ?", array($search,'search'));
				db_exec("UPDATE `settings` SET `search` = ? WHERE `id` = ?", array($search,1));
			}
			
		}
		$apps=db_find('apps');
		foreach ($apps as $app) {
			$app['state']= (int)$app['state'];
		}
		$vars['apps'] = $apps;
		render('apps', $vars);
			}else{
			render('denied', $vars);
			}

		}
		else{
			//$arr = ,
			redirect('/login');
		}

		
	}


	public function settings($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			if(isset($_POST['app'])){
			if ($_POST['app']=='navmenu') {
			
			}
			if ($_POST['app']=='general') {
				$sitename = $_POST['title'];
				$per_page = $_POST['perpage'];
				db_exec("UPDATE `settings` SET `sitename` = ? , `per_page` = ? WHERE `id` = ?", array($sitename,$per_page,1));
			}
			if ($_POST['app']=='addlink') {
				$title = $_POST['title'];
				$app = $_POST['addapp'];
				$alias= $_POST['alias'];
				if ($alias=='alias_blogcat') {
				db_exec("INSERT INTO `navmenu` (`id`, `title`, `app`, `alias`, `cat`) VALUES (NULL, ?,?,?,?);",array($title, $app, $alias,$_POST['category']));
				}
				else{	
				db_exec("INSERT INTO `navmenu` (`id`, `title`, `app`, `alias`) VALUES (NULL, ?,?,?);",array($title, $app, $alias));
				}
			}
			$vars['message'] = array('text'=>'Настройки сохранены!','type'=>'alert-success');
		}
		$apps=db_find('apps');
		foreach ($apps as $app) {
			$app['state']=(int)$app['state'];
			$app['aliases'] = explode(',', $app['aliases']);

		}

		$vars['apps'] = $apps;
		
		render('settings', $vars);
			}else{
			render('denied', $vars);
			}

		}
		else{

			redirect('/login');
		}
	



	}
	public function pages($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			render('pages', $vars);
			}else{
			render('denied', $vars);
			}

		}
		else{

			redirect('/login');
		}
	}
	public function ArtDelete($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			db_exec("DELETE FROM `blog` WHERE `id` = ?",array($args['1']));
			$vars['message'] = array('text'=>'Запись удалена!','type'=>'alert-success');
			redirect($_SERVER['HTTP_REFERER']);
			}else{
			render('denied', $vars);
			}

		}
		else{
			//$arr = ,
			redirect('/login');
		}
	}

	public function NavDelete($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			db_exec("DELETE FROM `navmenu` WHERE `id` = ?",array($args['1']));
			$vars['message'] = array('text'=>'Ссылка удалена!','type'=>'alert-success');
			redirect($_SERVER['HTTP_REFERER']);
			}else{
			render('denied', $vars);
			}

		}
		else{
			//$arr = ,
			redirect('/login');
		}
	}
	public function add($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			if(isset($_POST['add']))
		{
			$title = $_POST['title'];
			$image = $_FILES['image']['name'];
			if(isset($_FILES['image']) && $_FILES['image']['error']==0){
			copy($_FILES['image']['tmp_name'], UPLOAD_DIR . '/images/' .$_FILES['image']['name']);
			}
			$cat = $_POST['cat'];
			$text = $_POST['text'];
			$desc = $_POST['desc'];
			$data = array(
				'title' => $title,
				'image' => $image,
				'category_id' => $cat,
				'desc' => $desc,
				'text' => $text
			);
			db_dispense('blog',$data);
 		}
		render('add', $vars);
			}else{
			render('denied', $vars);
			}
		}
		else{
			//$arr = ,
			redirect('/login');
		}		
	}
	public function catadd($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			if(isset($_POST['catadd']))
		{
			$name = $_POST['name'];
			$data = array(
				'name' => $name
			);
			db_dispense('categories',$data);
 		}
		redirect('/admin/blog');
			}else{
			render('denied', $vars);
			}
		}
		else{
			//$arr = ,
			redirect('/login');
		}		
	}
	public function edit($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			if(isset($_POST['edit']))
		{
			$title = $_POST['title'];
			
			if(isset($_FILES['image']) && $_FILES['image']['error']==0){
			$image = $_FILES['image']['name'];
			copy($_FILES['image']['tmp_name'], UPLOAD_DIR . '/images/' .$_FILES['image']['name']);
			}
			$cat = $_POST['cat'];
			$text = $_POST['text'];
			$desc = $_POST['desc'];
			$id = $args['1'];
			if(isset($image)){
				
				db_exec("UPDATE `blog` SET `title` = ?, `image` =?, `category_id`=?,`desc`=?,`text`=? WHERE `id` = ?;",array($title,$image,$cat,$desc,$text,$id));
			}else{
				db_exec("UPDATE `blog` SET `title` = ?, `category_id`=?,`desc`=?,`text`=? WHERE `id` = ?;",array($title,$cat,$desc,$text,$id));
			}
			
 		}
 		$article = db_find('blog','id',array($args['1']),1);
 		$vars['article'] = $article;
		render('edit', $vars);
			}else{
			render('denied', $vars);
			}

		}
		else{
			//$arr = ,
			redirect('/login');
		}
	
		
	}
	public function Navedit($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			if(isset($_POST['edit']))
		{
			$title = $_POST['title'];
			db_exec("UPDATE `navmenu` SET `title` = ? WHERE `id` = ?;",array($title,$args['1']));
			
			
 		}
 		$link = db_find('navmenu','id',array($args['1']),1);
 		$vars['link'] = $link;
		render('editlink', $vars);
			}else{
			render('denied', $vars);
			}

		}
		else{
			//$arr = ,
			redirect('/login');
		}
	
		
	}
	public function blog($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			//***код
			$per_page = 10; 
			$page_count = page_count('blog',$per_page);
			$offset = page_offset($per_page);
			$collection = db_collection('blog',$offset,$per_page);
			while( $art = $collection->next() ) {
				$cat = db_find('categories','id',array($art['category_id']),1);
				$art['cat_name'] = $cat["name"];
				$news_list[]=$art;
			}

			$vars['news'] = $news_list;
			$vars["page_count"]= $page_count;
			render('blog', $vars);
			//******
			}else{
				render('denied', $vars);
			}

		}
		else{
			//$arr = ,
			redirect('/login');
		}
	}
	public function users($args){
		if(isset($_SESSION['login'])){
			$user = db_find('users','login',array(($_SESSION['login'])),1);
			if($user['type']=='1'){
			$per_page = 10; 
			$page_count = page_count('users',$per_page);
			$offset = page_offset($per_page);
			$users=array();
			$collection = db_collection('users',$offset,$per_page);
			while( $art = $collection->next() ) {
				$art['type']=(int)$art['type'];
				$users[]=$art;

			}
			$vars['users'] = $users;
			$vars["page_count"]= $page_count;
			render('users', $vars);
			}else{
				render('denied', $vars);
			}
		}
		else{
			//$arr = ,
			redirect('/login');
		}
	
		
	}
}
?>