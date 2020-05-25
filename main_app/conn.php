<?php
	$mysqli = new mysqli('localhost:3308','root','','racoestudi');
	if($mysqli->connect_errno){
		echo"Error al connectar-se a la BD ".$mysqli->connect_error;
	}
?>