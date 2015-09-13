<?php
session_start(); // inicia sesion
if (!empty($_SESSION["usuario"])) { //verifica si la variable de sesion no esta vacia
    $conexion = mssql_connect() or die("Error de conexión.");
    mssql_select_db('Taller_Mod_Seg') or die("Error de selección de base de datos.");
    $query = mssql_query("select distinct c.ci_cli,c.nombre,c.paterno,c.materno "
            . "from cliente as c, tramite_proceso as tp where tp.ci_cli=c.ci_cli and tp.estado='Activo' order by paterno ASC") or
            die("Error SQL");
    if ($row = mssql_fetch_array($query, MSSQL_NUM)) {
        echo "<table border = '1' style=\"border-collapse:collapse;width:100%;\"> \n";
        echo "<tr style=\"background-color:#336666;
   text-align:center; color:white;\"><td><b>CI</b></td><td><b>Nombre</b></td><td><b>Paterno</b></td><td><b>Materno</b></td><td style=\"width:15%;\"></td></tr> \n";
        do {
            echo "<tr><td>" . $row["0"] . "</td><td>" . $row["1"] . "</td><td>" . $row["2"] . "</td><td>" . $row["3"] . "</td><td><form action=\"modtrapro1.php\"><input type=\"hidden\" name =\"valor\" value=" . $row["0"] . "> <input type=\"submit\" value=\"Tramites\" style=\"background-color: #66FF33;width:100%;heigth:100%; border-color:#336666;\"></form></td></tr> \n";
        } while ($row = mssql_fetch_array($query, MSSQL_NUM));

        echo "</table> \n";
    } else {
        echo "<script language='JavaScript'>alert('No existen clientes con tramites en proceso');
  location.href='../clear.html';</script>";
    }
    ?>
    <!DOCTYPE html>
    <head><link rel ="stylesheet" href = "../botones.css" type = "text/css"></head>
    <body>
        <section class="botones">
            <a href="../clear.html"  style="text-decoration:none; background-color: #66FF33; color:black; margin-left:45%; border: 2px solid white; ">Salir</a>
        </section>
    </body>
    </html>
    <?php
} else {
    echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../pagina.html';</script>";
}
?>