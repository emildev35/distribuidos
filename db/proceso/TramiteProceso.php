<?php 

include_once __DIR__.'/../Conexion.php';
/**
* Clase de Abstarccion para la Tabla de Proceso
*/

class TramiteProceso extends Conexion
{

    function __construct()
    {
        $this->selectdb("mysql");
    }
    
    public function getall(){
        return $this->execute("select * from paso");
    }

}
