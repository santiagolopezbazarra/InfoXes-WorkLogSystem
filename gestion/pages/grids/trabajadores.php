<?php
/**
 * XESTION DE HUMBERTO RIVAS CONSTRUCCIONES
 *
 * @author J. López Domínguez
 * @version 1.0 - 2024-2025
 */

// Mínimo control de acceso.
require('../../includes/include-pagina-restringida.php'); 

// GRID DE TRABAJADORES
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

// QUERY PRINCIPAL: trabajadores
$g->select_command = "SELECT tr_id,tr_nombre,tr_codigo,es_denominacion AS tr_estado,tr_borrado "
    ."FROM trabajadores "
    ."LEFT JOIN estados ON tr_estado = es_id "
    ."WHERE tr_borrado = 0";
			

// Definición de columnas ************************************

// ID DEL  REGISTRO
$col = array();
$col["title"] = 'ID';
$col["name"] = 'tr_id';
$col["dbname"] = 'tr_id';
$col["width"] = '25';
$col["editable"] = false;
$cols[] = $col;

// DENOMINACION
$col = array();
$col["title"] = 'NOMBRE';
$col["name"] = 'tr_nombre';
$col["dbname"] = 'tr_nombre';
$col["width"] = '130';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$cols[] = $col;

// CODIGO DE ACCESO
$col = array();
$col["title"] = 'CODIGO ACCESO';
$col["name"] = 'tr_codigo';
$col["dbname"] = 'tr_codigo';
$col["width"] = '50';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$cols[] = $col;

// ESTADO DEL TRABAJADOR
$col = array();
$col["title"] = 'ESTADO DEL TRABAJADOR';
$col["name"] = 'tr_estado';
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
$grid["caption"] = "GESTIÓN DE TRABAJADORES";
$grid["multiselect"] = false;
$grid["height"] = "400";
$grid["autowidth"] = true;
$grid["rowNum"] = 50;
$grid["pastefromexcel"] = false;
$grid["cellEdit"] = false;
$grid["toolbar"] = "bottom";
$grid["sortname"] ="tr_nombre";
$grid["sortorder"] ="asc";

// PARÁMETROS DEL LADO DEL SERVIDOR
$e["on_delete"] = array("borra_trabajador", null, false);  // FUNCIONES AL FINAL DE LA PÁGINA.
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
$g->table = "trabajadores";

// Generamos la salida del GRID, con un único nombre de GRID: 'list1'
$out_master = $g->render("list1");
$ruta ="ADMINISTRACIÓN / TRABAJADORES";
// INCLUÍMOS EL FICHERO QUE SE ENCARGA DE MOSTRAR EL GRID.
include("../views/ver_grid.php");


// FUNCIONES DEL LADO DEL SERVIDOR
// CONTROL DE BORRADO DE MAQUINARIA
function borra_trabajador($data){
    include_once('../../includes/conectaDB.php');
    $in_it = $data["tr_id"];
    $update = "UPDATE trabajadores SET tr_borrado = 1,tr_estado = 2 WHERE tr_id = $in_it";
    $resultado = mysqli_query($conexion,$update) or die("FALLO en la operación de recuperacion:$update");
    $row = mysqli_fetch_assoc($resultado);
  }

?>
