<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>HUMBERTO RIVAS - CONSTRUCCIONES</title>
    <!-- CSS files -->
    <link href="../../vendors/tabler/css/tabler.min.css" rel="stylesheet"/>
    <link href="../..vendors/tabler/css/tabler-flags.min.css" rel="stylesheet"/>
    <!-- JQUERY -->
    <script src="../../vendors/phpgrid/js/jquery.min.js" type="text/javascript"></script>

   <style>
  </style>
  </head>

<body >
<?php
// Mínimo control de acceso
require('../../includes/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
$nivel = utf8_encode($_SESSION['USUARIO']['nivel']);
include("header.php");
$persona = $_SESSION['USUARIO']['id'];
?>
<!-- ZONA PRINCIPAL -->
<div class="page">
  <div class="page-wrapper">
    <div class="container-fluid"> 
    <!-- Page body -->
   <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <div class="col-12">
         <?php
         //RECIBIMOS EL FORMULARIO
         if (isset($_POST["submit"])) {
            grabamos_datos($persona);
          } else {
           // DIBUJAMOS EL FORMULARIO
           dibujamos_formulario($persona);
          }
          ?>
        </div>
      </div>
     </div>
     </div>
    </div> <!-- Page-body -->
  </div>
</div>


<!-- FUNCIONES -->
<?php
function grabamos_datos($persona){

  $fecha = $_POST['fecha'];

  if( isset($_POST['hora']) ) {
    $hora = $_POST['hora'];
  }else{
    $hora = "falta la hora";
  }
  setlocale(LC_ALL,"spanish");
  date_default_timezone_set('Europe/Madrid');
  $tipo_jornada = $_POST['tipo_jornada'];
  $registro = $_POST['registro'];
  $incidencia = $_POST['incidencia'];
  $formated_DATE = date('Y-m-d');
  $formated_TIME = date('H:i:s');

  require_once('../../includes/conectaDB.php');

  // PRIMERO SABEMOS SI YA HAY UN REGISTRO ESE DÍA
  $query_busca = "SELECT ch_persona,ch_dia FROM control_horario WHERE ch_persona = $persona AND ch_dia = '$formated_DATE'";

  //$file = fopen("c:\QUERY_DIA.txt", "w");
  //fwrite($file, "Log en operaciones de VARIABLES" . PHP_EOL);
  //fwrite($file, "QUERY.-".$query_busca . PHP_EOL);
  //fclose($file);

  $resultado_busca = mysqli_query($conexion,$query_busca);
  if($resultado_busca){ //
    //UPDATE
    switch($registro){
      case 1: //ENTRADA
        $query_update = "UPDATE control_horario SET ch_hora_entrada='$formated_TIME',ch_tipo_jornada=$tipo_jornada,ch_incidencia='$incidencia' "
        ."WHERE ch_persona=$persona AND ch_dia = '$formated_DATE'";

        $file = fopen("c:\QUERY_update_entrada.txt", "w");
        fwrite($file, "Log en operaciones de VARIABLES" . PHP_EOL);
        fwrite($file, "QUERY.-".$query_update . PHP_EOL);
        fclose($file);

        break;
      case 2: // SALIDA
        $query_update = "UPDATE control_horario SET ch_hora_salida='$formated_TIME',ch_tipo_jornada=$tipo_jornada,ch_incidencia='$incidencia' "
        ."WHERE ch_persona=$persona AND ch_dia = '$formated_DATE'";

        $file = fopen("c:\QUERY_update_salida.txt", "w");
        fwrite($file, "Log en operaciones de VARIABLES" . PHP_EOL);
        fwrite($file, "QUERY.-".$query_update . PHP_EOL);
        fclose($file);

        break;
    }
    $resultado_update = mysqli_query($conexion,$query_update);
    if(!$resultado_update){
      $mensaje='<div class="alert alert-success">ERROR! EN EL REGISTRO. </div>';                    
      } else {
      $mensaje="<div class='alert alert-success'>REGISTRO/CONTROL DE HORARIO EFECTUADO CON ÉXITO : <b>".date('d-m-Y',strtotime($formated_DATE))." / ".$formated_TIME." / ". $registro."</b></div>";
      $boton = "<div class='col-6 col-sm-4 col-md-2 col-xl py-3'><a href='../views/logout.php' class='btn btn-danger w-100'>Logout / Salir</a></div>";
      echo $mensaje.$boton;
      };
      mysqli_close($conexion);


  } else {
    //INSERT
    switch($registro){
      case 1: //ENTRADA
        $query_insert = "INSERT INTO control_horario "
        ."(ch_persona,ch_dia,ch_hora_entrada,ch_tipo_jornada,ch_registro,ch_incidencia) "
        ."VALUES ($persona,'$formated_DATE','$formated_TIME',$tipo_jornada,$registro,'$incidencia')";
        echo $query_insert;
        break;
      case 2: // SALIDA
        $query_insert = "INSERT INTO control_horario "
        ."(ch_persona,ch_dia,ch_hora_salida,ch_tipo_jornada,ch_registro,ch_incidencia) "
        ."VALUES ($persona,'$formated_DATE','$formated_TIME',$tipo_jornada,$registro,'$incidencia')";
        echo $query_insert;
        break;
    }
    $resultado_insert = mysqli_query($conexion,$query_insert);

    if(!$resultado_insert){
      $mensaje='<div class="alert alert-success">ERROR! EN EL REGISTRO. </div>';                    
      } else {
      $mensaje="<div class='alert alert-success'>REGISTRO/CONTROL DE HORARIO EFECTUADO CON ÉXITO : <b>".date('d-m-Y',strtotime($formated_DATE))." / ".$formated_TIME & $registro."</b></div>";
      $boton = "<div class='col-6 col-sm-4 col-md-2 col-xl py-3'><a href='../views/logout.php' class='btn btn-danger w-100'>Logout / Salir</a></div>";
      echo $mensaje.$boton;
      };
      mysqli_close($conexion);
  }

 

}








function dibujamos_formulario($persona){
  setlocale(LC_ALL,"spanish");
  date_default_timezone_set('Europe/Madrid');
  $fecha = strftime("%A %d %B");
  $dia = date('l j F');
  $hora = date('h:i:s A');
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="card">
<div class="card-header">
  <h4 class="card-title">CONTROL HORARIO / JORNADA</h4>
</div>
<!-- CARD BODY -->
<div class="card-body">
  <div class="row">
  <!-- COLUMNA 1 -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">

          <div class="mb-3 row"><!-- DÍA ACTUAL -->
            <label class="col-3 col-form-label required">DÍA ACTUAL:</label>
            <div class="col">
              <input type="fecha" class="form-control" name="fecha" id="fecha" value="<?php echo utf8_encode($fecha); ?>" readonly  >
            </div>
          </div>
          <div class="mb-3 row"> <!-- HORA ACTUAL -->
              <label class="col-3 col-form-label required">HORA ACTUAL:</label>
              <div class="col">
                <input type="text" class="form-control" name="hora" id="hora" value="<?php echo $hora; ?>" readonly>
              </div>
          </div>
          <div class="mb-3 row"> <!-- TIPO JORNADA -->
            <label class="col-3 col-form-label">TIPO JORNADA:</label>
            <div class="col">
              <select class="form-select" name="tipo_jornada" id="tipo_jornada">
              <?php
                require_once('../../includes/conectaDB.php');
                $query = "SELECT tj_id,tj_denominacion FROM tipo_jornada";
                $resultado = $conexion->query($query);
                while($row = $resultado->FETCH_ASSOC()) { ?>
                  <option value="<?php echo $row["tj_id"]; ?>">
                  <?php echo $row["tj_denominacion"]; ?>
                  </option>
                <?php } ?>
              <select>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-3 col-form-label">REGISTRO:</label>
            <div class="col">
              <select class="form-select" name="registro" id="registro">
                <?php
                //require('../../includes/conectaDB.php');
                $query = "SELECT tr_id,tr_denominacion FROM tipo_registro_horario";
                $resultado = $conexion->query($query);
                while($row = $resultado->FETCH_ASSOC()) { ?>
                  <option value="<?php echo $row["tr_id"]; ?>">
                  <?php echo $row["tr_denominacion"]; ?>
                  </option>
                  <?php } ?>
              <select>
            </div>
          </div>
          <div class="mb-3"> <!-- INCIDENCIAS -->
              <label class="form-label">INCIDENCIA: </label>
              <textarea class="form-control" name="incidencia" id="incidencia" data-bs-toggle="autosize" placeholder="Max: 300 caracteres"></textarea>
          </div>
          <div class="card-footer text-end">
            <button type="submit" name ="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-success">REGISTRAR</button>
              <br>
              <br>
              <div class="text-end"><a href="../views/logout.php" class="btn btn-danger">LOGOUT / SALIR</a> </div>
          </div>
        </div> <!-- CARD BODY -->
      </div>
    </div>
    <!-- COLUMNA 2 -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">REGISTRO DE JORNADA</h3>
          <!-- <p class="card-subtitle">Se muestra el último registro efectuado por parte del trabajador.</p> -->

        <?php
        require_once('../../includes/conectaDB.php');
        $query = "SELECT ch_id,ch_persona,ch_dia,ch_hora_entrada,ch_hora_salida,ch_tipo_jornada,tr_denominacion as ch_registro,ch_incidencia "
                ."FROM control_horario "
                ."LEFT JOIN tipo_registro_horario ON tr_id = ch_registro "
                ."WHERE ch_persona = $persona ORDER BY ch_id DESC";
        //echo $query;
        $resultado = $conexion->query($query);
        $row = $resultado->FETCH_ASSOC();
        if(!$resultado){
          $mensaje='<div class="alert alert-success">NO HAY REGISTROS HORARIOS GUARDADOS. </div>';                    
          } else {
          $mensaje="<div class='alert'>ÚLTIMO REGISTRO/CONTROL DE HORARIO EFECTUADO CON ÉXITO : </br></br>"
          ."DÍA.- <b>".date('d-m-Y',strtotime($row['ch_dia']))."</b></br>"
          ."HORA ENTRADA.- <b>".$row['ch_hora_entrada']."</b></br>"
          ."HORA SALIDA.- <b>".$row['ch_hora_salida']."</b></br>"
          //."REGISTRO.- <b>".$row['ch_registro']."</b>"
          ."</div>";
            echo $mensaje;
        };
        mysqli_close($conexion);
        ?>

      </div>
  </div>
</div>
</div>

<div class="col-12 col-lg-auto mt-3 mt-lg-0">
<ul class="list-inline list-inline-dots mb-0">
  <li class="list-inline-item">
    Copyright &copy; 2023 -
    <a href="." class="link-secondary">INFOXES</a>.
    All rights reserved.
    </li>
  <li class="list-inline-item">
    <a href="" class="link-secondary" rel="noopener"> v2.0.0</a>
  </li>
</ul>
</div>
      </form>

<?php } ?>

<!-- FIN DE FUNCION DIBUJAMOS_FORMULARIO() -->

<script src="../../vendors/tabler/js/tabler.min.js"></script>
</body>
</html>
