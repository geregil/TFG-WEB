<script src="../assets/js/push.min.js"></script>
<?php 
session_start();

$varsesio = $_SESSION['idex'];

if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}else{
     if(isset($_POST['resposta'])){
        require 'conn.php';
        $id = $_SESSION['idex'];
        $alumne = $_SESSION['idalumne'];
        $punts = $_SESSION['punts'];
        $resp = $_POST['resposta'];
        strtolower($resp);
        $data = date("d/m/Y h:m:s A");
        $sql = "SELECT Resposta, auto from exercici where ID=$id";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $resposta = $row["Resposta"];
                 $auto = $row["auto"];
            }
        }
       $mysqli->close();

        $rowcount=0;
          $con=mysqli_connect('localhost:3308','root','','racoestudi');
          $sql="SELECT IDexercici FROM alumne_exercici WHERE IDalumne = $alumne and IDexercici = $id";
            if ($result1=mysqli_query($con,$sql))
            {
                $rowcount=mysqli_num_rows($result1);                
                mysqli_free_result($result1);
            }
        mysqli_close($con);


       $conn = mysqli_connect('localhost:3308','root','','racoestudi');
       $revisat=1;
       $nota = 10;
       if(($resp == $resposta) && ($auto == 1)){
        $text = "Exercici correcte!";
        if($rowcount == 1){
            $calcul = $rowcount;
        }else{
             $calcul = $rowcount * 0.5;
        }
        $punts = $punts - $calcul;
        if($punts <= 0){
            $punts = 1;
        }
        $nota = $nota - $calcul;
       }else if (($resp != $resposta) && ($auto == 1)){
        $text = "Exercici incorrecte!";
        $nota = 0;
        $punts = 0;
       }else{
        $text = "Exercici pendent de revisió!";
        $punts = 0;
        $nota = 0;
        $revisat=0;
       }

       $sql1 = "INSERT INTO alumne_exercici (IDalumne, IDexercici, Data, Punts_Obtinguts, Nota, revisat, resposta) values ($alumne,$id,'$data',$punts,$nota,$revisat,'$resp')";
       $conn->query($sql1);

       $conn->close();


        require 'conn.php';
        $sql2 = "SELECT SUM(Punts_Obtinguts) AS puntstotals FROM alumne_exercici where IDalumne=$alumne";
        $result = $mysqli->query($sql2);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $puntsalumne = $row["puntstotals"];
            }
        }
       $mysqli->close();

       require 'conn.php';
       $sql3 = "SELECT COUNT(*) AS exercicistotals FROM alumne_exercici where IDalumne=$alumne and Punts_Obtinguts > 0";
        $result = $mysqli->query($sql3);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $exercicisalumne = $row["exercicistotals"];
            }
        }
       $mysqli->close();


       $conn = mysqli_connect('localhost:3308','root','','racoestudi');
        $sql3 = "UPDATE Alumne SET Punts=$puntsalumne, exercicis=$exercicisalumne WHERE id=$alumne";
        mysqli_query($conn,$sql3);
        $conn->close();

        cursos();
        trofeus($puntsalumne,$exercicisalumne);


    }else{
        echo"Error intern codi:x01";
    }
}


function trofeus($punts, $exercicis){
    $array=[];
    $arrayfets=[];

     require 'conn.php';
        $sql = "SELECT IDtrofeu from alumne_trofeu where IDalumne='".$_SESSION['idalumne']."'";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 array_push($arrayfets, $row["IDtrofeu"]);
            }
        }
        $mysqli->close();

    if($exercicis >= 1){
        array_push($array, 1);
    }
    if($exercicis >= 10){
        array_push($array, 2);
    }
    if($exercicis >= 100){
        array_push($array, 3);
    }
    if($exercicis >= 500){
        array_push($array, 4);
    }
    if($exercicis >= 2000){
        array_push($array, 5);
    }

    if($punts >= 10){
        array_push($array, 6);
    }
    if($punts >=100){
        array_push($array, 7);
    }
    if($punts >=1000){
        array_push($array, 8);
    }
    if($punts >=10000){
        array_push($array, 9);
    }

    if($punts >= 50000 && $exercicis >= 6000){
        array_push($array, 10);
    }
    $max = count($arrayfets);
    for($i=0;$i<$max;$i++){
        $j = $arrayfets[$i];
        $maxi = count($array);
        for($k=0;$k<$maxi;$k++){
            $l = $array[$k];
            if($j == $l){
                array_splice($array, $k, 1);
                $maxi = count($array);
            }
        }
    }
    $a = count($array);
    
    connexio($a,$array);
    if($a > 0){
    echo'<script>Push.create("Trofeu nou!",{
                body:"Has guanyat un trofeu, consulta el teu espai de trofeus.",
                icon:"../imatges/copes/8.jpg",
                onclick: function(){
                    window.location="trofeus.php";
                }
            });</script>';
    }
}

