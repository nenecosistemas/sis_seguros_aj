<?php
class Usuario
{
    private $correo;
    private $clave;
    private $usuario;
    private $nombrereal;
    
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