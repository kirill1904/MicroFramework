<?php 
define('TWIG_CACHE_DIR', FRAMEWORK_DIR . '/cache');
define('APPS_DIR', BASE_DIR . '/apps');
define('THEME_DIR', BASE_DIR . '/theme');
define('TEMPLATES_DIR', FRAMEWORK_DIR . '/templates');
define('SYSTEM_DIR', FRAMEWORK_DIR . '/core');
define('MODULES_DIR', FRAMEWORK_DIR . '/modules');
define('CORE_DIR', FRAMEWORK_DIR . '/core');
define('COMPOSER_DIR', CORE_DIR . '/composer');
define('TWIG_EXT_DIR',   MODULES_DIR .'/twig_ext');
define('UPLOAD_DIR',   BASE_DIR .'/load');

//Подключение composer
if(file_exists(FRAMEWORK_DIR . '/core/composer/vendor/autoload.php')) {
	require FRAMEWORK_DIR . '/core/composer/vendor/autoload.php';
}

$modules = glob( MODULES_DIR . '/*.module.php' );
foreach ($modules as $module) {
require $module;
}




require FRAMEWORK_DIR.'/core/system.php';
require FRAMEWORK_DIR.'/core/controller.php';


$settings=db_find('settings','id',array(1),1);
if(!$settings && !defined('INSTALL')){System::install();}
define('PER_PAGE', $settings['per_page']);
require FRAMEWORK_DIR.'/core/bootstrap.php';
?>