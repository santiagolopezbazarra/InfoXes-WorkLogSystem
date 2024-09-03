<?php
    session_start();

    include('../IMPORT/conex_emp.php');
    
    $conex = connection();

    //CHECK DE LA CONEXION
    if(mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $sql = "SELECT * FROM empleado";
    $query_row = mysqli_query($conex, $sql);

    if(isset($_POST['Contrasena'])){
        if(strlen($_POST['Contrasena']) >= 1){
            $password = trim($_POST['Contrasena']);
            $sql_pass = "SELECT * FROM empleado WHERE ID_EMP = $password";
            $result = mysqli_query($conex, $sql_pass);

            if($result->num_rows > 0){
                $user_data = mysqli_fetch_assoc($result);

                if(password_verify($password, $user_data['ID_EMP'])){
                    session_start();
                    header("Location: AltaTrabajo.php");
                    exit();
                }
            }
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
    <div id="log_Container" class="log_Container">
        <form action="AltaTrabajo.html">
            <div class="contrasena">
                <input spellcheck="false" class="control" id="password" type="password" placeholder="Código de Usuario" name="Contrasena">
                <button class="toggle" type="button" onclick="togglePassword(this)"></button>
            </div>
            <button type="submit">ENTRAR</button>
        </form>
    </div>
</body>
</html>