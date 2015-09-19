<?php
$p_clase = $_GET["clase"];
$p_metodo = $_GET["metodo"];

$clase_instancia = new $p_clase();

$resultado = $clase_instancia->$p_metodo();
echo json_encode($resultado);

