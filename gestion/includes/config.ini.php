<?php
/*
 * Configuración general: conexión a la base de datos y otro parámetros
 */
define('SERVIDOR_MYSQL','localhost'); //servidor de la base de datos
define('USUARIO_MYSQL','tabi13_humberto'); //usuario de la base de datos
define('PASSWORD_MYSQL','enmmqYxDVx5rt8hZ9Smp'); //la clave para conectar
define('BASE_DATOS','tabi13_humberto'); // indica el nombre de la base de datos que contiene la tabla de los usuarios

define('TABLA_DATOS_LOGIN','personal'); //nombre de la tabla usarios
define('ID_LOGIN','pe_id'); //campo que contiene los datos de los usuarios (se puede usar el email)
define('USUARIO_LOGIN','pe_login'); //campo que contiene los datos de los usuarios (se puede usar el email)
define('CLAVE_LOGIN','pe_password'); //campo que contiene la contraseña
define('NOMBRE_LOGIN','pe_nombre'); // campo con el nombre completo del usuario
define('NIVEL_LOGIN','pe_nivel'); // campo con el nivel del usuario
//define('NIVEL_PEDIDOS_LOGIN','pr_nivel_pedidos'); // campo con el nivel del usuario para PEDIDOS
//define('CICLO_LOGIN','pr_ciclo'); // campo con el nivel del usuario para PEDIDOS
define('EMAIL_LOGIN','pe_email'); // campo con el correo electrónico del usuario

define('METODO_ENCRIPTACION_CLAVE','texto'); //método utilizado para almacenar la contraseña encriptada. Opciones: sha1, md5, o texto


//$file = fopen("c:\wamp\www\genepol_web\OUT_PRINT.txt", "w");
//fwrite($file, "Log en operaciones de VARIABLES" . PHP_EOL);
//fwrite($file, "QUERY.-".$query_detalle . PHP_EOL);
//fwrite($file, $query2 . PHP_EOL);
//fwrite($file, "Estado.-".$estado . PHP_EOL);
//fclose($file);


?>
