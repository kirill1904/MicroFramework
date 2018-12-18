<?php
	$style=array();
	$styles = glob( FRAMEWORK_DIR . '/assets/css/*.css' );
	foreach ($styles as $st) {
	$style[] = str_replace('Z:\domains\framephp.loc','',$st);
	}
	$script=array();
	$scripts = glob( FRAMEWORK_DIR . '/assets/js/*.js' );
	foreach ($scripts as $st) {
	$script[] = str_replace('Z:\domains\framephp.loc','',$st);
	}
	
	return array(
		'site' => 'Framework',
		'styles' => $style,
		'scripts' => $script,
		'apps' => array(
			'simple_pages',
			'blog',
			'bad_link',
			'auth',
			'admin'
		)
	);
?>