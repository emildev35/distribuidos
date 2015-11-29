<?php
include 'db/seguridad/Usuario.php';
if(isset($_REQUEST['nick']))// verifica si esta vacio
    {
        $instanciaUsuario = new Usuario();
        $datosUsuario = $instanciaUsuario->verificar_password($_REQUEST['nick'], $_REQUEST['pass']);
        if(count($datosUsuario)!=0)
        {
            session_start();//crea una sesion
            $_SESSION['nombre']=$datosUsuario['nombre']." ".$datosUsuario['apellido_paterno'];
            header("location: principal.php");
        }
        else
        {
            echo "<script language='JavaScript'>alert('Datos Incorrectos');
            location.href='index.php';</script>";
        }
    }
    else
    {
?>
<!DOCTYPE html>
<head>
<title>Log In</title> <!--es lo que aparece en la pestaña-->
</head>
<body >
    * Campos con asterisco son obligatorios
  <h2 align="center">LOG IN</h2>
  <form  action ="index.php" method="post">
                    <h4 > Correo de Usuario </h4>
                    <h1 > <input type="text" title="hola@ejemplo.gob.bo" value=""autofocus required name="nick" size="30" placeholder="hola@ejemplo.gob.bo" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"/> </h1>
                    <h4 > Contraseña </h4>
                    <h1 > <input type="password" required title="Solo numeros, minimo 7"  name="pass" size="30" pattern="[0-9]{7,10}" maxlength="10"/> </h1>
                    <h1 align="center"> <input type="submit" value="Ingresar" name="bot"> </h1>
                </form>
</body>
</html>
<?php
}
?>