<?php
$conn = mysqli_connect('localhost:3308','root','','racoestudi');
session_start();
$password = $_POST['password'];
$nom = $_POST['nom'];
$usuari = $_SESSION['usuari'];

/**dades sessió noves**/

	$_SESSION['nom'] = $nom;
	$_SESSION['contrasenya'] = $password;

$sql="UPDATE alumne SET Contrasenya='$password', Nom='$nom' WHERE NomUsuari = '$usuari'";

echo mysqli_query($conn,$sql);

?>