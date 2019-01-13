<?php


class Search_Controller extends Controller
{
	public function main($args){
		render('main', array(
			'get' => $_GET,
			'title' => 'Поиск',
		));
	}

	
}

?>