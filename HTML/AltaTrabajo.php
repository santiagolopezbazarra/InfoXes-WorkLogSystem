<?php
    session_start();
    include('../IMPORT/conex_emp.php');

    if (!isset($_SESSION['usuario'])) {
        // Redirigir a la página de inicio de sesión si no hay una sesión activa
        header("Location: InicioSesion.php");
        exit();
    }
        
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

    <!-- Formulario para el registro de datos -->
    <form action="../IMPORT/procesar_registro.php" method="POST">
        <select name="obra" id="obras" required>
            <option value="" disabled selected>Selecciona una obra</option>
            <?php
            foreach($obras as $obra) {
                echo "<option value='" . htmlspecialchars($obra['OB_ID']) . "'>" . htmlspecialchars($obra['OB_NOMBRE']) . "</option>";
            }
            ?>
        </select>

        <input type="time" name="horaEntrada" id="horaEntrada" required>
        <input type="time" name="horaSalida" id="horaSalida" required>

        <select name="maquinaria" id="maquinas" required>
            <option value="" disabled selected>Selecciona una maquina</option>
            <?php
            foreach($maquinarias as $maquinaria) {
                echo "<option value='" . htmlspecialchars($maquinaria['MA_ID']) . "'>" . htmlspecialchars($maquinaria['MA_NOMBRE']) . "</option>";
            }
            ?>
        </select>

        <button class="observaciones">OBSERVACIONES</button>
        <button type="submit" class="enviar">ENVIAR</button>

        <!-- Estructura del modal -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>OBSERVACIONES</h2>
                <textarea id="observacionesText" rows="5" placeholder="Escribe tus observaciones aquí..."></textarea>
                <button id="guardarObservaciones">Guardar</button>
            </div>
        </div>
    </form>

    <script src="../JS/AltaTrabajo.js"></script>
</body>
</html>