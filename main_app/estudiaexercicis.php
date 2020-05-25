<?php 
session_start();
//error_reporting(0);
$varsesio = $_SESSION['idcurs'];

if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}if(isset($_POST['idtasca'])){
     $id = $_POST['idtasca'];
    $_SESSION['idtasca'] = $id;
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
                  <a href="estudia_tasques.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <h1><strong><center>Exercicis</center></strong></h1>
    <center><input id="myInput" type="text" placeholder="Busca.." style="width:50%;"></center></br>
    <div class="container" id="taulaprincipal">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Data</th>
      <th scope="col">Nota</th>
      <th scope="col">Punts</th>
      <th scope="col">Automàtic</th>
      <th scope="col">Accés</th>
    </tr>
  </thead>
  <tbody>
    <?php
            $idtasca = $_SESSION['idtasca'];
        $idalumne = $_SESSION['idalumne'];
    require 'conn.php';

                                    $cursos ="SELECT count(Nom) as total from exercici where IDtasca = $idtasca ";

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
        $exercicis = "SELECT ID,Nom,Data,Punts,auto from exercici where IDtasca = $idtasca order by Data DESC LIMIT $pag, 5";
        $result = $mysqli->query($exercicis);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $id = $row["ID"];

              $con=mysqli_connect('localhost:3308','root','','racoestudi');
              $sql="SELECT IDexercici from alumne_exercici where IDalumne=$idalumne and IDexercici = $id";
              if ($result1=mysqli_query($con,$sql))
                {
                   $rowcount=mysqli_num_rows($result1);                
                  mysqli_free_result($result1);
                }
                 mysqli_close($con);

                 $rowcount1=0;
              $con=mysqli_connect('localhost:3308','root','','racoestudi');
              $sql="SELECT IDexercici from alumne_exercici where IDalumne=$idalumne and IDexercici = $id and Punts_obtinguts > 0";
              if ($result2=mysqli_query($con,$sql))
                {
                   $rowcount1=mysqli_num_rows($result2);                
                  mysqli_free_result($result2);
                }
                 mysqli_close($con);

                $con=mysqli_connect('localhost:3308','root','','racoestudi');
                $sql = "SELECT * FROM alumne_exercici where IDalumne=$idalumne and IDexercici = $id";
                $result2 = $con->query($sql);

                if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row1 = $result2->fetch_assoc()) {
                        $nota = $row1["Nota"];
                        $puntss = $row1["Punts_Obtinguts"];
                    }
                }
                $con->close();
                                 
                if($rowcount==0){
                  $nota = 0;
                  $puntss = 0;
                }

                  if($row["auto"] == 0 && $rowcount > 0 && $rowcount1 == 0){
                    echo"<tr style='background-color:#faf6a7'>";
                  }else if((($row["auto"] == 1) && ($rowcount1 > 0) && ($nota >= 5))||(($row["auto"] == 0) && ($rowcount1 > 0) && ($nota >= 5))){
                    echo"<tr style='background-color:#a4fc7c'>";
                  }else if((($row["auto"] == 1) && ($rowcount1 > 0) && ($nota < 5))||(($row["auto"] == 0) && ($rowcount1 > 0) && ($nota < 5))){
                    echo"<tr style='background-color:#fc515f'>";
                  }else{
                     echo"<tr>";

                  }
                      echo"<td>".utf8_encode($row["Nom"])."</td>
                       <td>".utf8_encode($row["Data"])."</td>
                       <td>$nota</td>
                       <td>$puntss</td>
                       <td>";
                       if($row["auto"] == 1){
                         echo"Sí";
                       }else{
                        echo"No";
                       }
                        echo"</td>";
                        
                          echo"<td><form method='post' action='realitzaexercici.php'>
                      <input type='hidden' name='idex' value='".$row["ID"]."'>";
                      if(($row["auto"] == 0 && $rowcount == 0) || ($row["auto"] == 1 && $rowcount1 == 0)) {
                      echo"<input type='submit' class='btn btn-primary' value='Entra'></form></br></br>";
                        }else{
                           echo"<input type='hidden' name='fet' value='-1'>
                           <input type='submit' class='btn btn-success' value='Veure'></form></td>";
                        }
                        echo"
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
    <div class="container" id="taula" style="display:none">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Data</th>
      <th scope="col">Nota</th>
      <th scope="col">Punts</th>
      <th scope="col">Automàtic</th>
      <th scope="col">Accés</th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php
            $idtasca = $_SESSION['idtasca'];
        $idalumne = $_SESSION['idalumne'];
    
     require 'conn.php';
        $exercicis = "SELECT ID,Nom,Data,Punts,auto from exercici where IDtasca = $idtasca order by Data DESC";
        $result = $mysqli->query($exercicis);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $id = $row["ID"];

              $con=mysqli_connect('localhost:3308','root','','racoestudi');
              $sql="SELECT IDexercici from alumne_exercici where IDalumne=$idalumne and IDexercici = $id";
              if ($result1=mysqli_query($con,$sql))
                {
                   $rowcount=mysqli_num_rows($result1);                
                  mysqli_free_result($result1);
                }
                 mysqli_close($con);

                 $rowcount1=0;
              $con=mysqli_connect('localhost:3308','root','','racoestudi');
              $sql="SELECT IDexercici from alumne_exercici where IDalumne=$idalumne and IDexercici = $id and Punts_obtinguts > 0";
              if ($result2=mysqli_query($con,$sql))
                {
                   $rowcount1=mysqli_num_rows($result2);                
                  mysqli_free_result($result2);
                }
                 mysqli_close($con);

                $con=mysqli_connect('localhost:3308','root','','racoestudi');
                $sql = "SELECT * FROM alumne_exercici where IDalumne=$idalumne and IDexercici = $id";
                $result2 = $con->query($sql);

                if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row1 = $result2->fetch_assoc()) {
                        $nota = $row1["Nota"];
                        $puntss = $row1["Punts_Obtinguts"];
                    }
                }
                $con->close();
                                 
                if($rowcount==0){
                  $nota = 0;
                  $puntss = 0;
                }

                  if($row["auto"] == 0 && $rowcount > 0 && $rowcount1 == 0){
                    echo"<tr style='background-color:#faf6a7'>";
                  }else if((($row["auto"] == 1) && ($rowcount1 > 0) && ($nota >= 5))||(($row["auto"] == 0) && ($rowcount1 > 0) && ($nota >= 5))){
                    echo"<tr style='background-color:#a4fc7c'>";
                  }else if((($row["auto"] == 1) && ($rowcount1 > 0) && ($nota < 5))||(($row["auto"] == 0) && ($rowcount1 > 0) && ($nota < 5))){
                    echo"<tr style='background-color:#fc515f'>";
                  }else{
                     echo"<tr>";

                  }
                      echo"<td>".utf8_encode($row["Nom"])."</td>
                       <td>".utf8_encode($row["Data"])."</td>
                       <td>$nota</td>
                       <td>$puntss</td>
                       <td>";
                       if($row["auto"] == 1){
                         echo"Sí";
                       }else{
                        echo"No";
                       }
                        echo"</td>";
                        
                          echo"<td><form method='post' action='realitzaexercici.php'>
                      <input type='hidden' name='idex' value='".$row["ID"]."'>";
                      if(($row["auto"] == 0 && $rowcount == 0) || ($row["auto"] == 1 && $rowcount1 == 0)) {
                      echo"<input type='submit' class='btn btn-primary' value='Entra'></form></br></br>";
                        }else{
                           echo"<input type='hidden' name='fet' value='-1'>
                           <input type='submit' class='btn btn-success' value='Veure'></form></td>";
                        }
                        echo"
                     </td>
                      </tr>";
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