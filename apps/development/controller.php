<?php


class Development_Controller extends Controller
{
	

	public function main($args){
		render('main', array(
			'today' => today(),
			'title' => 'В разработке',

		));
	}

	
}

?>