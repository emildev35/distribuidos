<?php
session_start(); // inicia sesion
  echo $_SESSION['nombre'];//verifica si la variable de sesion no esta vacia
  ?>
<!DOCTYPE html> 
<head>
  <script type="text/javascript">
    function volver()
    {history.back();}
  </script>
</head>
<body> 
<div >
                <ul>
                	<li><!--esta clase permitira que cuando el ouse este sobre esta lista cambie de color-->
                    <a href="seguridad/cargo/agregar.php" target="iframe">Agregar Cargo</a><!--cuando se coloca en href "#  direccionara a la misma pagina (recursivo)-->
                </li>
                <li><a href="seguridad/cargo/modificar.php" target="iframe">Modificar Cargo</a></li>
                <li><a href="seguridad/cargo/eliminar.php" target="iframe">Eliminar Cargo</a></li>
             
                    <li><!--esta clase permitira que cuando el ouse este sobre esta lista cambie de color-->
                    <a href="tipo/agregar.php" target="iframe">Agregar Tipo</a><!--cuando se coloca en href "#  direccionara a la misma pagina (recursivo)-->
                </li>
                <li><a href="tipo/modificar.php" target="iframe">Modificar Tipo</a></li>
                <li><a href="tipo/eliminar.php" target="iframe">Eliminar Tipo</a></li>
                <li><!--esta clase permitira que cuando el ouse este sobre esta lista cambie de color-->
                    <a href="tramite/agregar.php" target="iframe">Agregar Tramite</a><!--cuando se coloca en href "#  direccionara a la misma pagina (recursivo)-->
                </li>
                <li><a href="tramite/modificar.php" target="iframe">Modificar Tramite</a></li>
                <li><a href="tramite/eliminar.php" target="iframe">Eliminar Tramite</a></li>
                <li><!--esta clase permitira que cuando el ouse este sobre esta lista cambie de color-->
                    <a href="paso/agregar.php" target="iframe">Agregar Paso</a><!--cuando se coloca en href "#  direccionara a la misma pagina (recursivo)-->
                </li>
                <li><a href="paso/modificar.php" target="iframe">Modificar Paso</a></li>
                <li><a href="paso/eliminar.php" target="iframe">Eliminar Paso</a></li>
                <li><!--esta clase permitira que cuando el ouse este sobre esta lista cambie de color-->
                    <a href="proceso/iniciartramite.php" target="iframe">Iniciar Tramite</a><!--cuando se coloca en href "#  direccionara a la misma pagina (recursivo)-->
                </li>
                <li><a href="proceso/agregardocumento.php" target="iframe">Registrar Documentos</a></li>
                </ul>
            </div>

</body> 
</html> 