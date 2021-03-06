<?php

/**
 * Clase encargada de la gestion del Middleware
 * tiene los metodos send, recive, produce, consume
 *
 * @author franzemil
 */
class Middleware {

    var $module;
    var $entity;
    var $action;
    var $params;
    var $result;
    var $file;

    /**
     * @param mixed $module
     * @param mixed $entity
     * @param mixed $action
     * @param mixed $params=null|
     */
    public function __construct($module, $entity, $action, $params=null)
    {
        $this->module = $module;
        $this->entity = $entity;
        $this->action = $action;
    }
    

    /**
     * Envia Mensaje mediante el produce
     *
     * @return void
     * @author yourname
     */
    function send($params) {
        $this->produce($params);
        include_once __DIR__.'/util/Encrypter.php';
        return Encrypter::encrypt(json_encode($this->result));
    }

    /**
     * Recive el Mensage y utiliza 
     * cosume para la lectura
     *
     * @return message
     * @author franzemil
     */
    function receive($params){

    }
    /**
     * Se crea el mensanje
     *
     * @return message
     * @author franzemil
     */
    function produce($params) {
        $this->file = __DIR__.'/../db/'. $this->module.'/'.$this->entity.'.php';
        if(is_file($this->file)){
            include_once $this->file;
            $clase_instancia = new $this->entity();
            $metodo = $this->action;
            $this->result = $clase_instancia->$metodo(...$params);

        }else{
            $this->result = array("result" => "Accion Desconocida");
        }
    }
    /**
     * Desencripta el mensaje 
     *
     * @return message
     * @author franzemil
     */
    function consume($params) {
    }
}
