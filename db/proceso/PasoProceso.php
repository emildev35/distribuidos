<?php

include_once  __DIR__.'/../Conexion.php';
/**
 * Description of PasoProceso
 *
 * @author franzemil
 */
class PasoProceso extends Conexion{

    public function __construct() {
        $this->selectdb("pgsql");
    }
}
