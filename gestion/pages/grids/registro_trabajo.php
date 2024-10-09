<?php
/**
 * XESTION DE HUMBERTO RIVAS CONSTRUCCIONES
 *
 * @author J. López Domínguez
 * @version 1.0 - 2024-2025
 */

// Mínimo control de acceso.
require('../../includes/include-pagina-restringida.php'); 

// GRID DE REGISTRO DE TRABAJOS
include('../../includes/config_phpgrid.php');
include('../../vendors/phpgrid/inc/jqgrid_dist.php');

// Instanciamos un nuevo objeto jqgrid
$db_conf = array(
					"type" 		=> PHPGRID_DBTYPE,
					"server" 	=> PHPGRID_DBHOST,
					"user" 		=> PHPGRID_DBUSER,
					"password" 	=> PHPGRID_DBPASS,
					"database" 	=> PHPGRID_DBNAME
				);
$g = new jqgrid($db_conf);

// QUERY PRINCIPAL: registro_trabajo
$g->select_command = "SELECT rt_id,rt_fecha,rt_hentrada,rt_hsalida,rt_observaciones,tr_nombre AS rt_trabajador,ob_denominacion AS rt_obra,ma_denominacion AS rt_maquinaria "
    ."FROM registro_trabajo "
    ."LEFT JOIN trabajadores ON rt_trabajador = tr_id "
    ."LEFT JOIN obras ON rt_obra = ob_id "
    ."LEFT JOIN maquinaria ON rt_maquinaria = ma_id";
    
	

// Definición de columnas ************************************

// ID DEL  REGISTRO
$col = array();
$col["title"] = 'ID';
$col["name"] = 'rt_id';
$col["dbname"] = 'rt_id';
$col["width"] = '25';
$col["editable"] = false;
$cols[] = $col;

//FECHA
$col = array();
$col["title"] = 'FECHA REGISTRO';
$col["name"] = 'rt_fecha';
$col["width"] = '85';
$col["editoptions"] = array("size"=>20);
$col["formatter"] = "date";
$col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d-m-Y');
$col["datefmt"] = "d-m-Y";
$col["sortable"] = false;
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$cols[] = $col;


// ESTADO DEL TRABAJADOR
$col = array();
$col["title"] = 'TRABAJADOR';
$col["name"] = 'rt_trabajador';
$col["dbname"] = 'trabajadores.tr_nombre';
$col["width"] = '150';
$col["editable"] = true;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct tr_id as k, tr_nombre as v from trabajadores WHERE tr_estado = 1 ORDER BY tr_nombre");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'1');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;

// OBRA
$col = array();
$col["title"] = 'OBRA';
$col["name"] = 'rt_obra';
$col["dbname"] = 'obras.ob_denominacion';
$col["width"] = '150';
$col["editable"] = true;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct ob_id as k, ob_denominacion as v from obras WHERE ob_estado = 1 ORDER BY ob_denominacion");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'1');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;

// MAQUINARIA
$col = array();
$col["title"] = 'MAQUINARIA';
$col["name"] = 'rt_maquinaria';
$col["dbname"] = 'maquinaria.ma_denominacion';
$col["width"] = '150';
$col["editable"] = true;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct ma_id as k, ma_denominacion as v from maquinaria WHERE ma_estado = 1 ORDER BY ma_denominacion");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'1');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;

// HORA ENTRADA
$col = array();
$col["title"] = 'HORA ENTRADA';
$col["name"] = 'rt_hentrada';
$col["dbname"] = 'rt_hentrada';
$col["width"] = '100';
$col["editable"] = true;
$col["formatter"] = "datetime";
//$col["formatoptions"] = array("srcformat"=>'H:i:s',"newformat"=>'H:i:s');
$col["formatoptions"] = array("srcformat"=>'Y-m-d H:i:s',"newformat"=>'H:i',"opts" => array("timeOnly" => true, "timeFormat"=>"HH:mm"));
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>15);
$cols[] = $col;

// HORA SALIDA
$col = array();
$col["title"] = 'HORA SALIDA';
$col["name"] = 'rt_hsalida';
$col["dbname"] = 'rt_hsalida';
$col["width"] = '100';
$col["editable"] = true;
$col["formatter"] = "datetime";
$col["formatoptions"] = array("srcformat"=>'Y-m-d H:i:s',"newformat"=>'H:i',"opts" => array("timeOnly" => true, "timeFormat"=>"HH:mm"));
//$col["formatoptions"] = array("srcformat"=>'H:i:s',"newformat"=>'H:i:s');
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>15);
$cols[] = $col;

// PARA EL CONTROL/SUMA DE HORAS
$col = array();
$col["title"] = "SUMA HORAS";
$col["name"] = "horas";
$col["width"] = "100";
$col["search"] = true;
$col["editable"] = false;
$cols[] = $col;

$col = array();
$col["title"] = "SUMA SEGUNDOS";
$col["name"] = "segundos";
$col["width"] = "120";
$col["search"] = true;
$col["editable"] = false;
$col["hidden"] = true;
//$col["hidden"] = false;
$cols[] = $col;


// OBSERVACIONES
$col = array();
$col["title"] = 'OBSERVACIONES';
$col["name"] = 'rt_observaciones';
$col["width"] = '220';
$col["editoptions"] = array("size"=>50, "value"=>$str, "maxlenght"=>300);
$col["editable"] = true;
$col["editrules"] = array("required"=>false);
$col["edittype"] = "textarea";
$col["editoptions"] = array("rows"=>4, "cols"=>60);
$cols[] = $col;



