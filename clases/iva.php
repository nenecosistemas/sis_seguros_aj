<?php
class Iva
{
    private $iva;
    private $descripcion_iva;    
    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }
    

}