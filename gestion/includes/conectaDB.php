<?php

//$conn = mysqli_connect("localhost", "cau", "K4t4rs1s") or die(mysql_error());
//mysql_select_db("cau") or die(mysql_error());
//include('includes/php/config.ini.php');
include('config.ini.php');
//1 - conectamos a la base de datos utilizando los parámetros globales
$conexion =  mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL, BASE_DATOS);
$conexion->set_charset("utf8");

if ($conexion -> connect_errno) {
die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno(). ") " . $mysqli -> mysqli_connect_error());
}

?>
