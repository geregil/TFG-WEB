<?php
	session_start();
	error_reporting(0);
	$varsesio = $_SESSION['correu'];

	if($varsesio == null || $varsesio = ''){
		echo 'No té autorització';
		die();
	}
	session_destroy();
	header("Location:../index.html");
?>