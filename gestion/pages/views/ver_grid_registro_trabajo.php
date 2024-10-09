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
    <script src="../../vendors/phpgrid/js/jquery.min.js" type="text/javascript"></script>

    <!-- bootstrap3 + jqgrid compatibility css -->
    <link rel="stylesheet" type="text/css" media="screen" href="../../vendors/phpgrid/js/jqgrid/css/ui.jqgrid.bs.css">
    <script src="../../vendors/phpgrid/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
    <script src="../../vendors/phpgrid/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="../../vendors/phpgrid/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
    <script src="../../includes/js/date_picker_es.js" type="text/javascript"></script>

    <!-- library for checkbox in column chooser  -->
    <link href="//cdn.jsdelivr.net/gh/wenzhixin/multiple-select@1.2.1/multiple-select.css" rel="stylesheet" />
    <script src="//cdn.jsdelivr.net/gh/wenzhixin/multiple-select@1.2.1/multiple-select.js"></script>
<style>
.select-css {
   background: transparent;
   border: 10px;
   font-size: 12px;
   height: 30px;
   padding: 0px;
   width: 250px;
   border-radius: none;
   border-color:brown;
   margin: 0%;
}

.ms-choice {
    display: block;
    width: 100%;
    height: 26px;
    padding: 0;
    overflow: hidden;
    /* cursor: pointer; */
    border: 1px solid #aaa;
    text-align: left;
    white-space: nowrap;
    /* line-height: 26px; */
    color: #444;
    text-decoration: none;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
    background-color: #fff;
}

.ms-choice.disabled {
    background-color: white;
    background-image: none;
    border: 1px solid #ddd;
    cursor: default;
}
</style>

  </head>
  <body>
  <script>

function grid_load() { }
  function grid_select(id) { }
  function secondsToString(seconds) {
        var hour = Math.floor(seconds / 3600);
        hour = (hour < 10)? '0' + hour : hour;
        var minute = Math.floor((seconds / 60) % 60);
        minute = (minute < 10)? '0' + minute : minute;
        var second = seconds % 60;
        second = (second < 10)? '0' + second : second;
        return hour + ':' + minute + ':' + second;
  }
  function grid_onload() {
		      var grid = $("#list1");
      		// SUMA LA COLUMNA SEGUNDOS
          sum = grid.jqGrid('getCol', 'segundos', false, 'sum'); 
          horas = secondsToString(sum);
          grid.jqGrid('footerData','set', {horas: 'Total: '+horas}, false);
          //VISUALIZA TOTAL SEGUNDOS
          grid.jqGrid('footerData','set', {segundos: 'Total: '+sum}, false);
  };

	jQuery(window).load(function()
	{
		// show dropdown in toolbar
		jQuery('.navtable tr:first').append('<td><div style="padding-left: 5px; padding-top:0px; float:left"><select style="height:24px" class="chngroup"><option value="clear" >Agrupado por : </option><?php foreach($g->options["colModel"] as $c) { if($c["title"] !='Action'){?><option value="<?php echo $c["name"] ?>" <?php echo ($c["name"]=="role")?"selected":"" ?>><?php echo $c["title"] ?></option><?php }} ?></select></div></td>');
		var grid_id = '<?php echo $g->id ?>';
		jQuery(".chngroup").change(function()
		{
			var vl = jQuery(this).val(); 
			if(vl) 
			{ 
				if(vl == "clear") 
					jQuery("#"+grid_id).jqGrid('groupingRemove',true); 
				else 
					jQuery("#"+grid_id).jqGrid('groupingGroupBy',vl); 
			} 
		});
		
		// http://www.trirand.com/jqgridwiki/doku.php?id=wiki:grouping#methods
		jQuery("#toggleGroup").click(function()
		{
			jQuery("."+grid_id+"ghead_0").each(function(){
				jQuery("#"+grid_id).jqGrid('groupingToggle',jQuery(this).attr('id')); 
			});
		});

		jQuery(".opengroup").change(function(){
			var grid_id = "list1";
			var group_id = jQuery(this).val();
			id = grid_id + "ghead_0" + "_" + group_id;
			jQuery("#"+grid_id).jqGrid('groupingToggle',id);
		})
	});

