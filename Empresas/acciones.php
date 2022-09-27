<?php 
include("../Conexion/conexion.php");

$respuesta=array();
switch ($_POST['key']){
    case 'cds2':
        $valores=json_decode($_POST['valores'],true);
        $colum=$mysqli->query("SELECT count(id_usuario) FROM relacion WHERE (id_empresa=".$valores["y"].") AND (id_rol=1)")->fetch_array();
        $respuesta['numAdmi']=$colum[0];
        $mysqli->close();
        break;
    case 'al2f':
        $valores=json_decode($_POST['valores'],true);
        $mysqli->query("DELETE FROM relacion WHERE (id_empresa=".$valores['y'].") AND (id_usuario > 0)");
        $res=$mysqli->query("DELETE FROM empresas WHERE id_empresa=".$valores["y"]);
        $respuesta['success']=0;
        if ($res) {$respuesta['success']=1;}
        $mysqli->close();
        break;
    case 'jnjs2':
        $valores=json_decode($_POST['valores'],true);
        $res=$mysqli->query("UPDATE relacion SET id_rol=2 WHERE (id_empresa=".$valores["y"].") AND (id_usuario=".$valores["x"].")");
        $respuesta['success']=0;
        if ($res) {$respuesta['success']=1;}
        $mysqli->close();
        break;
    case 'a1st':
        $valores=json_decode($_POST['valores'],true);
        $colum=$mysqli->query("SELECT nombre, apellido, correo, password FROM usuarios WHERE id_usuario=".$valores["x"])->fetch_array();
        $respuesta['nombre']=$colum[0]." ".$colum[1];
        $respuesta['correo']=$colum[2];
        $mysqli->close();
        break;
    case 'cdsk':
        $valores=json_decode($_POST['valores'],true);
        $res=$mysqli->query("UPDATE relacion SET id_rol=1 WHERE (id_empresa=".$valores["y"].") AND (id_usuario=".$valores["x"].")");
        $respuesta['success']=0;
        if ($res) {$respuesta['success']=1;}
        $mysqli->close();
        break;
    case 'xsa1s':
        $valores=json_decode($_POST['valores'],true);
        $res=$mysqli->query("DELETE FROM relacion WHERE (id_empresa=".$valores["y"].") AND (id_usuario=".$valores["x"].")");
        $respuesta['success']=0;
        if ($res) {$respuesta['success']=1;}
        $mysqli->close();
        break;
        
    default:
        # x... user
        break;
}

echo json_encode($respuesta);

?>