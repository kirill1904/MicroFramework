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
function page_count($table,$per_page,$type=0,$cat=0){  
	if ($type==0){
	$count = count( db_find($table) );
	return ceil($count / $per_page);
	}
	if ($type==1){
	$count = count( db_find($table,'category_id',array($cat)) );
	return ceil($count / $per_page);
	}
}

?>