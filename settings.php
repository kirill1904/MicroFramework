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

	
	return array(
		'site' => 'Framework',
		'styles' => $style,
		'scripts' => $script,
		'macro' => $macro,
		'apps' => array(
			'simple_pages',
			'blog',
			'bad_link',
			'auth',
			'admin'
		)
	);
?>