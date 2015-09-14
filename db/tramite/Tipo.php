<?php
/**
 * Created by PhpStorm.
 * User: vasquez
 * Date: 13/09/2015
 * Time: 02:50 PM
 */
include_once __DIR__.'/../Conexion.php';
class Tipo extends  Conexion {


    function __construct()
    {
        $this->selectdb("mysql");
    }

    public function  add($descripcion){
        return $this->execute("call tipo_A('$descripcion')");
    }
}

//CREATE PROCEDURE tipo_A( IN _decripcion VARCHAR(30)) BEGIN insert into tipo values (curdate(),@_decripcion); END