</script>


  <?php
  // Mínimo control de acceso
    require('../../includes/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
  ?>

  <div class="page">
			   <?php
            include "header.php";
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
                      <!-- FORMULARIO DE BÚSQUEDA -->
                      <!-- NOMBRE TRABAJADOR -->
                      <div style="margin:10px">
                        <fieldset style="float:left; width:300px; font-family:tahoma; font-size:12px">
                          <form>
                          TRABAJADOR: <input type="text" id="filter"/>
                          <input type="submit" id="search_text" value="Filter">
                          </form>
                        </fieldset>
                        <!-- FECHAS -->
                        <fieldset style="float:left; width:600px; font-family:tahoma; font-size:12px">
                          <form>
                          FECHA INICIAL: <input class="datepicker" type="text" id="datefrom"/>
                          FECHA FINAL: <input class="datepicker" type="text" id="dateto"/>
                          <input type="submit" id="search_date" value="Filter">
                          </form>
                        </fieldset>

                        <fieldset style="float:left; width:600px; font-family:tahoma; font-size:12px;" >
                          <form>
                          OBRA: 
                            <select id="search_name" multiple="multiple" class="select-css">
				                      <option> DEPURADORA GENEPOL</option>
				                      <option> OFICINAS TYRMA</option>
			                      </select>
			                      <input type="submit" id="button_search_name" value="Filtrar">
                          </form>
                        </fieldset>
                        <script>
                          $(function() {
			                        $('select[multiple]').multipleSelect()
		                      })
                        </script>	

                        <!-- DENOMINACION DE OBRAS -->
                        <div style="clear:both;margin-bottom:10px"></div>
                       
                       
                      </div>

                      <!-- FIN DEL FORMULARIO -->
                      <!-- DIBUJAMOS EL GRID -->
                      <div style="clear:both;margin-bottom:10px"></div>
                          <?php echo $out_master ?>
                      </div>
                      
                      </div>
                    </div>
                  </div>
                  <br>
                  <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-scrollable">
                  IMPRESIÓN RESUMEN TRABAJADOR
                  </a>
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
        <form id="form1" name="form1" method="post" action="../../pages/modules/pdf/print_listado_trabajador_mes.php">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">IMPRESIÓN RESUMEN TRABAJADOR</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">FECHA INICIAL:</label>
                <input type="date" name="fecha1" class="form-control" id="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label">FECHA FINAL:</label>
                <input type="date" name="fecha2" class="form-control" id="">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Selecciona trabajador:</label>
                    <select class="form-select" name="trabajador">
                      <!-- <option value="9" selected>Todas</option> -->
                      <?php
                      // Mínimo control de acceso
                      include_once('../../includes/conectaDB.php'); 
                      $estados = "SELECT tr_id,tr_nombre,tr_estado,tr_borrado from trabajadores WHERE tr_estado = 1 AND tr_borrado = 0";
                      $resultado = $conexion->query($estados);
                      while($row = $resultado->FETCH_ASSOC()) {
                        ?>
                        <option value="<?php  echo ($row['tr_id']); ?>" > <?php  echo ($row['tr_nombre']); ?></option>
                      <?php } ?>
                    </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Imprimir</button>
          </div>
        </div>
       </form>
      </div>
    </div>
    <!-- FIN MODAL -->

<!-- SCRIPT DE BÚSQUEDA/FILTRO -->



<script>
    jQuery(window).load(function() {
		jQuery(".datepicker").datepicker(
								{
								"disabled":false,
								"dateFormat":"yy-mm-dd",
								"changeMonth": true,
								"changeYear": true,
								"firstDay": 1,
								"showOn":'both'
								}
							).next('button').button({
								icons: {
									primary: 'ui-icon-calendar'
								}, text:false
							}).css({'font-size':'80%', 'margin-left':'2px', 'margin-top':'-5px'});
											
	});
    // BÚSQUEDA POR NOMBRE DEL TRABAJADOR
    jQuery("#search_text").click(function() {
    	grid = jQuery("#list1");
      var searchFilter = jQuery("#filter").val(), f;
  		if (searchFilter.length === 0) {
        grid[0].p.search = false;
			jQuery.extend(grid[0].p.postData,{filters:""});
		}
		else
		{
			f = {groupOp:"OR",rules:[]};
	
			f.rules.push({field:"rt_trabajador",op:"bw",data:searchFilter});
			//f.rules.push({field:"rt_fecha",op:"bw",data:searchFilter});
	
			grid[0].p.search = true;
			
			// if toolbar filter, keep in with external search form
			if (grid[0].p.postData.filters != undefined && grid[0].p.postData.filters != '') {
				var toolbar_filters = JSON.parse(grid[0].p.postData.filters);
				var combine_filters = {groupOp:"AND",rules:[],groups:[toolbar_filters,f]};
			} else
				var combine_filters = f;
				jQuery.extend(grid[0].p.postData,{filters:JSON.stringify(combine_filters)});
		}
        grid.trigger("reloadGrid",[{jqgrid_page:1,current:true}]);
        return false;
    });
	
    // BÚSQUEDA ENTRE FECHAS
    jQuery("#search_date").click(function() {
      grid = jQuery("#list1");
		  if (jQuery("#datefrom").val() == '' || jQuery("#dateto").val() == '')
			  return false;
	
	  	var f = {groupOp:"AND",rules:[]};
		  if (jQuery("#datefrom").val())
        f.rules.push({field:"rt_fecha",op:"ge",data:jQuery("#datefrom").val()});
		
		  if (jQuery("#dateto").val())
        f.rules.push({field:"rt_fecha",op:"le",data:jQuery("#dateto").val()});

		  var s = {groupOp:"OR",rules:[],groups:[f]};
		  s.rules.push({field:"rt_fecha",op:"nu",data:''});
		   
      grid[0].p.search = true;
      jQuery.extend(grid[0].p.postData,{filters:JSON.stringify(s)});

      grid.trigger("reloadGrid",[{jqgrid_page:1,current:true}]);
      return false;
    });

    // BÚSQUEDA POR COMBO DE OBRAS !!!!!
	  var search_with_name = function() {
    	grid = jQuery("#list1");

		var template = jQuery("#search_name").val();
		if (template.length === 0) {
      grid[0].p.search = false;
			jQuery.extend(grid[0].p.postData,{filters:""});
		}
		
		template = template.join(",");
		var f = {groupOp:"AND",rules:[]};
		f.rules.push({field:"rt_obra",op:"in",data:template});

    grid[0].p.search = true;
    jQuery.extend(grid[0].p.postData,{filters:JSON.stringify(f)});
    grid.trigger("reloadGrid",[{jqgrid_page:1,current:true}]);
    return false;
    };

    jQuery("#button_search_name").click(search_with_name);
    jQuery("#button_search_tpl").click(search_with_tpl);
    jQuery("#search_tpl").change(search_with_tpl);
	
	</script>

<script>
	setTimeout(() => {
		$(window).load( function () {
			// bind custom reload handler, required for url based filters
			$('.ui-jqgrid-toppager #refresh_list1, .ui-jqgrid-pager #refresh_list1').unbind( "click" );
			$('.ui-jqgrid-toppager #refresh_list1, .ui-jqgrid-pager #refresh_list1').click( function (event) {
			reloadGrid();
			});
		});
	}, 200);

	// Nuevo evento para el botón reload
	function reloadGrid() 	{
		var grid = $("#list1");
		grid.trigger("reloadGrid",[{current:true}]);
	}
</script>












<!-- Tabler Core -->
<script src="../../vendors/tabler/js/tabler.min.js"></script>

</body>
</html>
