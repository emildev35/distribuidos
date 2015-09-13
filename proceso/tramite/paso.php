<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  {
$fecha = date("Y-m-d");
include '../class_conexion.php'; 
    $query2= mysql_query("select p.nombre,pp.ini_paso,pp.inihora_paso,pp.fin_paso, pp.finhora_paso,pp.estado,pp.porcentaje,pp.observaciones
     from paso_proceso as pp, paso as p 
     where pp.id_proceso= '$_REQUEST[proceso]' and pp.id_paso='$_REQUEST[paso]' and pp.id_paso = p.id_paso") or
      die("Error SQL");
      while ($row = mysql_fetch_array($query2, MYSQL_NUM))
 {
  echo "<section style=\"width:30%;float:left;margin-left:3%;margin-top:-2%;\">";
  echo "<h3>"."Datos del Paso:"."</h3>";
  echo "<b>Descripcion: </b>".$row[0]."<br>";// b pone el texto en negrillas y br es salto de lonea en html
  echo "<b>Fecha de Inicio: </b>".$row[1]."<br>";
  echo "<b>Hora de Inicio: </b>".$row[2]."<br>";
  echo "<b>Fecha de Fin: </b>".$row[3]."<br>";
  echo "<b>Hora de Fin: </b>".$row[4]."<br>";
  echo "</section>";
  echo "<section style=\"width:30%;float:left;margin-left:3%;margin-top:-2%;\">";
  echo "<h3>"."Avance:"."</h3>";
  echo "<b>Estado: </b>".$row[5]."<br>";
  echo "<b>Porcentaje: </b>".$row[6]."<br>";
  if($row[7]=="")
  {echo "<b>Observaciones: </b>Ninguna<br>";}
else{echo "<b>Observaciones: </b>".$row[7]."<br>";}
  echo "</section>";
}
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";}
?>