<?php

include_once __DIR__.'/../Conexion.php';

class Usuario extends Conexion
{

    function __construct()
    {
        $this->selectdb("mssql");
    
    }
    public function verificar_password($nick,$password)
    {
        $datosUsuario = $this->execute("usuario_S '".$nick."', '".$password."'");
    	return $datosUsuario;
    }
}
