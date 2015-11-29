<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  {
  ?>
<!DOCTYPE html> 
<head><link rel ="stylesheet" href = "../botones.css" type = "text/css">
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
 <!--<link rel="stylesheet" type="text/css" href="http://code.jquery.com/qunit/qunit-1.11.0.css">
        <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script>
<script type="text/javascript" src="../qunit/PruebaHolaMundo.js"></script>-->
 <script type="text/javascript">
function volver()
{history.back();}
  </script>
  </head>
<body> 
  <!--<div id="qunit"></div>
        <div id="qunit-fixture"></div>-->
<?php 
$fecha = date("Y-m-d");
include '../class_conexion.php'; 
  function mostrar()
  {
    echo "<h2 style=\"margin-left:43%;\">PROCESO</h2>";
    $query2= mysql_query("select t.nombre, c.ci_cli, c.nombre, c.paterno, c.materno,
    tp.ini_tramite, tp.finaprox_tramite,tp.id_proceso,p.posicion
     from tramite_proceso as tp, cliente as c, tramites as t, paso as p 
     where tp.ci_cli= '$_REQUEST[ci]' and tp.id_tramite='$_REQUEST[valor]' and tp.id_tramite = t.id_tramite
     and tp.ci_cli=c.ci_cli and tp.id_paso=p.id_paso") or
      die("Error SQL");
      while ($row = mysql_fetch_array($query2, MYSQL_NUM))
 {
  echo "<section style=\"width:20%;float:left;margin-left:3%;margin-top:-2%;\">";
  echo "<h3>"."Datos del Cliente:"."</h3>";
  echo "<b>CI: </b>".$row[1]."<br>";// b pone el texto en negrillas y br es salto de lonea en html
  echo "<b>Nombre: </b>".$row[2]."<br>";
  echo "<b>Apellido Paterno: </b>".$row[3]."<br>";
  echo "<b>Apellido Materno: </b>".$row[4]."<br>";
  echo "<h3>"."Datos Tramite:"."</h3>";
  echo "<b>Tramite: </b>".$row[0]."<br>";
  echo "<b>Inicio: </b>".$row[5]."<br>";
  echo "<b>Fin Aproximado: </b>".$row[6]."<br>";
  echo "</section>";
  ?>
  <section style="width:2%; float:left;">
  <hr style="width:1px; height:290px; " />
  </section>
  <?php
  echo "<section style=\"width:70%;float:left; margin-left:3%;\">";
$query3= mysql_query("select distinct p.id_paso,p.nombre,p.posicion, d.descripcion
     from departamento as d , paso as p
     where p.id_tramite='$_REQUEST[valor]' and d.id_dep=p.id_dep order by p.posicion ASC ") or
      die("Error SQL");
      $i=0;
      echo "<b>Seleccione un proceso para ver sus especificaciones:<b>"."<br>";
    while ($row3 = mysql_fetch_array($query3, MYSQL_NUM))
 {  $i++;
  if($i>1)
      {echo"&rArr;";}
if($row3[2]<$row[8])
  {
    ?>
<input type="button" onClick="ifra.location.href='paso.php?paso=<?php echo $row3[0];?>&proceso=<?php echo $row[7];?>'"  style="background-color:#33ccff" name="<?php echo "bot".$i;?>" value="<?php echo "Paso:\n".$row3[1]."\nDepartamento Encargado:\n".$row3[3];?>" />
 <?php
}//fin del if
elseif($row3[2]==$row[8])
{$queryn1= mysql_query("select distinct pp.estado
     from paso_proceso as pp 
     where pp.id_proceso='$row[7]' and pp.id_paso='$row3[0]' ") or
      die("Error SQL");
       while ($rown1 = mysql_fetch_array($queryn1, MYSQL_NUM))
 {
  if($rown1[0]=="Demorado" or $rown1[0]=="Detenido")
  {
  ?>
<input type="button" onClick="ifra.location.href='paso.php?paso=<?php echo $row3[0];?>&proceso=<?php echo $row[7];?>'"  style="background-color:red" name="<?php echo "bot".$i;?>" value="<?php echo "Paso:\n".$row3[1]."\nDepartamento Encargado:\n".$row3[3];?>" />
<?php
}// fin del if
else{
  ?>
  <input type="button" onClick="ifra.location.href='paso.php?paso=<?php echo $row3[0];?>&proceso=<?php echo $row[7];?>'"  style="background-color:yellow" name="<?php echo "bot".$i;?>" value="<?php echo "Paso:\n".$row3[1]."\nDepartamento Encargado:\n".$row3[3];?>" />

  <?php
}//fin del else
}//fin del while
}//fin del elseif
else
  {?>
<input type="button" onClick="ifra.location.href='paso.php?paso=<?php echo $row3[0];?>&proceso=<?php echo $row[7];?>'" style="background-color:green" name="<?php echo "bot".$i;?>" value="<?php echo "Paso:\n".$row3[1]."\nDepartamento Encargado:\n".$row3[3];?>" /> 
<?php
}// fin del else
}//fin del while
?>
<section style="width:100%; margin-top:2px;height:200px; ">
<iframe  src="" name ="ifra" id ="ifra" style="width:100%; height:100%; border:none;"></iframe>
</section>
<?php
 echo "</section>";
 }//fin del while
  }//fin de la funcion
$query= mysql_query("select id_paso, ini_paso, inihora_paso, fin_paso, finhora_paso, id_proceso from tramite_proceso where ci_cli='$_REQUEST[ci]' and id_tramite='$_REQUEST[valor]'") or
  die("Error SQL"); 

 while ($row = mysql_fetch_array($query, MYSQL_NUM))
 {
  $anio=date("Y", strtotime($row[3]));
  $mes=date("m", strtotime($row[3]));
  $dia=date("d", strtotime($row[3]));
if($anio<date("Y") or $anio==date("Y") and $mes<date("m") or $anio==date("Y") and $mes==date("m") and $dia<date("d") or $anio==date("Y") and $mes==date("m") and $dia==date("d") and $row[4]<date("G"))
{
  $ver=mysql_query("select estado from paso_proceso where id_proceso='$row[5]' and id_paso='$row[0]'") or
            die("Error SQL");
            while ($verrow = mysql_fetch_array($ver, MYSQL_NUM))
 {
  if($verrow[0]=="Detenido")
  {
    mostrar();
  }
else{
  mysql_query("update paso_proceso set estado='Demorado'
             where id_proceso='$row[5]' and id_paso='$row[0]'") or
            die("Error SQL");
            mostrar();
          }
 }
        
}// fin if verificacion fecha
else
{
  mostrar();
}
 }// fin while query 
?> 
<section class="botones">
<a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:45%; border: 2px solid white; ">Salir</a>
<a href="javascript:volver()" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Volver</a>
</section>
<?php
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";}
?>