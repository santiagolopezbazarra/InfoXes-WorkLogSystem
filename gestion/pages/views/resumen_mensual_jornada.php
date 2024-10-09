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
    <link href="../../vendors/tabler/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="../../vendors/tabler/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="../../vendors/tabler/css/demo.min.css" rel="stylesheet"/>
    <!-- JQUERY -->
    <script src="../../vendors/phpgrid/js/jquery.min.js" type="text/javascript"></script>

   <!-- FULL CALENDAR -->
   <link rel="stylesheet" href="../../vendors/fullcalendar/fullcalendar.min.css">
   <link rel="stylesheet" href="../../vendors/fullcalendar/fullcalendar.print.min.css" media="print">
   <script src="../../vendors/moment/moment.js"></script>
   <script src="../../vendors/fullcalendar/fullcalendar.min.js"></script>

   <!-- SCRIPTS PARA CONTROL DE LOS EVENTOS DEL CALENDARIO -->
   <script src="../../includes/js/calendar.js"></script>
   <!-- <script src="../../includes/js/calendar_gl.js"></script> -->

   <style>
    #calendar {
      width: 1150px;
      margin: 1 auto;
      padding: 5px;
    }

    #reservados {
      height: 350px;
      overflow-y: scroll;
      font-size: 11px;
    }
    #no_cargados{
    	height: 550px;
      overflow-y: scroll;
      font-size: 11px;
    }

  </style>
  </head>

<body >
  <?php
  // Mínimo control de acceso
        require('../../includes/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
        $nivel = utf8_encode($_SESSION['USUARIO']['nivel']);
    ?>

<div class="page">
    <?php
        include("header.php");
        //include("aside.php");
    ?>
  <!-- ZONA PRINCIPAL -->

  <div class="page-wrapper">
    <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  RESUMEN REGISTROS MENSUAL
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="card-body">
                <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><button class="table-sort" data-sort="sort-name">DÍA</button></th>
                        <th><button class="table-sort" data-sort="sort-city">HORA ENTRADA</button></th>
                        <th><button class="table-sort" data-sort="sort-city">HORA SALIDA</button></th>
                        <th><button class="table-sort" data-sort="sort-type">TIPO JORNADA</button></th>
                        <th><button class="table-sort" data-sort="sort-date">INCIDENCIA</button></th>
                        <th><button class="table-sort" data-sort="sort-quantity">TOTAL HORAS</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    <?php
                        require('../../includes/conectaDB.php');
                        $trabajador=2;
                        $query = "SELECT ch_id,pe_nombre AS ch_persona,ch_dia,ch_hora_entrada,ch_hora_salida,tj_denominacion AS ch_tipo_jornada,ch_incidencia "
                                            ."FROM control_horario "
                                            ."LEFT JOIN personal ON ch_persona = pe_id "
                                            ."LEFT JOIN tipo_jornada ON ch_tipo_jornada = tj_id "
                                            ."WHERE ch_persona=1 "
                                            ."ORDER BY ch_dia ASC";
                        $resultado = $conexion->query($query);
                        while($row = $resultado->FETCH_ASSOC()) { 
                            $dia = $row["ch_dia"];
                            if($dia == $row["ch_dia"]){ ?>
                                <tr>
                                <td class="sort-name"><?php echo $row["ch_dia"]; ?></td>
                                <td class="sort-city"><?php echo $row["ch_hora_entrada"]; ?></td>
                                <td class="sort-city"><?php echo $row["ch_hora_salida"]; ?></td>
                                <td class="sort-type"><?php echo $row["ch_tipo_jornada"]; ?></td>
                                <td class="sort-quantity"><?php echo $row["ch_incidencia"]; ?></td>
                                <td class="sort-progress" data-progress="30">aaa</td>
                               </tr>
                            <?php
                            } else {
                                $dia = $row["ch_dia"];
                            }
                        }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank" class="link-secondary" rel="noopener">Documentation</a></li>
                  <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
                  <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
                  <li class="list-inline-item">
                    <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                      <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Sponsor
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2023
                    <a href="." class="link-secondary">Tabler</a>.
                    All rights reserved.
                  </li>
                  <li class="list-inline-item">
                    <a href="./changelog.html" class="link-secondary" rel="noopener">
                      v1.0.0-beta19
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>












  <!-- FOOTER -->
  <?php include("footer.php"); ?>
  <!-- FIN FOOTER -->
  </div>
</div>
<script src="../../vendors/tabler/js/tabler.min.js"></script>
<script>
      document.addEventListener("DOMContentLoaded", function() {
      const list = new List('table-default', {
      	sortClass: 'table-sort',
      	listClass: 'table-tbody',
      	valueNames: [ 'sort-name', 'sort-type', 'sort-city', 'sort-score',
      		{ attr: 'data-date', name: 'sort-date' },
      		{ attr: 'data-progress', name: 'sort-progress' },
      		'sort-quantity'
      	]
      });
      })
    </script>
</body>
</html>
