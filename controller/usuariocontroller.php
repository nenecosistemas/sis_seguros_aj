<?php
class UsuarioModel
{    private $conexion;
    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }

    public function __construct()
    {
        include_once("../controller/conexion.php");        
        
        try {
            $conectar = new Conexion();
            $this->conexion = $conectar->Conectar();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function Agregar(Usuario $usuario)
    {       
        try {
            
            $usuario = $usuario->__GET('usuario');
            $nombre = $usuario->__GET('nombrereal');
            $correo = $usuario->__GET('correo');
            $clave = $usuario->__GET('clave');

          
            $sentenciaSQL = $this->__GET('conexion')->prepare("INSERT INTO aj_usuario
                (usuario, nombrereal, correo, clave) 
                values 
                (:usuario, :nombrereal, :correo, aes_encrypt(:clave,'nenecosistemas13'));");

            $sentenciaSQL->bindParam(':usuario', $usuario);
            $sentenciaSQL->bindParam(':nombre', $nombre);
            $sentenciaSQL->bindParam(':correo', $correo);
            $sentenciaSQL->bindParam(':clave', $clave);
            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }

    public function Seleccionar($id)
    {
        try {            
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT usuario, nombrereal, correo, cast(aes_decrypt(clave,'nenecosistemas13') as char) FROM aj_usuario WHERE correo=:id");

            $sentenciaSQL->bindParam(':correo', $id);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function Modificar(Usuario $usuario, string $id)
    {
        try {
            $correo = $usuario->__GET('correo');
            $clave = $usuario->__GET('clave');
            $usuario = $usuario->__GET('usuario');
            $nombre = $usuario->__GET('nombrereal');
            
            
            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_usuario
                SET clave=aes_encrypt(:clave,'nenecosistemas13'),
                usuario=:usuario,
                nombrereal=:nombre WHERE correo=:correo");

            $sentenciaSQL->bindParam(':clave', $clave);            
            $sentenciaSQL->bindParam(':usuario', $usuario);
            $sentenciaSQL->bindParam(':nombrereal', $nombre);
            
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Eliminar($id)
    {
        try {
            $sentenciaSQL = $this->__GET('conexion')->prepare("DELETE FROM aj_usuario WHERE correo=:correo");
            $sentenciaSQL->bindParam(':correo', $id);
            $sentenciaSQL->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function esUsuarioHabilitado(string $correo, string $clave)
    {
        $rol = "user";
        $user = "ajuranovic";
        if ($correo == "andrea@andrea.com" and $clave == "valentina") {
            if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
                // session isn't started
                session_start();
            }
            if ($rol == "admin") {                
                $_SESSION["rol_admin"] = $rol;
            }           
            $_SESSION["user_login"] = $user; 
            return true;
        } else {
            if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
                // session isn't started
                session_start();
            }
            unset($_SESSION["rol_admin"]);
            return false;
        }
    }

}