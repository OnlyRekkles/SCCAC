<?php 
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Login/login.php");
    exit();
}
$user=$_SESSION["usuario"];

include("../Conexion/conexion.php");
$respuesta=array();
if ($_GET['o']=='consulta') {
    $sql="SELECT nombre, apellido FROM usuarios where id_usuario=$user";
    $colum=$mysqli->query($sql)-> fetch_array();
    $respuesta['name']=$colum[0];
    $respuesta['lastname']=$colum[1];
    echo json_encode($respuesta);
    exit();
}
if ($_GET['o']=='up_nombre') {
    $sql="UPDATE usuarios SET nombre='".$_GET['n']."', apellido='".$_GET['l']."' WHERE id_usuario=$user";
    $respuesta['update']=$mysqli->query($sql);
    echo json_encode($respuesta);
    exit();
}
if ($_GET['o']=='up_pass') {
    include("../Conexion/encriptar.php");
    $respuesta['update']=false;
    $pass=encrypt($_GET['p'], 'encrypt');
    $result = $mysqli->query("SELECT id_usuario FROM usuarios WHERE id_usuario ='$user' and password='$pass' LIMIT 1 ");
    if ($result->num_rows == 1) {
        $pass_up=encrypt($_GET['r'], 'encrypt');
        $sql="UPDATE usuarios SET password='$pass_up' WHERE id_usuario=$user";
        $respuesta['update']=$mysqli->query($sql);
    }
    echo json_encode($respuesta);
    exit();
}

?>