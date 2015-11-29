<?php
session_start(); // inicia sesion
if (!empty($_SESSION["usuario"])) { //verifica si la variable de sesion no esta vacia
    include '../class_conexion.php';

    $menus = mysql_query("select distinct ti.id_tipo, ti.descripcion from tipo as ti,tramites as  t, paso as p where ti.id_tipo=t.id_tipo and p.id_tramite=t.id_tramite") or
            die("Error SQL");

    if (!mysql_num_rows($menus)) {
        echo "
        <script language='JavaScript'>
            alert('No existen tramites con pasos registrados');
            location.href='../clear.html';
        </script>";
    } else {
        ?>
        <html>
            <head>
                <link rel ="stylesheet" href = "../botones.css" type = "text/css">
                <link rel ="stylesheet" href = "../seguridad/agperfil.css" type = "text/css">
                <title>Agregar Persona</title>
                <script type="text/javascript">
                    function volver()
                    {
                        history.back();
                    }
                </script>
            </head>
            <body>
                <section class="contenido">
                    <form action="agtrapro2.php" method="post">
                        <section class="datos">
                            * Campos con asterisco son obligatorios
                            <h2 align="center">INICIAR TRAMITE</h2>
                            <input type="hidden" name ="valor" value="<?php echo $_REQUEST['valor']; ?>">
                            <h3>Seleccione el tramite que realizara el cliente</h3>
                            <div id="header">
                                <ul class="nav">
                                    <?php
                                    while ($fila = mysql_fetch_array($menus, MYSQL_NUM)) {
                                        $id_menu = $fila[0];
                                        ?>
                                        <li class="menu">
                                            <label><?php echo $fila[1]; ?></label>
                                            <?php
                                            $submenus = mysql_query("select distinct t.id_tramite, t.nombre FROM tramites as t, paso as p WHERE id_tipo='$id_menu' and p.id_tramite=t.id_tramite");

                                            if (!mysql_num_rows($submenus)) {
                                                
                                            } else {
                                                ?>
                                                <ul>
                                                    <?php
                                                    while ($fila_submenu = mysql_fetch_array($submenus, MYSQL_NUM)) {
                                                    ?>
                                                        <label><input type='radio' name='tramite' required value="<?php echo $fila_submenu [0]; ?> "/><?php echo $fila_submenu[1]; ?></label><br>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php } ?>
                                        </li>
                                        <?php } ?>
                                </ul>
                            </div> 
                        </section>
                        <section class="botones">
                            <input  class="pri" type="submit" value="Registrar">
                            <a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Salir</a>
                            <a href="javascript:volver()" style="text-decoration:none; background-color: lightgray; color:black; margin-left:20px;margin-right:20px;border: 2px solid white; ">Volver</a>
                            <input type="reset" value="Limpiar Datos">
                        </section>
                    </form>
            </body>
        </html>
        <?php
    }
} else {
    echo "<script language='JavaScript'>alert('Debe iniciar sesion');
  location.href='../index.html';</script>";
}
?>