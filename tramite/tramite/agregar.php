<?php
session_start(); // inicia sesion
//if (!empty($_SESSION["usuario"])) { //verifica si la variable de sesion no esta vacia
include '../../db/tramite/Tipo.php';
include '../../db/tramite/Tramite.php';

$select_tipo = new Tipo();
$lista_tipo = $select_tipo->getall();


if (isset ($_POST["registrar"])){
    $add = new Tramite();
    $add->add($_POST["nombre"], $_POST["duracion"], $_POST["tipo"]);
}
$combobit="";
foreach ($lista_tipo as $row2) {
    $combobit .= "<option name='tipo' value ='" . $row2[0] . "'>" . $row2[2] . "</option>";
}
?>
    <html>
    <head>
        <link rel="stylesheet" href="../botones.css" type="text/css">
        <link rel="stylesheet" href="agperfil.css" type="text/css">
        <title>Agregar Tramite</title>
    </head>
    <body>
    * Campos con asterisco son obligatorios
    <h2 align="center">ESPECIFICACIONES TRAMITE</h2>

    <form action="" method="post">
        <h3>Nombre del Tramite:
            <input type="text" name="nombre" pattern="[A-Za-z\s]{3,50}" maxlength="50" required size="50">*</h3>

        <h3>Duracion:
            <input type="number" name="duracion" required min="1">dias *</h3>

        <h3>Tipo de Tramite:
            <select name="tipo">
                <?php echo $combobit; ?>
            </select>* </h3>
        </section>
        <section class="botones">
            <input class="pri" type="submit" value="Registrar" name="registrar">
            <a href="../clear.html"
               style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Salir</a>
            <input type="reset" value="Limpiar Datos">
        </section>
    </form>
    </body>
    </html>
<?php
/*} else {
    echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";
}*/
?>
