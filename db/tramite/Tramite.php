<?php
/**
 * Created by PhpStorm.
 * User: vasquez
 * Date: 13/09/2015
 * Time: 01:50 PM
 */
include_once __DIR__. '/../Conexion.php';
class Tramite extends  Conexion{

    /**
     * METODO CONTRUCTOR PARA DECIR QUE BASE DE DATOS VOY A UTILIZAR
     */
    function __construct (){
        $this -> selectdb("mysql");
    }
    public function add($descripcion, $duracion, $tipo){
        return $this -> execute("call tramite_A('$descripcion', $duracion, $tipo)");
    }
    /**
     * METODO PARA MOSTRAR LOS TRAMITES CON LA DESCRIPCION DEL PASO
     */
    public function getTramite(){
        return $this -> execute("call tramitebytipo_S");
    }

}