<?php
class Usuario
{
    private $usuario;
    private $nombrereal;
    private $correo;
    private $clave;
    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }

    public function __construct(string $correo, string $clave)
    {
        $this->correo = $correo;
        $this->clave = $clave;        

    }

}