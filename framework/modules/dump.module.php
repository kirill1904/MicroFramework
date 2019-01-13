<?php 
function dump($what, $exit = true){
	new dBug($what);

	if ( $exit ){
		exit;
	}


}
?>