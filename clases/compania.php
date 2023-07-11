<?php
class Compania
{
    private $cuit_compania;
    private $nombre_compania;
    private $tipoiva_compania;
    private $domicilio_compania;
    private $telefono_asegurado;
    private $email_compania;
    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }
    

}