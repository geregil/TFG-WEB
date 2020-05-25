<?php 
session_start();
error_reporting(0);
$varsesio = $_SESSION['usuariprof'];

if($varsesio == null || $varsesio = ''){
    echo 'No té autorització';
    die();
}else{
     require 'conn.php';
        $id = $_POST['idex'];
        $_SESSION['idae'] = $_POST['idae'];
        $idae = $_SESSION['idae'];
        $_SESSION['idex'] = $id;
        $sql = "SELECT e.img, e.Enunciat, e.Nom, e.Punts, ae.resposta, ae.ID from exercici e INNER JOIN alumne_exercici ae ON e.ID = ae.IDexercici where ae.ID = $idae";
        $imatge = null;
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $imatge = $row["img"];
                 $enunciat = $row["Enunciat"];
                 $nom = $row["Nom"];
                 $punts = $row["Punts"];
                 $resposta = $row["resposta"];
                 $idae = $row["ID"];
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
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="../assets/js/Grid-and-List-view-V10.js"></script>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
    <script src="../assets/js/Sidebar-Menu.js"></script>
</head>
<style>
#img{
    max-width:100%;
    max-height:100%;
}
</style>
<body>
       <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_professor.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_professor.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="correcio.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <div class="row register-form">
        <div class="col-md-12 alert-col relative" id="control" style="display:none">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span id="comentari"></span></div>
            </div>
        <div class="col-md-8 offset-md-2">
             <form class="custom-form" id="frmrg" method="POST" enctype="multipart/form-data" action="exerciciok.php">
                <h1><?php echo $nom ?></h1>
                <h3><?php echo $punts ?> punts</h3></br></br>
                <div class="form-row form-group">
                    <div class="col-sm-12 label-column"><center><?php echo $enunciat ?></center></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-12 input-column"><center><?php 
                    if(($imatge == null) || ($imatge=='')){
                        echo "L'exercici no té imatge";
                    }else{
                         echo"<img id='img' src='../imatges/".$imatge."'>";
                    }

                    ?></center></div>
              </div></br>
              <hr>
              <h5 style="color: red">Resposta alumne</h5></br>
                    <p><center><?php echo $resposta ?></center></p></br>
                <hr>
                <div class="form-row form-group" id="notadiv">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field" id="puntslabel">Nota</label></div>
                    <div class="col-sm-6 input-column"><input class="form-control" id="nota" name="nota" required /></div>
                </div>               
                <input class="btn btn-primary" type="submit" id="btcrea" value="Envia"><a class="btn btn-danger form-btn" type="reset" id="reset" href="correcio.php">CANCEL·LA</a>  </div>
         </div>
                 
        </form>
        </div>
    </div>
</body>
</html>