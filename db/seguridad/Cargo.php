<?php

include_once __DIR__.'/../Conexion.php';

class Cargo extends Conexion
{

    function __construct()
    {
        $this->selectdb("mssql");
    }
    
    public function agregar($descripcion)
    {
        $registroCorrecto = $this->execute("cargo_A '".$descripcion."'");
    	return $registroCorrecto;
    }

    public function extraer_datos_cargo($descripcion)
    {
        $datosCargo = $this->execute("cargo_S_ConDescripcion '".$descripcion."'");
    	return $datosCargo;
    }
}
?>