function cursos(){
    require 'conn.php';
        $sql = "SELECT COUNT(IDexercici) as exercicisfets from alumne_exercici where revisat = 1 and Punts_Obtinguts > 0 and IDalumne='".$_SESSION['idalumne']."'";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $exercicisf = $row["exercicisfets"];
            }
        }
        $mysqli->close();

    require 'conn.php';
        $sql = "SELECT IDcurs from exercici where ID='".$_SESSION['idex']."'";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $curs = $row["IDcurs"];
            }
        }
        $mysqli->close();

    require 'conn.php';
        $sql = "SELECT Count(ID) as ID from exercici where IDcurs=$curs";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $exercicistotals = $row["ID"];
            }
        }
        $mysqli->close();
        echo $exercicistotals;
        echo $exercicisf;
    if($exercicistotals == $exercicisf){
        $conn = mysqli_connect('localhost:3308','root','','racoestudi');
        $date = date('d/m/y h:m:s A');


        $sql3 = "UPDATE Alumne_curs SET Completat=1, Data_completat = '$date' WHERE IDalumne='".$_SESSION['idalumne']."'";
        mysqli_query($conn,$sql3);
        $conn->close();
    }

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>El racó d'estudi</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/Animated-Pretty-Product-List-v12.css">
    <link rel="stylesheet" href="../assets/css/Article-List.css">
    <link rel="stylesheet" href="../assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="../assets/css/Grid-and-List-view-V10-1.css">
    <link rel="stylesheet" href="../assets/css/Grid-and-List-view-V10.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navbar-Fixed-Side.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="../assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="../assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../assets/css/Responsive-Form-1.css">
    <link rel="stylesheet" href="../assets/css/Responsive-Form.css">
    <link rel="stylesheet" href="../assets/css/Sidebar-1-1.css">
    <link rel="stylesheet" href="../assets/css/Sidebar-1-2.css">
    <link rel="stylesheet" href="../assets/css/sidebar-1.css">
    <link rel="stylesheet" href="../assets/css/Sidebar-Menu-1.css">
    <link rel="stylesheet" href="../assets/css/Sidebar-Menu.css">
    <link rel="stylesheet" href="../assets/css/SIdebar-Responsive-2-1.css">
    <link rel="stylesheet" href="../assets/css/SIdebar-Responsive-2.css">
    <link rel="stylesheet" href="../assets/css/Sidebar-with-sticky-icon.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="../assets/js/Grid-and-List-view-V10.js"></script>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
    <script src="../assets/js/Sidebar-Menu.js"></script>
</head>

<?php
function connexio($count,$array){
if($count > 0){
    $conn = mysqli_connect('localhost:3308','root','','racoestudi');
    $i = 0;
    $data = date("d-m-Y H:i:s A");
    while($i < $count){
        $sql1 ="INSERT INTO alumne_trofeu(IDalumne,IDtrofeu,Data) values ('".$_SESSION['idalumne']."',$array[$i],'$data')";
        mysqli_query($conn,$sql1);
        $i++;

    }
    $conn->close();

    }

}
?>

<style>
#img{
    max-width:100%;
    max-height:100%;
}
</style>
<body>
    <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="#"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <div class="row register-form">
        <div class="col-md-12 alert-col relative" id="control" style="display:none">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span id="comentari"></span></div>
            </div>
        <div class="col-md-8 offset-md-2"><center>
                <h1><?php echo $text ?></h1></br>
                <h3><?php if($auto == 1){echo "Nota: ".$nota;}?></h3>

       <a class="btn btn-danger form-btn" type="reset" href="estudiaexercicis.php">TORNA</a>  </div>
       </center>
         </div>
        </div>
    </div>
</body>
</html>