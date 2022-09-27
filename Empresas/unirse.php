<?php
include("../Conexion/conexion.php");
session_start();
$user=$_SESSION["usuario"];
$respuesta="error";

if (isset($_POST['cod'])) {
    $cod=$_POST['cod'];
    $pass=$_POST['pass'];
    $sql="SELECT id_empresa, nombre, clave, acceso FROM empresas WHERE codigo =  _utf8 '".$cod."' collate utf8_bin ";
    $colum=$mysqli->query($sql)-> fetch_array();
    if (isset($colum[0])) {
        $existe=$mysqli->query("SELECT count(*) FROM relacion WHERE id_empresa=".$colum[0]." AND id_usuario=".$user)-> fetch_array();
        if ($existe[0]=="1") {
            $respuesta="op2";
        }else {
            if ($colum[2]===$pass && $colum[3]=="1") {
                $sql='INSERT INTO relacion VALUES ('.$colum[0].', '.$user.', 2)';
                if ($mysqli->query($sql)) {
                    $respuesta= "success";
                }
            }else {
                if ($colum[3]=="0") {
                    $respuesta="op3";
                }
            }
        }
    }
}
echo $respuesta;
$mysqli->close();
?>