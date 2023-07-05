<?php

$host = "localhost";
$bd = "segurosaj";
$usuario = "root";
$contrasenia = "1308";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    if ($conexion) {
        //echo "conectado a la base de datos......";
    }
} catch (PDOException $ex) {    
    echo $ex->getMessage();
    session_start();
    $_SESSION["msj_error"] = "Error de conexion con la Base de Datos";
}
?>