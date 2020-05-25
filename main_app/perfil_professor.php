<?php 
session_start();
error_reporting(0);
$varsesio = $_SESSION['usuariprof'];
$idprof = $_SESSION['id'];
if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}
if(isset($_FILES["image"])){
        $conn = mysqli_connect('localhost:3308','root','','racoestudi');
        $usuari = $_SESSION['usuariprof'];
        $image = basename($_FILES["image"]["name"]);
        $ruta=$_FILES["image"]["tmp_name"];
        $desti="../imatges/".$image;
        copy($ruta,$desti);

        $sql="UPDATE professor SET img='$image' WHERE NomUsuari = '$usuari'";

        mysqli_query($conn,$sql);
        mysqli_close($conn);
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
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/Article-List.css">
    <link rel="stylesheet" href="../assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body style="background-image: url(&quot;../assets/img/image50.jpg&quot;);">
   <nav class="navbar navbar-light navbar-expand sticky-top" style="background-color: #ffffff;">
            <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="#"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse text-right" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">

                        <li class="nav-item" role="presentation"><a class="nav-link active" href="tancar_sessio.php">Tancar Sessió</a></li>
                    </ul>
            </div>
            </div>
        </nav>
    <div class="container" id="contentHistoriasOm">
        <section id="subirOm" class="pb-3">
            <div class="row p-0 m-0">
                <div class="col p-0 m-0">
                    <div class="row bg-white mx-auto">
                        <div class="col-12 p-0 m-0 bg-primary">
                            <h5 class="text-center text-white p-0 m-0 display-5 pt-3 pb-3"><strong>Perfil personal de <?php echo $_SESSION['usuariprof'] ?></strong></h5>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-8 p-0 m-0 p-3 text-secondary" style="border:1px solid black">
                            <h3><strong>Benvingut al Racó d'estudi</strong></h3>
                            <p class="p-0 m-0 pb-2">Et trobes al teu perfil, al lloc on trobaras les teves dades personals, els cursos que has creat a la plataforma i les estadístiques dels exercicis que han realitzat els teus alumnes.</p>
                            <div class="col-md-4 relative">
                    
                        <?php
                        require 'conn.php';
                            $usuari = $_SESSION['usuariprof'];
                            $sql = "SELECT img from professor where NomUsuari = '$usuari'";
                            $imatge = null;
                            $result = $mysqli->query($sql);
                            if ($result->num_rows > 0) {
                             while($row = $result->fetch_assoc()) {
                                $imatge = $row["img"]; 
                             }
                            }
                            $mysqli->close();
                            if(($imatge == null) || ($imatge=='')){
                            echo'<div class="avatar-bg center"></div>';
                        }else{
                         echo"<img id='img' width='100%' height='100%' src='../imatges/".$imatge."'>";
                        }

                        ?>
                    </div>
                        </div>
                        <div class="col-lg-4 col-xl-4 p-0 m-0 p-3 mx-auto bg-info" style="color:black;border:1px solid black">
                            <h5 class="p-0 m-0 pb-2" style="color: black"><strong>GESTIONA!</strong></h5><a class="btn btn-primary btn-block estudia" type="button" href="gestiona.php">ENTRA</a></br>
                            <?php
                            $con=mysqli_connect('localhost:3308','root','','racoestudi');
                              $sql="SELECT e.Nom FROM `alumne_exercici` a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN curs c ON e.IDcurs = c.ID  WHERE c.IDprofessor=$idprof and a.revisat = 0";
                              if ($result1=mysqli_query($con,$sql))
                                {
                                   $rowcount=mysqli_num_rows($result1);                
                                  mysqli_free_result($result1);
                                }
                                 mysqli_close($con);

                                  $con=mysqli_connect('localhost:3308','root','','racoestudi');
                              $sql="SELECT titol FROM pregunta WHERE IDprofessor=$idprof and tancada = 0";
                              if ($result1=mysqli_query($con,$sql))
                                {
                                   $rowcount2=mysqli_num_rows($result1);                
                                  mysqli_free_result($result1);
                                }
                                 mysqli_close($con);
                                            ?>
                            <h5 class=" p-0 m-0 pb-2" style="color: black"><strong>Corregeix!  <span class="label danger" style="color: red"><?php echo $rowcount;?></span></strong></h5><a class="btn btn-primary btn-block estudia" type="button" href="correcio.php">ENTRA</a>
                            <h5 class=" p-0 m-0 pb-2" style="color: black"><strong>Preguntes!  <span class="label danger" style="color: red"><?php echo $rowcount2;?></span></strong></h5><a class="btn btn-primary btn-block estudia" type="button" href="preguntes_prof.php">ENTRA</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-0 m-0">
                <div class="col-lg-4 col-xl-5 p-0 m-0 p-3 bg-info mx-auto" style="color:black; border:1px solid black">
                    <h5 class="p-0 m-0 pb-2"><strong>LES TEVES DADES PERSONALS:</strong></h5>
                    <p class="p-0 m-0 pb-2">Si és necessàri modifica-les amb el botó editar.</p>
                    <div class="table-responsive">
                        <table class="table" style="color:black">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nom: <?php echo $_SESSION['nom'] ?></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <td>Nom d'usuari: <?php echo $_SESSION['usuariprof'] ?></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <td>Contrasenya: <a class="hidetext" style="-webkit-text-security: disc"><?php echo $_SESSION['contrasenya'] ?></a></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <td>Email: <?php echo $_SESSION['correu'] ?></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                 <tr>
                                    <td>Imatge perfil: <form enctype="multipart/form-data" method="POST" action="perfil_professor.php"><input type="file" class="form-control" id="image" name="image"><center><input class="btn btn-primary form-btn" type="submit" value="Puja"></center></form></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><a class="btn btn-primary btn-block" role="button" href="editar_perfilProf.php">EDITAR</a><a class="btn btn-primary btn-block" type="button" href="estadistiques.php">ESTADÍSTIQUES</a></div>
                <div class="col-lg-4 col-xl-7 p-0 m-0 p-3 bg-warning mx-auto" style='color:white; border:1px solid black' >
                    <h5 class="text-primary p-0 m-0 pb-2" style='color:white'><strong style='color:white'>ÚLTIMS CURSOS CREATS:</strong></h5>
                    <p class="p-0 m-0 pb-2">A continuació tens el llistat de cursos que has creat:</p>
                    <center><input id="myInput" type="text" placeholder="Busca.." style="width:50%;"></center></br>
                    <div class="table-responsive" id="taulaprincipal">
                        <table class="table" style='color:white'>
                            <thead>
                                <tr>
                                    <th>CURS</th>
                                    <th>CATEGORIA</th>
                                    <th>ACCÉS</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                 require 'conn.php';

                                    $cursos ="SELECT count(curs.Nom) as total from curs INNER JOIN categoria c ON curs.categoria = c.id WHERE curs.IDprofessor = $idprof ";

                                    $result = $mysqli->query($cursos);
                                    $i = 0;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                             $totalcurs = $row["total"];
                                        }
                                    }
                                   $mysqli->close();

                                   $pagines = $totalcurs / 5;
                                   $pagi = round($pagines);

                                 //Check if the starting row variable was passed in the URL or not
                                if ( ! isset( $_GET['pag'] ) or ! is_numeric( $_GET['pag'] ) ) {

                                    //We give the value of the starting row to 0 because nothing was found in URL
                                    $pag = 0;

                                    //Otherwise we take the value from the URL
                                } else {
                                    $pag = (int) $_GET['pag'];
                                }

                                 require 'conn.php';

                                    $cursos ="SELECT curs.ID, curs.Nom, curs.Data_creat, c.nom, curs.Descripcio from curs INNER JOIN categoria c ON curs.categoria = c.id WHERE curs.IDprofessor = $idprof ORDER BY curs.Data_creat DESC LIMIT $pag, 5";

                                    $result = $mysqli->query($cursos);
                                    $i = 0;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                              echo"<tr>
                                                  <td>".utf8_encode($row["Nom"])."</td>
                                                  <td>".utf8_encode($row["nom"])."</td>
                                                  <td>
                                                   <form method='post' action='gestionacurs.php'>
                                                  <input type='hidden' name='idcurs' value='".$row["ID"]."'>
                                                  <input class='btn btn-dark' type='submit' value='Entra'>
                                                  </form>
                                                  </td>
                                                  </tr>";
                                        }
                                    }
                                   $mysqli->close();
                              
                                ?>
                            </tbody>
                        </table>
                        <center>
                        <?php
                         //Now this is the link..
                            
                            $pagin = $pag / 5;
                            $a = $pagin + 1;
                            $prev = $pag - 5;
                            $ult = ($pagi-1) * 5;
                            if(($a<$pagi)&& ( $pag == 0 )){
                            echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . ( $pag + 5 ) . '">></a>';
                            echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' .$ult. '">Última </a>';
                            }else if(($a<$pagi) && ( $prev >= 0 )){
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=0"> Primera</a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . $prev . '"><</a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . ( $pag + 5 ) . '">></a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . $ult . '">Última </a>';
                            }else if(($a>=$pagi) && ( $prev >= 0 )){
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=0"> Primera</a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . $prev . '"><</a>';
                            }


                        ?>
                    </center>
                    </div>
                    <div class="table-responsive" id="taula" style="display:none">
                        <table class="table" style='color:white'>
                            <thead>
                                <tr>
                                    <th>CURS</th>
                                    <th>CATEGORIA</th>
                                    <th>ACCÉS</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                 <?php
                                 require 'conn.php';

                                    $cursos ="SELECT curs.ID, curs.Nom, curs.Data_creat, c.nom, curs.Descripcio from curs INNER JOIN categoria c ON curs.categoria = c.id WHERE curs.IDprofessor = $idprof ORDER BY curs.Data_creat DESC";

                                    $result = $mysqli->query($cursos);
                                    $i = 0;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                              echo"<tr>
                                                  <td>".utf8_encode($row["Nom"])."</td>
                                                  <td>".utf8_encode($row["nom"])."</td>
                                                  <td>
                                                   <form method='post' action='gestionacurs.php'>
                                                  <input type='hidden' name='idcurs' value='".$row["ID"]."'>
                                                  <input class='btn btn-dark' type='submit' value='Entra'>
                                                  </form>
                                                  </td>
                                                  </tr>";
                                        }
                                    }
                                   $mysqli->close();
                              
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <form class="p-0 m-0">
                        <div class="input-group">
                            <div class="input-group-prepend"></div>
                            <div class="input-group-append"></div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<script type="text/javascript">
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    if(value < 1){
      $("#taulaprincipal").css("display","block");
      $("#taula").css("display","none");
    }else{
      $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      $("#taulaprincipal").css("display","none");
      $("#taula").css("display","block");
    });
    }
  });
});
</script>
</html>