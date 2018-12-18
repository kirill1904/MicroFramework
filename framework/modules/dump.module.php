<?php 
function dump($what, $exit = true){
	echo "<pre>";
	var_dump($what);
	echo "</pre>";

	if ( $exit ){
		exit;
	}


}
?>