<?php
    session_start();

    include('../IMPORT/conex_emp.php');
    
    $conex = connection();

   

    if (isset($_POST['Contrasena']) && !empty($_POST['Contrasena'])) {
        $codigo = trim($_POST['Contrasena']);
        
        // Preparar la consulta usando una consulta preparada de PDO
        $stmt = $conex->prepare('SELECT * FROM trabajadores WHERE tr_codigo = :codigo');
        
        // Enlazar el parámetro de la consulta para evitar inyección SQL
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $user = $stmt->fetch();

        if ($user) {
            // Usuario encontrado, iniciar sesión y redirigir
            $_SESSION['usuario'] = $user;
            echo "<pre>";
            print_r($_SESSION['usuario']);
            echo "</pre>";
            // Después de depurar, puedes redirigir
            header("Location: AltaTrabajo.php");
            exit();
        } else {
            // Usuario no encontrado, mostrar mensaje de error
            echo "<p>Código incorrecto</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFOXES</title>
    <link rel="stylesheet" href="../CSS/InicioSesion.css">
    <script type="text/javascript" src="../JS/main.js"></script>
</head>
<body>
    <img class="logo" src="../IMG/Humberto_logo.png" alt="Logo de la empresa">
    <div id="log_Container" class="log_Container">
        <form method="post">
            <div class="contrasena">
                <input spellcheck="false" class="control" id="password" type="password" placeholder="Código de Usuario" name="Contrasena">
                <button class="toggle" type="button" onclick="togglePassword(this)"></button>
            </div>
            <button type="submit">ENTRAR</button>
        </form>
    </div>
</body>
</html>