<?php
session_start(); // inicia sesion
if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
{

?>
    <html>
    <head>
        <link rel ="stylesheet" href = "../botones.css" type = "text/css">
        <link rel ="stylesheet" href = "agperfil.css" type = "text/css">
        <title>Agregar Tramite</title>
    </head>
    <body>
    * Campos con asterisco son obligatorios
    <h2 align="center">TIPO</h2>
    <form action="agtramite1.php" method="post">
        <h3>Descripcion:
            <input type="text" name="nombre" pattern="[A-Za-z\s]{3,50}" maxlength="50" required size="50">*</h3>

        </section>
        <section class="botones">
            <input  class="pri" type="submit" value="Registrar">
            <a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Salir</a>
            <input type="reset" value="Limpiar Datos">
        </section>
    </form>
    </body>
    </html>
<?php
  }
  else
  {echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";}
?>