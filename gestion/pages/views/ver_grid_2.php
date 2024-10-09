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

    <link rel="stylesheet" type="text/css" media="screen" href="../../vendors/phpgrid/js/themes/blitzer/jquery-ui.custom.css">

      <script src="../../vendors/phpgrid/js/jquery.min.js" type="text/javascript"></script>
    	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"> -->
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
      require('../../includes/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
    ?>
    <div class="page">
			   <?php
            include("header.php");
            include("aside.php");
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
                      <br>
                      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-scrollable">
                          Scrollable modal
                        </a>
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

    <!-- EJEMPLO DE MODAL -->
    <div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Scrollable modal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
              eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
              laoreet rutrum faucibus dolor auctor.</p>
            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
              consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN EJEMPLO MODAL -->

    <!-- Tabler Core -->
    <script src="../../vendors/tabler/js/tabler.min.js"></script>

  </body>
</html>
