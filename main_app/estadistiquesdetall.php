<?php 
session_start();
//error_reporting(0);
$varsesio = $_SESSION['usuariprof'];
$idprof = $_SESSION['id'];
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
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body style="background-image: url(&quot;../assets/img/image50.jpg&quot;);">
    <div class="container" id="contentHistoriasOm">
        <section id="subirOm" class="pb-3">
            <div class="row p-0 m-0">
                <div class="col p-0 m-0">
                    <div class="row bg-white mx-auto">
                        <div class="col-12 p-0 m-0 bg-primary">
                            <?php
                             if(isset($_POST["idcurs"])){
                                $idcurs = $_POST["idcurs"];
                                $_SESSION['idcurs'] = $idcurs;
                            }else{
                                $idcurs = $_SESSION['idcurs'];
                            }
                                    require 'conn.php';
                                       $sql = "SELECT * FROM curs where ID = $idcurs";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $nom = $row["Nom"];
                                            }
                                        }
                                       $mysqli->close();
                            ?>
                            <h1 class="text-center text-white p-0 m-0 display-5 pt-3 pb-3"><strong><?php echo $nom ?></strong></h1>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 m-0 p-3 text-secondary" style="border:1px solid black">
                            <h3><strong>Estadístiques generals del curs</strong></h3>
                            <table class="table">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
    
                                     require 'conn.php';
                                       $sql = "SELECT COUNT(*) AS alumnes FROM alumne_curs a INNER JOIN curs c ON c.ID = a.IDcurs where a.IDcurs =$idcurs";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $alumnes = $row["alumnes"];
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    <td>Alumnes totals: <?php echo $alumnes ?></td>
                                    <td class="p-0 m-0 p-1">
                                        <form method='post' action='alumnes_curs.php'>
                                      <input type='submit' class='btn btn-primary form-btn' value='Veure'>
                                      </form>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                     require 'conn.php';
                                       $sql = "SELECT COUNT(*) AS tasques FROM curs c INNER JOIN tasca t ON c.ID = t.IDcurs where c.IDprofessor = $idprof and c.ID =$idcurs";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $tasques = $row["tasques"];
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    <td>Tasques Totals: <?php echo $tasques?></td>
                                    <td class="p-0 m-0 p-1"><form method='post' action='gestiona_tasques.php'>
                                      <input type='submit' class='btn btn-primary form-btn' value='Veure'>
                                      </form></td>
                                </tr>
                                <tr>
                                    <?php
                                     require 'conn.php';
                                       $sql = "SELECT COUNT(*) AS exercicis, SUM(Punts) as punts FROM curs c INNER JOIN exercici e ON c.ID = e.IDcurs where c.IDprofessor = $idprof and c.ID =$idcurs";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $exercicis = $row["exercicis"];
                                                 $punts = $row["punts"];
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    <td>Exercicis Totals: <?php echo $exercicis ?></a></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <td>Punts Totals: <?php echo $punts ?></td>
                                    <td class="p-0 m-0 p-1"></td>
                                </tr>
                                <tr>
                                    <?php
                                     require 'conn.php';
                                       $sql = "SELECT COUNT(*) AS intents FROM alumne_exercici a INNER JOIN exercici e ON a.IDexercici = e.ID where e.IDcurs =$idcurs";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                 $intents = $row["intents"];
                                            }
                                        }
                                       $mysqli->close();
                                    ?>
                                    <td>Intents Totals: <?php echo $intents ?></td>
                                    <td class="p-0 m-0 p-1"><form method='post' action='totalintents.php'>
                                      <input type='submit' class='btn btn-primary form-btn' value='Veure'>
                                      </form></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 m-0 p-3 bg-warning mx-auto" style='color:white;border:1px solid black'>
                            <h3><strong>Alumnes amb més punts</strong></h3>
                            <table class="table" style='color:white'>
                            <thead>
                                <tr>
                                    <th>Posició</th>
                                    <th>Nom</th>
                                    <th>Punts</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                 require 'conn.php';
   
                                    $sql = "SELECT al.NomUsuari, SUM(Punts_Obtinguts) AS punts FROM alumne_exercici a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN alumne al ON a.IDalumne = al.ID where e.IDcurs =$idcurs GROUP BY a.IDalumne ORDER BY punts DESC LIMIT 5";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        $i=1;
                                        while($row = $result->fetch_assoc()) {
                                            echo"<tr>
                                                  <td>$i</td>
                                                  <td>".utf8_encode($row["NomUsuari"])."</td>
                                                  <td>".$row["punts"]."</td>
                                                </tr>";
                                                $i++;
                                        }
                                    }
                                       $mysqli->close();
                              
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-0 m-0">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 m-0 p-3 bg-warning mx-auto" style='color:white;border:1px solid black'>
                            <h3><strong>Alumnes amb més exercicis</strong></h3>
                            <table class="table" style='color:white'>
                            <thead>
                                <tr>
                                    <th>Posició</th>
                                    <th>Nom</th>
                                    <th>Exercicis</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                 require 'conn.php';

                                    $sql = "SELECT al.NomUsuari, COUNT(IDexercici) AS exercicis FROM alumne_exercici a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN alumne al ON a.IDalumne = al.ID where e.IDcurs =$idcurs and a.revisat = 1 and a.Punts_Obtinguts > 0 GROUP BY a.IDalumne ORDER BY exercicis DESC LIMIT 5";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        $i=1;
                                        while($row = $result->fetch_assoc()) {
                                            echo"<tr>
                                                  <td>$i</td>
                                                  <td>".utf8_encode($row["NomUsuari"])."</td>
                                                  <td>".$row["exercicis"]."</td>
                                                </tr>";
                                                $i++;
                                        }
                                    }
                                       $mysqli->close();
                              
                                ?>
                            </tbody>
                        </table>
                        </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 m-0 p-3 bg-warning mx-auto" style='color:white;border:1px solid black'>
                            <h3><strong>Alumnes amb més intents</strong></h3>
                            <table class="table" style='color:white'>
                            <thead>
                                <tr>
                                    <th>Posició</th>
                                    <th>Nom</th>
                                    <th>Intents</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                 require 'conn.php';
              
                                    $sql = "SELECT al.NomUsuari, COUNT(IDalumne) AS intents FROM alumne_exercici a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN alumne al ON a.IDalumne = al.ID where e.IDcurs =$idcurs GROUP BY a.IDalumne ORDER BY intents DESC LIMIT 5";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        $i=1;
                                        while($row = $result->fetch_assoc()) {
                                            echo"<tr>
                                                  <td>$i</td>
                                                  <td>".utf8_encode($row["NomUsuari"])."</td>
                                                  <td>".$row["intents"]."</td>
                                                </tr>";
                                                $i++;
                                        }
                                    }
                                       $mysqli->close();
                              
                                ?>
                            </tbody>
                        </table>
                        </div>
                
                    <form class="p-0 m-0">
                        <div class="input-group">
                            <div class="input-group-prepend"></div>
                            <div class="input-group-append"></div>
                        </div>
                    </form>
                </div>
                <div class="row p-0 m-0">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 m-0 p-3 bg-warning mx-auto" style='color:white;border:1px solid black'>
                            <h3><strong>Alumnes amb millor mitjana</strong></h3>
                            <table class="table" style='color:white'>
                            <thead>
                                <tr>
                                    <th>Posició</th>
                                    <th>Nom</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                                 require 'conn.php';
                                    $sql = "SELECT al.NomUsuari, (SUM(Nota) / COUNT(IDalumne)) AS mitjana FROM alumne_exercici a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN alumne al ON a.IDalumne = al.ID where e.IDcurs =$idcurs and a.revisat = 1 GROUP BY a.IDalumne ORDER BY mitjana DESC LIMIT 5";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {
                                        $i=1;
                                        while($row = $result->fetch_assoc()) {
                                            echo"<tr>
                                                  <td>$i</td>
                                                  <td>".utf8_encode($row["NomUsuari"])."</td>
                                                  <td>".number_format($row["mitjana"],2)."</td>
                                                </tr>";
                                                $i++;
                                        }
                                    }
                                       $mysqli->close();
                              
                                ?>
                            </tbody>
                        </table>
                        </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 m-0 p-3 bg-warning mx-auto" style='color:white;border:1px solid black'>
                            <h3><strong>Ha estrenat el curs</strong></h3>
                                 <?php
                                 require 'conn.php';
                                    $sql = "SELECT al.NomUsuari FROM alumne_exercici a INNER JOIN exercici e ON a.IDexercici = e.ID INNER JOIN alumne al ON a.IDalumne = al.ID where e.IDcurs =$idcurs and a.revisat = 1 GROUP BY a.IDalumne ORDER BY a.Data DESC LIMIT 1";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {;
                                        while($row = $result->fetch_assoc()) {
                                            echo $row["NomUsuari"];
                                            echo"</br>";
                                        }
                                    }
                                       $mysqli->close();
                                ?></br>
                                <h3><strong>Primer en acabar el curs</strong></h3>
                                <?php
                                 require 'conn.php';
                                    $sql = "SELECT al.NomUsuari FROM alumne_exercici a INNER JOIN alumne_curs e ON a.IDalumne = e.IDalumne INNER JOIN alumne al ON a.IDalumne = al.ID where e.completat = 1 ORDER BY e.Data_completat ASC LIMIT 1";
                                    $result = $mysqli->query($sql);
                                    if ($result->num_rows > 0) {;
                                        while($row = $result->fetch_assoc()) {
                                            echo $row["NomUsuari"];
                                        }
                                    }
                                       $mysqli->close();
                                ?>
                        </div>
                
                    <form class="p-0 m-0">
                        <div class="input-group">
                            <div class="input-group-prepend"></div>
                            <div class="input-group-append"></div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
       <nav class="navbar navbar-light navbar-expand sticky-top">
        <div class="container"><img id="logo" src="../assets/img/logo.png"><a class="navbar-brand" href="perfil_professor.php"><strong>El Racó d'estudi</strong></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a href="perfil_professor.php"><img src="../imatges/icones/perfil.png" alt="Perfil" height="42" width="42"></a>
            <div
                class="collapse navbar-collapse text-right" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                  <a href="estadistiques.php"><img src="../imatges/icones/torna.png" alt="Perfil" height="42" width="42" href="perfil_alumne.php"></a>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="tancar_sessio.php">Tancar sessió</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>