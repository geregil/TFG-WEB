<?php
require 'conn.php';
sleep(2);
$alumne =$mysqli->query("SELECT Correu, Contrasenya, NomUsuari, Nom, Punts from alumne WHERE Correu = '".$_POST['email']."'");

if($alumne->num_rows == 1){
	echo json_encode(array('error'=>true));
}else{
	echo json_encode(array('error' => false));
}

$mysqli ->close();
?>