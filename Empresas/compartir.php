<?php
include("../Conexion/conexion.php");
session_start();
$user=$_SESSION["usuario"];

$respuesta="error";


if (isset($_POST['editar'])) {
    $sql='SELECT id_empresa FROM empresas WHERE codigo="'.$_POST['editar'].'"';
    $colum=$mysqli->query($sql)-> fetch_array();
    $sql='UPDATE empresas SET clave="'.$_POST['clave'].'", acceso='.$_POST['acceso'].' WHERE empresas.id_empresa='.$colum[0];
    if ($mysqli->query($sql)) {
        $respuesta= "Success";
    }


}else {
    $sql='SELECT empresas.codigo, empresas.clave, empresas.acceso
    FROM relacion
    INNER JOIN empresas ON relacion.id_empresa=empresas.id_empresa
    INNER JOIN usuarios ON relacion.id_usuario=usuarios.id_usuario
    WHERE relacion.id_usuario='.$user.' and empresas.nombre="'.$_POST['nombre'].'" LIMIT 1';

    $colum=$mysqli->query($sql)-> fetch_array();
    $array = array(
        "codigo" => $colum[0],
        "contra" => $colum[1],
        "acceso" => $colum[2],
        "accion" => "consulta"
    );
    $respuesta=$array;
}


echo json_encode($respuesta);
$mysqli->close();
?>