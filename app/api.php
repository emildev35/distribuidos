<?php
$p_clase = $_GET["clase"];
$p_metodo = $_GET["metodo"];
$p_modulo = $_GET["modulo"];


include_once __DIR__.'/Middleware.php';

$middleware = new Middleware($p_modulo, $p_clase, $p_metodo);
$middleware->send(5);



