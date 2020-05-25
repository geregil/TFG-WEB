<?php 
session_start();
$idalumne = $_SESSION['idalumne'];
error_reporting(0);
$varsesio = $_SESSION['usuari'];

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
</head>

<body>
    <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_alumne.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_alumne.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="perfil_alumne.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <h1><strong><center>Trofeus</center></strong></h1>
    <div class="container">
        <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">Imatge</th>
      <th scope="col">Nom</th>
      <th scope="col">Data aconseguit</th>
      <th scope="col">+ INFO</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $rowcount=0;
          $con=mysqli_connect('localhost:3308','root','','racoestudi');
          $sql="SELECT IDalumne FROM alumne_trofeu WHERE IDalumne = $idalumne";
            if ($result1=mysqli_query($con,$sql))
            {
                $rowcount=mysqli_num_rows($result1);                
                mysqli_free_result($result1);
            }
        mysqli_close($con);

    if($rowcount > 0){
      require 'conn.php';
        $sql = "SELECT t.Nom,a.Data,t.img, t.ID, a.IDalumne from trofeu t INNER JOIN alumne_trofeu a ON t.ID = a.IDtrofeu where a.IDalumne='".$_SESSION['idalumne']."'";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                  echo"<tr>
                      <td><img id='img' src='../imatges/copes/".$row["img"]."' width='30' height='30'></td>
                      <td>".utf8_encode($row["Nom"])."</td>
                      <td>".utf8_encode($row["Data"])."</td>
                      <td>
                      <form method='post' action='trofeudetall.php'>
                      <input type='hidden' name='idtrofeu' value='".$row["ID"]."'>
                      <input type='submit' class='btn btn-primary form-btn' value='Veure'>
                      </form>
                      </td>
                      </tr>";
            }
        }
        $mysqli->close();
    }else{
      echo"
              <center><p>No tens trofeus</p></center>
          ";
    }
    ?>
  </tbody>
</table>
       
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/Animated-Pretty-Product-List-v12.js"></script>
    <script src="../assets/js/Grid-and-List-view-V10.js"></script>
    <script src="../assets/js/Profile-Edit-Form.js"></script>
    <script src="../assets/js/Sidebar-Menu.js"></script>
</body>
<script type="text/javascript">

</script>

</html>