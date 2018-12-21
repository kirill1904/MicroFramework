<?php
	$style=array();
	$styles = glob( FRAMEWORK_DIR . '/assets/css/*.{css.php,css}' , GLOB_BRACE );
	foreach ($styles as $st) {
	$style[] = str_replace('Z:\domains\framephp.loc','',$st);
	}

	$script=array();
	$scripts = glob( FRAMEWORK_DIR . '/assets/js/*.js' );
	foreach ($scripts as $st) {
	$script[] = str_replace('Z:\domains\framephp.loc','',$st);
	}

	$macro=array();
	$macros = glob( TEMPLATES_DIR . '/macro/*.macro.html' );
	foreach ($macros as $key => $value) {
	$macro[$key]['path'] = basename($value);
	$macro[$key]['name'] = str_replace('.macro.html','', $macro[$key]['path'] );
	}

	$apps = db_find('apps','`state`',array(1),2);
	$active_apps=array();
	foreach ($apps as $app) {
		$active_apps[] = $app['appname'];
	}

	return array(
		'site' => 'Framework',
		'styles' => $style,
		'scripts' => $script,
		'macro' => $macro,
		'apps' => $active_apps
	);

/*
	return array(
		'site' => 'Framework',
		'styles' => $style,
		'scripts' => $script,
		'macro' => $macro,
		'apps' => array(
			'simple_pages',
			'blog',
			'development',
			'auth',
			'admin'
		)
	);*/
?>