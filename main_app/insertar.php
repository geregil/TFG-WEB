<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email = $_POST['email'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$usuari = $_POST['usuari'];

 require 'conn.php';
       $sql3 = "SELECT COUNT(*) AS existeix FROM alumne where Correu='$email' or NomUsuari = '$usuari' ";
        $result = $mysqli->query($sql3);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                 $existeix = $row["existeix"];
            }
        }
$mysqli->close();

if($existeix == 0){

$conn = mysqli_connect('localhost:3308','root','','racoestudi');
$sql="INSERT into alumne (Nom,NomUsuari,Contrasenya,Correu,img) values ('$nom','$usuari','$password','$email','perfil.png')";

mysqli_query($conn,$sql);
mysqli_close($conn);

require 'conn.php';

    $alumne ="SELECT ID from alumne where NomUsuari = '$usuari'";
    $result = $mysqli->query($alumne);

        if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                $idalumne = $row["ID"];
            }
        }
$mysqli->close();

$randomNumber = rand(15,30000); 
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
    $mail->setFrom('geregil.cat@gmail.com', utf8_encode('Administració Racó Estudi'));
    $mail->addAddress($email,$nom);     // Add a recipient
    

   
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = utf8_encode('Validació compte');
    $mail->Body    = utf8_encode('Per validar el compte entra al següent enllaç.</br></br> <a href="http://localhost/WEB/main_app/validacio.php?validat='.$idalumne.'&codi='.$randomNumber.'">validar el compte</a>');
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$conn = mysqli_connect('localhost:3308','root','','racoestudi');
$data = date('d/m/y h:m:s A');
$sql="INSERT into validacio_alumne (IDalumne,codi,Data_enviament,validat,Data_validacio) values ($idalumne,$randomNumber,'$data',0,null)";

}
echo mysqli_query($conn,$sql);

?> 