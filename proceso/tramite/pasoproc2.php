<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  { 
include '../class_conexion.php'; 

if($_REQUEST['porcentaje']==100 and $_REQUEST['estado']!= 'Terminado' or $_REQUEST['estado']=='Terminado' and $_REQUEST['porcentaje']!=100)
  { echo "<script language='JavaScript'>alert('El estado y el porcentaje deben ser coherentes entre si');
history.back();</script>";}
elseif($_REQUEST['observacion']=="" and $_REQUEST['estado']== 'Detenido')
  { echo "<script language='JavaScript'>alert('Se debe especificar porque esta detenido en el apartado de observaciones');
history.back();</script>";}
else
{
  function registrar()
  { 
    $mes=0;
    $mes1=0;
    $dia=0;
    $dia1=0;
    $fecha = date("Y-m-d");
      $query=mysql_query("select p.duracion, p.posicion from tramite_proceso as tp, paso as p where tp.id_proceso='$_REQUEST[id]' and p.id_paso='$_REQUEST[paso]'") or
           die("Error SQL");
      while ($row = mysql_fetch_array($query, MYSQL_NUM)) 
           {
                     $duracion =$row[0]; 
                     $posicion =$row[1]; 
            }
      // determinando la fecha de fin de paso
            $mes1=date("n");// extrae el mes actual sin ceros delante
            $dia1=date("d");
            $anio1=date("Y");
            $horaact=date("G");// extrae la hora del registro sin ceros 
            for($i= 0;$i< $duracion;$i++)
      {
        if($mes1>12)
        {
      $mes1=1;
      $anio1=$anio1+1;
        }
      if($mes1==4 or $mes1==6 or $mes1==9 or $mes1==11)// verifica si el mes es abril, junio, septiembre o noviembre que tienen 30 dias
      {
        if($dia1<30)// verifica que mientras sea menor a 30 se incremente caso contrario volvera a 0 pues paso de mes
        {
          if($horaact<24)
            {$horaact=$horaact+1;}
          else
          {$dia1=$dia1+1;
            $horaact=0;}
        }
        else{$dia1=1;
          $mes1=$mes1+1;}
      }
      elseif($mes1==2)// verifica si el mes es febrero
      {
      if($anio1%4==0 and $anio1%100!=0 or $anio1%400==0)//verifica si el año es biciesto
      {
        if($dia1<29)// verifica que mientras sea menor a 29 se incremente caso contrario volvera a 0 pues paso de mes
        {
          if($horaact<24)
            {$horaact=$horaact+1;}
          else
          {$dia1=$dia1+1;
          $horaact=0;}
        }
        else{$dia1=1;
          $mes1=$mes1+1;}
      }
      else // no es biciesto
      {
        if($dia1<28)// verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
        {
          if($horaact<24)
            {$horaact=$horaact+1;}
          else
          {$dia1=$dia1+1;
          $horaact=0;}
        }
        else{$dia1=1;
          $mes1=$mes1+1;}
      }
      }
      else{
        if($dia1<31)// verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
        {if($horaact<24)
            {$horaact=$horaact+1;}
          else
          {$dia1=$dia1+1;
          $horaact=0;}
        }
        else{$dia1=1;
          $mes1=$mes1+1;}
      }
      } 
      if(strlen($mes)<2)//determina el tamaño del numero
      {$mes="0".$mes;}
      if(strlen($dia)<2)
      {$dia="0".$dia;}
      if(strlen($mes1)<2)
      {$mes1="0".$mes1;}
      if(strlen($dia1)<2)
      {$dia1="0".$dia1;}
      if(strlen($horaact)<2)
      {$horaact="0".$horaact;}// hora de finalizacion
      $hora=date("H");// extrae la hora del registro con ceros, tomar en cuenta que redondea al inmediato superior
      $finpaprox= $anio1."-".$mes1."-".$dia1;// convierte a date la cadena
      mysql_query("insert into paso_proceso (fecha_reg,id_proceso,id_paso,ini_paso,
       inihora_paso,fin_paso,finhora_paso,estado,porcentaje,observaciones,ci_per) 
      values ('$fecha', '$_REQUEST[id]','$_REQUEST[paso]','$fecha',
        '$hora','$finpaprox','$horaact','$_REQUEST[estado]',
        '$_REQUEST[porcentaje]','$_REQUEST[observacion]','$_SESSION[ci]')") or
        die("Error SQL");
        echo "<script language='JavaScript'>alert('Grabacion Correcta');</script>";
  }
  function modificar()
  { $fecha = date("Y-m-d");
  $hora=date("H");
  if($_REQUEST['estado']=="Terminado")
  {
    mysql_query("update paso_proceso set fecha_reg='$fecha',
    estado='$_REQUEST[estado]',
    porcentaje='$_REQUEST[porcentaje]',
    observaciones='$_REQUEST[observacion]',
    ci_per='$_SESSION[ci]',
    fin='$fecha',
    finhora='$hora'
    where id_paso='$_REQUEST[paso]' and id_proceso='$_REQUEST[id]'") or
        die("Error SQL");
  }
  else{
  mysql_query("update paso_proceso set fecha_reg='$fecha',
    estado='$_REQUEST[estado]',
    porcentaje='$_REQUEST[porcentaje]',
    observaciones='$_REQUEST[observacion]',
    ci_per='$_SESSION[ci]'
    where id_paso='$_REQUEST[paso]' and id_proceso='$_REQUEST[id]'") or
        die("Error SQL");}
        if($_REQUEST['porcentaje']==100 and $_REQUEST['estado']== 'Terminado')
        {
         $query1= mysql_query("select posicion, id_tramite from paso where id_paso='$_REQUEST[paso]'") or
      die("Error SQL");
      while ($row1 = mysql_fetch_array($query1, MYSQL_NUM))
     {
      $num=$row1[0]+1;// le incrementa una unidad a causa de que se quiere obtner la posicion del siguiente paso
      $query2= mysql_query("select id_paso, duracion,ci_per from paso where id_tramite='$row1[1]' and posicion='$num'") or
      die("Error SQL");
      if (!mysql_num_rows($query2)) 
      {
        mysql_query("update tramite_proceso set fecha_reg='$fecha',
             estado='Terminado'
             where id_proceso='$_REQUEST[id]'") or
            die("Error SQL");
      }
    else{
      while ($row2 = mysql_fetch_array($query2, MYSQL_NUM))
     {
            $paso=$row2[0];
            $ci_per=$row2[2];
                $mes1=date("n");// extrae el mes actual sin ceros delante
                $dia1=date("d");
                $anio1=date("Y");
                $horaact=date("G");// extrae la hora del registro sin ceros 
                for($i= 0;$i< $row2[1];$i++)
          {
            if($mes1>12)
            {
          $mes1=1;
          $anio1=$anio1+1;
            }
          if($mes1==4 or $mes1==6 or $mes1==9 or $mes1==11)// verifica si el mes es abril, junio, septiembre o noviembre que tienen 30 dias
          {
            if($dia1<30)// verifica que mientras sea menor a 30 se incremente caso contrario volvera a 0 pues paso de mes
            {
              if($horaact<24)
                {$horaact=$horaact+1;}
              else
              {$dia1=$dia1+1;
                $horaact=0;}
            }
            else{$dia1=1;
              $mes1=$mes1+1;}
          }
          elseif($mes1==2)// verifica si el mes es febrero
          {
          if($anio1%4==0 and $anio1%100!=0 or $anio1%400==0)//verifica si el año es biciesto
          {
            if($dia1<29)// verifica que mientras sea menor a 29 se incremente caso contrario volvera a 0 pues paso de mes
            {
              if($horaact<24)
                {$horaact=$horaact+1;}
              else
              {$dia1=$dia1+1;
              $horaact=0;}
            }
            else{$dia1=1;
              $mes1=$mes1+1;}
          }
          else // no es biciesto
          {
            if($dia1<28)// verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
            {
              if($horaact<24)
                {$horaact=$horaact+1;}
              else
              {$dia1=$dia1+1;
              $horaact=0;}
            }
            else{$dia1=1;
              $mes1=$mes1+1;}
          }
          }
          else{
            if($dia1<31)// verifica que mientras sea menor a 28 se incremente caso contrario volvera a 0 pues paso de mes
            {if($horaact<24)
                {$horaact=$horaact+1;}
              else
              {$dia1=$dia1+1;
              $horaact=0;}
            }
            else{$dia1=1;
              $mes1=$mes1+1;}
          }
          } 

          if(strlen($mes1)<2)
          {$mes1="0".$mes1;}
          if(strlen($dia1)<2)
          {$dia1="0".$dia1;}
          if(strlen($horaact)<2)
          {$horaact="0".$horaact;}
          $hora=date("H");// extrae la hora del registro con ceros, tomar en cuenta que redondea al inmediato superior
          $finpaprox= $anio1."-".$mes1."-".$dia1;// convierte a date la cadena
          mysql_query("update tramite_proceso set fecha_reg='$fecha',
             id_paso='$paso', 
             ini_paso='$fecha',
             inihora_paso='$hora',
             fin_paso='$finpaprox',
             finhora_paso='$horaact'
             where id_proceso='$_REQUEST[id]'") or
            die("Error SQL");
          mysql_query("insert into paso_proceso (fecha_reg,id_proceso,id_paso,ini_paso,
       inihora_paso,fin_paso,finhora_paso,estado,porcentaje,observaciones,ci_per) 
      values ('$fecha', '$_REQUEST[id]','$paso','$fecha',
        '$hora','$finpaprox','$horaact','En Proceso',
        '0','','$ci_per')") or
        die("Error SQL");
      }// fin while query 2 
      }// fin else verificacion vacio   
     }// fin while query 1 
   }//fin del if
        echo "<script language='JavaScript'>alert('Grabacion Correcta');</script>";
  }

  $sub=mysql_query("select * from paso_proceso where id_paso='$_REQUEST[paso]' and id_proceso='$_REQUEST[id]' ") or die("Error SQL");
  if (!mysql_num_rows($sub))
  {registrar();}
  else{
        modificar();
    }
  }
mysql_close($conexion);
?>
    <!DOCTYPE html>
    <head><link rel ="stylesheet" href = "../botones.css" type = "text/css"></head>
    <body>
      <section class="botones">
      <a  href="mensaje.php" style="text-decoration:none; background-color: #66FF33; color:black; margin-left:40%; padding-left:5px;padding-right:5px; ">Enviar Mensaje Cliente</a>
      <a href="../clear.html" style="text-decoration:none; background-color: #66FF33; color:black; margin-left:20px;padding-left:5px;padding-right:5px;">Salir</a>
      </section>
    </body>
    </html>
    <?php
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";}
?>