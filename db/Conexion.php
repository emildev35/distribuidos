<?php

class Conexion{

    var $conn;


    /**
     * Conexion constructor.
     */
    public function __construct()
    {
    }

    public function getConnection_mssql(){
    }
    public function getConnection_mysql(){

    }
    public function getConnection_pgsql(){
        $conn = pg_connect("host=");
    }
}