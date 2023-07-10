<?php
class Usuario
{
    private $_nombre;
    private $_nombreReal;
    private $_correo;
    private $_clave;
    public function setnombre($nombre)
    {
        $this->_nombre = $nombre;
    }
    public function setnombreReal($nombreReal)
    {
        $this->_nombreReal = $nombreReal;
    }
    public function setcorreo($correo)
    {
        $this->_correo = $correo;
    }
    public function setclave($clave)
    {
        $this->_clave = $clave;
    }
    public function getnombre()
    {
        return $this->_nombre;
    }
    public function getnombreReal()
    {
        return $this->_nombreReal;
    }
    public function getcorreo()
    {
        return $this->_correo;
    }
    public function getclave()
    {
        return $this->_clave;
    }

    public function __construct(string $correo, string $clave)
    {
        $this->_correo = $correo;
        $this->_clave = $clave;

        //include_once("../config/bd.php");
                    }
    public function esUsuarioHabilitado()
    {
        if ($this->getcorreo() == "andrea@andrea.com" and $this->getclave() == "valentina") {
            return true;
        } else {
            return false;
        }
    }
}
