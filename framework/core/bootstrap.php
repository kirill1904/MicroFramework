<?php 

class Engine 
{
	public 
		$settings,
		$uri,
		$app;

	function __construct($settings)
	{
		$this->settings = $settings;
		$this->uri = urldecode(preg_replace('/\?.*/iu', '', $_SERVER['REQUEST_URI']));
		$this->app = false;
		$this->process_path();
		$this->process_defines();
		$this->process_controllers();
	}

	public function process_path(){
		foreach ($this->settings['apps'] as $iterable_app) {
			$iterable_urls = require(BASE_DIR . '/apps/' . $iterable_app . '/urls.php');
			foreach ($iterable_urls as $url) {
				$url['pattern'] = convert_url($url['pattern']);

				$matches= array();
				if (preg_match($url['pattern'], $this->uri, $matches)) {
					
					$this->app =  array($iterable_app, array('pattern'=>$url['pattern'], 'method' => $url['view'], 'alias'=>$url['alias'], 'args' => $matches));
					
					break(2);

				}
			}

		}

		if($this->app==false){
			exit("App not found");

		}
	}

	public function process_defines(){
		define('ACTIVE_APP', $this->app['0']);
	}

	public function process_controllers(){
		
		if($this->app || is_array($this->app)){
			$app_controller = BASE_DIR . '/apps/' . $this->app['0'] . '/controller.php';
			
			if ( is_array($this->app['1']['method'])) {
				//direct render
				if(file_exists($app_controller)) {
					require($app_controller);
					$controller_name = $this->app['0'] . '_Controller';
					//if (isset($_POST)) {$this->app['1']['args']['post']=$_POST;}
					$this->app_controller = new $controller_name($this->app['1']['args']);
				}

			render($this->app['1']['method']['views'], $this->app['1']['method']['vars'] );
			}
			else {
			
				if(file_exists($app_controller)) {
					require($app_controller);
					$controller_name = $this->app['0'] . '_Controller';
					//if (isset($_POST)) {$this->app['1']['args']['post']=$_POST;}
					$this->app_controller = new $controller_name($this->app['1']['args']);
					$this->app_controller->{$this->app['1']['method']}($this->app['1']['args']);
				}
		}
		}
	}


}



?>