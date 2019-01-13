<?php
/*
define('BASE_DIR',  getcwd() );
define('INSTALL',1);
define('FRAMEWORK_DIR', BASE_DIR . '/framework');

require FRAMEWORK_DIR.'/starter.php';

if(isset($_POST['install'])){
	System::change_database($_POST['dbname'],$_POST['dblogin'],$_POST['dbpass']);
	System::create_DBstruct();
	System::set_admin($_POST['adminlogin'],$_POST['adminemail'],password_hash($_POST['adminpass'],PASSWORD_DEFAULT));
	redirect('/');
}

echo('
	<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <link rel="icon" href="/framework/assets/images/icon.ico">
    <title>Установка</title>
	\n
	');
		

		

$style=array();
$styles = glob(__DIR__.'/framework/assets/css/*.{css.php,css}' , GLOB_BRACE );
foreach ($styles as $st) {
$style = str_replace(__DIR__,'',$st);
print("<link rel=stylesheet href='$style'>\n");
}
echo("</head>
");

echo('
	<body class="c">
    <form class="form-signin" method="post" action="/install.php">
      <div class="text-center mb-4">
        <img class="mb-4" src="/framework/assets/images/icon.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Установка движка</h1>
       
      </div>

      <div class="form-label-group">
        <input type="text" id="dbname" class="form-control" placeholder="Имя базы данных" name=dbname required autofocus>
        <label for="dbname">Имя базы данных</label>
      </div>
      <div class="form-label-group">
        <input type="text" id="dbLogin" class="form-control" placeholder="Логин пользователя базы данных" name=dblogin required >
        <label for="dbLogin">Логин пользователя базы данных</label>
      </div>
      <div class="form-label-group">
        <input type="password" id="dbPass" class="form-control" placeholder="Пароль пользователя базы данных" name="dbpass" >
        <label for="dbPass">Пароль пользователя базы данных</label>
      </div>
      <div class="form-label-group">
        <input type="text" id="adminLogin" class="form-control" placeholder="Логин администратора" name=adminlogin required >
        <label for="adminLogin">Логин администратора</label>
      </div>
       <div class="form-label-group">
        <input type="email" id="adminEmail" class="form-control" placeholder="Email администратора" name=adminemail required >
        <label for="adminEmail">Email администратора</label>
      </div>
      <div class="form-label-group">
        <input type="password" id="adminPass" class="form-control" placeholder="Пароль администратора" name="adminpass" required>
        <label for="adminPass">Пароль администратора</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" name=install type="submit">Установить!</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-2019</p>
    </form>

	');


$script=array();
$scripts = glob( __DIR__.'/framework/assets/js/*.js' );
echo("<script>window.jQuery || document.write('<script src='/framework/assets/js/jquery-3.3.1.min.js'><\/script>')</script>\n");
foreach ($scripts as $st) {
$script = str_replace(__DIR__,'',$st);

echo("<script src=$script></script>\n");
}
echo("</body>
</html>");

*/
?>
