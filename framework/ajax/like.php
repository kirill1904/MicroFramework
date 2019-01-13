<?php 
if(file_exists('../core/composer/vendor/autoload.php')) {
	require '../core/composer/vendor/autoload.php';
} 
define("CORE_DIR", str_replace(basename(__DIR__), '/core', __DIR__));
require '../modules/db.module.php';
$id = $_GET['like'];
$likes = db_find('blog','id',array($id),1);
$art = db_exec("UPDATE `blog` SET `likes` = ? WHERE `id` = ?",array($likes['likes']+1,$id));
echo($likes['likes']+1);
?>