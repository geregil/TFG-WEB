<script src="../assets/js/push.min.js"></script>
<?php 
session_start();
error_reporting(0);
$varsesio = $_SESSION['idcurs'];

if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}
if(isset($_POST['idalumne'])){
  
    $conn = mysqli_connect('localhost:3308','root','','racoestudi');

  $id = $_POST['idalumne'];


  $sql="DELETE FROM alumne_curs WHERE IDalumne=$id";

  mysqli_query($conn,$sql);
  echo'<script>Push.create("Alumne eliminat!",{
                body:"Has eliminat un alumne.",
                timeout:4000,
            });</script>';
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
<style>
  #alertBox {
    position:relative;
    width:300px;
    min-height:100px;
    margin-top:50px;
    border:1px solid #666;
    background-color:#fff;
    background-repeat:no-repeat;
    background-position:20px 30px;
}
</style>
<body>
       <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_professor.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_professor.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="gestionacurs.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <h1><strong><center>Alumnes assignats</center></strong></h1>
        <center><input id="myInput" type="text" placeholder="Busca.." style="width:50%;"></center></br>
    <div class="container" id="taulaprincipal">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col"></th>
      <th scope="col"><button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModalLong" id="cercabtn">Afegeix Alumne</button></td></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $idcurs = $_SESSION['idcurs'];
    require 'conn.php';

                                    $cursos ="SELECT count(IDalumne) as total from alumne_curs where IDcurs = $idcurs";

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
        $alumnes = "SELECT a.NomUsuari, a.ID, a.img from alumne_curs INNER JOIN alumne a ON alumne_curs.IDalumne = a.ID WHERE alumne_curs.IDcurs = $idcurs LIMIT $pag, 5";
        $result = $mysqli->query($alumnes);
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                  echo"<tr>
                      <td>".utf8_encode($row["NomUsuari"])."</td>";
                         echo"<td><img id='img' width='150px' height='75px' src='../imatges/".$row['img']."'>";

                      echo"</td>
                      <td>     
                      <form method='post' action='alumnes_curs.php'>
                      <input type='hidden' name='idalumne' value='".$row["ID"]."'>
                      <input type='submit' class='btn btn-danger form-btn' onclick='return confirm(\"Segur que vols eliminar-lo?\");' value='Elimina'>
                      </form></td>
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
   <div class="container" id="taula" style="display:none">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Nom</th>
      <th scope="col"><button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModalLong" id="cercabtn">Afegeix Alumne</button></td></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php
    $idcurs = $_SESSION['idcurs'];
     require 'conn.php';
        $alumnes = "SELECT a.NomUsuari, a.ID, a.img from alumne_curs INNER JOIN alumne a ON alumne_curs.IDalumne = a.ID WHERE alumne_curs.IDcurs = $idcurs";

        $result = $mysqli->query($alumnes);
        $i = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                  echo"<tr>
                      <td>".utf8_encode($row["NomUsuari"])."</td>";
                      echo"<td><img id='img' width='150px' height='75px' src='../imatges/".$row['img']."'>";
                      echo"<td>     
                      <form method='post' action='alumnes_curs.php'>
                      <input type='hidden' name='idalumne' value='".$row["ID"]."'>
                      <input type='submit' class='btn btn-danger form-btn' onclick='return confirm(\"Segur que vols eliminar-lo?\");' value='Elimina'>
                      </form></td>
                      </tr>";
            }
        }
       $mysqli->close();
  
    ?>
  </tbody>
</table>

</div>
                    <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Assigna alumnes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <table class="table">
                            <?php
                            require 'conn.php';

                            $alumnes ="SELECT ID,NomUsuari,img from alumne";

                            $result = $mysqli->query($alumnes);
                            $i = 0;
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                	$idal = $row["ID"];
                                	$rowcount=0;
							          $con=mysqli_connect('localhost:3308','root','','racoestudi');
							          $sql="SELECT IDalumne FROM alumne_curs WHERE IDalumne = $idal and IDcurs = $idcurs";
							            if ($result1=mysqli_query($con,$sql))
							            {
							                $rowcount=mysqli_num_rows($result1);                
							                mysqli_free_result($result1);
							            }
							        mysqli_close($con);
							        if($rowcount == 0){
							        	echo"<tr>
                                          <td> <div class='form-check'>
                                                <input type='checkbox' name='selector[]' id='checkbox".$i."' value=".utf8_encode($row["ID"]).">
                                            </div>
                                        </td>
                                          <td>".utf8_encode($row["NomUsuari"])."</td>";
                                          echo"<td><img id='img' width='150px' height='75px' src='../imatges/".$row['img']."'>";
                                          echo"</tr>";
							        }
                                    
                                     $i++;
                                  }
                                }
                           $mysqli->close();

                            ?>
                       </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                        <input type="button" class="btn btn-primary" id="save_value" name="save_value" value="Guarda" />
                      </div>
                    </div>
                  </div>
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
                    var val = [];
                        $(function alumnes(){
                          $('#save_value').click(function(){
                            $(':checkbox:checked').each(function(i){
                              val[i] = $(this).val();
                            });
                             $.ajax({
                          type:"POST",
                           url:"assigna_alumnes.php",
                           data: {arrayAlumnes: val},
                           success:function(r){
                            if(r==1){                   
                                   location.reload();
                                  }else{
                                      location.reload();
                                   }
                            }
                          });
                        });
                      });
                    });
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