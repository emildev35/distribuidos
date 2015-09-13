<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  {
include '../class_conexion.php'; 
$query= mysql_query("select distinct tp.id_proceso,t.nombre,p.nombre,tp.ini_paso,tp.inihora_paso, tp.id_paso from tramite_proceso as tp,tramites as t,paso as p 
	where tp.estado='Activo' and t.id_tramite=tp.id_tramite and p.id_paso=tp.id_paso and p.ci_per='$_SESSION[ci]' order by tp.ini_paso ASC") or
  die("Error SQL");  
if ($row = mysql_fetch_array($query, MYSQL_NUM))
{
   echo "<table border = '1' style=\"border-collapse:collapse;width:100%;\"> \n"; 
   echo "<tr style=\"background-color:black;
   text-align:center; color:white;\"><td><b>Codigo Proceso</b></td><td><b>Tramite</b></td><td><b>Paso</b></td><td><b>Inicio Paso</b></td><td><b>Hora Inicio</b></td><td style=\"width:15%;\"></td></tr> \n"; 
   do { 
      echo "<tr><td>".$row["0"]."</td><td>".$row["1"]."</td><td>".$row["2"]."</td><td>".$row["3"]."</td><td>".$row["4"]."</td><td><form action=\"pasoproc1.php\"><input type=\"hidden\" name =\"valor\" value=".$row["0"]."><input type=\"hidden\" name =\"paso\" value=".$row["5"]."> <input type=\"submit\" value=\"Realizar\" style=\"background-color: black;color:white;width:100%;heigth:100%; border-color:#336666;\"></form></td></tr> \n"; 
   } while ($row = mysql_fetch_array($query, MYSQL_NUM)); 
  
 echo "</table> \n"; 
} 
else { 
echo "<script language='JavaScript'>alert('No existen pasos bajo su cargo');
  location.href='../clear.html';</script>";
} 
?>
    <!DOCTYPE html>
    <head><link rel ="stylesheet" href = "../botones.css" type = "text/css"></head>
    <body>
      <section class="botones">
        <a href="../clear.html"  style="text-decoration:none; background-color: lightgray; color:black; margin-left:45%; border: 2px solid white; ">Salir</a>
 </section>
    </body>
    </html>
    <?php
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";}
 ?>