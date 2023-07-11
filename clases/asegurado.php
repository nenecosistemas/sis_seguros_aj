<?php
class Asegurado
{
    private $dni_asegurado;
    private $apellido_y_nombre_asegurado;
    private $domicilio_asegurado;
    private $telefono_asegurado;
    private $correo_asegurado;
    private $tipoiva_asegurado;
    private $cuit_asegurado;

    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }

}