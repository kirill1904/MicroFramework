<?php

function active_page(){
	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}else{
		$page=1;
	}
	return $page;
}

function page_offset($per_page){
	return  $per_page * active_page() - $per_page;
}
// количество страниц
function page_count($table,$per_page){  
	$count = count( db_find($table) );
	return ceil($count / $per_page);
}

?>