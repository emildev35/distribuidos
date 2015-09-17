<?php
session_start(); // inicia sesion
  if (! empty($_SESSION['nombre'])) //verifica si la variable de sesion no esta vacia
  {
      include 'db/Tabla.php';
      $instanciaTabla = new Tabla();
      if($_REQUEST['metodo']==1)
      {
        $datosProcedimiento = $instanciaTabla->ejecutar_query_mssql($_REQUEST['procedimiento']);    
      }
      if($_REQUEST['metodo']==2)
      {
        $datosProcedimiento = $instanciaTabla->ejecutar_query_mysql($_REQUEST['procedimiento']);    
      }
      if($_REQUEST['metodo']==3)
      {
        $datosProcedimiento = $instanciaTabla->ejecutar_query_pgsql($_REQUEST['procedimiento']);    
      }
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
        {
          echo "<td><b>".$tit[$i]."</b></td>";
        }
      ?>
        <td style="width:15%;"></td>
        </tr>
      <?php 
      $datosProcedimiento=array_values($datosProcedimiento);
   
         foreach ($datosProcedimiento as $data) 
          {
            $data=array_values($data);
              echo "<tr>";
              echo "<td>".$data[0]."</td>";
              echo "<td>".$data[1]."</td>";
              echo "<td>".$data[2]."</td>";
              echo "<td><form action=".$_REQUEST['destino']."><input type=\"hidden\" name =\"valor\" value=".$data["0"]."><input type=\"submit\" value=\"Seleccionar\" style=\"background-color: #000000;width:100%;heigth:100%; border-color:white; color:white;\"></form></td></tr> \n"; 
              echo "</tr>";
         } 
      ?>
      </table>
      <section class="botones">
             <a href="clear.html"  style="text-decoration:none; background-color: #DFDFDF; color:black; margin-left:45%; border: 2px solid white; ">Salir</a>
       </section>
          </body>
          </html>
          <?php
}
else
{
  echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='index.php';</script>";
}
 ?>