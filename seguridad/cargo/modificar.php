<?php
session_start(); // inicia sesion
include '../../db/seguridad/Cargo.php'; 
$instanciaCargo = new Cargo();
  if (!empty($_SESSION['nombre'])) //verifica si la variable de sesion no esta vacia
  {
    if(!isset($_REQUEST['valor']))// verifica si esta vacio
    {
      $procedimiento= "cargo_S";
      $metodo=1;
      $titulos = "Codigo,Descripcion,Fecha";
      $campos=3;
      $destino="seguridad/cargo/modificar.php";

      header("Location:../../tabla.php?procedimiento=".$procedimiento."& metodo=".$metodo."& titulos=".$titulos."& campos=".$campos."& destino=".$destino);
    }
    else
      {
        if(isset($_REQUEST['Guardar']))
        {
$modificacionCorrecta = $instanciaCargo->modificar($_REQUEST['valor'],$_REQUEST['descripcion']);
if(count($modificacionCorrecta)>0)
        {
echo "<script language='JavaScript'>alert('Modificacion Correcta');
            location.href='../../principal.php';</script>";
        }
        else
        {
            echo "<script language='JavaScript'>alert('Se produjeron errores en la modificacion');
          location.href='../../principal.php';</script>";
        }
        }
      else
      {
        ?>
<!DOCTYPE html> 
<head>
  <script type="text/javascript">
    function volver()
    {history.back();}
  </script>
</head>
<body> 
<?php 
        $datosCargo = $instanciaCargo->extraer_datos_cargo($_REQUEST['valor']);
foreach ($datosCargo as $data) 
            {
?>
  <section class="contenido">
    * Campos con asterisco son obligatorios
  <h2 align="center">MODIFICAR CARGO</h2>
<form action ="modificar.php">
<h3 align="center"> 
Nuevo nombre del cargo
<input type ="text" value="<?php echo $data["descripcion"];?>" required pattern="[A-Za-z\s]{3,30}" name="descripcion" size="30" maxlength="30">*</h3>
<input type ="hidden" value="<?php echo $_REQUEST['valor'];?>" name="valor" size="40">
</section>
<section class="botones">
<input  class="pri" type="submit" value="Guardar" name="Guardar">
<a href="javascript:volver()" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Volver</a>
<a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:10px;margin-right:20px;border: 2px solid white; ">Salir</a>
<input type="reset" value="Limpiar Datos">
</section>
<?php
} 
} 
}
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../../index.php';</script>";}
?>