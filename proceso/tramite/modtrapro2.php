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
    echo "<h2 style=\"margin-left:43%;\">DATOS</h2>";
    $query2= mssql_query("select tp.fecha_reg, t.nombre, c.ci_cli, c.nombre, c.paterno, c.materno,
    tp.ini_tramite, tp.finaprox_tramite, p.nombre, tp.ini_paso, tp.inihora_paso, tp.fin_paso, tp.finhora_paso
     from tramite_proceso as tp, cliente as c, tramites as t, paso as p 
     where tp.ci_cli= '$_REQUEST[ci]' and tp.id_tramite='$_REQUEST[valor]' and tp.id_tramite = t.id_tramite
     and tp.ci_cli=c.ci_cli and tp.id_paso=p.id_paso") or
      die("Error SQL");
      while ($row = mssql_fetch_array($query2, MSSQL_NUM))
 {
  echo "<b>Ultima Fecha de Actualizacion: </b>".$row[0]."<br>"."<br>";
  echo "<section style=\"width:30%;float:left;margin-left:10%;\">";
  echo "<h3>"."Datos del Cliente:"."</h3>"."<br>";
  echo "<b>CI: </b>".$row[2]."<br>";// b pone el texto en negrillas y br es salto de lonea en html
  echo "<b>Nombre: </b>".$row[3]."<br>";
  echo "<b>Apellido Paterno: </b>".$row[4]."<br>";
  echo "<b>Apellido Materno: </b>".$row[5]."<br>";
  echo "</section>";
  echo "<section style=\"width:30%;float:left;\">";
  echo "<h3>"."Datos Tramite:"."</h3>"."<br>";
  echo "<b>Tramite: </b>".$row[1]."<br>";
  echo "<b>Inicio: </b>".$row[6]."<br>";
  echo "<b>Fin Aproximado: </b>".$row[7]."<br>";
  echo "</section>";
  echo "<section style=\"width:30%;float:left;\">";
  echo "<h3>"."Datos Paso:"."</h3>"."<br>";
  echo "<b>Paso Actual: </b>".$row[8]."<br>";
  echo "<b>Inicio: </b>".$row[9]."<br>";
  echo "<b>Hora Inicio: </b>".$row[10]."<br>";
  echo "<b>Fin Aproximado : </b>".$row[11]."<br>";
  echo "<b>Hora Fin: </b>".$row[12]."<br>";
  echo "</section>";
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