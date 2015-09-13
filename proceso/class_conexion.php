<?php
$seg_inac=50;// Esta variable se usa para el chat, son 50 segundos que si el usuario no hace nada, se lo considera inactivo 
$user_name="root";// nombre del servidor
$pass_word="tallersistemas1";// almacena la contraseña
$database="taller";// nombre de la base de datos a conectar
$server="127.0.0.1"; // es el localhost
$conexion = mysql_connect($server, $user_name, $pass_word);
 // realiza la coneccion
$db_found = mysql_select_db($database,$conexion);// Busca la base de datos
?>