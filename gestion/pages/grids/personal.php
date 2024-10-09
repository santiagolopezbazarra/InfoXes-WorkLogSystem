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
$g->select_command = "SELECT pe_id,pe_login,pe_password,pn_denominacion as pe_nivel,pe_nombre,pe_email "
			."FROM personal "
			."LEFT JOIN personal_niveles ON pe_nivel = pn_nivel";

// Definición de columnas ************************************

// ID DEL  REGISTRO
$col = array();
$col["title"] = 'ID';
$col["name"] = 'pe_id';
$col["dbname"] = 'pe_id';
$col["width"] = '25';
$col["editable"] = false;
$cols[] = $col;

// LOGIN
$col = array();
$col["title"] = 'LOGIN';
$col["name"] = 'pe_login';
$col["dbname"] = 'pe_login';
$col["width"] = '60';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>30);
$cols[] = $col;

// PASSWORD
$col = array();
$col["title"] = 'CONTRASEÑA';
$col["name"] = 'pe_password';
$col["dbname"] = 'pe_password';
$col["width"] = '50';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>10);
$cols[] = $col;

// NIVEL DE ACCESO
$col = array();
$col["title"] = 'NIVEL';
$col["name"] = 'pe_nivel';
$col["dbname"] = 'personal_niveles.pn_denominacion';
$col["width"] = '80';
if ($nivel <= 1) {
	$col["editable"] = true;
} else {
	$col["editable"] = false;
}
$col["edittype"] = "select";
$str = $g->get_dropdown_values("select distinct pn_nivel as k, pn_denominacion as v from personal_niveles ORDER BY pn_id");
$col["editoptions"] = array("value"=>$str, "defaultValue"=>'4');
$col["editrules"] = array("required"=>false);
$col["sortable"] = false;
$cols[] = $col;

// NOMBRE
$col = array();
$col["title"] = 'NOMBRE';
$col["name"] = 'pe_nombre';
$col["dbname"] = 'pe_nombre';
$col["width"] = '130';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$cols[] = $col;

// EMAIL
$col = array();
$col["title"] = 'EMAIL';
$col["name"] = 'pe_email';
$col["dbname"] = 'pe_email';
$col["width"] = '125';
$col["editable"] = true;
$col["editrules"] = array("required"=>true);
$col["editoptions"] = array("size"=>50);
$cols[] = $col;




// ******************************************************************************
// PARÁMETROS DEL GRID
$grid["caption"] = "GESTIÓN DE PERSONAL";
$grid["multiselect"] = false;
$grid["height"] = "400";
$grid["autowidth"] = true;
$grid["rowNum"] = 50;
$grid["pastefromexcel"] = false;
$grid["cellEdit"] = false;
$grid["toolbar"] = "bottom";
//$grid["detail_grid_id"] = "list2,list3";


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
$g->table = "personal";

// Generamos la salida del GRID, con un único nombre de GRID: 'list1'
$out_master = $g->render("list1");
$ruta ="ADMINISTRACIÓN / PERSONAL";
// INCLUÍMOS EL FICHERO QUE SE ENCARGA DE MOSTRAR EL GRID.
include("../views/ver_grid.php");
?>
