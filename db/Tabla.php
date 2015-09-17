<?php

include_once __DIR__.'../Conexion.php';

class Tabla extends Conexion
{

    function __construct()
    {
        $this->selectdb("mssql");
    }
    
    public function ejecutar_query_mssql($procedimiento)
    {
        $datosUsuario = $this->execute($procedimiento);
    	return $datosUsuario;
    }

     public function ejecutar_query_mysql($procedimiento)
    {
    	$this->selectdb("mysql");
        $datosUsuario = $this->execute($procedimiento);
    	return $datosUsuario;
    }

    public function ejecutar_query_postgress($procedimiento)
    {
    	$this->selectdb("pgsql");
        $datosUsuario = $this->execute($procedimiento);
    	return $datosUsuario;
    }
}
?>