<?php

class Conexion {

    var $conn;
    var $host;
    var $user;
    var $password;
    var $dbname;
    var $db_engine;

    /**
     * Conexion constructor.
     */
    public function __construct() {
        
    }

    public function getConnection_mssql() {
        $host = "CINTIA-PC";
        $dbname = "tramites";
        $user = "sa";
        $password = "sistemas";
        $conn = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$host;Database=$dbname;", $user, $password);
        return $conn;
    }

    public function getConnection_mysql() {
        $host = "127.0.0.1";
        $dbname = "tramites";
        $user = "root";
        $password = "taller";
        $conn = mysql_connect($host, $user, $password);
        mysql_select_db($dbname, $conn);
        return $conn;
    }

    public function getConnection_pgsql() {
        $host = "127.0.0.1";
        $dbname = "tramites";
        $user = "postgres";
        $password = "sistemas";
        $conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user password=$password");
        return $conn;
    }

    public function selectdb($db) {
        if ($db == "pgsql") {
            $this->conn = $this->getConnection_pgsql();
            $this->db_engine = "pgsql";
        }

        if ($db == "mssql") {
            $this->conn = $this->getConnection_mssql();
            $this->db_engine = "mssql";
        }

        if ($db == "mysql") {
            $this->conn = $this->getConnection_mysql();
            $this->db_engine = "mysql";
        }
    }
    public function execute($query, $type=null) {
        $result = array();
        switch ($this->db_engine) {
            case "pgsql":
                pg_prepare($this->conn, "pg_query", " $1 ");
                $resultado = pg_execute($this->conn, "pg_query", array($query));
                $result = pg_fetch_all($resultado);
                break;
            case "mssql":
                $resultado = odbc_exec($this->conn, $query);
                while($row = odbc_fetch_array($resultado)){
                    $result[] = $row;
                }
                break;
            case "mysql":
                $result = array();
                $resultado = mysql_query($query);
                if(gettype($resultado)=="boolean"){
                    $result = $resultado;
                }else{
                    while ($row = mysql_fetch_row($resultado)) {
                        $result[] = $row;
                    }
                }
                mysql_close($this->conn);
                break;
        }
        return $result;
    }
    
    

}
