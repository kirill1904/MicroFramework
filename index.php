<?php 
define('BASE_DIR',  getcwd() );

session_start();
//echo(BASE_DIR); exit();
define('FRAMEWORK_DIR', BASE_DIR . '/framework');

require FRAMEWORK_DIR . '/starter.php';

$app = new Engine(require('settings.php')); 
?>