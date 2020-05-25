<script src="../assets/js/push.min.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<?php 
session_start();
error_reporting(0);
$varsesio = $_SESSION['usuari'];
$idalumne = $_SESSION['idalumne'];
if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}else{
    require 'conn.php';

        $alumne ="SELECT validat, Data_enviament from validacio_alumne where IDalumne=$idalumne";
        $result = $mysqli->query($alumne);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $validat = $row["validat"];
                $enviament = $row["Data_enviament"];
            }
        }
        $mysqli->close();

        if($validat == 0){
           if($enviament == null){
            
           }
            echo"<script type='text/javascript'>
                $(document).ready(function() {
                    $('#alerta').modal('show');
                });
            </script>";
        }
}
if(isset($_FILES["image"])){
        $conn = mysqli_connect('localhost:3308','root','','racoestudi');
        $usuari = $_SESSION['usuari'];
        $image = basename($_FILES["image"]["name"]);
        $ruta=$_FILES["image"]["tmp_name"];
        $desti="../imatges/".$image;
        copy($ruta,$desti);

        $sql="UPDATE alumne SET img='$image' WHERE NomUsuari = '$usuari'";

        mysqli_query($conn,$sql);
        mysqli_close($conn);
}
if(isset($_POST['titol'])){
    require 'conn.php';

        $prof ="SELECT ID from professor where NomUsuari='".$_POST['destinatari']."'";
        $result = $mysqli->query($prof);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $idprof = $row["ID"];
            }
        }
        $mysqli->close();

    $titol = $_POST["titol"];
    $missatge = $_POST["missatge"];
    $data = date("d/m/y h:m:s A");
    $conn = mysqli_connect('localhost:3308','root','','racoestudi');
    $sql1 = "INSERT INTO pregunta (titol, missatge, Data, IDalumne, IDprofessor, tancada) values ('$titol','$missatge','$data',$idalumne,$idprof,0)";
    $conn->query($sql1);
    $conn->close();
    echo'<script>Push.create("Pregunta!",{
                body:"Has obert una pregunta",
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
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/Article-List.css">
    <link rel="stylesheet" href="../assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="../assets/css/Profile-Edit-Form.css">
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
                            <h5 class="text-center text-white p-0 m-0 display-5 pt-3 pb-3"><strong>Perfil personal de <?php echo $_SESSION['usuari'] ?></strong></h5>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-8 p-0 m-0 p-3 text-secondary" style="border:1px solid black">
                            <h3><strong>Benvingut al Racó d'estudi</strong></h3>
                            <p class="p-0 m-0 pb-2">Et trobes al teu perfil, al lloc on trobaras les teves dades personals, els cursos que tens assignats a la plataforma i les estadístiques dels exercicis realitzats.</p>
                            <div class="col-md-4 relative">
                    
                        <?php
                        require 'conn.php';
                            $usuari = $_SESSION['usuari'];
                            $sql = "SELECT img from alumne where NomUsuari = '$usuari'";
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
                         echo"<img id='img' width='50%' height='50%' src='../imatges/".$imatge."'>";
                        }

                        ?>
                    </div>
                        </div>
                        <div class="col-lg-4 col-xl-4 p-0 m-0 p-3 mx-auto bg-info" style="border:1px solid black">
                            <h5 class="text-primary p-0 m-0 pb-2" style="color: rgb(13,13,13);"><strong style="color:black">ESTUDIA!</strong></h5><a class="btn btn-primary btn-block estudia" type="button" href="estudia.php">ENTRA</a>
                            <?php
                                    $punts = $_SESSION['punts'];
                                    if($punts == null){
                                        $escrit =  0;
                                    }else{
                                        $escrit = $punts;
                                    }
                            ?>
                            <p style="background-color: #e32929;color: rgb(251,248,248);font-size: 16px;">Tens <?php echo $escrit ?> punts</p>
                            <h5 class="text-primary p-0 m-0 pb-2" style="color: rgb(13,13,13);"><strong style="color:black">Dubtes</strong></h5><button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModalLong" id="cercabtn">ENVIA</button> <a class="btn btn-primary" style ="color:white" type="button" href="preguntes.php">VEURE</a>
                            <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Fes una pregunta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <center>
                        <form method="post" action="perfil_alumne.php" id="formt">
                            <label>Professor: &nbsp;</label></br>
                            <select class="form-control" id="destinatari" name="destinatari">
                            <?php
                                    require 'conn.php';

                                    $correu ="SELECT p.NomUsuari from alumne_curs al INNER JOIN curs c ON al.IDcurs = c.ID INNER JOIN professor p ON c.IDprofessor = p.ID where al.IDalumne = $idalumne group by p.ID";
                                    $result = $mysqli->query($correu);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option>".$row["NomUsuari"]."</option>";
                                        }
                                    }
                                    $mysqli->close();
                                ?>

                        </select>
                        </br></br>
                            <label>Títol: &nbsp;</label></br><input type="text" id="titol" name="titol" required />
                            </br></br>
                            <label>Missatge: &nbsp;</label></br><textarea type="text" id="missatge" name="missatge" cols="50" required></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tanca</button>
                        <input type="submit" class="btn btn-primary" id="save_value" name="save_value" value="Guarda" />
                      </div>
                    </form>
                </center>
                    </div>
                  </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-0 m-0">
                <div class="col-lg-4 col-xl-5 p-0 m-0 p-3 bg-info mx-auto" style="border:1px solid black">
                    <h5 class=" p-0 m-0 pb-2" style="color:black"><strong>LES TEVES DADES PERSONALS:</strong></h5>
                    <p class="p-0 m-0 pb-2" style="color:black">Si és necessari modifica-les amb el botó editar.</p>
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
                                    <td>Nom d'usuari: <?php echo $_SESSION['usuari'] ?></td>
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
                                    <td>Imatge perfil: <form enctype="multipart/form-data" method="POST" action="perfil_alumne.php"><input type="file" class="form-control" id="image" name="image"><center><input class="btn btn-primary form-btn" type="submit" value="Puja"></center></form></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><a class="btn btn-primary btn-block" role="button" href="editar_perfil.php">EDITAR</a><a class="btn btn-primary btn-block" type="button" href="estadistiquesalumne.php">ESTADÍSTIQUES</a></div>
                <div class="col-lg-4 col-xl-7 p-0 m-0 p-3 bg-warning mx-auto" style="color:white;border:1px solid black"">
                    <h5 style="color:white"><strong>CURSOS:</strong></h5>
                    <p class="p-0 m-0 pb-2">A continuació tens el llistat dels últims cursos que estàs inscrit:</p>
                    <center><input id="myInput" type="text" placeholder="Busca.." style="width:50%;"></center></br>
                    <div class="table-responsive" id="taulaprincipal">
                        <table class="table" style="color:white">
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

                                 //Check if the starting row variable was passed in the URL or not
                                if ( ! isset( $_GET['pag'] ) or ! is_numeric( $_GET['pag'] ) ) {

                                    //We give the value of the starting row to 0 because nothing was found in URL
                                    $pag = 0;

                                    //Otherwise we take the value from the URL
                                } else {
                                    $pag = (int) $_GET['pag'];
                                }
                                 require 'conn.php';

                                    $cursos ="SELECT c.ID, c.Nom, c.Data_creat, ca.nom from alumne_curs INNER JOIN curs c ON alumne_curs.IDcurs = c.ID INNER JOIN categoria ca ON c.categoria = ca.ID WHERE alumne_curs.IDalumne = $idalumne ORDER BY c.Data_creat DESC LIMIT $pag, 5";

                                    $result = $mysqli->query($cursos);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                              echo"<tr>
                                                  <td>".utf8_encode($row["Nom"])."</td>
                                                  <td>".utf8_encode($row["nom"])."</td>
                                                  <td>
                                                   <form method='post' action='estudia_tasques.php'>
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
                    <div class="table-responsive" id="taula" style="display:none">
                        <table class="table" style="color:white">
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
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                              echo"<tr>
                                                  <td>".utf8_encode($row["Nom"])."</td>
                                                  <td>".utf8_encode($row["nom"])."</td>
                                                  <td>
                                                   <form method='post' action='estudia_tasques.php'>
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
        <div id="alerta" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Validació</h5>
        <a type="button" class="close" aria-label="Close" href="tancar_sessio.php">
          <span aria-hidden="true" href="tancar_sessio.php">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        <p>Hem enviat un correu per validar-te!</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary"  href="tancar_sessio.php">Tanca</a>
      </div>
    </div>
  </div>
</div>
        <section id="cursosOm" class="trofeus">
            <h5 class="text-center text-primary p-0 m-0 pb-3" style="background-color: #f9c473;"><strong>TROFEUS ACONSEGUITS</strong></h5>
            <p class="text-center"><a class="btn btn-primary active text-center" type="button" href="trofeus.php" >CONSULTA</a></p>
        </section>
    </div>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
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