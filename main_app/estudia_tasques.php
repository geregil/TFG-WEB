<?php 
session_start();
error_reporting(0);
$varsesio = $_SESSION['usuari'];
$idalumne = $_SESSION['idalumne'];
if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}else{
  if(isset($_POST['idcurs'])){


    $id = $_POST['idcurs'];
    $_SESSION['idcurs'] = $id;
    }
    $id = $_SESSION['idcurs'];
    require 'conn.php';

        $cursos ="SELECT * from curs WHERE ID = $id";

        $result = $mysqli->query($cursos);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $nom = $row["Nom"];
            }
        }
       $mysqli->close();
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
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_alumne.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_alumne.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="estudia.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <h1><strong><center>Tasques</center></strong></h1>
     <center><input id="myInput" type="text" placeholder="Busca.." style="width:50%;"></br>
     <form method='post' action='gestiona_recursos.php'>
                      <input type='hidden' name='idcurs' value=<?php $_SESSION['idcurs'];?>>
                      <input type='hidden' name='alumne' value='a'>
                      <input type='submit' class='btn btn-primary' value='BIBLIOTECA'>
                      </form>
    </center>
    <div class="container" id="taulaprincipal">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Data</th>
      <th scope="col">Nota</th>
      <th scope="col">Accés</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $idcurs = $_SESSION['idcurs'];
       require 'conn.php';

                                    $cursos ="SELECT count(ID) as total from tasca WHERE IDcurs = $idcurs ";

                                    $result = $mysqli->query($cursos);
                                    $i = 0;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                             $totalcurs = $row["total"];
                                        }
                                    }
                                   $mysqli->close();

                                   $pagines = $totalcurs / 10;
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
        $tasques = "SELECT ID,Nom,Data from tasca where IDcurs = $idcurs ORDER BY Data ASC LIMIT $pag, 10";

        $result = $mysqli->query($tasques);
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $con=mysqli_connect('localhost:3308','root','','racoestudi');
                $sql="SELECT (SUM(al.Nota) / count(al.IDexercici)) as mitjana from alumne_exercici al INNER JOIN exercici e ON al.IDexercici = e.ID where al.IDalumne=$idalumne and  Punts_obtinguts > 0 and e.IDtasca = '".$row["ID"]."'"; 
                $result1 = $mysqli->query($sql);
                 if ($result1->num_rows > 0) {
                     while($row1 = $result1->fetch_assoc()) {

                      echo"<tr>
                      <td>".utf8_encode($row["Nom"])."</td>
                       <td>".utf8_encode($row["Data"])."</td>
                       <td>".number_format($row1["mitjana"],2)."</td>
                      <td>     
                       <form method='post' action='estudiaexercicis.php'>
                      <input type='hidden' name='idtasca' value='".$row["ID"]."'>
                      <input type='submit' class='btn btn-primary' value='Entra'>
                      </form>
                     </td>
                      </tr>";
                     }
                 }
                
              mysqli_close($con);
            }
        }
       $mysqli->close();
  
    ?>
  </tbody>
</table>
<center>
                        <?php
                         //Now this is the link..
                            
                            $pagin = $pag / 10;
                            $a = $pagin + 1;
                            $prev = $pag - 10;
                            $ult = ($pagi-1) * 10;
                            if(($a<$pagi)&& ( $pag == 0 )){
                            echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . ( $pag + 10 ) . '">></a>';
                            echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' .$ult. '">Última </a>';
                            }else if(($a<$pagi) && ( $prev >= 0 )){
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=0"> Primera</a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . $prev . '"><</a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . ( $pag + 10 ) . '">></a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . $ult . '">Última </a>';
                            }else if(($a>=$pagi) && ( $prev >= 0 )){
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=0"> Primera</a>';
                                echo '<a class="btn btn-light" href="' . $_SERVER['PHP_SELF'] . '?pag=' . $prev . '"><</a>';
                            }


                        ?>
                    </center>
       
    </div>
        <div class="container" id="taula" style="display:none">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Data</th>
      <th scope="col">Nota</th>
      <th scope="col">Accés</th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php
    $idcurs = $_SESSION['idcurs'];
       require 'conn.php';

                                    $cursos ="SELECT count(ID) as total from tasca WHERE IDcurs = $idcurs ";

                                    $result = $mysqli->query($cursos);
                                    $i = 0;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                             $totalcurs = $row["total"];
                                        }
                                    }
                                   $mysqli->close();

                                   $pagines = $totalcurs / 10;
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
        $tasques = "SELECT ID,Nom,Data from tasca where IDcurs = $idcurs ORDER BY Data ASC";

        $result = $mysqli->query($tasques);
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $con=mysqli_connect('localhost:3308','root','','racoestudi');
                $sql="SELECT (SUM(al.Nota) / count(al.IDexercici)) as mitjana from alumne_exercici al INNER JOIN exercici e ON al.IDexercici = e.ID where al.IDalumne=$idalumne and  Punts_obtinguts > 0 and e.IDtasca = '".$row["ID"]."'"; 
                $result1 = $mysqli->query($sql);
                 if ($result1->num_rows > 0) {
                     while($row1 = $result1->fetch_assoc()) {

                      echo"<tr>
                      <td>".utf8_encode($row["Nom"])."</td>
                       <td>".utf8_encode($row["Data"])."</td>
                       <td>".number_format($row1["mitjana"],2)."</td>
                      <td>     
                       <form method='post' action='estudiaexercicis.php'>
                      <input type='hidden' name='idtasca' value='".$row["ID"]."'>
                      <input type='submit' class='btn btn-primary' value='Entra'>
                      </form>
                     </td>
                      </tr>";
                     }
                 }
                
              mysqli_close($con);
            }
        }
       $mysqli->close();
  
    ?>
  </tbody>
</table>
  
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="../assets/js/Grid-and-List-view-V10.js"></script>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
    <script src="../assets/js/Sidebar-Menu.js"></script>
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