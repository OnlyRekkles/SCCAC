<?php
session_start();
$user=$_SESSION["usuario"];
include("../Conexion/conexion.php");


$sql='SELECT relacion.id_rol,relacion.id_empresa
    FROM relacion
    INNER JOIN empresas ON relacion.id_empresa=empresas.id_empresa
    INNER JOIN usuarios ON relacion.id_usuario=usuarios.id_usuario
    WHERE relacion.id_usuario='.$user.' and empresas.nombre="'.$_GET['nombre'].'" LIMIT 1';

$colum=$mysqli->query($sql)-> fetch_array();
$permiso_compartir="";
$permiso_boton_adm="";
$permiso_boton_user="";
if ( $colum[0] =="1") {
   $permiso_compartir='
    <div class="d-flex justify-content-end  align-items-end">
    <div>
       <a href="#ModalCode" data-bs-target="#ModalCode" class="text-decoration-none" data-bs-toggle="modal">compartir <i class="fa fa-code" aria-hidden="true"></i></a>
    </div>
    </div>';
    $permiso_boton_adm='
    <div class="dropdown">
        <button class="btn btn-outline-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" onclick="eliminar_adm(******)">Eliminar</a>
          <a class="dropdown-item" onclick="noadmin(******)">Descartar como admin.</a>
        </div>
    </div>
        </div>';
        $permiso_boton_user='
    <div class="dropdown">
        <button class="btn btn-outline-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" onclick="eliminar_u(******)" href="#">Eliminar</a>
          <a class="dropdown-item" onclick="hacerAdmin(******)" href="#">Hacer admin.</a>
        </div>
    </div>
        </div>';
}

$sql='SELECT  usuarios.id_usuario, usuarios.nombre, usuarios.apellido
FROM relacion
INNER JOIN empresas ON relacion.id_empresa=empresas.id_empresa
INNER JOIN usuarios ON relacion.id_usuario=usuarios.id_usuario
WHERE relacion.id_empresa='.$colum[1].' AND relacion.id_rol=1';

$administradores="";

$admins_sql = $mysqli->query($sql);
while ($cam = $admins_sql->fetch_assoc()){
    $tu="";
    $z="null";
    if ($cam["id_usuario"]==$user) {
        $tu=" (Tú)";
        $z="true";
    }

    $administradores .='
    <li class="list-group-item list-group-item-action " >
    <div class="d-flex w-100 justify-content-start align-items-center cursor-pointer">
        <img src="../IMAGES/img/perfil.png" alt="perfil" class="rounded-circle border border-light border-2" style="height: 2rem;">
        <h5 class="ml-2 mr-auto cursor-pointer ">'.$cam["nombre"].' '.$cam["apellido"].' '.$tu.'</h5>
        <small class="text-muted ml-auto user-select-none">Adm.</small>
        '.str_replace("******",''.$cam["id_usuario"].','.$colum[1].','.$z.'',$permiso_boton_adm).'
    </li>';
}

$sql='SELECT  usuarios.id_usuario, usuarios.nombre, usuarios.apellido
FROM relacion
INNER JOIN empresas ON relacion.id_empresa=empresas.id_empresa
INNER JOIN usuarios ON relacion.id_usuario=usuarios.id_usuario
WHERE relacion.id_empresa='.$colum[1].' AND relacion.id_rol=2';

$usuarios="";

$usuarios_sql = $mysqli->query($sql);
while ($camp = $usuarios_sql->fetch_assoc()){
    $tu="";
    if ($camp["id_usuario"]==$user) {
        $tu=" (Tú)";
    }
    $usuarios .='
    <li class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-start align-items-center cursor-pointer">
                <img src="../IMAGES/img/perfil.png" alt="perfil" class="rounded-circle border border-light border-2" style="height: 2rem;">
                <h5 class="ml-2 mr-auto cursor-pointer">'.$camp["nombre"].' '.$camp["apellido"].' '.$tu.'</h5>
                '.str_replace("******",''.$camp["id_usuario"].','.$colum[1].'',$permiso_boton_user).'
            </div>
            
    </li>';
}
//usuario % empresa
//."%".$colum[0]


$mysqli->close();
?>

        <?php echo $permiso_compartir; ?>
    <p class="h5 user-select-none text-black-50 mt-2">Administradores<hr class="mt-1" /></p>
    <ul class="list-group list-group-flush ">
        <?php echo $administradores; ?>
    </ul>
    <p class="h5 user-select-none text-black-50 mt-3">Usuarios<hr class="mt-1"/></p>
    <ul class="list-group list-group-flush ">
        <?php echo $usuarios; ?>
    </ul>











    

