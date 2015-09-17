<?php
include '../../db/seguridad/Departamento.php';
if(isset($_POST['Registrar']))
{
$instanciaDepartamento = new Departamento();

        $registroCorrecto = $instanciaDepartamento->agregar($_REQUEST['descripcion']);
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
<!DOCTYPE html>
<head>
<title>Agregar Departamento</title> <!--es lo que aparece en la pestaña-->
</head>
<body >
    * Campos con asterisco son obligatorios
  <h2 align="center">AGREGAR DEPARTAMENTO</h2>
<form action="agregar.php" method="post">
<h3 align="center">Nombre del departamento:
<input type="text" name="descripcion" size="30" pattern="[A-Za-z\s]{3,30}" maxlength="30" required></h3>
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
?>