<?php   
include("../Conexion/encriptar.php");
if (isset($_COOKIE['Login_info'])) {
    $_SESSION["usuario"]=encrypt($_COOKIE['Login_info'], 'decrypt');
    header("Location: ../Empresas/empresas.php");
    exit();
}
include('../Registro/index.html');
?>