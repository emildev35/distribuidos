<?php

include_once __DIR__.'/app/util/Encrypter.php';


$text = "kim funciona!!! pd. Puedes ir por jawitas";
echo $text ."<br>";

$texto_encriptado = Encrypter::encrypt($text);
echo $texto_encriptado . "<br>";

$texto_desencriptado = Encrypter::decrypt($texto_encriptado);

echo $texto_desencriptado;

