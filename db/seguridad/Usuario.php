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
        $datosUsuario = $this->execute("execute usuario_S 'circ@ddrr.com.bo', '8320279'");
        print_r($datosUsuario);
    	return $datosUsuario;
    }
}
?>