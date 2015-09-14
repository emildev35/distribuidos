<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  {
include 'db/Tabla.php';
$instanciaTabla = new Tabla();

        $datosProcedimiento = $instanciaTabla->ejecutar_query($_REQUEST['procedimiento']);
        
        foreach ($datosProcedimiento as $data) 
            {
?>
<!DOCTYPE html>
<html>
<head><link rel ="stylesheet" href = "botones.css" type = "text/css"></head>
  <body>
  <table border = '1' style="border-collapse:collapse;width:100%;">
  <tr style="background-color:#000000;text-align:center; color:white;">
<?php
$tit = explode(",", $_REQUEST['titulos']);
  for($i=0;$i<$_REQUEST['campos'];$i++)
  {echo "<td><b>".$tit[$i]."</b></td>";}
?>
  <td style="width:15%;"></td>
  </tr>
<?php 
   for($i=0;$i<count($data);$i++) 
   {
    echo "<tr>";
    for($i=0;$i<$_REQUEST['campos'];$i++)
    {
      echo "<td>".$data[$i]."</td>";
    }
    echo "<td><form action=".$_REQUEST['destino']."><input type=\"hidden\" name =\"valor\" value=".$data["0"]."><input type=\"submit\" value=\"Seleccionar\" style=\"background-color: #000000;width:100%;heigth:100%; border-color:white; color:white;\"></form></td></tr> \n"; 
   } 
?>
</table>
<?php 
} 
else { 
echo "<script language='JavaScript'>alert('No existen registros');
  location.href='clear.html';</script>";
} 
?>
<section class="botones">
       <a href="clear.html"  style="text-decoration:none; background-color: #DFDFDF; color:black; margin-left:45%; border: 2px solid white; ">Salir</a>
 </section>
    </body>
    </html>
    <?php
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../pagina.html';</script>";}
 ?>