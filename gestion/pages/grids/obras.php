<?php
/**
 * XESTION DE HUMBERTO RIVAS CONSTRUCCIONES
 *
 * @author J. López Domínguez
 * @version 1.0 - 2024-2025
 */

// Mínimo control de acceso.
require('../../includes/include-pagina-restringida.php');

// GRID DE OBRAS
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

// QUERY PRINCIPAL: OBRAS
$g->select_command = "SELECT ob_id,ob_denominacion,es_denominacion as ob_estado,ob_borrado "
    ."FROM obras "
    ."LEFT JOIN estados ON ob_estado = es_id "
    ."WHERE ob_borrado = 0";
			

// Definición de columnas ************************************

// ID DEL  REGISTRO
$col = array();
$col["title"] = 'ID';
$col["name"] = 'ob_id';
$col["dbname"] = 'ob_id';
$col["width"] = '25';
$col["editable"] = false;
$cols[] = $col;

// DENOMINACION
$col = array();
$col["title"] = 'DENOMINACION';
$col["name"] = 'ob_denominacion';
$col["dbname"] = 'ob_denominacion';
$col["width"] = '130';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$cols[] = $col;

// ESTADO DE LA OBRA
$col = array();
$col["title"] = 'ESTADO DE LA OBRA';
$col["name"] = 'ob_estado';
$col["dbname"] = 'estados.es_denominacion';
$col["width"] = '80';
$col["editable"] = true;
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct es_id as k, es_denominacion as v from estados ORDER BY es_denominacion");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'1');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;


// ******************************************************************************
// PARÁMETROS DEL GRID
$grid["caption"] = "GESTIÓN DE OBRAS";
$grid["multiselect"] = false;
$grid["height"] = "400";
$grid["autowidth"] = true;
$grid["rowNum"] = 50;
$grid["pastefromexcel"] = false;
$grid["cellEdit"] = false;
$grid["toolbar"] = "bottom";
$grid["sortname"] ="ob_denominacion";
$grid["sortorder"] ="asc";

// PARÁMETROS DEL LADO DEL SERVIDOR
$e["on_delete"] = array("borra_obra", null, false);  // FUNCIONES AL FINAL DE LA PÁGINA.
$g->set_events($e);

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
                        "export"=>false,
                        "import"=>false,
                        "autofilter" => false,
                        "search" => "simple",
                        "inlineadd" => false,
                        "showhidecolumns" => false
                    )
                );
// ************************************

// ESTABLECER LA TABLA PARA OPERACIONES CRUD
$g->table = "obras";

// Generamos la salida del GRID, con un único nombre de GRID: 'list1'
$out_master = $g->render("list1");
$ruta ="ADMINISTRACIÓN / OBRAS";
// INCLUÍMOS EL FICHERO QUE SE ENCARGA DE MOSTRAR EL GRID.
include("../views/ver_grid.php");



// FUNCIONES DEL LADO DEL SERVIDOR
// CONTROL DE BORRADO DE OBRAS
function borra_obra($data){
    include_once('../../includes/conectaDB.php');
    $in_it = $data["ob_id"];
    $update = "UPDATE obras SET ob_borrado = 1,ob_estado = 2 WHERE ob_id = $in_it";
    $resultado = mysqli_query($conexion,$update) or die("FALLO en la operación de recuperacion:$update");
    $row = mysqli_fetch_assoc($resultado);
  }

?>
