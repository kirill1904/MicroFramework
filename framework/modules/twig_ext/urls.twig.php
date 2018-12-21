<?php 
namespace Twig_Extenstions;


class Urls_Twig_Extenstion extends \Twig_Extension
{
	protected
		$placeholders,
		$c=0;

	public function getFunctions()
	{
		return array(
			new \Twig_SimpleFunction('url', array($this, 'url'))
		);
	}
	public function url($arguments){
		//
		$settings = require BASE_DIR . '/settings.php';
		$this->placeholders = $arguments;

		if (isset($arguments['alias'])) {
			$alias_name = $arguments['alias'];
		}
		if (isset($arguments['app'])) {
			$app_name = $arguments['app'];
		}
		
		$iterable_urls = array();
		if(isset($app_name) && in_array($app_name, $settings['apps'])){
			$iterable_urls = require APPS_DIR . '/' . strtolower($app_name) . '/urls.php';

		}else{
			
			foreach ($settings['apps'] as $app) {
				$iterable_urls = array_merge($iterable_urls, require APPS_DIR . '/' . strtolower($app) . '/urls.php');
			}
		} 
		
		foreach ($iterable_urls as $iu) {
			
			if($alias_name == $iu['alias']){
				//$c++;
				return $this->convert_url($iu['pattern']);
			}
		}
		if ($c==0) {
				return '/development';
			}



	}

	public function convert_url($pattern){
		return preg_replace_callback('#\{[A-z0-9]+\}#', array($this, 'convert_url_callback'), $pattern);
	}

	public function convert_url_callback($match){
		$key = str_replace('{', '', str_replace('}', '', $match[0]));
		$value=$this->placeholders[$key];
		unset($this->placeholders[$key]);
		return $value;
	}
}
?>