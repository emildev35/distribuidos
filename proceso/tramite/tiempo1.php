<?php
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
  {
$fecha = date("Y-m-d");
include '../class_conexion.php'; 
$query2= mysql_query("select p.nombre,pp.ini_paso,pp.inihora_paso,pp.fin_paso, pp.finhora_paso,pp.estado,pp.porcentaje,pp.observaciones,p.posicion, pp.fin, pp.finhora
     from paso_proceso as pp, paso as p 
     where pp.id_proceso= '$_REQUEST[valor]' and pp.id_paso = p.id_paso") or
      die("Error SQL");
      if(isset($query2))
      {
      while ($row = mysql_fetch_array($query2, MYSQL_NUM))
 {
  echo "<section style=\"width:30%;float:left;margin-left:3%;margin-top:-2%;\">";
  echo "<h3>"."Datos del Paso:"."</h3>";
  echo "<b>Posicion: </b>".$row[8]."<br>";
  echo "<b>Descripcion: </b>".$row[0]."<br>";// b pone el texto en negrillas y br es salto de lonea en html
  echo "<b>Fecha de Inicio: </b>".$row[1]."<br>";
  echo "<b>Hora de Inicio: </b>".$row[2]."<br>";
  echo "<b>Fecha Estimada de Fin : </b>".$row[3]."<br>";
  echo "<b>Hora Estimada de Fin: </b>".$row[4]."<br>";
  if(isset($row[9]))
    {
      echo "<b>Fecha de Fin: </b>".$row[9]."<br>";
      echo "<b>Hora de Fin: </b>".$row[10]."<br>";
    }

  echo "<h3>"."Avance:"."</h3>";
  echo "<b>Estado: </b>".$row[5]."<br>";
  echo "<b>Porcentaje: </b>".$row[6]."<br>";
  if(date("Y") == date("Y", strtotime($row[3])) and date("m") == date("m", strtotime($row[3])) and date("d") == date("d", strtotime($row[3])) and date("H") > $row[4])
  {
    $retraso=date("H")-$row[4];
    echo "<b>Retraso: </b>".$retraso." horas <br>";
  }
  elseif(date("Y") == date("Y", strtotime($row[3])) and date("m") == date("m", strtotime($row[3])) and  date("d")> date("d", strtotime($row[3])))
  {$sum=0;
    $dia=date("d");
    while($dia>date("d", strtotime($row[3])))
      {
        $sum=$sum+8;// se pone 8 pues representa las horas de trabajo
        $dia-1;
      }

    $retraso=date("H")+ $sum + (24-$row[3]);
    echo "<b>Retraso: </b>".$retraso." horas <br>";
  }
  elseif(date("Y") == date("Y", strtotime($row[3])) and date("m") > date("m", strtotime($row[3])) )
  {
    echo "<b>Retraso: </b>La realizacion del paso esta retrasado por mas de 1 mes<br>";
  }
  elseif(date("Y") > date("Y", strtotime($row[3])))
  {
    echo "<b>Retraso: </b>La realizacion del paso esta retrasado por mas de 1 año<br>";
  }

  if($row[7]=="")
  {echo "<b>Observaciones: </b>Ninguna<br>";}
else{echo "<b>Observaciones: </b>".$row[7]."<br>";}
  echo "</section>";
}
}
else{echo "<script language='JavaScript'>alert('No se han iniciado los pasos de este tramite');
  location.href='../clear.html';</script>";}
  ?>
   <!DOCTYPE html>
    <head>
    <link rel ="stylesheet" href = "../botones.css" type = "text/css">
    <script type="text/javascript">
function volver()
{history.back();}
  </script></head>
    <body>
      <section class="botones">
      <a href="javascript:volver()" class="pri" style="text-decoration:none; background-color: lightgray; color:black; border: 2px solid white; ">Volver</a>
      <a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;padding-left:5px;padding-right:5px;">Salir</a>
      </section>
    </body>
    </html>
    <?php
}
else
{echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";}
?>