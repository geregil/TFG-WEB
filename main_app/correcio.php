<?php 
session_start();
error_reporting(0);
$idprof = $_SESSION['id'];
$varsesio = $_SESSION['usuariprof'];

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
</head>

<body>
       <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_professor.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_professor.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="perfil_professor.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <h1><strong><center>Exercicis pendents</center></strong></h1>
    <div class="container">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Exercici</th>
      <th scope="col">Alumne</th>
      <th scope="col">Data fet</th>
      <th scope="col">Accés</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require 'conn.php';

                                    $cursos ="SELECT count(e.Nom) as total FROM `alumne_exercici` a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN curs c ON e.IDcurs = c.ID INNER JOIN alumne al on a.IDalumne = al.ID WHERE c.IDprofessor=$idprof and a.revisat = 0";

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
                $con=mysqli_connect('localhost:3308','root','','racoestudi');
                $sql = "SELECT e.ID, e.Nom, a.Data, al.NomUsuari, a.id FROM `alumne_exercici` a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN curs c ON e.IDcurs = c.ID INNER JOIN alumne al on a.IDalumne = al.ID WHERE c.IDprofessor=$idprof and a.revisat = 0 ORDER BY a.Data DESC LIMIT $pag, 5";
                $result2 = $con->query($sql);
                if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row1 = $result2->fetch_assoc()) {
                      echo"<tr>
                      <td>".utf8_encode($row1["Nom"])."</td>
                      <td>".utf8_encode($row1["NomUsuari"])."</td>
                      <td>".utf8_encode($row1["Data"])."</td>
                      <td>
                      <form method='post' action='veureexercici.php'>
                      <input type='hidden' name='idex' value='".$row1["ID"]."'>
                      <input type='hidden' name='idae' value='".$row1["id"]."'>
                      <input type='submit' class='btn btn-primary form-btn' value='Entra'>
                      </form>
                      </td>
                      </tr>";
                    }
                }
                $con->close();

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
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="../assets/js/Grid-and-List-view-V10.js"></script>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
    <script src="../assets/js/Sidebar-Menu.js"></script>
</body>
<script type="text/javascript">

</script>

</html>