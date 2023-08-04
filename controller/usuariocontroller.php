<?php
class UsuarioController
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
        include_once("../../controller/conexion.php");        
        
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
            
            $usuariocorto = $usuario->__GET('usuario');
            $nombre = $usuario->__GET('nombrereal');
            $correo = $usuario->__GET('correo');
            $clave = $usuario->__GET('clave');
            $rol = $usuario->__GET('rol');
          
            $sentenciaSQL = $this->__GET('conexion')->prepare("INSERT INTO aj_usuario
                (usuario, nombrereal, correo, clave, rol) 
                values 
                (:usuario, :nombrereal, :correo, aes_encrypt(:clave,'nenecosistemas13'),:rol);");

            $sentenciaSQL->bindParam(':usuario', $usuariocorto);
            $sentenciaSQL->bindParam(':nombrereal', $nombre);
            $sentenciaSQL->bindParam(':correo', $correo);
            $sentenciaSQL->bindParam(':clave', $clave);
            $sentenciaSQL->bindParam(':rol', $rol);
            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function Seleccionar($id)
    {
        try {            
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT usuario, nombrereal, correo, rol, cast(aes_decrypt(clave,'nenecosistemas13') as char) as clave FROM aj_usuario WHERE correo=:correo");
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
            $usuariocorto = $usuario->__GET('usuario');
            $nombre = $usuario->__GET('nombrereal');
            $rol = $usuario->__GET('rol');
                        
            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_usuario
                SET clave=aes_encrypt(:clave,'nenecosistemas13'),
                usuario=:usuario, 
                rol=:rol,
                nombrereal=:nombrereal WHERE correo=:correo");

            $sentenciaSQL->bindParam(':correo', $id);            
            $sentenciaSQL->bindParam(':clave', $clave);            
            $sentenciaSQL->bindParam(':usuario', $usuariocorto);
            $sentenciaSQL->bindParam(':nombrereal', $nombre);
            $sentenciaSQL->bindParam(':rol', $rol);
            
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function ModificarClave(Usuario $usuario, string $id)
    {
        try {
            $correo = $usuario->__GET('correo');
            $clave = $usuario->__GET('clave');
            $usuariocorto = $usuario->__GET('usuario');
            $nombre = $usuario->__GET('nombrereal');
            $rol = $usuario->__GET('rol');
                        
            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_usuario
                SET clave=aes_encrypt(:clave,'nenecosistemas13'),
                usuario=:usuario,                 
                nombrereal=:nombrereal WHERE correo=:correo");

            $sentenciaSQL->bindParam(':correo', $id);            
            $sentenciaSQL->bindParam(':clave', $clave);            
            $sentenciaSQL->bindParam(':usuario', $usuariocorto);
            $sentenciaSQL->bindParam(':nombrereal', $nombre);            
            
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Buscar($txtusuarioBuscado)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_usuario WHERE nombrereal LIKE CONCAT('%', :nombrereal, '%') order by nombrereal");
            $sentenciaSQL->bindParam(':nombrereal', $txtusuarioBuscado, PDO::PARAM_STR);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

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
        $txUsuario = $this->Seleccionar($correo);
        
        if ($correo == $txUsuario['correo'] and $clave == $txUsuario['clave']) {
            session_start();
            
            $rol = $txUsuario['rol'];
            $user = $txUsuario['usuario'];

            $_SESSION["rol_admin"] = $rol;                      
            $_SESSION["user_login"] = $user; 
            $_SESSION["email_login"] = $correo; 
            return true;
        } else {
            return false;
        }
    }
}