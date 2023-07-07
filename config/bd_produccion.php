<?php

$host = "localhost";
$bd = "id20981420_segurosaj";
$usuario = "id20981420_root";
$contrasenia = "Ed2506do.";

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