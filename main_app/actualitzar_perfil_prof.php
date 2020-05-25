<?php
        $conn = mysqli_connect('localhost:3308','root','','racoestudi');
        session_start();
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $usuari = $_SESSION['usuari'];
        $centre = $_POST['centre'];
        /**dades sessió noves**/

        $_SESSION['nom'] = $nom;
        $_SESSION['contrasenya'] = $password;
        $_SESSION['centre'] = $centre;

        $sql="UPDATE professor SET Nom='$nom', Contrasenya='$password', Centre_educatiu='$centre' WHERE NomUsuari = '$usuari'";

        echo mysqli_query($conn,$sql);
?>