<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  {
  ?>
<!DOCTYPE html> 
<head>
  <link rel ="stylesheet" href = "../botones.css" type = "text/css">
  <!--<link rel="stylesheet" type="text/css" href="http://code.jquery.com/qunit/qunit-1.11.0.css">
        <script type="text/javascript" src="http://code.jquery.com/qunit/qunit-1.11.0.js"></script>
<script type="text/javascript" src="../qunit/prueba1.js"></script>-->
  <script type="text/javascript">
function volver()
{history.back();}
  </script>
</head>
<body> 
<?php 
include '../class_conexion.php'; 
?>
  <section class="contenido">
<form action ="pasoproc2.php">
   * Campos con asterisco son obligatorios
  <h2 align="center">REALIZAR PROCESO</h2>
<h3>Estado: 
  <select name="estado">
    <option>En Proceso</option>
    <option>Demorado</option>
    <option>Detenido</option>
    <option>Terminado</option>
  </select>*</h3>
<h3>Porcentaje Avanzado:
<input type ="number"  required  min="1" max="100" name="porcentaje">% *</h3>>
<h3>Observaciones:<br>
<textarea name="observacion" id="texto" cols="20" rows="4" maxlength="50"></textarea></h3>>
<section style="width:30%; float:left;">
<h4>Documentos Requeridos:</h4>
<?php
$query1= mysql_query("select distinct descripcion from docupaso where id_paso='$_REQUEST[paso]'") or die("Error SQL");  
if (!mysql_num_rows($query1))
{echo "Ningun Documento ";}
else{
  echo "<ul>";
while ($row1 = mysql_fetch_array($query1, MYSQL_NUM))
{
  ?>
    <li>
<?php echo $row1[0];?>
    </li><br>
  <?php
}
echo "</ul>";
}
?>
</section>
<section style="width:30%; float:left;">
<h4>Documentos Presentados Cliente:</h4>
<?php
$query1= mysql_query("select distinct d.descripcion from docupaso as d, docucli as c where   
   d.id_paso='$_REQUEST[paso]' and c.id_doc=d.id_doc") or die("Error SQL");  
if (!mysql_num_rows($query1))
{echo "Ningun Documento ";}
else{
  echo "<ul>";
while ($row1 = mysql_fetch_array($query1, MYSQL_NUM))
{
  ?>
    <li>
<?php echo $row1[0];?>
    </li><br>
  <?php
}
echo "</ul>";
}
?>
</section>
<input type ="hidden" value="<?php echo $_REQUEST['valor'];?>" name="id" size="40">
<input type ="hidden" value="<?php echo $_REQUEST['paso'];?>" name="paso" size="40">
</section>
<section class="botones">
<input  class="pri" type="submit" value="Guardar">
<a href="javascript:volver()" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Volver</a>
<a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:10px;margin-right:20px;border: 2px solid white; ">Salir</a>
<input type="reset" value="Limpiar Datos">
</section>
<?php 
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";}

?> 