
<?php
$conn = mysqli_connect('localhost:3308','root','','racoestudi');
session_start();
$id = $_SESSION['id'];
$nom = $_POST['nom'];
$categoria = $_POST['categoria'][0];
$desc = $_POST['desc'];
$data = date("d-m-Y H:i:s A");
$array=$_POST['arrayAlumnes'];

$sql="INSERT into curs (Nom,Descripcio,Data_creat,categoria,IDprofessor) values ('$nom','$desc','$data',$categoria,$id)";
mysqli_query($conn,$sql);


$sql2="SELECT ID from curs WHERE nom = '$nom'";
$result = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $idcurs = $row["ID"];
    }
} 

$a = count($array);
$i = 0;
while($i < $a){
	$sql1 ="INSERT INTO alumne_curs(IDalumne,IDcurs,completat,Data_completat) values ($array[$i],$idcurs,0,0)";
	mysqli_query($conn,$sql1);
	$i++;

}
?> 