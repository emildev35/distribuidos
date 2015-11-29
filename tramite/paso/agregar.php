<?php
/**
 * Created by PhpStorm.
 * User: vasquez
 * Date: 14/09/2015
 * Time: 08:41 PM
 */
/*
session_start(); // inicia sesion
  if (! empty($_SESSION["usuario"])) //verifica si la variable de sesion no esta vacia
{*/
if (!isset($_POST['valor']))// verifica si esta vacio
{
    $procedimiento = 'tramitebytipo_S';
    $metodo=2;
    $titulos = "Codigo,Nombre,Fecha,Duracion,Tipo";
    $campos = 5;
    $destino = "tramite/paso/agregar.php";
    header("Location:../../tabla.php?procedimiento=" . $procedimiento ."& metodo=".$metodo. "& titulos=" . $titulos . "& campos=" . $campos . "& destino=" . $destino);
} else {

    $combobit = "";


    $combobit .= "<option value ='" . 'Recuros Humanos' . "' >".'Recursos Humanos'."</option>";

    $combobit .= "<option value ='" . 'Sistemas'. "'>" . 'Sistemas' . "</option>";



    // Liberar de memoria el resultado de la consulta
?>
<!DOCTYPE html>
<head>
  <link rel ="stylesheet" href = "../botones.css" type = "text/css">
    <script type="text/javascript">
    function volver()
    {
        history.back();
}
</script>
</head>
<body>
  <form method="post" action="">
    * Campos con asterisco son obligatorios
  <h2 align="center">AGREGAR PASO</h2>
    <input type="hidden" name ="valor" value="<?php echo $_POST['valor']; ?>">
    <h3>Nombre:  <input type="text" value="<?php if (isset($_POST['nombre'])) {
        echo $_POST['nombre'];
    } ?>" name="nombre" pattern="[A-Za-z\s]{3,30}" maxlength="30" size="30" required>*</h3>
   <h3>Duracion:<input type="number" name="duracion" min="1" required> horas *</h3>
   <h3>Departamento encargado:
   <select name="dep">
       <?php echo $combobit; ?>
   </select>*</h3>
      <section class="botones">
<input  class="pri" type="submit" value="Registrar" name="registrar">
<?php if (isset ($_POST['registrar'])) {

    //registro del paso
} ?>
<a href="../clear.html" style="text-decoration:none; background-color: lightgray; color:black; margin-left:10px;margin-right:20px;border: 2px solid white; ">Salir</a>
<input type="reset" value="Limpiar Datos">
</section>
   </form>
  </body>
</html>
<?php
}

/* }
 else
 {echo "<script language='JavaScript'>alert('Debe iniciar sesion');
 location.href='../index.html';</script>";}
 */
?>
