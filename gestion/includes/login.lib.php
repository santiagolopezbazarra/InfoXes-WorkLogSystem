<?php
/**
 * Libreria para validar un usuario comprobando su usuario (o email) y contraseña
 * Forma parte del paquete de tutoriales en PHP disponible en http://www.emiliort.com
 * @author Emilio Rodríguez - http://www.emiliort.com
 */

/**
 * valida un usuario y contraseña
 * @param string $usuario
 * @param string $password
 * @return bool
 */
function login($usuario,$password) {

    //usuario y password tienen datos?
    if (empty($usuario)) return false;
    if (empty ($password)) return false;

    //1 - conectamos a la base de datos utilizando los parámetros globales
    $conexion =  mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL, BASE_DATOS);



	if ($conexion -> connect_errno) {
	die( "Fallo la conexión a MySQL: (" . $mysqli -> mysqli_connect_errno(). ") " . $mysqli -> mysqli_connect_error());
	}

    //2 - preparamos la consulta SQL a ejecutar utilizando sólo el usuario y evitando ataques de inyección SQL.
      $query="SELECT ".ID_LOGIN.", ".USUARIO_LOGIN.", ".CLAVE_LOGIN.", ".NOMBRE_LOGIN.", ".NIVEL_LOGIN.", ".EMAIL_LOGIN." FROM " .TABLA_DATOS_LOGIN. " WHERE ".USUARIO_LOGIN." = '". $usuario."'"; //la tabla y el campo se definen en los parametros globales
      $result = mysqli_query($conexion, $query) or trigger_error("Falla la query de la consulta".mysqli_error($conexion), E_USER_ERROR);
    //3 - extraemos el registro de este usuario
      $row = mysqli_fetch_assoc($result);

    if ($row) {
        //4 - Generamos el hash de la contraseña encriptada para comparar o lo dejamos como texto plano
        switch (METODO_ENCRIPTACION_CLAVE) {
            case 'sha1'|'SHA1':
                $hash=sha1($password);
                break;
            case 'md5'|'MD5':
                $hash=md5($password);
                break;
            case 'texto'|'TEXTO':
                $hash=$password;
                break;
            default:
                trigger_error('El valor de la constante METODO_ENCRIPTACION_CLAVE no es válido. Utiliza MD5 o SHA1 o TEXTO',E_USER_ERROR);
        }
        //5 - comprobamos la contraseña
        if ($hash==$row[CLAVE_LOGIN]) {
            @session_start();
            $_SESSION['USUARIO']=array('id'=>$row[ID_LOGIN],'nivel'=>$row[NIVEL_LOGIN],'user'=>$row[USUARIO_LOGIN],'nombre'=>$row[NOMBRE_LOGIN], 'email'=>$row[EMAIL_LOGIN]); //almacenamos en memoria el usuario y su nombre completo
            //print_r($_SESSION['USUARIO']);
            // en este punto puede ser interesante guardar más datos en memoria para su posterior uso, como por ejemplo un array asociativo con el id, nombre, email, preferencias, ....
            return true; //usuario y contraseña validadas
        } else {
            @session_start();
            unset($_SESSION['USUARIO']); //destruimos la session activa al fallar el login por si existia
            return false; //no coincide la contraseña
        }
    } else {
        //El usuario no existe
        return false;
    }

}

/**
 * Veridica si el usuario está logeado
 * @return bool
 */
function estoy_logeado () {
    @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)

    if (!isset($_SESSION['USUARIO'])) return false; //no existe la variable $_SESSION['USUARIO']. No logeado.
    if (!is_array($_SESSION['USUARIO'])) return false; //la variable no es un array $_SESSION['USUARIO']. No logeado.
    if (empty($_SESSION['USUARIO']['user'])) return false; //no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.
    //echo "<script type='text/javascript'>alert('message'); </script>";

    //cumple las condiciones anteriores, entonces es un usuario validado
    return true;

}

/**
 * Vacia la sesion con los datos del usuario validado
 */
function logout() {
    @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)
    unset($_SESSION['USUARIO']); //eliminamos la variable con los datos de usuario;
    session_write_close(); //nos asegurmos que se guarda y cierra la sesion
    return true;
}



?>
