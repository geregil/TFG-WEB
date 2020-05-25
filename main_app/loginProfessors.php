<?php
require 'conn.php';
sleep(2);
$prof =$mysqli->query("SELECT * from professor WHERE Correu = '".$_POST['email']."' AND Contrasenya = '".$_POST['password']."'");

if($prof->num_rows == 1){
	$dades = $prof->fetch_assoc();
	echo json_encode(array('error' => false));
	session_start();
	$_SESSION['usuariprof'] = $dades["NomUsuari"];
	$_SESSION['correu'] = $dades["Correu"];
	$_SESSION['nom'] = $dades["Nom"];
	$_SESSION['contrasenya'] = $dades["Contrasenya"];
	$_SESSION['centre'] = $dades["Centre_educatiu"];
	$_SESSION['id'] = $dades["ID"];

}else{
	echo json_encode(array('error'=>true));
}

$mysqli ->close();
?>