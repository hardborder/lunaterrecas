<?php
 function conectar(){
	$db = mysqli_connect('localhost', 'root', '', 'siwal');
	if($db)
	{
		
		         				
	}
	else{
		echo 'Error';
		exit;
	}
	return $db;
}
?>