<?php
class SeccionModel
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

    public function Agregar(Seccion $seccion)
    {
        try {
            $nombre = $seccion->__GET('nombre_seccion');
            $descripcion = $seccion->__GET('descripcion_seccion');                       
            
            $sentenciaSQL = $this->__GET('conexion')->prepare("INSERT INTO aj_seccion 
                (nombre_seccion, descripcion_seccion) 
                values 
                (:nombre_seccion, :descripcion_seccion);");

            $sentenciaSQL->bindParam(':nombre_seccion', $nombre);
            $sentenciaSQL->bindParam(':descripcion_seccion', $descripcion);
            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Modificar(Seccion $seccion, string $id)
    {
        try {
            
            $nombre = $seccion->__GET('nombre_seccion');
            $descripcion = $seccion->__GET('descripcion_seccion');                       
            
            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_seccion 
                SET nombre_seccion=:nombre_seccion,
                descripcion_seccion=:descripcion_seccion
                WHERE id=:id");

            $sentenciaSQL->bindParam(':id', $id);            
            $sentenciaSQL->bindParam(':nombre_seccion', $nombre);
            $sentenciaSQL->bindParam(':descripcion_seccion', $descripcion);
            
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Eliminar($id)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("DELETE FROM aj_seccion WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $id);
            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
     public function Todos()
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_seccion ORDER BY nombre_seccion");            
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Buscar($txtseccionBuscado)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_seccion WHERE nombre_seccion LIKE CONCAT('%', :nombre_seccion, '%') order by nombre_seccion");
            $sentenciaSQL->bindParam(':nombre_seccion', $txtseccionBuscado, PDO::PARAM_STR);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Seleccionar($id)
    {
        try {            
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_seccion WHERE id=:id");

            $sentenciaSQL->bindParam(':id', $id);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

}