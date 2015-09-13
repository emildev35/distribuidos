<?php

include '../Conexion.php';
/**
* Clase de Abstarccion para la Tabla de Proceso
*/
class Proceso extends Conexion
{

    function __construct()
    {
        $this->selectdb("pgsql");
    }
    
    public function getall(){

    }

}
