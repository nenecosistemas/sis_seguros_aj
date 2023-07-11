<?php
class Conexion
{
    private $host;
    private $usuario;
    private $clave;
    private $bd;

    private $conexion;

    function __construct()
    {
        $host = "localhost";
        $bd = "segurosaj";
        $usuario = "root";
        $contrasenia = "1308";

        $this->host = $host;
        $this->usuario = $usuario;
        $this->clave = $contrasenia;
        $this->bd = $bd;
    }
    public function Conectar(): PDO  
     {
        try {
            $this->conexion = new PDO("mysql:host=$this->host;
            dbname=$this->bd", $this->usuario, $this->clave);
            return $this->conexion;
        } catch (PDOException $ex) {            
            session_start();
            $_SESSION["msj_error"] = "Error de conexion con la Base de Datos";
            session_destroy();
            session_unset();
            die($ex->getMessage());
        }
        
    }
}