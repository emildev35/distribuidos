<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  {
  ?>
<!DOCTYPE html> 
<head><link rel ="stylesheet" href = "../botones.css" type = "text/css">
 <script type="text/javascript">
function volver()
{history.back();}
  </script>
  </head>
<body> 
<?php 
$fecha = date("Y-m-d");
$conexion=mssql_connect() or
  die("Error de conexión.");
mssql_select_db( 'Taller_Mod_Seg') or
  die("Error de selección de base de datos.");
  $fecha=date("Y-m-d");
$query= mssql_query("select distinct  t.id_tramite, t.nombre from tramites as t, tramite_proceso as tp where tp.ci_cli='$_REQUEST[valor]' and tp.id_tramite=t.id_tramite order by t.nombre ASC ") or
  die("Error SQL");  
if ($row = mssql_fetch_array($query, MSSQL_NUM)){ 
   echo "<table border = '1' style=\"border-collapse:collapse;width:100%;\"> \n"; 
   echo "<tr style=\"background-color:#336666;
   text-align:center; color:white;\"><td><b>Codigo</b></td><td><b>Nombre</b></td><td style=\"width:15%;\"></td></tr> \n"; 
   do { 
      echo "<tr><td>".$row["0"]."</td><td>".$row["1"]."</td><td><form action=\"modtrapro2.php\"><input type=\"hidden\" name =\"valor\" value=".$row["0"]."><input type=\"hidden\" name =\"ci\" value=".$_REQUEST["valor"]."><input type=\"submit\" value=\"Ver\" style=\"background-color: #66FF33;width:100%;heigth:100%; border-color:#336666;\"></form></td></tr> \n"; 
  } while ($row = mssql_fetch_array($query, MSSQL_NUM)); 
  
 echo "</table> \n"; 
} else { 
} 
?> 
<section class="botones">
<a href="../clear.html" style="text-decoration:none; background-color: #66FF33; color:black; margin-left:45%; border: 2px solid white; ">Salir</a>
<a href="javascript:volver()" style="text-decoration:none; background-color: #66FF33; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Volver</a>
</section>
<?php
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../pagina.html';</script>";}
?>