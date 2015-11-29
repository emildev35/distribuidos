<?php
/**
 * Created by PhpStorm.
 * User: vasquez
 * Date: 13/09/2015
 * Time: 02:50 PM
 */
include_once __DIR__.'/../Conexion.php';
class Tipo extends  Conexion {
    /**
     * METODO DEL CONTRUCTOR PARA DECIR QUE BASE DE DATOS VOY A UTILIZAR
     */
    function __construct()
    {
        $this->selectdb("mysql");
    }

    /** METODO PARA REGISTRAR EL TIPO
     * @param $descripcion
     * @return array|resource
     */
    public function  add($descripcion){
        return $this->execute("call tipo_A('$descripcion')");
    }
    /**
     * SELECCIONAR
     */
    public function getall($app, $nombre){
        //return $this->execute("call tipo_S");
        return $app. " - ". $nombre;
    }
}
