<?php 
if(file_exists('../core/composer/vendor/autoload.php')) {
	require '../core/composer/vendor/autoload.php';
} 
require '../modules/db.module.php';
//$r="blog";
$categories = db_find('categories');
$resp = array();
foreach ($categories as $cat) {
	$resp[] = $cat;
	//if ($key=='aliases') $resp[$key] = explode(',', $value);
}

$resp=json_encode($resp);
echo($resp);


?>