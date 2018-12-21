<?php


class Development_Controller extends Controller
{
	

	public function main($args){
		render('main', array(
			'today' => today(),
			'title' => 'Главная',
			'header' => 'Стриница на реконструкции',
 			'banner'=> 'Lorem ipsum dolor sit amet.'
		));
	}

	
}

?>