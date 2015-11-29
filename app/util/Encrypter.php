<?php

/**
 * Clase de Apoyo para la Encripcion de la Contraseña
 *
 * @package default
 * @subpackage default
 * @author yourname
 */
class Encrypter
{
    private static $Key = "KI-VASQ-IM";

    /**
     * encrypt
     * @return void
     * @author yourname
     **/
    public static function encrypt($input)
    {
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256 , md5(Encrypter::$Key), $input, MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))));
        return $output;

    }
    public static function decrypt ($input) {
        $output = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(Encrypter::$Key), base64_decode($input), MCRYPT_MODE_CBC, md5(md5(Encrypter::$Key))), "\0");
        return $output;
    }

} // END class Encrypt
