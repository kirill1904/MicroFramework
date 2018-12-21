<?php 
	$count = count( db_find('blog') );
	$page_count = page_count('blog',PER_PAGE);
	return array(
		'count' => $count,
		'page_count'=> $page_count,
	);
?>