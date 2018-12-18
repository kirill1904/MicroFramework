<?php


class Bad_Link_Controller extends Controller
{
	

	public function main($args){
		render('main', array(
			'today' => today(),
			'title' => 'Главная',
			'header' => 'Сайт бла бла бла',
 			'banner'=> 'Lorem ipsum dolor sit amet.'
		));
	}

	
}

?>