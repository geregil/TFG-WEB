<?php
//error_reporting(0);
if(isset($_GET['validat']) && isset($_GET['codi'])){
    require 'conn.php';
    $codi = $_GET['codi'];
    $idalumne = $_GET['validat'];
    $alumne ="SELECT count(IDalumne) as validat from validacio_alumne where codi = $codi and IDalumne = $idalumne";
    $result = $mysqli->query($alumne);

        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                $validacio = $row["validat"];
            }
        }
    $mysqli->close();
    if($validacio > 0){

       $conn = mysqli_connect('localhost:3308','root','','racoestudi');
       $data = date('d/m/y h:m:s A');
        $sql3 = "UPDATE validacio_alumne SET validat=1, Data_validacio='$data' WHERE IDalumne=$idalumne";
        mysqli_query($conn,$sql3);
        $conn->close();
    }else{
         echo 'No té autorització';
        die();
    }
}else{
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
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="#"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
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
    	<form method='post' id='formlg' action='http://localhost/WEB/'>
            <div class='form-group'><center><label>Validació correcte!</label></center></br></br>
            <center><label>Ja pots gaudir del Racó d'Estudi!</label></center></div>
            <input class='btn btn-info btn-block' id='botonlg' type='submit' value='Torna' />
        </form>
          
    </div>
    <div class="footer-basic">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Services</a></li>
                <li class="list-inline-item"><a href="#">About</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">Racó d'estudi © 2020</p>
        </footer>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>