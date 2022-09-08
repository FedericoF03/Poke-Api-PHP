<?php 

class Autoload {

    public function __construct() {

        spl_autoload_register(function($class_name){
            $controllers_path = './Controllers/' . $class_name . ".php";
            $Models_path = './Models/' . $class_name . ".php";
            
            if(file_exists($controllers_path)) require_once($controllers_path);
            if(file_exists($Models_path)) require_once($Models_path);
            
        });
    }

    public function __destruct() {

    }
}

?>