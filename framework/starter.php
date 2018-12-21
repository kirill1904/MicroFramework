<?php 

require FRAMEWORK_DIR .'/core/system/base_controller.php';
require FRAMEWORK_DIR .'/core/system/controller.php';



//Подключение composer
if(file_exists(FRAMEWORK_DIR . '/core/composer/vendor/autoload.php')) {
	require FRAMEWORK_DIR . '/core/composer/vendor/autoload.php';
}


define('TWIG_CACHE_DIR', FRAMEWORK_DIR . '/cache');
define('APPS_DIR', BASE_DIR . '/apps');
define('TEMPLATES_DIR', BASE_DIR . '/templates');
define('MODULES_DIR', FRAMEWORK_DIR . '/modules');
define('CORE_DIR', FRAMEWORK_DIR . '/core');
define('COMPOSER_DIR', CORE_DIR . '/composer');
define('TWIG_EXT_DIR',   MODULES_DIR .'/twig_ext');

$modules = glob( MODULES_DIR . '/*.module.php' );
foreach ($modules as $module) {
require $module;
}

$settings=db_find('settings','id',array(1),1);

define('PER_PAGE', $settings['per_page']);



require FRAMEWORK_DIR. '/core/bootstrap.php';






?>