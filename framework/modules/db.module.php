<?php 
use \RedBeanPHP\R as R;


R::setup( 'mysql:host=localhost;dbname=framework',
        'root', '' ); //for both mysql or mariaDB

function db_dispense($table,$data){
	$db=R::dispense($table);
	foreach ($data as $key => $value) {
		$db->$key=$value;
	}
	return R::store( $db );
}

function db_find($table,$where='',$what=array(),$type=0){
	if($type==0){
		$result = R::find($table);
	}elseif ($type==1) {
		$result = R::findOne($table, $where.' LIKE ? ', $what);
	}
	return $result;
}

function lorem($count){

for ($i=0; $i < $count; $i++) { 
	$lorem = array('title'=>"Lorem ".$i,'image'=>$i.'.jpg', 'text'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae ex eum amet consectetur similique, repellendus minus magnam ad tempora earum harum necessitatibus explicabo, culpa nostrum inventore praesentium dolore, ducimus soluta!', 'views'=>rand() );
	db_dispense('blog',$lorem);
}
 
}
?>
