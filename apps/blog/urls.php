<?php 
	
	return array(
		url('/blog', 'main', 'alias_blog'),
		url('/blog/{id}-{title}', 'read', 'blog_page')
	);


/*
	return array(
		'#^/news/read/([0-9]+)#i' => 'ReadNews',
		'#^/news*#i' => 'Main'
		
		);

*/
 ?>

