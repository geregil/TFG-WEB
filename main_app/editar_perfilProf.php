<?php
session_start();
error_reporting(0);
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
                        <a href="perfil_professor.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_professor.php"></a>
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="tancar_sessio.php">Tancar Sessió</a></li>
                    </ul>
            </div>
            </div>
        </nav>
    <div id="contenidor" style="margin-top:3%">
    <div class="container profile profile-view" id="profile" style="background-color: #ffffff;">
        <div class="row">
            <div class="col-md-12 alert-col relative" id="control" style="display:none">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span id="comentari"></span></div>
            </div>
        </div>
        <form id="frmrg" enctype="multipart/form-data" method="POST">
            <div class="alert alert-success alert-dismissible" id="alerta" style="display:none">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Fet!</strong> Perfil guardat amb èxit.
                   </div>
                   <div class="alert alert-danger alert-dismissible" id="alertaerror" style="display:none">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <p id="nomerror"></p>
                  </div>
            <div class="form-row profile-row">
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
                <div class="col-md-8">
                    <h1>Perfil</h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Nom</label><input class="form-control" type="text" name="nom" id="nom"/></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Centre educatiu</label><input class="form-control" type="text" name="centre" id="centre"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Contrasenya&nbsp;</label><input class="form-control" type="password" name="password" autocomplete="off" id="contrasenya"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirma contrasenya</label><input class="form-control" type="password" name="confirmpass" autocomplete="off" id="contrasenyarep"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><input class="btn btn-primary form-btn" type="submit" id="btnguardar" value="Guardar"><a class="btn btn-danger form-btn" role="button" href="perfil_professor.php">Cancel·la</a></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
</body>
<script text="text/javascript">
     $(document).ready(function(){
                    $('#alerta').css('display', 'none');
                    $('#alertaerror').css('display', 'none');
                    $('#btnguardar').click(function(){
                        if($('#contrasenya').val() == $('#contrasenyarep').val()){
                            if($('#contrasenya').val().length > 7){
                                    if($('#nom').val().length > 1){
                                        var dades=$('#frmrg').serialize();
                                        $.ajax({
                                            type:"POST",
                                            url:"actualitzar_perfil_prof.php",
                                            data:dades,
                                            success:function(r){
                                                if(r==1){
                                                    $('#alerta').slideDown('slow');
                                                        setTimeout(function(){
                                                    $('#alerta').slideUp('slow');
                                                    },3000);
                                                }else{
                                                     $('#alerta').slideDown('slow');
                                                        setTimeout(function(){
                                                    $('#alerta').slideUp('slow');
                                                    },3000);
                                                }
                                            }
                                        });
                                    }
                                    else{

                                     $('#alertaerror').slideDown('slow');
                                                        setTimeout(function(){
                                                    $('#alertaerror').slideUp('slow');
                                                    },3000);
                                    $('#nomerror').html('Nom curt');
                                    return false;
                                }
                            }else{
                                  $('#alertaerror').slideDown('slow');
                                                        setTimeout(function(){
                                                    $('#alertaerror').slideUp('slow');
                                                    },3000);
                                    $('#nomerror').html('Contrasenya mínim 8 caràcters');
                                return false;
                            }
                        }else{
                                 $('#alertaerror').slideDown('slow');
                                                        setTimeout(function(){
                                                    $('#alertaerror').slideUp('slow');
                                                    },3000);
                                    $('#nomerror').html('Contrasenyes diferents');
                            return false;
                        }
                        return false;
                    })
                });
</script>

</html>