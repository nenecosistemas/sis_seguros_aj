<?php
class UsuarioModel
{
    private $conexion;
    public function __construct()
    {
        include_once("../controller/conexion.php");

        try {
            $conectar = new Conexion();
            $this->conexion = $conectar->Conectar();
            
        } catch(Exception $e) {
            die($e->getMessage()); 
        }      
    }
    
    public function esUsuarioHabilitado(string $correo, string $clave)
    {
        if ($correo == "andrea@andrea.com" and $clave == "valentina") {
            return true;
        } else {
            return false;
        }
    }

}