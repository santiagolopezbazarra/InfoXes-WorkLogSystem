<?php
    function connection(){
        $host = "localhost";
        $user = "root";
        $pass = "11051966";
        $db = "infoxes-gestion";
        // CONEXIÓN CON MYSQLI
        $connect = mysqli_connect($host, $user, $pass, $db);
        mysqli_select_db($connect, $db);
        // CONEXIÓN CON PDO



        return $connect; 
    }



?>