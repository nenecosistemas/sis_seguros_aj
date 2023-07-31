<?php
class Poliza
{
    private $id;
    private $compania_id;
    private $seccion_id;
    private $asegurado_id;
    private $poliza_nro;
    private $endoso_nro;
    private $renovacion_poliza;
    private $fecha_emision;
    private $vigencia_desde;
    private $vigencia_hasta;
    private $descripcion_asegurado;
    private $cobertura_asegurado;
    private $suma_asegurada;
    private $prima;
    private $premio;    
    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
  }    

}