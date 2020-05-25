<?php
$conn = mysqli_connect('localhost:3308','root','','racoestudi');
session_start();
$idcurs = $_SESSION['idcurs'];
$array=$_POST['arrayAlumnes'];


$a = count($array);
$i = 0;
while($i < $a){
	$sql1 ="INSERT INTO alumne_curs(IDalumne,IDcurs,completat,Data_completat) values ($array[$i],$idcurs,0,0)";
	mysqli_query($conn,$sql1);
	$i++;

}





?> 