<?php 
session_start();
error_reporting(0);
$varsesio = $_SESSION["correu"];

if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}else{
        require 'conn.php';
        if(isset($_POST['idpregunta'])){
         $idpregunta = $_POST['idpregunta'];
        }else{
            $idpregunta = $_SESSION['idpregunta'];
        }

        $sql = "SELECT p.Data, p.titol, p.missatge, p.IDalumne, p.tancada, pr.ID, pr.NomUsuari, pr.img from pregunta p inner join professor pr on p.IDprofessor = pr.ID where p.id = $idpregunta";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data = $row["Data"];
                $titol = utf8_encode($row["titol"]);
                $missatge= utf8_encode($row["missatge"]);
                $idalumne = $row["IDalumne"];
                $estat = $row["tancada"];
                $idprof = $row["ID"];
                $professor = $row["NomUsuari"];
                $imatgeprof =$row["img"];
            }
        }
    $mysqli->close();
    require 'conn.php';
        $imatge = null;
        $sql = "SELECT * from alumne where ID = $idalumne";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $usuarialumne = $row["NomUsuari"];
                $imatge = $row["img"];
            }
        }
    $mysqli->close();

    if(isset($_POST["resposta"])){
    $resposta =$_POST["resposta"];
    $dataresposta = date("d/m/y h:m:s A");
    $conn = mysqli_connect('localhost:3308','root','','racoestudi');
       $sql1 = "INSERT INTO resposta (IDpregunta, missatge, Data) values ($idpregunta,'$resposta','$dataresposta')";
       $conn->query($sql1);

       $conn->close();

    $conn = mysqli_connect('localhost:3308','root','','racoestudi');
        $sql3 = "UPDATE pregunta SET tancada=1 WHERE id=$idpregunta";
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="../assets/js/Grid-and-List-view-V10.js"></script>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
    <script src="../assets/js/Sidebar-Menu.js"></script>
</head>
<style>

</style>
<body>
    <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_alumne.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_alumne.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <?php
                    if(isset($_GET['al'])){
                        echo'<a href="preguntes.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>';
                    }else{
                        echo'<a href="preguntes_prof.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_professor.php"></a>';
                    }
                    ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <center><h1><?php echo $titol?></h1></center>
<div class="container" style="margin-top:5%; margin-left:40%">
    <div class="row">
        <div class="col-8">
            <div class="card card-white post">
                <div class="post-heading">
                    <div class="float-left image">
                      <?php

                         echo"<img id='img' width='100px' height='50px' src='../imatges/".$imatge."'>";
          

                        ?>
                    </div>
                    <div class="float-left meta">
                        <div class="col-md-4 relative">
                    </div>
                        <div class="title h5">
                            <a href="#"><b><?php echo $usuarialumne?></b></a>
                            ha escrit..
                        </div>
                        <h6 class="text-muted time"><?php echo $data?></h6>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p><?php echo utf8_encode($missatge)?></p>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($estat == 0){
    $_SESSION["idpregunta"] = $idpregunta;
    echo'<form method="post" action="preguntadetallprof.php" id="formt">
<center>
    <div id="resposta" style="margin-top:5%">
<label><b>Respòn la pregunta:</b></label></br>
<textarea type="text" id="resposta" name="resposta" cols="100" rows="5" required></textarea>
</div>
<input type="submit" class="btn btn-primary" id="envia" name="envia" value="Envia" />
</center>
</form>';
}else{
    require 'conn.php';
    
        $sql = "SELECT * from resposta where IDpregunta = $idpregunta";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dataresposta = $row["Data"];
                $resposta = $row["missatge"];
            }
        }
    $mysqli->close();
echo'
<div class="container" style="margin-top:5%">
    <div class="row">
        <div class="col-8">
            <div class="card card-white post">
                <div class="post-heading">
                <div class="float-left image">';
                            
    
                         echo"<img id='img' width='100px' height='50px' src='../imatges/".$imatgeprof."'>";
                        

                    echo'</div>
                    <div class="float-left meta">
                        <div class="title h5">
                            <a href="#"><b>'.$professor.'</b></a>
                            ha escrit..
                        </div>
                        <h6 class="text-muted time">'.$dataresposta.'</h6>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p>'.utf8_encode($resposta).'</p>

                </div>
            </div>
        </div>
        
    </div>
</div>';
}
?>
</body>
</html>