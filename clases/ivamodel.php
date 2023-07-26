<?php
class IvaModel
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
        include_once("../clases/conexion.php");

        try {
            $conectar = new Conexion();
            $this->conexion = $conectar->Conectar();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Agregar(Iva $iva)
    {
        try {
            $nombre = $iva->__GET('nombre_iva');
            $descripcion = $iva->__GET('descripcion_iva');                       
            
            $sentenciaSQL = $this->__GET('conexion')->prepare("INSERT INTO aj_iva 
                (nombre_iva, descripcion_iva) 
                values 
                (:nombre_iva, :descripcion_iva);");

            $sentenciaSQL->bindParam(':nombre_iva', $nombre);
            $sentenciaSQL->bindParam(':descripcion_iva', $descripcion);
            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Modificar(Iva $iva, string $id)
    {
        try {
            
            $nombre = $iva->__GET('nombre_iva');
            $descripcion = $iva->__GET('descripcion_iva');                       
            
            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_iva 
                SET nombre_iva=:nombre_iva,
                descripcion_iva=:descripcion_iva
                WHERE id=:id");

            $sentenciaSQL->bindParam(':id', $id);            
            $sentenciaSQL->bindParam(':nombre_iva', $nombre);
            $sentenciaSQL->bindParam(':descripcion_iva', $descripcion);
            
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Eliminar($id)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("DELETE FROM aj_iva WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $id);
            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Buscar($txtivaBuscado)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_iva WHERE nombre_iva LIKE CONCAT('%', :nombre_iva, '%') order by nombre_iva");
            $sentenciaSQL->bindParam(':nombre_iva', $txtivaBuscado, PDO::PARAM_STR);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Todos()
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_iva ORDER BY nombre_iva");            
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Seleccionar($id)
    {
        try {            
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_iva WHERE id=:id");

            $sentenciaSQL->bindParam(':id', $id);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

}