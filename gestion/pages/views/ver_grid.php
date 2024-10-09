<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>HUMBERTO RIVAS - CONSTRUCCIONES</title>
    <!-- CSS files -->
    <link href="../../vendors/tabler/css/tabler.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" media="screen" href="../../vendors/phpgrid/js/themes/redmond/jquery-ui.custom.css">
    <!-- JQUERY -->
    <script src="../../vendors/phpgrid/js/jquery.min.js" type="text/javascript"></script>
    <!-- bootstrap3 + jqgrid compatibility css -->
    <link rel="stylesheet" type="text/css" media="screen" href="../../vendors/phpgrid/js/jqgrid/css/ui.jqgrid.bs.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> -->
    <script src="../../vendors/phpgrid/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
    <script src="../../vendors/phpgrid/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="../../vendors/phpgrid/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
  </head>

  <body>
    <script>
      function grid_load() { }
      function grid_select(id) { }
    </script>
    <?php
      // Mínimo control de acceso
      require('../../includes/include-pagina-restringida.php'); 
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
			           <div class="col-12">
                   <div class="card">
                     <div class="card-header">
                       <h3 class="card-title"><?php echo $ruta; ?></h3>
                     </div>
                     <div class="card-body border-bottom py-3">
                       <?php echo $out_master ?>
                       <br>
                       <div style="float:left">
                         <?php if (!empty($out_detail1)){
                           echo $out_detail1;
                         } ?>
                       </div>
                       <div style="float:left; margin-left:10px">
                         <?php if (!empty($out_detail2)){
                           echo $out_detail2;
                         } ?>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <!-- FOOTER -->
        <?php
          include("footer.php");
         ?>
        <!-- FIN FOOTER -->
      </div>
    </div>
    <!-- Tabler Core -->
    <script src="../../vendors/tabler/js/tabler.min.js"></script>

  </body>
</html>
