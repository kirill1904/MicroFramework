<?php 
if(file_exists('../core/composer/vendor/autoload.php')) {
	require '../core/composer/vendor/autoload.php';
} 
require '../modules/db.module.php';
$r = $_GET['app'];
//$r="blog";
$app = db_find('apps','appname',array($r),1);
$resp = array();
foreach ($app as $key => $value) {
	$resp[$key] = $value;
	//if ($key=='aliases') $resp[$key] = explode(',', $value);
}
$resp=json_encode($resp);
echo($resp);


?>