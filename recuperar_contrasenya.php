<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if(isset($_GET['recuperar'])){
	$i = -2;
}else{
	$i = -1;
}

	if(isset($_POST['email'])){
		 	$conn = mysqli_connect('localhost:3308','root','','racoestudi');
		 	$correu = $_POST['email'];
            $sql ="SELECT ID,Correu, Nom from alumne where Correu ='$correu'";
            $result = $conn->query($sql);
            $i = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $correualumne = $row['Correu'];
                    $nomalumne = $row['Nom'];
                    $idalumne = $row['ID'];
                    $i++;
                }
            }
            $conn->close();
            if($i > 0){



       $conn = mysqli_connect('localhost:3308','root','','racoestudi');
       $date = date('d/m/y h:m:s A');
       $randomNumber = rand(15,30000); 
       $sql1 = "INSERT INTO recuperacio_alumne (IDalumne, Data, Codi, Utilitzat) values ($idalumne,'$date',$randomNumber,0)";
       $conn->query($sql1);

       $conn->close();

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'geregil.cat@gmail.com';                     // SMTP username
    $mail->Password   = '1994-ggc';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('geregil.cat@gmail.com', 'Administració Racó Estudi');
    $mail->addAddress($correualumne,$nomalumne);     // Add a recipient
    

   
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Recuperació compte';
    $mail->Body    = 'Has fet una recuperació de contrasenya.</br></br> El número de recuperació: '.$randomNumber.'</br></br> Vés a aquest enllaç <a href="http://localhost/WEB/recuperar_contrasenya.php?recuperar='.$idalumne.'">recuperar contrasenya</a>';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
            }
     	
         
	}
if(isset($_POST['codi'])){
		$codi = $_POST['codi'];
		$idalumne= $_POST['idalumne'];
	    $conn = mysqli_connect('localhost:3308','root','','racoestudi');
            $sql ="SELECT count(*) as si from recuperacio_alumne where Utilitzat = 0 and Codi = $codi and IDalumne =$idalumne";
            $result = $conn->query($sql);
            $count =0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $count = $row['si'];
                }
            }
            $conn->close();
       

        if($count == 0){
        	$i=-3;
        }else{
        	$i = -4;
        	$conn = mysqli_connect('localhost:3308','root','','racoestudi');
		       $sql1 = "UPDATE recuperacio_alumne SET utilitzat=1 WHERE Codi=$codi and IDalumne =$idalumne";
		       $conn->query($sql1);

		       $conn->close();

		       $contrasenya = $_POST['contrasenya'];
		     $conn = mysqli_connect('localhost:3308','root','','racoestudi');
		       $sql1 = "UPDATE alumne SET Contrasenya='$contrasenya' WHERE ID =$idalumne";
		       $conn->query($sql1);

		       $conn->close();
		     
        }

}
      
?>

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
    	<?php
    	if($i==0){
    		echo"<form method='post' id='formlg' action='recuperar_contrasenya.php'>
    		<div class='form-group'><center><label style='color:red'>Correu incorrecte</label></center></br></br><input class='form-control' type='email' name='email' placeholder='Correu' required></div>
    		<input class='btn btn-info btn-block' id='botonlg' type='submit' value='Envia' />
    		</form>";
    	}else if($i == -1){
    		echo"<form method='post' id='formlg' action='recuperar_contrasenya.php'>
    		<div class='form-group'><center><label>Recuperació contrasenya</label></center></br></br><input class='form-control' type='email' name='email' placeholder='Correu'  minlength='8' required></div>
    		<input class='btn btn-info btn-block' id='botonlg' type='submit' value='Envia' />
    		</form>";
    	}else if($i > 0){
    		echo"<form method='post' id='formlg' action='login_alumnes.php'>
    		<div class='form-group'><center><label>Correu enviat!</label></center></br></br>
    		<center><label>Consulta el teu correu</label></center></div>
    		<input class='btn btn-info btn-block' id='botonlg' type='submit' value='Torna' />
    		</form>
    		";
    	}else if($i == -2){
    		$idalumne = $_GET['recuperar'];
    		echo"<form method='post' id='formlg' action='recuperar_contrasenya.php'>
    		<div class='form-group'><center><label>Recuperació contrasenya</label></center></br></br><label>Codi: </label><input class='form-control' type='text' name='codi'  required></br></br><label>Contrasenya nova: </label><input class='form-control' type='password' name='contrasenya' minlength='8'  required></div>
    		<input type='hidden' name='idalumne' value='".$idalumne."' />
    		<input class='btn btn-info btn-block' id='botonlg' type='submit' value='Envia' />
    		</form>";
    	}else if($i == -3){
    		echo"<form method='post' id='formlg' action='recuperar_contrasenya.php'>
    		<div class='form-group'><center><label style='color:red'>Codi incorrecte</label></center></br></br><center><label>Consulta el teu correu</label></center></div></div>
    		<input class='btn btn-info btn-block' id='botonlg' type='submit' value='Envia' />
    		</form>";
    	}else if($i == -4){
    		echo"<form method='post' id='formlg' action='login_alumnes.php'>
    		<div class='form-group'><center><label>Contrasenya canviada!</label></center></br></br>
    	</div>
    		<input class='btn btn-info btn-block' id='botonlg' type='submit' value='Torna' />
    		</form>
    		";
    	}
    	?>
        
          
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>