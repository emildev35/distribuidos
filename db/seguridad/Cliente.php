<?php

include_once __DIR__.'/../Conexion.php';

class Cliente extends Conexion
{

    function __construct()
    {
        $this->selectdb("mssql");
    }
    
    public function agregar($CI,$Nombre,$Paterno, $Materno, $Telefono, $Direccion,$Correo)
    {
        $registroCorrecto = $this->execute("cliente_A '".$CI."', '".$Nombre."', '".$Paterno."', '".$Materno."', '".$Direccion."', '".$Telefono."', '".$Correo."'");
    	return $registroCorrecto;
    }

    public function extraer_datos_cargo($IdCargo)
    {
        $datosCargo = $this->execute("cargo_S_PorID '".$IdCargo."'");
    	return $datosCargo;
    }

    public function modificar($id,$descripcion)
    {
        $modificacionCorrecta = $this->execute("cargo_M '".$id."', '".$descripcion."'");
    	return $modificacionCorrecta;
    }

    public function extraer_empleado_cargo($idCargo)
    {
        $cargoUsuario = $this->execute("cargo_S_CargoEmpleado '".$idCargo."'");
        return $cargoUsuario; 
    }

    public function eliminar($idCargo)
    {
        $eliminacionCorrecta = $this->execute("cargo_E '".$idCargo."'");
        return $eliminacionCorrecta;
    }
}
?>