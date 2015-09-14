<?php

include_once __DIR__.'/../Conexion.php';

class Usuario extends Conexion
{

    function __construct()
    {
        $this->selectdb("mssql");
    }
    
    public function ejecutar_query($procedimiento)
    {
        $datosUsuario = $this->execute($procedimiento);
    	return $datosUsuario;
    }
}
?>