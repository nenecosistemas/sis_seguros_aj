<?php
class Seccion
{
    private $id;
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