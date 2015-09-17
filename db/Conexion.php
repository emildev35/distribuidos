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
        $host = "10.0.1.18";
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
    /**
     *
     * @param type $query
     * @param type $type
     * @return type
     */
    public function execute($query, $type=null) {
        $result = array();
        switch ($this->db_engine) {
            case "pgsql":
                $resultado = pg_query($this->conn, $query);
                while($row = pg_fetch_row($resultado)){
                  $result[] = $row;
                }
                pg_close($this->conn);
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
