<?php
class AseguradoModel
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

    public function Agregar(Asegurado $asegurado)
    {
        try {
            $dni = $asegurado->__GET('dni_asegurado');
            $apellido_y_nombre = $asegurado->__GET('apellido_y_nombre_asegurado');
            $domicilio = $asegurado->__GET('domicilio_asegurado');
            $telefono = $asegurado->__GET('telefono_asegurado');
            $correo = $asegurado->__GET('correo_asegurado');
            $tipoIva = $asegurado->__GET('tipoiva_asegurado');
            $cuit = $asegurado->__GET('cuit_asegurado');

            $sentenciaSQL = $this->__GET('conexion')->prepare("INSERT INTO aj_asegurado 
                (dni_asegurado,apellido_y_nombre_asegurado,domicilio_asegurado,
                telefono_asegurado,correo_asegurado,tipoiva_asegurado,cuit_asegurado) 
                values 
                (:dni_asegurado,:apellido_y_nombre_asegurado,:domicilio_asegurado,
                :telefono_asegurado,:correo_asegurado,:tipoiva_asegurado,:cuit_asegurado);");

            $sentenciaSQL->bindParam(':dni_asegurado', $dni);
            $sentenciaSQL->bindParam(':apellido_y_nombre_asegurado', $apellido_y_nombre);
            $sentenciaSQL->bindParam(':domicilio_asegurado', $domicilio);
            $sentenciaSQL->bindParam(':telefono_asegurado', $telefono);
            $sentenciaSQL->bindParam(':correo_asegurado', $correo);
            $sentenciaSQL->bindParam(':tipoiva_asegurado', $tipoIva);
            $sentenciaSQL->bindParam(':cuit_asegurado', $cuit);

            $sentenciaSQL->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Modificar(Asegurado $asegurado,string $id)
    {
        try {
            $dni = $asegurado->__GET('dni_asegurado');
            $apellido_y_nombre = $asegurado->__GET('apellido_y_nombre_asegurado');
            $domicilio = $asegurado->__GET('domicilio_asegurado');
            $telefono = $asegurado->__GET('telefono_asegurado');
            $correo = $asegurado->__GET('correo_asegurado');
            $tipoIva = $asegurado->__GET('tipoiva_asegurado');
            $cuit = $asegurado->__GET('cuit_asegurado');

            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_asegurado 
                SET apellido_y_nombre_asegurado=:apellido_y_nombre_asegurado,
                domicilio_asegurado=:domicilio_asegurado,
                telefono_asegurado=:telefono_asegurado,
                correo_asegurado=:correo_asegurado,
                tipoiva_asegurado=:tipoiva_asegurado,
                cuit_asegurado=:cuit_asegurado WHERE dni_asegurado=:dni_asegurado");

            $sentenciaSQL->bindParam(':dni_asegurado', $id);
            $sentenciaSQL->bindParam(':apellido_y_nombre_asegurado', $apellido_y_nombre);
            $sentenciaSQL->bindParam(':domicilio_asegurado', $domicilio);
            $sentenciaSQL->bindParam(':telefono_asegurado', $telefono);
            $sentenciaSQL->bindParam(':correo_asegurado', $correo);
            $sentenciaSQL->bindParam(':tipoiva_asegurado', $tipoIva);
            $sentenciaSQL->bindParam(':cuit_asegurado', $cuit);
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Eliminar($id)
    {
        try {
            $sentenciaSQL = $this->__GET('conexion')->prepare("DELETE FROM aj_asegurado WHERE dni_asegurado=:dni_asegurado");
            $sentenciaSQL->bindParam(':dni_asegurado', $id);
            $sentenciaSQL->execute();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Buscar($txtAseguradoBuscado)
    {
        try {
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_asegurado WHERE apellido_y_nombre_asegurado LIKE CONCAT('%', :apellido_y_nombre_asegurado, '%') order by apellido_y_nombre_asegurado");
            $sentenciaSQL->bindParam(':apellido_y_nombre_asegurado', $txtAseguradoBuscado, PDO::PARAM_STR);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Seleccionar($id)
    {
        try {
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_asegurado WHERE dni_asegurado=:dni_asegurado");
            $sentenciaSQL->bindParam(':dni_asegurado', $id);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

}