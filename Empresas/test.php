<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Login/login.php");
    exit();
}
$user=$_SESSION["usuario"];
$_SESSION["empresa"]=trim($_GET['time']);
echo str_replace(' ', '', trim($_GET['name']));
?>