<?php
require 'conn.php';
sleep(2);
$alumne =$mysqli->query("SELECT ID,Correu, Contrasenya, NomUsuari, Nom, Punts from alumne WHERE Correu = '".$_POST['email']."' AND Contrasenya = '".$_POST['password']."'");

if($alumne->num_rows == 1){
	$dades = $alumne->fetch_assoc();
	echo json_encode(array('error' => false));
	session_start();
	$_SESSION['usuari'] = $dades["NomUsuari"];
	$_SESSION['correu'] = $dades["Correu"];
	$_SESSION['nom'] = $dades["Nom"];
	$_SESSION['contrasenya'] = $dades["Contrasenya"];
	$_SESSION['punts'] = $dades["Punts"];
	$_SESSION['idalumne'] = $dades["ID"];

}else{
	echo json_encode(array('error'=>true));
}

$mysqli ->close();
?>