<?php
    include('../IMPORT/conex_emp.php');
        
    $conex = connection();
    
    $sql = "SELECT * FROM obra";

    try {
        $stmt = $conex->query($sql);
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <?php
          // Recorre el array $empresas obtenido desde la base de datos
          foreach($empresas as $empresa) {
            // Para cada empresa, crea una opción con el nombre de la razón social
            echo "<option value='".$empresa['OB_NOMBRE']."'>";
          }
        ?>
    </select>
    <input type="time" name="horaEntrada" id="horaEntrada">
    <input type="time" name="horaSalida" id="horaSalida">
    <select name="maquinas" id="maquinas">
        <option value="MQ-01">maquina 1</option>
        <option value="MQ-02">maquina 2</option>
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

<option value="OB-01">obra 1</option>
<option value="OB-02">obra 2</option>