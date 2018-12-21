<?php


class Simple_Pages_Controller extends Controller
{
	public function main($args){
		
		render('main', array(
			'today' => today(),
			'title' => 'Главная',
			'header' => 'Сайт бла бла бла',
 			'banner'=> 'Lorem ipsum dolor sit amet.'
		));
	}

	public function contact($args){
		render('contact',array(
			'phone' => '+70000000000',
			'email' => 'adm@site.ru',
			'title' => 'Контакты'
		));
		
		}
}

?>