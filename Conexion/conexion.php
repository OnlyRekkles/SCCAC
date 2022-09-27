<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sgcdoc";

//Considera el warning como un error, y así tratar la excepción.
mysqli_report(MYSQLI_REPORT_STRICT);
try {
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    //echo 'connect success: '.$mysqli->host_info;
} catch (Exception $e) {
    alert ('ERROR:'.$e->getMessage());
}


?>