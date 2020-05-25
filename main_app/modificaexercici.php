<?php
$conn = mysqli_connect('localhost:3308','root','','racoestudi');
session_start();
$id = $_SESSION['idex'];
$nom = $_POST['nom'];
$punts = $_POST['punts'];
if($punts <= 1){
	$punts = 2;
}

$sql = "UPDATE exercici SET Nom='$nom', Punts='$punts' WHERE id=$id";
mysqli_query($conn,$sql);

?> 