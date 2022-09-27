<?php
include("../Conexion/conexion.php");
include("../Conexion/encriptar.php");
$respuesta=false;
if (isset($_POST['email']) && isset($_POST['pass'])){
    $email=($_POST['email']);
    $pass=encrypt($_POST['pass'], 'encrypt');
    $result = $mysqli->query("SELECT id_usuario FROM usuarios WHERE correo ='$email' and password='$pass' LIMIT 1 ");
    if ($result->num_rows == 1) {
        $ident=$result->fetch_assoc()['id_usuario'];
        session_start();
        $_SESSION["usuario"]=$ident;
        if (isset($_POST['remember-me'])) {
            setcookie("Login_info",encrypt($ident, 'encrypt'),null,"/");
        }
        $respuesta="../Empresas/empresas.php";
    }
}
mysqli_close($mysqli);
echo $respuesta;
?>