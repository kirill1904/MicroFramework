<?php 

function render($view,$vars = array()){
	$loader = new Twig_Loader_Filesystem(TEMPLATES_DIR);
	$loader->addPath(TEMPLATES_DIR . '/' . ACTIVE_APP);

	$twig = new Twig_Environment($loader, array(
    //'cache' => TWIG_CHACHE_DIR
	));
	$exts = glob( TWIG_EXT_DIR . '/*.twig.php' );
	foreach ($exts as $ext) {
		require $ext;
		$ext_class_name = '\\Twig_Extenstions\\'.  ucfirst(str_replace('.twig.php', '', basename($ext))) . '_Twig_Extenstion';
		$twig->addExtension( new  $ext_class_name());
	}
	$twig->addExtension(new Twig_Extensions_Extension_Text());
	$template = $twig->loadTemplate($view . '.html');

	extend_vars($vars);
	$template->display($vars);
}

function render_url($view, $vars = array()){
	extend_vars($vars);
	return array(
		'views' => $view,
		'vars' => $vars
		);

}

function extend_vars(&$vars){
	$vars['settings'] = require(BASE_DIR . '/settings.php');
	$vars['post'] = $_POST;
	if(isset($_SESSION['login'])){$vars['user']['login'] = $_SESSION['login'];}

	foreach ($vars['settings']['apps'] as $iterable_app) {
		$twig_app_extend = BASE_DIR . '/apps/' . $iterable_app . '/twig.php';
		if ( file_exists($twig_app_extend) ) {
			$vars['apps'][$iterable_app] = require $twig_app_extend;
		}
	}
}
?>