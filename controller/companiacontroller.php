<?php
class CompaniaController
{
    private $conexion;
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

    public function Agregar(Compania $compania)
    {
        try {
            $cuit = $compania->__GET('cuit_compania');
            $nombre = $compania->__GET('nombre_compania');
            $iva = $compania->__GET('tipoiva_compania');
            $domicilio = $compania->__GET('domicilio_compania');
            $telefono = $compania->__GET('telefono_compania');
            $correo = $compania->__GET('correo_compania');
            
            
            $sentenciaSQL = $this->__GET('conexion')->prepare("INSERT INTO aj_compania 
                (cuit_compania,nombre_compania,domicilio_compania,
                telefono_compania,correo_compania,tipoiva_compania) 
                values 
                (:cuit_compania,:nombre_compania,:domicilio_compania,
                :telefono_compania,:correo_compania,:tipoiva_compania);");

            $sentenciaSQL->bindParam(':cuit_compania', $cuit);
            $sentenciaSQL->bindParam(':nombre_compania', $nombre);
            $sentenciaSQL->bindParam(':domicilio_compania', $domicilio);
            $sentenciaSQL->bindParam(':telefono_compania', $telefono);
            $sentenciaSQL->bindParam(':correo_compania', $correo);
            $sentenciaSQL->bindParam(':tipoiva_compania', $iva);            
            $sentenciaSQL->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Modificar(Compania $compania, string $id)
    {
        try {
            $cuit = $compania->__GET('cuit_compania');
            $nombre = $compania->__GET('nombre_compania');
            $iva = $compania->__GET('tipoiva_compania');
            $domicilio = $compania->__GET('domicilio_compania');
            $telefono = $compania->__GET('telefono_compania');
            $correo = $compania->__GET('correo_compania');

            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_compania 
                SET cuit_compania=:cuit_compania,
                nombre_compania=:nombre_compania,
                domicilio_compania=:domicilio_compania,
                telefono_compania=:telefono_compania,
                correo_compania=:correo_compania,
                tipoiva_compania=:tipoiva_compania WHERE cuit_compania=:cuit_compania");

            $sentenciaSQL->bindParam(':cuit_compania', $id);            
            $sentenciaSQL->bindParam(':nombre_compania', $nombre);
            $sentenciaSQL->bindParam(':domicilio_compania', $domicilio);
            $sentenciaSQL->bindParam(':telefono_compania', $telefono);
            $sentenciaSQL->bindParam(':correo_compania', $correo);
            $sentenciaSQL->bindParam(':tipoiva_compania', $iva);
            
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Eliminar($id)
    {
        try {
            $sentenciaSQL = $this->__GET('conexion')->prepare("DELETE FROM aj_compania WHERE cuit_compania=:cuit_compania");
            $sentenciaSQL->bindParam(':cuit_compania', $id);
            $sentenciaSQL->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Todos()
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_compania ORDER BY nombre_compania");            
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Buscar($txtcompaniaBuscado)
    {
        try {
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_compania WHERE nombre_compania LIKE CONCAT('%', :nombre_compania, '%') order by nombre_compania") ;
            $sentenciaSQL->bindParam(':nombre_compania', $txtcompaniaBuscado, PDO::PARAM_STR);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Seleccionar($id)
    {
        try {
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_compania WHERE cuit_compania=:cuit_compania");
            $sentenciaSQL->bindParam(':cuit_compania', $id);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

}