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

    public function extraer_datos_cargo($IdCargo)
    {
        $datosCargo = $this->execute("cargo_S_PorID '".$IdCargo."'");
    	return $datosCargo;
    }

    public function modificar($id,$descripcion)
    {
        $modificacionCorrecta = $this->execute("cargo_M '".$id."', '".$descripcion."'");
    	return $modificacionCorrecta;
    }
}
?>