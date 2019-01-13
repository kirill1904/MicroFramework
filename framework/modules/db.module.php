<?php 

$database = require_once(CORE_DIR.'/database.php');

class_alias('\RedBeanPHP\R','R');
R::setup( 'mysql:host=127.0.0.1;dbname='.$database['name'],
        $database['login'], $database['pass'] );//for both mysql or mariaDB

function db_dispense($table,$data){
	$db=R::dispense($table);
	foreach ($data as $key => $value) {
		$db->$key=$value;
	}
	R::store( $db );
}

function db_find($table,$where='',$what=array(),$type=0){
	try{
	if($type==0){
		$result = R::find($table);
	}elseif ($type==1) {
		$result = R::findOne($table, $where.' LIKE ? ', $what);
	}
	elseif ($type==2) {
		$result = R::findAll($table, $where .' LIKE ? ', $what);
	}
	return $result;
	} catch (PDOException $e){
		System::install();
	}	
}

function db_collection($table,$offset=0,$limit=10,$type=0,$cat=0){
	if($type == 0){
		$result = R::findCollection( $table , 'ORDER BY `id` DESC LIMIT '.$offset.','. $limit);
	}else{
		$result = R::findCollection( $table , 'WHERE `category_id` = '.$cat.' ORDER BY `id` DESC LIMIT '.$offset.','. $limit);
	}
	return $result;
}

function db_exec($query,$arr){
return R::exec($query, $arr);
}



?>
