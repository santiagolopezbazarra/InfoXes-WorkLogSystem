<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>HUMBERTO RIVAS - CONSTRUCCIONES</title>
    <!-- CSS files -->
    <link href="../../vendors/tabler/css/tabler.css" rel="stylesheet"/>
    <!-- JQUERY -->
    <script src="../../vendors/phpgrid/js/jquery.min.js" type="text/javascript"></script>

   <!-- FULL CALENDAR -->
   <link rel="stylesheet" href="../../vendors/fullcalendar/fullcalendar.min.css">
   <link rel="stylesheet" href="../../vendors/fullcalendar/fullcalendar.print.min.css" media="print">
   <script src="../../vendors/moment/moment.js"></script>
   <script src="../../vendors/fullcalendar/fullcalendar.min.js"></script>

   <!-- SCRIPTS PARA CONTROL DE LOS EVENTOS DEL CALENDARIO -->
   <script src="../../includes/js/calendar.js"></script>

   <style>
    #calendar {
      width: 1450px;
      margin: 1 auto;
      padding: 5px;
    }
   </style>
  </head>

<body >
  <?php
  // Mínimo control de acceso
        require('../../includes/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
        $nivel = $_SESSION['USUARIO']['nivel'];
?>

  <div class="page">
	  <?php
    include("header.php");
    ?>
  <!-- ZONA PRINCIPAL -->
  <div class="page-wrapper">
    <div class="container-fluid">
    </div>
    <div class="page-body">
      <div class="container-fluid">
        <div class="row row-deck row-cards">
              <!-- CALENDARIO GENERAL -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">CALENDARIO</h3>
              </div>
              <div class="table-responsive">
                <div id='calendar'></div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- FOOTER -->
  <?php include("footer.php"); ?>
  <!-- FIN FOOTER -->
  </div>
</div>
<script src="../../vendors/tabler/js/tabler.min.js"></script>
</body>
</html>
