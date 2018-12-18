<?php 
	return array(
		url('/', 'main', 'alias_index'),
		url('/contact',render_url('contact', array(
			'phone' => '+70000000000',
			'email' => 'adm@site.ru',
			'title' => 'Контакты'
		)),'alias_contact'));
 ?>

