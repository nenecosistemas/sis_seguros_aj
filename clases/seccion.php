<?php
class Seccion
{
    private $nombre_seccion;
    private $descripcion_seccion;    
    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }
    

}