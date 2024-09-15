<?php
    session_start();
    include('../IMPORT/conex_emp.php');

    date_default_timezone_set("Europe/Madrid");

    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $obra = $_POST['obra']; // ID de la obra seleccionada
        $maquinaria = $_POST['maquinaria']; // ID de la maquinaria seleccionada
        $horaEntrada = $_POST['horaEntrada'];
        $horaSalida = $_POST['horaSalida'];
        $observaciones = !empty($_POST['observaciones']) ? $_POST['observaciones'] : null;
        $empleado = $_SESSION['usuario']['EM_ID']; // ID del empleado desde la sesión actual

        // Obtener la fecha actual y la hora del registro
        $fecha = date("Y-m-d");
        $horaRegistro = date("H:i:s");

        // Conexión a la base de datos
        $conex = connection();

        // SQL para insertar los datos en la tabla "registro_trabajo"
        $sqlInsert = "INSERT INTO registro_trabajo (RT_FECHA, RT_HENTRADA, RT_HSALIDA, RT_OBSERVACION, RT_EMPLEADO, RT_OBRA, RT_MAQUINARIA, RT_HREGISTRO)
                      VALUES (:fecha, :horaEntrada, :horaSalida, :observaciones, :empleado, :obra, :maquinaria, :horaRegistro)";

        try {
            // Preparar la consulta
            $stmt = $conex->prepare($sqlInsert);

            // Asociar los valores a los parámetros
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':horaEntrada', $horaEntrada);
            $stmt->bindParam(':horaSalida', $horaSalida);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->bindParam(':empleado', $empleado);
            $stmt->bindParam(':obra', $obra);
            $stmt->bindParam(':maquinaria', $maquinaria);
            $stmt->bindParam(':horaRegistro', $horaRegistro);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                header("Location: ../HTML/AltaTrabajo.php?status=success");
                exit();
            } else {
                header("Location: ../HTML/AltaTrabajo.php?status=error");
                exit();
            }

        } catch (PDOException $e) {
            header("Location: ../HTML/AltaTrabajo.php?status=error");
            exit();
        }
    } else {
        header("Location: ../HTML/AltaTrabajo.php?status=error");
        exit();
    }
?>
