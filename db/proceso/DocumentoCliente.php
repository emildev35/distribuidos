<?php

/**
 * Description of DocumentoCliente
 *
 * @author franzemil
 */

include_once  __DIR__.'/../Conexion.php';

class DocumentoCliente extends Conexion{
    public function __construct() {
        $this->selectdb("pgsql");
    }
    
}
