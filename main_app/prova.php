<?php
$conn = mysqli_connect('localhost:3308','root','','racoestudi');
session_start();
$id = $_SESSION['id'];
$nom = $_POST['nom'];
$categoria = $_POST['categoria'][0];
$desc = $_POST['desc'];
$data = date("d-m-Y");
$array=$_REQUEST['arrayAlumnes'];

$sql="INSERT into curs (Nom,Descripcio,Data_creat,categoria,IDprofessor) values ('$nom','$desc','$data',$categoria,$id)";
$a = count($array);
$i = 0;
while($i < $a){
	$sql1 ="INSERT INTO alumne_curs(IDalumne,IDcurs) values ($array[$i],1)";
	mysqli_query($conn,$sql1);
	$i++;

}
echo mysqli_query($conn,$sql);


?> 