<?php

class Router {
    protected $route;
    
    public function __construct() {
        $this->route = isset($_GET['r']) ? $_GET['r'] : 'home';
        
            $controller = new ViewController();
            switch ($this->route) {
                case 'home':
                    $controller->load_view('home');
                    break;
                case 'pokedex':
                    $controller->load_view('pokedex');
                    break;
                case 'poke-info':
                    $controller->load_view('poke-info');
                    break;
                case 'poke-info-db':
                    $controller->load_view('poke-info-db');
                    break;
                case 'pokedex-add':
                    $controller->load_view('pokedex-add');
                    break;
                default:
                    $controller->load_view('Error404');
                    break;
        }
    }
}

?>