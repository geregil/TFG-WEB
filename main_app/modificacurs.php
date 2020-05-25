<?php
$conn = mysqli_connect('localhost:3308','root','','racoestudi');
session_start();
$id = $_SESSION['idcurs'];
$nom = $_POST['nom'];
$categoria = $_POST['categoria'][0];
$desc = $_POST['desc'];

$sql = "UPDATE curs SET Nom='$nom', Descripcio='$desc', categoria=$categoria WHERE id=$id";
mysqli_query($conn,$sql);

?> 