<?php
include("../Conexion/conexion.php");
include("../Conexion/encriptar.php");
$respuesta=false;
if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['pass'])){
    $nombre=ucwords(strtolower($_POST['nombre']));
    $apellido=ucwords(strtolower($_POST['apellido']));
    $email=($_POST['email']);
    $pass=($_POST['pass']);
    $result = $mysqli->query("SELECT id_usuario FROM usuarios WHERE correo ='$email' LIMIT 1");
    if (!$result->num_rows == 1) {
        if ($mysqli->query("SELECT COUNT(*) FROM roles")->fetch_array()[0] == "0") {
            $mysqli->query("INSERT INTO roles VALUES (1,'admin'),(2,'user')");
        }
        $passs=encrypt("$pass", 'encrypt');
        if ($result = $mysqli->query("INSERT INTO usuarios VALUES (null,'$nombre','$apellido','$email','$passs')")) {
            $respuesta="../Login/login.php";
        }
    }
}
mysqli_close($mysqli);
echo $respuesta;
?>