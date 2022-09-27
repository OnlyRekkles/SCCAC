<?php
session_start();
unset($_SESSION["usuario"]);
session_destroy();
setcookie("Login_info","",null,"/");
echo"../Login/login.php";
?>