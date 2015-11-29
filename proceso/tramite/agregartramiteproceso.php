<?php
/**
 * Verificar la Session
 */
session_start();
if (!empty($_SESSION["usuario"])) { //verifica si la variable de sesion no esta vacia
    include '../class_conexion.php';
    $query = mysql_query("select distinct ci_cli,nombre,paterno,materno from cliente order by paterno ASC") or die("Error SQL");
    if ($row = mysql_fetch_array($query, MYSQL_NUM)) {
        echo "<table border = '1' style=\"border-collapse:collapse;width:100%;\"> \n";
        echo "<tr style=\"background-color:black;
        text-align:center; color:white;\"><td><b>CI</b></td><td><b>Nombre</b></td><td><b>Paterno</b></td><td><b>Materno</b></td><td style=\"width:15%;\"></td></tr> \n";
        do {
            echo "<tr><td>" . $row["0"] . "</td><td>" . $row["1"] . "</td><td>" . $row["2"] . "</td><td>" . $row["3"] . "</td><td><form action=\"agtrapro1.php\"><input type=\"hidden\" name =\"valor\" value=" . $row["0"] . "> <input type=\"submit\" value=\"Seleccionar\" style=\"background-color: black;color:white;width:100%;heigth:100%; border-color:#336666;\"></form></td></tr> \n";
        } while ($row = mysql_fetch_array($query, MYSQL_NUM));

        echo "</table> \n";
    } else {
        echo "<script language='JavaScript'>alert('No existen clientes registrados');
        location.href='../clear.html';</script>";
    }
?>
    <!DOCTYPE html>
    <head><link rel ="stylesheet" href = "../botones.css" type = "text/css"></head>
    <body>
        <section class="botones">
            <a href="../clear.html"  style="text-decoration:none; background-color: lightgray; color:black; margin-left:45%; border: 2px solid white; ">Salir</a>
        </section>

    </body>
    </html>
<?php
} else {
    echo "<script language='JavaScript'>alert('Debe iniciar sesion');
    location.href='../index.html';</script>";
}
?>
