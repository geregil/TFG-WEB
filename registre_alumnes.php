<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>El racó d'estudi</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/jquery.min"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="assets/img/logo.png"><a class="navbar-brand" href="#"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.html">Inici</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Espai_Alumnes.html">Alumnes</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Espai_Professors.html">Professors</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Suport.html">Suport</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form id="frmrg" method="POST">
                <h2 class="text-center"><strong>Crea </strong>un compte</h2>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Correu" id="correu" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></div>
                <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Contrasenya" id="contrasenya" minlength="8" required></div>
                <div class="form-group"><input class="form-control" type="password" name="password-repeat" placeholder="Contrasenya (repeteix)" id="contrasenyarep" required></div>
                <div class="form-group"><input class="form-control" type="text" name="nom" placeholder="Nom" id="nom" required></div>
                <div class="form-group"><input class="form-control" type="text" name="usuari" placeholder="Nom d'usuari" id="usuari" minlength="4" required></div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" required>Estic d'acord amb les condicions del servei.</label></div>
                </div>
                <div class="form-group"><button id="btnguardar" class="btn btn-success btn-block" type="submit">Registre</button></div>
            </form>
        </div>
        <center>
        <div class="error" style="display:none, color:white, background-color:red;">
                <span id="control"></span>
        </div>
    </center>
    </div>
    <div class="footer-basic">
        <footer>
            <div class="social"><a href="https://www.linkedin.com/in/gerard-gil-0b736013a/" target="_blank"><i class="icon ion-social-linkedin"></i></a><a href="mailto:ggilcas@uoc.edu"><i class="icon ion-android-mail"></i></a></div>
            <ul class="list-inline">
               
            </ul>
            <p class="copyright">Racó d'estudi © 2020 - Treball de final de grau realitzat per Gerard Gil</p>
        </footer>
    </div>

</body>

</html>
<script type="text/javascript">


            $(document).ready(function(){
                    $("#frmrg").submit(function( event ){
                    if($('#contrasenya').val() == $('#contrasenyarep').val()){
                            var dades=$('#frmrg').serialize();
                                        $.ajax({
                                            type:"POST",
                                            url:"main_app/insertar.php",
                                            data:dades,
                                            success:function(r){
                                                if(r==1){
                                                    $('#control').css( "color", "green" );
                                                    $('#control').html('Registre fet correctament! <a href="index.html">Torna</a>');
                                                       $('.error').slideDown('slow');
                                                }else{
                                                    $('#control').css( "color", "red" );
                                                    $('#control').html('Usuari o Correu existeix!');
                                                       $('.error').slideDown('slow');
                                                }
                                            }
                                        });
                                }else{
                            $('#control').html('Contrasenyes diferents');
                               $('.error').slideDown('slow');
                                    setTimeout(function(){
                                        $('.error').slideUp('slow');
                                    },3000);
                            return false;
                        }
                        return false;
                    });
                });

</script>