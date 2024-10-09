<?php
/*
 * Valida un usuario y contraseña o presenta el formulario para hacer login
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // ¿Nos mandan datos por el formulario?
    include('../../includes/config.ini.php'); //incluimos configuración
    include('../../includes/login.lib.php'); //incluimos las funciones

    //verificamos el usuario y contraseña mandados
    if (login($_POST['usuario'],$_POST['password'])) {

       //acciones a realizar cuando un usuario se identifica
       //EJ: almacenar en memoria sus datos, registrar un acceso a una tabla de datos
       //Estas acciones se veran en los siguientes tutorianes en http://www.emiliort.com

        //saltamos al inicio del área restringida
        header('Location: ../../index.php');
        die();
    } else {
        //acciones a realizar en un intento fallido
        //Ej: mostrar captcha para evitar ataques fuerza bruta, bloqueas durante un rato esta ip, ....
        //Estas acciones se veran en los siguientes tutorianes en http://www.emiliort.com

        //preparamos un mensaje de error y continuamos para mostrar el formulario
        $mensaje='Usuario o contraseña incorrecta.';
    }
} //fin if post
?>


<!doctype html>

<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>TYRMA - INTRANET - LOGIN</title>
    <!-- CSS files -->
    <link href="../../vendors/tabler/css/tabler.min.css" rel="stylesheet"/>
    <link href="../..vendors/tabler/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="../../vendors/tabler/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="../../vendors/tabler/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="../../vendors/tabler/css/demo.min.css" rel="stylesheet"/>
    <style>
    #principal {
      background-color: transparent;
      /*background-image: url("../../img/fondo.jpg"); */
      background-repeat: no-repeat;
      background-position: center center;
      background-attachment: fixed;
      background-size: contain;
      }
    </style>

  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column" id="principal">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="../../img/logo_principal.png" width="620" height="120" alt=""></a>
        </div>
        <form class="card card-md" action="login.php" method="POST" autocomplete="off">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">ACCESO A LA APLICACIÓN</h2>
            <div class="mb-3">
              <label class="form-label">Login / usuario</label>
              <input type="text" class="form-control" name="usuario" id="username" placeholder="Usuario">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Contraseña
                <span class="form-label-description">
                  <a href="#">No recuerdo mi contraseña</a>
                </span>
              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control"  name="password" id="password" placeholder="Contraseña"  autocomplete="off">
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                  </a>
                </span>
              </div>
            </div>

            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Accede</button>
              <?php
                //si hay algún mensaje de error lo mostramos escapando los carácteres html
                if (!empty($mensaje)) echo('<h5>'.htmlspecialchars($mensaje).'</h5>');
              ?>
            </div>
          </div>

        </form>

      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
  </body>
</html>
