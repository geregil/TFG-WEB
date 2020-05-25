<?php
require 'conn.php';

$categoria ="SELECT nom from categoria";
$result = $mysqli->query($categoria);

if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
        echo $row["nom"];

    }
}
$mysqli->close();
?>
