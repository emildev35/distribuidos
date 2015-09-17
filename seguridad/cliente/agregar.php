<?php
session_start(); // inicia sesion
include '../../db/seguridad/Cliente.php';
  if (! empty($_SESSION["nombre"])) //verifica si la variable de sesion no esta vacia
  { 
    if(isset($_POST['Registrar']))
{
$instanciaCliente = new Cliente();

        $registroCorrecto = $instanciaCliente->agregar($_REQUEST['CI'],$_REQUEST['nombre'],$_REQUEST['paterno'],$_REQUEST['materno'],$_REQUEST['direccion'],$_REQUEST['telefono'],$_REQUEST['correo']);
        print_r($registroCorrecto);
        if($registroCorrecto[0]>0)
        {
echo "<script language='JavaScript'>alert('Registro Correcto');
            location.href='../../principal.php';</script>";
        }
        else
        {
            echo "<script language='JavaScript'>alert('Se produjeron errores en el registro');
          location.href='../../principal.php';</script>";
        }
}
else
{
?>
<html>
<head>
  <link rel ="stylesheet" href = "../botones.css" type = "text/css">
  <link rel ="stylesheet" href = "../seguridad/agperfil.css" type = "text/css">
<title>Agregar Persona</title>
</head>
<body>
  <section class="contenido">
<form action="agregar.php" method="post">
  <section class="datos">
  	 * Campos con asterisco son obligatorios
  <h2 align="center">AGREGAR CLIENTE</h2>
<h3>CI:
<input class="in" type="number" name="CI" size="8" pattern="[0-9]{5,10}" maxlength="8" required>*</h3>
<h3>Nombre:
<input class="in" type="text" name="nombre" size="30" pattern="[A-Za-z\s]{3,30}" maxlength="30" required>*</h3>
<h3>Apellido paterno:
<input class="in" type="text" name="paterno" size="30" pattern="[A-Za-z\s]{3,30}" maxlength="30" required>*</h3>
<h3>Apellido materno:
<input class="in" type="text" name="materno" size="30" pattern="[A-Za-z\s]{3,30}" maxlength="30" ></h3>
<h3>Direccion:
<input class="in" type="text" name="direccion" size="30" pattern="[0-9A-Za-z\s]{3,30}" maxlength="30" required>*</h3>
<h3>Telefono:
<input class="in" type="number" name="telefono" size="8" pattern="[0-9]{6,10}" maxlength="8" required>*</h3>
<h3>Correo: <input type="text" title="hola@ejemplo.com" value=""autofocus required name="correo" size="30" placeholder="hola@ejemplo.com" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"/>*</h3> 
<section class="botones">
<input  class="pri" type="submit" value="Registrar" name="Registrar">
<a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Salir</a>
<input type="reset" value="Limpiar Datos">
</section>
</form>
</body>
</html>
<?php
}
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../pagina.html';</script>";}
?>