<?php

class Conexion
{

    var $conn;
    var $host;
    var $user;
    var $password;
    var $dbname;

    /**
     * Conexion constructor.
     */
    public function __construct()
    {
    }

    public function getConnection_mssql()
    {
        $host = "127.0.0.1";
        $dbname = "distribudios";
        $user = "postgres";
        $password = "sistemas";
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password");
        return $conn;
    }

    public function getConnection_mysql()
    {
        $host = "127.0.0.1";
        $dbname = "distribudios";
        $user = "postgres";
        $password = "sistemas";
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password");
        return $conn;
    }

    public function getConnection_pgsql()
    {
        $host = "127.0.0.1";
        $dbname = "distribudios";
        $user = "postgres";
        $password = "sistemas";
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password");
        return $conn;
    }
    
    public function selectdb($db){
        if ($db=="pgsql"){
            $this->conn = $this->getConnection_pgsql();
        }
        
    }
}
