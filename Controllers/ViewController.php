<?php 

    class ViewController {
        private static $view_path = './Views/';
        private static $view_path_error = './Views/Errors/';

        public function load_view($view) {
           if($view == 'home') {
            require_once(self::$view_path . $view . '.php');
           } else if ($view == 'Error403' || $view == 'Error404') {
            require_once(self::$view_path_error . $view . '.php');
           } else {
            require_once(self::$view_path . 'header.php');
            require_once(self::$view_path . $view . '.php');
            require_once(self::$view_path . 'footer.php');
           }
            
            
        }

        public function __destruct() {

        }
    }

?>