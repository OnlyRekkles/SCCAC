<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../Login/login.php");
    exit();
}
$user=$_SESSION["usuario"];
include("../Conexion/conexion.php");
$sql="SELECT nombre, apellido FROM usuarios where id_usuario=$user";
$colum=$mysqli->query($sql)-> fetch_array();
$nombre=$colum[0]." ".$colum[1];
$name=$colum[0];
$lastname=$colum[1];
$sql="SELECT empresas.id_empresa, empresas.nombre as empresa, empresas.logo, empresas.logo_type
FROM relacion
INNER JOIN empresas ON relacion.id_empresa=empresas.id_empresa
INNER JOIN usuarios ON relacion.id_usuario=usuarios.id_usuario
WHERE relacion.id_usuario=$user";

$structura_empresas="";
$empresas_sql = $mysqli->query($sql);
if ($empresas_sql->num_rows > 0) {
    while ($campo = $empresas_sql->fetch_assoc()) {
        $structura_empresas .='
        <div class="col-12 col-md-6 col-lg-4">
        <body background="../IMAGES/img/fondoini.jpg">
        <div class="card" onclick="redireccion(event)">
            <div class="cback"></div>
            <div class="img2">
                <img src="data:'.$campo["logo_type"].';base64,'.base64_encode($campo['logo']).'" alt="'.$campo["id_empresa"].'">
            </div>
            <div class="main-text">
                <h2>'.$campo["empresa"].'</h2>
            </div>
            <div class="socials">
                <i class="fa fa-users" data-bs-toggle="modal" href="#ModalEdit" role="button" data-whatever="'.$campo["empresa"].'"></i>
            </div>
        </div>
        </div>';
    }
}else {
    $structura_empresas='
    <div class="shadow-sm p-3 mb-5 bg-body rounded-3 bg-light bg-opacity-25">
    <p class="text-center user-select-none">No hay empresas registradas.</p>
    </div>';
}
$empresas_sql->free();





include('../Empresas/index.php');
$mysqli->close();
?>
