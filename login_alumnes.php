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
</head>

<body>
    <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="assets/img/logo.png"><a class="navbar-brand" href="#"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.html">Inici</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="Espai_Alumnes.html">Alumnes</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Espai_Professors.html">Professors</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Suport.html">Suport</a></li>
                </ul>
        </div>
        </div>
    </nav>
    
    <div class="login-clean">
        <form method="post" id="formlg">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked" id="login-icon"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Correu" required></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Contrasenya" required></div>
            <div class="form-group"><button class="btn btn-info btn-block" id="botonlg" type="submit">Accés</button></div><a class="forgot" href="recuperar_contrasenya.php">Problemes per entrar?</a></form>
            <div class="error" style="display:none, color:white, background-color:red;">
                <span><center> Dades entrades no vàlides, intenta-ho de nou<center></span>
            </div>
    </div>
    <div class="footer-basic">
        <footer>
            <div class="social"><a href="https://www.linkedin.com/in/gerard-gil-0b736013a/" target="_blank"><i class="icon ion-social-linkedin"></i></a><a href="mailto:ggilcas@uoc.edu"><i class="icon ion-android-mail"></i></a></div>
            <ul class="list-inline">
               
            </ul>
            <p class="copyright">Racó d'estudi © 2020 - Treball de final de grau realitzat per Gerard Gil</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>