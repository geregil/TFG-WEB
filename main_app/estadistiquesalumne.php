<?php 
session_start();
error_reporting(0);
$varsesio = $_SESSION['usuari'];
$idalumne = $_SESSION['idalumne'];

if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
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
  <div style="margin-top:5%">
    <div class="container" id="contentHistoriasOm">
        <section id="subirOm" class="pb-3">
            <div class="row p-0 m-0">
                <div class="col p-0 m-0">
                    <div class="row bg-white mx-auto">
                        <div class="col-12 p-0 m-0 bg-primary" >
                            <h1 class="text-center text-white p-0 m-0 display-5 pt-3 pb-3"><strong>Estadístiques</strong></h1>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row p-0 m-0">
                <div class="col-lg-4 col-xl-5 p-0 m-0 p-3 bg-info mx-auto" style="border:1px solid black">
                    <h5 class=" p-0 m-0 pb-2" style="color:black"><strong>GENERAL:</strong></h5>
                    <div class="table-responsive">
                        <table class="table" style="color:black">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                     require 'conn.php';
                                       $sql = "SELECT COUNT(*) AS cursos FROM alumne_curs where IDalumne = $idalumne";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $cursos = $row["cursos"];
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    <td>Cursos assignat: <?php echo $cursos?></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <?php
                                     require 'conn.php';
                                       $sql = "SELECT COUNT(*) AS tasques FROM alumne_curs al INNER JOIN curs c ON al.IDcurs = c.ID INNER JOIN tasca t ON c.ID = t.IDcurs where al.IDalumne= $idalumne";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $tasques = $row["tasques"];
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    <td>Tasques assignades: <?php echo $tasques ?></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <?php
                                     require 'conn.php';
                                       $sql = "SELECT exercicis, Punts FROM alumne where ID = $idalumne";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $exercicis = $row["exercicis"];
                                                 $punts = $row["Punts"];
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    <td>Exercicis Totals: <?php echo $exercicis ?></a></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <td>Punts Totals: <?php echo $punts?></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                
                                    <?php
                                     require 'conn.php';
                                       $sql = "SELECT id,nom FROM categoria";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $idcat = $row["id"];
                                                require 'conn.php';
                                                   $sql1 = "SELECT COUNT(*) AS cursos FROM alumne_curs al INNER JOIN curs c ON al.IDcurs = c.ID INNER JOIN categoria cat ON c.categoria = cat.id where cat.id = $idcat and al.IDalumne = $idalumne";
                                                    $result1 = $mysqli->query($sql1);
                                                    if ($result1->num_rows > 0) {
                                                        while($row1 = $result1->fetch_assoc()) {
                                                            echo"<tr><td>Cursos ".utf8_encode($row["nom"]).": ".$row1["cursos"]."</td>
                                                            <td class='p-0 m-0 p-1'></td> </tr>";
                                                        }
                                                    }
                                                   $mysqli->close();
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    
                               
                            </tbody>
                        </table>
                    </div></div>
                <div class="col-lg-4 col-xl-7 p-0 m-0 p-3 bg-warning mx-auto" style='color:white;border:1px solid black'>
                    <h5 class="text-primary p-0 m-0 pb-2" style='color:white'><strong style='color:white'>CURSOS CREATS:</strong></h5>
                    <p class="p-0 m-0 pb-2">A continuació tens el llistat de cursos que has creat:</p>
                    <div class="table-responsive">
                        <center><input id="myInput" type="text" placeholder="Busca.." style="width:50%;"></center></br>
                        <div class="container" id="taulaprincipal">
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

                                    $cursos ="SELECT count(c.Nom) as total from alumne_curs INNER JOIN curs c ON alumne_curs.IDcurs = c.ID INNER JOIN categoria ca ON c.categoria = ca.ID WHERE alumne_curs.IDalumne = $idalumne ";

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

                                if ( ! isset( $_GET['pag'] ) or ! is_numeric( $_GET['pag'] ) ) {

                                    $pag = 0;

                                } else {
                                    $pag = (int) $_GET['pag'];
                                }
                                 require 'conn.php';

                                    $cursos ="SELECT c.ID, c.Nom, c.Data_creat, ca.nom from alumne_curs INNER JOIN curs c ON alumne_curs.IDcurs = c.ID INNER JOIN categoria ca ON c.categoria = ca.ID WHERE alumne_curs.IDalumne = $idalumne ORDER BY c.Data_creat DESC LIMIT $pag, 5";

                                    $result = $mysqli->query($cursos);
                                    $i = 0;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                              echo"<tr>
                                                  <td>".utf8_encode($row["Nom"])."</td>
                                                  <td>".utf8_encode($row["nom"])."</td>
                                                  <td>
                                                   <form method='post' action='estadistiquesdetallalumne.php'>
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
                        <div class="container" id="taula" style='display:none'>
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

                                    $cursos ="SELECT c.ID, c.Nom, c.Data_creat, ca.nom from alumne_curs INNER JOIN curs c ON alumne_curs.IDcurs = c.ID INNER JOIN categoria ca ON c.categoria = ca.ID WHERE alumne_curs.IDalumne = $idalumne ORDER BY c.Data_creat DESC";

                                    $result = $mysqli->query($cursos);
                                    $i = 0;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                              echo"<tr>
                                                  <td>".utf8_encode($row["Nom"])."</td>
                                                  <td>".utf8_encode($row["nom"])."</td>
                                                  <td>
                                                   <form method='post' action='estadistiquesdetallalumne.php'>
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
                </div>
            </div>
        </section>
    </div>
    <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_alumne.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_alumne.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="perfil_alumne.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
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
