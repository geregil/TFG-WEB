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

<body>
       <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_professor.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_professor.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="gestiona.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
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
            <form class="custom-form" id="frmrg" method="POST" action="#">
                <h1>Crea un curs</h1>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field" id="nomlabel">Nom</label></div>
                    <div class="col-sm-6 input-column"><input class="form-control" type="text" id="nom" name="nom" required /></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Descripció</label></div>
                    <div class="col-sm-6 input-column"><textarea class="form-control" id="desc" name="desc"></textarea></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Categoria</label></div>
                    <div class="col-sm-6 input-column">
                        <select class="form-control" id="categoria" name="categoria">
                            <?php
                                    require 'conn.php';

                                    $categoria ="SELECT * from categoria";
                                    $result = $mysqli->query($categoria);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option>".$row["id"].". ".utf8_encode($row["nom"])."</option>";
                                        }
                                    }
                                    $mysqli->close();
                                ?>

                        </select>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="dropdown-input-field">Alumnes</label></div>
                    <div class="col-sm-4 input-column"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModalLong" id="cercabtn">Cerca..</button></div>
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

                            $alumnes ="SELECT ID,NomUsuari from alumne";

                            $result = $mysqli->query($alumnes);
                            $i = 0;
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                      echo"<tr>
                                          <td> <div class='form-check'>
                                                <input type='checkbox' name='selector[]' id='checkbox".$i."' value=".utf8_encode($row["ID"]).">
                                            </div>
                                        </td>
                                          <td>".utf8_encode($row["NomUsuari"])."</td>
                                          </tr>";
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

                </div><button class="btn btn-primary" type="button" id="btcrea">CREA</button><a class="btn btn-danger form-btn" type="reset" href="gestiona.php">CANCEL·LA</a>
        </form>
        </div>
    </div>
</body>
<script type="text/javascript">
                $(document).ready(function(){
                    var val = [];
                        $(function alumnes(){
                          $('#save_value').click(function(){
                            $(':checkbox:checked').each(function(i){
                              val[i] = $(this).val();
                            });
                            alert(val);
                            $('#cercabtn').html(Object.keys(val).length+' alumnes seleccionats');
                          });
                        });

                    $('#btcrea').click(function(){
                        //var dades=$('#frmrg').serialize();
                        var nom = $('#nom').val();
                        if((nom == null) || (nom == '')){
                            $("#nomlabel").css("color", "red");
                            $("#nom").css("background-color", "red");
                        }else{
                            var categoria = $('#categoria').val();
                        var desc = $('#desc').val();
                         $.ajax({
                          type:"POST",
                           url:"creacurs.php",
                           data: {nom: nom, arrayAlumnes: val, categoria: categoria, desc: desc},
                           success:function(r){
                            if(r==1){                   
                                  alert("Curs creat amb èxit!");
                                   location.reload();
                                  }else{
                                      location.reload();
                                   }
                                }
                            });
                        }

                        return false;
                    });



                });
</script>
</html>