<?php

include "../Conexion.php";

class Usuario extends Conexion{


    public static function all(){

        $data = pg_query("Select * from tramite", Usuario::getConnection_pgsql());
        return $data;
    }

    public function save(){

    }
}