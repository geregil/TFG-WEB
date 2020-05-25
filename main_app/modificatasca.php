<?php
$conn = mysqli_connect('localhost:3308','root','','racoestudi');
session_start();
$id = $_SESSION['idtasca'];
$nom = $_POST['nom'];

$sql = "UPDATE tasca SET Nom='$nom' WHERE id=$id";
mysqli_query($conn,$sql);

?> 