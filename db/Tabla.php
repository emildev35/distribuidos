<?php

include_once __DIR__.'../Conexion.php';

class Tabla extends Conexion
{

    function __construct()
    {
        $this->selectdb("mssql");
    }
    
    public function ejecutar_query($procedimiento)
    {
        $datosUsuario = $this->execute($procedimiento);
        print_r($datosUsuario);
    	return $datosUsuario;
    }
}
?>