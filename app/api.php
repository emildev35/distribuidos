<?php
include_once __DIR__.'/Middleware.php';

$url = array_slice(preg_split('/\//',$_GET["_url"]), 1);
$parametros = array_slice($url, 3);

$middleware = new Middleware($url[0], $url[1], $url[2]);

//echo $middleware->send();

//print_r($parametros);
include_once __DIR__.'/util/Encrypter.php';

echo Encrypter::decrypt($middleware->send($parametros));
