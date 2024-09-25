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

        if (!validar_fichaje($horaEntrada, $horaSalida)) {
            header("Location: ../HTML/AltaTrabajo.php?status=error");
            exit();    
        }

        $validacion = validar_nuevo_fichaje($empleado, $horaEntrada, $horaSalida, $fecha);

        if($validacion === "CORRECTO") {
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
                    echo "Registro guardado correctamente.";
                    // Aquí puedes redirigir al usuario a una página de confirmación si es necesario.
                    header("Location: ../HTML/AltaTrabajo.php?status=success");
                    exit();
                } else {
                    echo "Error al guardar el registro.";
                    header("Location: ../HTML/AltaTrabajo.php?status=error");
                    exit();
                }
    
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                header("Location: ../HTML/AltaTrabajo.php?status=error");
                exit();
            }
        } else {
            header("Location: ../HTML/AltaTrabajo.php?status=error");
            exit();    
        }

    } else {
        echo "Método de solicitud no válido.";
        header("Location: ../HTML/AltaTrabajo.php?status=error");
        exit();
    }

    function validar_fichaje($entrada, $salida){
        $hora_entrada = new DateTime($entrada);
        $hora_salida = new DateTime($salida);

        if($hora_entrada >= $hora_salida) {
            return false;
        }

        return true;
    }

    function fichaje_dentro_de_otro($entrada_1, $salida_1, $entrada_2, $salida_2) {
        $hora_entrada_1 = new DateTime($entrada_1);
        $hora_salida_1 = new DateTime($salida_1);
        $hora_entrada_2 = new DateTime($entrada_2);
        $hora_salida_2 = new DateTime($salida_2);

        if ($hora_entrada_2 >= $hora_entrada_1 && $hora_salida_2 <= $hora_salida_1) {
            return true; //Error, el segundo está dentro del primero
        }

        if ($hora_entrada_1 >= $hora_entrada_2 && $hora_salida_1 <= $hora_salida_2) {
            return true; //Error, el primero está dentro del segundo
        }

        return false; //No hay solapamiento completo
    }

    function fichajes_se_solapan($entrada_1, $salida_1, $entrada_2, $salida_2) {
        $hora_entrada_1 = new DateTime($entrada_1);
        $hora_salida_1 = new DateTime($salida_1);
        $hora_entrada_2 = new DateTime($entrada_2);
        $hora_salida_2 = new DateTime($salida_2);
        
        // Verificar si hay algún solapamiento entre los dos fichajes
        if ($hora_entrada_2 < $hora_salida_1 && $hora_entrada_2 >= $hora_entrada_1) {
            return true; // Error, solapamiento parcial entre fichajes
        }
        
        if ($hora_entrada_1 < $hora_salida_2 && $hora_entrada_1 >= $hora_entrada_2) {
            return true; // Error, solapamiento parcial entre fichajes
        }
        
        return false; // No hay solapamiento parcial
    }

    function obtener_fichajes_del_dia($empleado, $fecha) {
        $conex = connection();
        $sql = "SELECT RT_HENTRADA, RT_HSALIDA FROM registro_trabajo WHERE RT_EMPLEADO = :empleado AND RT_FECHA = :fecha ORDER BY RT_HENTRADA ASC;";

        $stmt = $conex->prepare($sql);
        $stmt->bindParam(':empleado', $empleado);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function validar_nuevo_fichaje($empleado, $horaEntrada, $horaSalida, $fecha) {
        $fichajes = obtener_fichajes_del_dia($empleado, $fecha);

        foreach($fichajes as $fichaje) {
            $entrada_existente = $fichaje['RT_HENTRADA'];
            $salida_existente = $fichaje['RT_HSALIDA'];

            if (fichaje_dentro_de_otro($entrada_existente, $salida_existente, $horaEntrada, $horaSalida)) {
                return "ERROR";
            }

            if (fichajes_se_solapan($entrada_existente, $salida_existente, $horaEntrada, $horaSalida)) {
                return "ERROR";
            }
        }

        return "CORRECTO";
    }
?>
