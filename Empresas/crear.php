<?php
include("../Conexion/conexion.php");
include("../Conexion/encriptar.php");
session_start();
$respuesta='false';

if (isset($_POST['addnombre']) && isset($_FILES['addfile'])){
    $nombre= strtoupper($_POST['addnombre']);
    if ($mysqli->query("SELECT COUNT(*) FROM empresas  where nombre='$nombre'")->fetch_array()[0] == "0"){
        $usuario=$_SESSION["usuario"];
        $archivo =$_FILES['addfile'];
        $imgContent= addslashes(file_get_contents($archivo['tmp_name']));
        $imgType=$archivo['type'];
        $codigo=buscarCode();
        if ($result = $mysqli->query("INSERT INTO empresas VALUES (null,'$nombre','$imgContent','$imgType','$codigo',null,false)")) {
            if ($result = $mysqli->query("INSERT INTO relacion VALUES (LAST_INSERT_ID(),$usuario,1)")){$respuesta='true';}
        }
    }else{ $respuesta='count'; }
}
function buscarCode(){
    include("../Conexion/conexion.php");
    $codigo="";
    do {
        while (strlen($codigo) <= 6) {
            $codigo .= chr(rand(97,122)).chr(rand(65,90));
        }
        $codigo=str_shuffle($codigo);

        if ($mysqli->query("SELECT COUNT(*) FROM empresas WHERE codigo =  _utf8 '$codigo' collate utf8_bin ")->fetch_array()[0] == "0") {
            break;
        }
        $a++;
    } while ($a < 10);
    return $codigo;
}

mysqli_close($mysqli);
echo $respuesta;
?>