// ******************************************************************************
// PARÁMETROS DEL GRID
$grid["caption"] = "REGISTRO DE TRABAJOS";
$grid["multiselect"] = false;
$grid["height"] = "450";
$grid["autowidth"] = true;
$grid["rowNum"] = 250;
$grid["pastefromexcel"] = false;
$grid["reloadedit"] = true;
$grid["responsive"] = true;
$grid["cellEdit"] = false;
$grid["toolbar"] = "bottom";
$grid["sortname"] ="rt_fecha";
$grid["sortorder"] ="asc";
$grid["footerrow"] = true;
$grid["reloadedit"] = true;

// GROUPING
$grid["grouping"] = true;
$grid["groupingView"] = array();
$grid["groupingView"]["groupField"] = array("rt_fecha"); // specify column name to group listing
$grid["groupingView"]["groupColumnShow"] = array(true); // either show grouped column in list or not (default: true)
$grid["groupingView"]["groupText"] = array("<b>{0} - {1} Item(s)</b>"); // {0} is grouped value, {1} is count in group
$grid["groupingView"]["groupOrder"] = array("DESC"); // show group in asc or desc order
$grid["groupingView"]["groupDataSorted"] = array(true); // show sorted data within group
$grid["groupingView"]["groupSummary"] = array(true); // work with summaryType, summaryTpl, see column: $col["name"] = "total"; (if false, set showSummaryOnHide to false)
$grid["groupingView"]["groupCollapse"] = false; // Turn true to show group collapse (default: false) 
$grid["groupingView"]["showSummaryOnHide"] = true; // show summary row even if group collapsed (hide) 
// to combine multiple records in same group
$grid["groupingView"]["isInTheSameGroup"] = array(
    "function (x, y) { return String(x).toLowerCase() === String(y).toLowerCase(); }"
);
$grid["groupingView"]["formatDisplayField"] = array(
    "function (displayValue, value, colModel, index, grp) { 

        // show label instead of ids for select formatter
        if (colModel.formatter == 'select')
            displayValue = $.fn.fmatter.select(displayValue,{'colModel':colModel});

        return displayValue[0].toUpperCase() + displayValue.substring(1).toLowerCase(); }"
);




// PARÁMETROS DEL LADO DEL SERVIDOR
//$e["on_delete"] = array("borra_trabajador", null, false);  // FUNCIONES AL FINAL DE LA PÁGINA.
//$g->set_events($e);

$e["on_data_display"] = array("filter_display", null, true);
$e["js_on_load_complete"] = "grid_onload";
$g->set_events($e);


function filter_display($data) {
	foreach($data["params"] as &$d) 	{
        // Definir las dos horas en formato "H:i"
        $hora_salida = explode(":",$d["rt_hsalida"]); 
        $hora_entrada = explode(":",$d["rt_hentrada"]);

        $hora_salida_2 = mktime($hora_salida[0],$hora_salida[1],0);
        $hora_entrada_2 = mktime($hora_entrada[0],$hora_entrada[1],0);

        $resta = $hora_salida_2 - $hora_entrada_2;
        $hora_final = date("H:i",$resta);
       
        $d["horas"] = $hora_final;

        $array_hora = explode(":",$hora_final);
        $segundos_totales = ($array_hora[0] * 3600 ) + ($array_hora[1] * 60 );
        $d["segundos"] = $segundos_totales;


    }
}





// PARAMETROS DE LAS VENTANAS DE VISUALIZACIÓN/EDICIÓN/ALTA
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'960', 'top'=>'10', 'left'=>'90');
$grid["add_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'960', 'top'=>'10', 'left'=>'90');
$grid["view_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'960', 'top'=>'10', 'left'=>'90');
$grid["add_options"]["modal"] = false;  // IMPORTANTE PARA QUE NO DE PROBLEMAS EL DATEPICKER EN ALTAS
$grid["edit_options"]["modal"] = false;  // IMPORTANTE PARA QUE NO DE PROBLEMAS EL DATEPICKER EN EDICIÓN
$g->set_options($grid);  // IMPORTANTE! : ACTIVA LAS OPCIONES DEL GRID.
$g->set_columns($cols);  // IMPORTANTE! : ACTIVA LAS OPCIONES DE LAS COLUMNAS.
$g->set_actions(array(
                        "add"=>true,
                        "edit"=>true,
                        "clone"=>false,
                        "bulkedit"=>false,
                        "delete"=>true,
                        "view"=>true,
                        "rowactions"=>false,
                        "export"=>true,
                        "import"=>false,
                        "autofilter" => false,
                        "search" => "simple",
                        "inlineadd" => false,
                        "showhidecolumns" => false
                    )
                );
               
// ************************************

// ESTABLECER LA TABLA PARA OPERACIONES CRUD
$g->table = "registro_trabajo";

// Generamos la salida del GRID, con un único nombre de GRID: 'list1'
$out_master = $g->render("list1");
$ruta ="ADMINISTRACIÓN / REGISTRO TRABAJOS";
// INCLUÍMOS EL FICHERO QUE SE ENCARGA DE MOSTRAR EL GRID.
include("../views/ver_grid_registro_trabajo.php");

