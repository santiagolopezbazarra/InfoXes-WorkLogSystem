<?php
/**
 * XESTION DE GENEPOL
 *
 * @author J. López Domínguez
 * @version 2.0 - 2021-2022
 */

// Mínimo control de acceso ¡¡¡¡¡¡ EN PRUEBAS !!!!!
require('../../includes/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php

// GRID DE UBICACIONES
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

// QUERY PRINCIPAL: PERSONAL

$g->select_command = "SELECT ch_id,pe_nombre AS ch_persona,ch_dia,ch_hora_entrada,ch_hora_salida,tj_denominacion AS ch_tipo_jornada, tr_denominacion AS ch_registro,ch_incidencia "
                    ."FROM control_horario "
                    ."LEFT JOIN personal ON ch_persona = pe_id "
                    ."LEFT JOIN tipo_jornada ON ch_tipo_jornada = tj_id "
                    ."LEFT JOIN tipo_registro_horario ON ch_registro = tr_id";

// Definición de columnas ************************************

// ID DEL  REGISTRO
$col = array();
$col["title"] = 'ID';
$col["name"] = 'ch_id';
$col["dbname"] = 'ch_id';
$col["width"] = '25';
$col["editable"] = false;
$cols[] = $col;

// NOMBRE DEL TRABAJADOR
$col = array();
$col["title"] = 'PERSONA';
$col["name"] = 'ch_persona';
$col["dbname"] = 'personal.pe_nombre';
$col["width"] = '100';
if ($nivel <= 1) {
	$col["editable"] = true;
} else {
	$col["editable"] = false;
}
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct pe_id as k, pe_nombre as v from personal ORDER BY pe_nombre");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'4');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;

// DIA
$col = array();
$col["title"] = 'DIA';
$col["name"] = 'ch_dia';
$col["dbname"] = 'ch_dia';
$col["width"] = '100';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$col["formatter"] = "date";
$col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d-m-Y');
$col["datefmt"] = "d-m-Y";
$cols[] = $col;

// HORA ENTRADA
$col = array();
$col["title"] = 'ENTRADA';
$col["name"] = 'ch_hora_entrada';
$col["dbname"] = 'ch_hora_entrada';
$col["width"] = '100';
$col["editable"] = true;
$col["formatter"] = "datetime";
$col["formatoptions"] = array("srcformat"=>'H:i:s',"newformat"=>'H:i:s');
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$cols[] = $col;

// HORA SALIDA
$col = array();
$col["title"] = 'SALIDA';
$col["name"] = 'ch_hora_salida';
$col["dbname"] = 'ch_hora_salida';
$col["width"] = '100';
$col["editable"] = true;
$col["formatter"] = "datetime";
$col["formatoptions"] = array("srcformat"=>'H:i:s',"newformat"=>'H:i:s');
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$cols[] = $col;


$col = array();
$col["title"] = "SUMA HORAS";
$col["name"] = "horas";
$col["width"] = "50";
$col["search"] = true;
$col["editable"] = false;
//$col["formatter"] = "number";
//$col["formatoptions"] = array("thousandsSeparator" => " ",
//"decimalSeparator" => ",",
//"decimalPlaces" => 2);
$cols[] = $col;


$col = array();
$col["title"] = "SUMA SEGUNDOS";
$col["name"] = "segundos";
$col["width"] = "100";
$col["search"] = true;
$col["editable"] = false;
//$col["formatter"] = "number";
//$col["formatoptions"] = array("thousandsSeparator" => " ",
//"decimalSeparator" => ",",
//"decimalPlaces" => 2);
$cols[] = $col;


// TIPO JORNADA
$col = array();
$col["title"] = 'JORNADA';
$col["name"] = 'ch_tipo_jornada';
$col["dbname"] = 'tipo_jornada.tj_denominacion';
$col["width"] = '100';
if ($nivel <= 1) {
	$col["editable"] = true;
} else {
	$col["editable"] = false;
}
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct tj_id as k, tj_denominacion as v from tipo_jornada ORDER BY tj_denominacion");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'4');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;

// REGISTRO
$col = array();
$col["title"] = 'ÚLTIMO REGISTRO';
$col["name"] = 'ch_registro';
$col["dbname"] = 'tipo_registro_horario.tr_denominacion';
$col["width"] = '100';
if ($nivel <= 1) {
	$col["editable"] = true;
} else {
	$col["editable"] = false;
}
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct tr_id as k, tr_denominacion as v from tipo_registro_horario ORDER BY tr_denominacion");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'4');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;

// INCIDENCIA
$col = array();
$col["title"] = 'INCIDENCIA';
$col["name"] = 'ch_incidencia';
$col["width"] = '200';
$col["editoptions"] = array("size"=>50, "value"=>$str, "maxlenght"=>300);
$col["editable"] = true;
$col["editrules"] = array("required"=>false);
if ($nivel > 2) { // ENCARGADOS
		$col["editrules"]["readonly"] = true;
}
$cols[] = $col;


// ******************************************************************************
// PARÁMETROS DEL GRID
$grid["caption"] = "CONTROL / REXISTRO HORARIO";
$grid["multiselect"] = false;
$grid["height"] = "550";
$grid["autowidth"] = true;
$grid["rowNum"] = 50;
$grid["pastefromexcel"] = false;
$grid["cellEdit"] = false;
$grid["toolbar"] = "bottom";
$grid["sortname"] = "ch_id";
$grid["sortorder"] = "DESC";
$grid["footerrow"] = true;
$grid["reloadedit"] = true;


// PARAMETROS DE LAS VENTANAS DE VISUALIZACIÓN/EDICIÓN/ALTA
$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'960', 'top'=>'10', 'left'=>'90');
$grid["add_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'960', 'top'=>'10', 'left'=>'90');
$grid["view_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, 'width'=>'960', 'top'=>'10', 'left'=>'90');
$grid["add_options"]["modal"] = false;  // IMPORTANTE PARA QUE NO DE PROBLEMAS EL DATEPICKER EN ALTAS
$grid["edit_options"]["modal"] = false;  // IMPORTANTE PARA QUE NO DE PROBLEMAS EL DATEPICKER EN EDICIÓN


// AGRUPACIÓN
$grid["grouping"] = true;
$grid["groupingView"] = array();
$grid["groupingView"]["groupField"] = array("ch_dia"); // COLUMNA POR LA QUE SE AGRUPA
$grid["groupingView"]["groupColumnShow"] = array(true); 
$grid["groupingView"]["groupText"] = array("<b>{0} - {1} Registros(s)</b>"); // {0} Valor del campo, {1} Contador
$grid["groupingView"]["groupOrder"] = array("desc"); 
$grid["groupingView"]["groupDataSorted"] = array(true); 
$grid["groupingView"]["groupSummary"] = array(true); // work with summaryType, summaryTpl, see column: $col["name"] = "total"; (if false, set showSummaryOnHide to false)
$grid["groupingView"]["groupCollapse"] = false; 
$grid["groupingView"]["showSummaryOnHide"] = true; // show summary row even if group collapsed (hide) 


$g->set_options($grid);  // IMPORTANTE! : ACTIVA LAS OPCIONES DEL GRID.
$g->set_columns($cols);  // IMPORTANTE! : ACTIVA LAS OPCIONES DE LAS COLUMNAS.

$e["on_data_display"] = array("filter_display", null, true);
$e["js_on_load_complete"] = "grid_onload";
$g->set_events($e);


function filter_display($data) {
	foreach($data["params"] as &$d) 	{
        // Definir las dos horas en formato "H:i"
        $hora_salida = explode(":",$d["ch_hora_salida"]); 
        $hora_entrada = explode(":",$d["ch_hora_entrada"]);

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



// FORMATO CONDICIONAL COLUMNA ESTADO = PENDIENTE
$f = array();
$f["column"] = "ch_registro";
$f["target"] = "ch_registro";
$f["op"] = "=";
$f["value"] = "Entrada";
$f["cellclass"] = "focus-cell_green_1";
$f_conditions[] = $f;

// FORMATO CONDICIONAL COLUMNA ESTADO = NO CONFIRMADO
$f = array();
$f["column"] = "ch_registro";
$f["target"] = "ch_registro";
$f["op"] = "=";
$f["value"] = "salida";
$f["cellclass"] = "focus-cell_orange";
$f_conditions[] = $f;

$g->set_conditional_css($f_conditions);

$g->set_actions(array(
                        "add"=>true,
                        "edit"=>true,
                        "clone"=>false,
                        "bulkedit"=>false,
                        "delete"=>false,
                        "view"=>true,
                        "rowactions"=>false,
                        "export"=>false,
                        "import"=>false,
                        "autofilter" => true,
                        "search" => "simple",
                        "inlineadd" => false,
                        "showhidecolumns" => false
                    )
                );
// ************************************

// ESTABLECER LA TABLA PARA OPERACIONES CRUD
$g->table = "control_horario";

// Generamos la salida del GRID, con un único nombre de GRID: 'list1'
$out_master = $g->render("list");
$ruta ="ADMINISTRACIÓN / PERSONAL / CONTROL DE PRESENCIA";
// INCLUÍMOS EL FICHERO QUE SE ENCARGA DE MOSTRAR EL GRID.
include("../views/ver_grid_control_presencia_admin.php");
//include("../views/ver_grid.php");
?>
