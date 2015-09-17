<?php
session_start(); // inicia sesion
include '../../db/seguridad/Cargo.php'; 
$instanciaCargo = new Cargo();
  if (!empty($_SESSION['nombre'])) //verifica si la variable de sesion no esta vacia
  {
    if(!isset($_REQUEST['valor']))// verifica si esta vacio
    {
      $procedimiento= "cargo_S";
      $titulos = "Codigo,Descripcion,Fecha";
      $campos=3;
      $destino="seguridad/cargo/eliminar.php";
      header("Location:../../tabla.php?procedimiento=".$procedimiento."& titulos=".$titulos."& campos=".$campos."& destino=".$destino);
    }
    else
    {
      if(!isset($_REQUEST['ind']))
      {
        echo "<script type=\"text/javascript\">
        var r=confirm(String.fromCharCode(191)+\"Esta seguro que desea eliminar el registro?\"); 
         if (r==true) 
          { location.href='eliminar.php? valor=$_REQUEST[valor] & ind=1';}
         else 
          { location.href='eliminar.php';} 
        </script>";
      }
      else
      {
      $cargoUsuario = $instanciaCargo->extraer_empleado_cargo($_REQUEST['valor']);
  
if (count($cargoUsuario)==0) 
{
  $eliminacionCorrecta = $instanciaCargo->eliminar($_REQUEST['valor']);
  if(count($eliminacionCorrecta)==0)
  {
 echo "<script language='JavaScript'>alert('Eliminacion realizada con exito');
  location.href='eliminar.php';</script>";
  } 
 else
 {
   echo "<script language='JavaScript'>alert('Se produjeron errores en la eliminacion');
  location.href='eliminar.php';</script>";
 }
} 
else 
{
  echo "<script language='JavaScript'>alert('No se puede eliminar el registro pues esta asociado a un empleado');
  location.href='eliminar.php';</script>";
}
      }
    }
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href=''../../index.php'';</script>";}
?>