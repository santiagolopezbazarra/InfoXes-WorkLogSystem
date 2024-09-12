<?php
    include('../IMPORT/conex_emp.php');
        
    $conex = connection();
    
    $sqlObra = "SELECT * FROM obra WHERE OB_ACTIVA = 1";
    $sqlMaquinaria = "SELECT * FROM maquinaria WHERE MA_ACTIVA = 1";

    try {
        //ejecución sql sobre tabla obra
        $stmtObra = $conex->query($sqlObra);
        $obras = $stmtObra->fetchAll(PDO::FETCH_ASSOC);

        //ejecución sql sobre tabla maquinaria        
        $stmtMaquinaria = $conex->query($sqlMaquinaria);
        $maquinarias = $stmtMaquinaria->fetchAll((PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/AltaTrabajo.css">
    <title>INFOXES</title>
</head>
<body onload="cargarDia()">
    <h1 id="elementoFecha"></h1>
    <select name="obras" id="obras">
        <option value="" disabled selected>Selecciona una obra</option>
        <?php
        // Recorremos el array $obras
        foreach($obras as $obra) {
            // Para cada obra, generamos una opción con el nombre visible entre las etiquetas option
            echo "<option value='" . htmlspecialchars($obra['OB_NOMBRE']) . "'>" . htmlspecialchars($obra['OB_NOMBRE']) . "</option>";
        }
        ?>
    </select>
    <input type="time" name="horaEntrada" id="horaEntrada">
    <input type="time" name="horaSalida" id="horaSalida">
    <select name="maquinas" id="maquinas">
        <option value="" disabled selected>Selecciona una maquina</option>
        <?php
        // Recorremos el array $obras
        foreach($maquinarias as $maquinaria) {
            // Para cada obra, generamos una opción con el nombre visible entre las etiquetas option
            echo "<option value='" . htmlspecialchars($maquinaria['MA_NOMBRE']) . "'>" . htmlspecialchars($maquinaria['MA_NOMBRE']) . "</option>";
        }
        ?>
    </select>
    <button class="observaciones">OBSERVACIONES</button>
    <button class="enviar">ENVIAR</button>

    <!-- Estructura del modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>OBSERVACIONES</h2>
            <textarea id="observacionesText" rows="5" placeholder="Escribe tus observaciones aquí..."></textarea>
            <button id="guardarObservaciones">Guardar</button>
        </div>
    </div>

    <script src="../JS/AltaTrabajo.js"></script>
</body>
</html>