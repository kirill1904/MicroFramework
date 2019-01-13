<?php 
	$count = count( db_find('blog') );

	return array(
		'count' => $count,
	);
?>