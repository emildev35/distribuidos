<?php

include_once  __DIR__.'/../Conexion.php';


class DocumentoCliente extends Conexion{

    public function __construct() {
        $this->selectdb("pgsql");
    }
 
    public function hola(){
        return $this->execute("SELECT * FROM BALALDFSDFSDFSADFASDFDSFSDAFSDAFSDAFASFSDAFSDFSDF");   
    }
    
}
