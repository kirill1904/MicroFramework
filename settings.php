<?php
$style=array();
$styles = glob( FRAMEWORK_DIR . '/assets/css/*.{css.php,css}' , GLOB_BRACE );
foreach ($styles as $st) {
$style[] = str_replace(BASE_DIR,'',$st);
}

$script=array();
$scripts = glob( FRAMEWORK_DIR . '/assets/js/*.js' );
foreach ($scripts as $st) {
$script[] = str_replace(BASE_DIR,'',$st);
}


$apps = db_find('apps','`state`',array(1),2);
$active_apps=array();
foreach ($apps as $app) {
	$active_apps[] = $app['appname'];
}
$settings = array();
$sett=db_find('settings','id',array(1),1);
foreach ($sett as $key => $value) {
$settings[$key] = $value;
}
$settings['styles'] = $style;
$settings['scripts'] = $script;
$settings['apps'] = $active_apps;


return $settings;

?>