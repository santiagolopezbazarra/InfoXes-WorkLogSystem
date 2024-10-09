<?php
// always load alternative config file for examples
require_once('../../../vendors/tcpdf/autoload.php');
use Spipu\Html2Pdf\Html2Pdf;


//Recoger el contenido del Html
ob_start();
require_once 'pr_listado_trabajador_mes.php';
$html = ob_get_clean();

$html2pdf = new Html2Pdf('P','A4','es','true','UTF-8',array(10, 10, 10, 15));
$html2pdf->setDefaultFont('dejavusans');

$html2pdf->writeHTML($html);
$html2pdf->output('listado_trabajador.pdf');
ob_end_clean();

 ?>
