<?php
class PolizaController
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

    public function Agregar(Poliza $poliza)
    {
        try {
            $compania = $poliza->__GET('compania_id');
            $seccion = $poliza->__GET('seccion_id');
            $asegurado = $poliza->__GET('asegurado_id');
            $polizanro = $poliza->__GET('poliza_nro');
            $endoso = $poliza->__GET('endoso_nro');
            $renueva = $poliza->__GET('renovacion_poliza');
            $emision = $poliza->__GET('fecha_emision');
            $desde = $poliza->__GET('vigencia_desde');
            $hasta = $poliza->__GET('vigencia_hasta');
            $descripcion = $poliza->__GET('descripcion_asegurado');
            $cobertura = $poliza->__GET('cobertura_asegurado');
            $suma = $poliza->__GET('suma_asegurada');
            $prima = $poliza->__GET('prima');
            $premio = $poliza->__GET('premio');
           
            $sentenciaSQL = $this->__GET('conexion')->prepare("INSERT INTO aj_poliza 
                (compania_id,
                seccion_id,
                asegurado_id,
                poliza_nro,
                endoso_nro,
                renovacion_poliza,
                fecha_emision,
                vigencia_desde,
                vigencia_hasta,
                descripcion_asegurado,
                cobertura_asegurado,
                suma_asegurada,
                prima,
                premio) 
                values 
                (:compania_id,
                :seccion_id,
                :asegurado_id,
                :poliza_nro,
                :endoso_nro,
                :renovacion_poliza,
                :fecha_emision,
                :vigencia_desde,
                :vigencia_hasta,
                :descripcion_asegurado,
                :cobertura_asegurado,
                :suma_asegurada,
                :prima,
                :premio);");

            $sentenciaSQL->bindParam(':compania_id', $compania);
            $sentenciaSQL->bindParam(':seccion_id', $seccion);
            $sentenciaSQL->bindParam(':asegurado_id', $asegurado);
            $sentenciaSQL->bindParam(':poliza_nro', $polizanro);
            $sentenciaSQL->bindParam(':endoso_nro', $endoso);
            $sentenciaSQL->bindParam(':renovacion_poliza', $renueva);
            $sentenciaSQL->bindParam(':fecha_emision', $emision);
            $sentenciaSQL->bindParam(':vigencia_desde', $desde);
            $sentenciaSQL->bindParam(':vigencia_hasta', $hasta);            
            $sentenciaSQL->bindParam(':descripcion_asegurado', $descripcion);
            $sentenciaSQL->bindParam(':cobertura_asegurado', $cobertura);
            $sentenciaSQL->bindParam(':suma_asegurada', $suma);
            $sentenciaSQL->bindParam(':prima', $prima);
            $sentenciaSQL->bindParam(':premio', $premio);

            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Modificar(Poliza $poliza, string $id)
    {
        try {
            
            $compania = $poliza->__GET('compania_id');
            $seccion = $poliza->__GET('seccion_id');
            $asegurado = $poliza->__GET('asegurado_id');
            $polizanro = $poliza->__GET('poliza_nro');
            $endoso = $poliza->__GET('endoso_nro');
            $renueva = $poliza->__GET('renovacion_poliza');
            $emision = $poliza->__GET('fecha_emision');
            $desde = $poliza->__GET('vigencia_desde');
            $hasta = $poliza->__GET('vigencia_hasta');
            $descripcion = $poliza->__GET('descripcion_asegurado');
            $cobertura = $poliza->__GET('cobertura_asegurado');
            $suma = $poliza->__GET('suma_asegurada');
            $prima = $poliza->__GET('prima');
            $premio = $poliza->__GET('premio');                       
            
            $sentenciaSQL = $this->__GET('conexion')->prepare("UPDATE aj_poliza 
                SET compania_id=:compania_id,
                seccion_id=:seccion_id,
                asegurado_id=:asegurado_id,
                poliza_nro=:poliza_nro,
                endoso_nro=:endoso_nro,
                renovacion_poliza=:renovacion_poliza,
                fecha_emision=:fecha_emision,
                vigencia_desde=:vigencia_desde,
                vigencia_hasta=:vigencia_hasta,
                descripcion_asegurado=:descripcion_asegurado,
                cobertura_asegurado=:cobertura_asegurado,
                suma_asegurada=:suma_asegurada,
                prima=:prima,
                premio=:premio
                WHERE id=:id");

            $sentenciaSQL->bindParam(':id', $id);            
            $sentenciaSQL->bindParam(':compania_id', $compania);
            $sentenciaSQL->bindParam(':seccion_id', $seccion);
            $sentenciaSQL->bindParam(':asegurado_id', $asegurado);
            $sentenciaSQL->bindParam(':poliza_nro', $polizanro);
            $sentenciaSQL->bindParam(':endoso_nro', $endoso);
            $sentenciaSQL->bindParam(':renovacion_poliza', $renueva);
            $sentenciaSQL->bindParam(':fecha_emision', $emision);
            $sentenciaSQL->bindParam(':vigencia_desde', $desde);
            $sentenciaSQL->bindParam(':vigencia_hasta', $hasta);            
            $sentenciaSQL->bindParam(':descripcion_asegurado', $descripcion);
            $sentenciaSQL->bindParam(':cobertura_asegurado', $cobertura);
            $sentenciaSQL->bindParam(':suma_asegurada', $suma);
            $sentenciaSQL->bindParam(':prima', $prima);
            $sentenciaSQL->bindParam(':premio', $premio);
            $sentenciaSQL->execute();       
                        
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

    }
    public function Eliminar($id)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("DELETE FROM aj_poliza WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $id);
            $sentenciaSQL->execute();

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Buscar($txtaseguradoBuscado)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT aj_poliza.*,
            aj_compania.nombre_compania,
            aj_seccion.nombre_seccion,
            aj_asegurado.apellido_y_nombre_asegurado
            FROM aj_poliza 
            LEFT JOIN aj_compania on aj_poliza.compania_id = aj_compania.cuit_compania
            LEFT JOIN aj_seccion on aj_poliza.seccion_id = aj_seccion.id
            LEFT JOIN aj_asegurado on aj_poliza.asegurado_id = aj_asegurado.dni_asegurado
            WHERE aj_asegurado.apellido_y_nombre_asegurado LIKE CONCAT('%', :nombre_asegurado, '%') order by aj_compania.nombre_compania, aj_seccion.nombre_seccion, aj_poliza.poliza_nro");
            $sentenciaSQL->bindParam(':nombre_asegurado', $txtaseguradoBuscado, PDO::PARAM_STR);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function Seleccionar($id)
    {
        try {            
            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT * FROM aj_poliza WHERE id=:id");

            $sentenciaSQL->bindParam(':id', $id);
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function BuscarporVigenciahasta($fechadesde, $fechahasta)
    {
        try {

            $sentenciaSQL = $this->__GET('conexion')->prepare("SELECT aj_poliza.*,
            aj_compania.nombre_compania,
            aj_seccion.nombre_seccion,
            aj_asegurado.apellido_y_nombre_asegurado
            FROM aj_poliza 
            LEFT JOIN aj_compania on aj_poliza.compania_id = aj_compania.cuit_compania
            LEFT JOIN aj_seccion on aj_poliza.seccion_id = aj_seccion.id
            LEFT JOIN aj_asegurado on aj_poliza.asegurado_id = aj_asegurado.dni_asegurado
            WHERE aj_poliza.vigencia_hasta between :fechadesde and :fechahasta order by aj_compania.nombre_compania, aj_seccion.nombre_seccion, aj_poliza.poliza_nro");
            $sentenciaSQL->bindParam(':fechadesde', $fechadesde);
            $sentenciaSQL->bindParam(':fechahasta', $fechahasta);            
            $sentenciaSQL->execute();
            return $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

}