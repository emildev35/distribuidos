<?php
$p_clase = $_GET["clase"];
$p_metodo = $_GET["metodo"];
$p_modulo = $_GET["modulo"];

include_once __DIR__.'/../db/'. $p_modulo.'/'.$p_clase.'.php';

$clase_instancia = new $p_clase();

$resultado = $clase_instancia->$p_metodo();
echo json_encode($resultado);

