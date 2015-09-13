<?php

include_once __DIR__.'/../Conexion.php';

class Usuario extends Conexion
{

    function __construct()
    {
        $this->selectdb("mssql");
    }
    
    public function verificar_password($nick,$password)
    {
    	$datosCorrectos = mssql_init('cargo_A', getConnection_mssql());
        $datosCargos = $this->execute("cargo_A $nick, $password");
    	return $datosCargos;
    }
}