<style>
table , td, th {
	border: 1px solid #595959;
	border-collapse: collapse;
}
td, th {
	padding: 3px;
	/*width: 30px;
	height: 25px; */
}

td { font-size: 8px; }

td.cabecera {
font-size: 10px;
font-weight:bold;
vertical-align: middle;
border: none;
}

td.cabeceraCenter {
background: #C0C0C0;
font-weight: bold;
text-align: center;
}

td.textoRecuadro {
	font-weight: bold;
	font-size: 10px;
	text-align: right;
}

td.pie { 	border: 0; }

.texto_cabecera {
	/* font-weight: bold; */

	font-size: 10px;
	text-align: left;
}

.texto_explicativo {
	font-size: 12px;
	font-weight: bold;
	text-align: justify;
}
.texto_normal {
	font-size: 12px;
	text-align: justify;
}


.footer_numeracion {
	display: block;
	font-size: 10px;
	text-align: right;
}

.footer_identificacion {
	display: block;
	font-size: 8px;
	text-align: center;
}

.footer_modelo {
	display: block;
	font-size: 10px;
	text-align: center;
}

th { 	background: #808080; }

ul {  list-style-type: none; }

</style>

<?php
require('../../../includes/conectaDB.php');

$trabajador = $_POST['trabajador'];
$fecha1 = date('Y-m-d',strtotime($_POST['fecha1']));
$fecha2 = date('Y-m-d',strtotime($_POST['fecha2']));
$fecha_actual = date("d-m-Y");

// QUERY TRABAJADOR
$query_trabajador = "SELECT tr_id,tr_nombre FROM trabajadores WHERE tr_id=$trabajador";
$resultado_trabajador = $conexion->query($query_trabajador);
$row_trabajador = $resultado_trabajador->FETCH_ASSOC();
$nombre = $row_trabajador['tr_nombre'];

// QUERY PRINCIPAL DE REGISTRO HORARIO
$query = "SELECT rt_id,rt_fecha,rt_hentrada,rt_hsalida,rt_observaciones,tr_nombre AS rt_trabajador,ob_denominacion AS rt_obra,ma_denominacion AS rt_maquinaria "
		."FROM registro_trabajo "
		."LEFT JOIN trabajadores ON trabajadores.tr_id = rt_trabajador "
		."LEFT JOIN obras ON obras.ob_id = rt_obra "
		."LEFT JOIN maquinaria ON maquinaria.ma_id = rt_maquinaria "
		."WHERE rt_trabajador = '$trabajador' AND rt_fecha between '$fecha1' AND '$fecha2' ";
$resultado = $conexion->query($query);
?>

<div class="texto_cabecera">
	<table>
		<tr>
			<td class="cabecera" style="width:250px;"><img src="../../../img/logo_principal.png" width="135" height="35" alt="logo" /></td>
			<td class="cabecera" style="width:300px;">REGISTRO HORARIO MENSUAL - TRABAJADOR</td>
		</tr>
	</table>
	<br>
	<br>
	<table>
		<tr>
			<td class="cabeceraCenter"style="width:120px;">TRABAJADOR</td>
			<td style="width:130px;"><?php echo $nombre; ?></td>
			<td class="cabeceraCenter" style="width:60px;">FECHA INICIO</td>
			<td style="width:50px;"><?php echo date('d-m-Y',strtotime($fecha1)); ?></td>
			<td class="cabeceraCenter" style="width:60px;">FCHA FIN</td>
			<td style="width:50px;"><?php echo date('d-m-Y',strtotime($fecha2)); ?></td>
			
		</tr>
	</table>
	<br>
	<br>
	<table>
		<tr>
			<td class="cabecera" style="width:300px;">REGISTRO POR DÍAS</td>
		</tr>
	</table>

</div>

<page_footer>
	<!-- <div class="footer"> -->
		<!-- <div class="footer_identificacion"> -->

		
			<table>
					<tr class="pie">
						<td class="pie" colspan="2" style="width=300px;"></td>
						<td class="pie" colspan="2" style="width=200px;">[[page_cu]]</td>
						<td class="pie" colspan="2" style="width=350px;">HUMERTO RIVAS CONSTRUCCIONES - <?php echo $fecha_actual; ?> </td>
					</tr>
			</table>
		<!--</div> -->
	<!-- </div> -->
	</page_footer>

	<?php
if ($resultado->num_rows == 0) {
	echo "Non hay ningún rexistro que cumpla esos filtros";
} else { ?>
	<table>
			<tr>
				<td class="cabeceraCenter" style="width:15px;">ID</td>
				<td class="cabeceraCenter" style="width:130px;">TRABAJADOR</td>
				<td class="cabeceraCenter" style="width:45px;">DÍA MES</td>
				<td class="cabeceraCenter" style="width:50px;">H.ENTRADA</td>
				<td class="cabeceraCenter" style="width:50px;">H.SALIDA</td>
				<td class="cabeceraCenter" style="width:55px;">HORAS REGISTRADAS</td>
				<td class="cabeceraCenter" style="width:150px;">OBRA</td>
				<td class="cabeceraCenter" style="width:120px;">MAQUINARIA</td> 
			</tr>
			<?php 
			$total_mes_segundos = 0;


			//*************************************
			
			while($row = $resultado->FETCH_ASSOC()) { 


				//$file = fopen("c:\OUT_PRINT.txt", "w");
				//fwrite($file, "Log en operaciones de VARIABLES" . PHP_EOL);
				//fwrite($file, "QUERY.-".$query . PHP_EOL);
				//fwrite($file, "HORA ENTRADA.-".$row['rt_hentrada'] . PHP_EOL);
				//fwrite($file, "HORA SALIDA.-".$row['rt_hsalida'] . PHP_EOL);
				//fclose($file);
				

				// Definir las dos horas en formato "H:i"
       				$hora_salida = explode(":",$row["rt_hsalida"]); 
       				$hora_entrada = explode(":",$row["rt_hentrada"]);

        			$hora_salida_2 = mktime($hora_salida[0],$hora_salida[1],0);
        			$hora_entrada_2 = mktime($hora_entrada[0],$hora_entrada[1],0);

       				$resta = $hora_salida_2 - $hora_entrada_2;
        			$hora_final = date("H:i",$resta);

					$array_hora = explode(":",$hora_final);
        			$segundos_totales = ($array_hora[0] * 3600 ) + ($array_hora[1] * 60 );
					$total_mes_segundos = $total_mes_segundos + $segundos_totales;
					$horas_totales_mes = gmdate("H:i:s", $total_mes_segundos);
				?>
				<tr>
					<td style="width:15px;"><?php echo $row['rt_id']; ?></td>
					<td style="width:130px;"><?php echo $row['rt_trabajador']; ?></td>
					<td style="width:45px;"><?php echo date('d-m-Y',strtotime($row['rt_fecha'])); ?></td>
					<?php

					if($row["rt_hentrada"] == false){
						echo "0:00";
					} else {
						echo "<td style='width:50px;'>".$row['rt_hentrada']."</td>";
						//echo "<td style='width=75px;'>".$hora_entrada."</td>";
					}

					if($row["rt_hsalida"]== false){
						echo "0:00";
					} else {
						echo "<td style='width:50px;'>".$row['rt_hsalida']."</td>";
						//echo "<td style='width=75px;'>".$hora_salida."</td>";
					}
					?>
					<td style="width:55px;"><?php echo $hora_final; ?></td>
					<td style="width:150px;"><?php echo $row['rt_obra']; ?></td>
					<td style="width:120px;"><?php echo $row['rt_maquinaria']; ?></td>

				</tr>
			<?php } ?>

		<!-- ************************************* -->
		</table>
		<br>
		<br>
		<table>
			<tr>
				<td class="cabeceraCenter" style="width=120px;">TOTAL HORAS:</td>
				<td class="textoRecuadro" style="width=100px;"><?php echo $horas_totales_mes; ?></td>
			</tr>
			<tr>
				<td class="cabeceraCenter" style="width=120px;">FECHA DOCUMENTO:</td>
				<td class="textoRecuadro" style="width=100px;"><?php echo $fecha_actual; ?></td>
			</tr>
			
			<!--<tr>
				<td class="cabeceraCenter" style="width=120px;">FIRMA TRABAJADOR</td>
				<td style="text-align ='left'; width=100px;"><br><br><br><br><br></td>
			</tr> -->

		</table>



<?php } ?>

