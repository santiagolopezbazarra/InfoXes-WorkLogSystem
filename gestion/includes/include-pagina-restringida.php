<?php
/*
 * Asegura la página en la que se incluya este script.
 */

//include_once('includes/php/config.ini.php'); //incluimos configuración
//include_once('includes/php/login.lib.php'); //incluimos las funciones
//include_once('config.ini.php'); //incluimos configuración
include_once('login.lib.php'); //incluimos las funciones

if (!estoy_logeado()) { // si no estoy logeado
    header('Location: ../../pages/views/login.php'); //saltamos a la página de login
    die('Acceso no autorizado'); // por si falla el header (solo se pueden mandar las cabeceras si no se ha impreso nada)
}
//si esta logeado el usuario continua con el script.
?>
