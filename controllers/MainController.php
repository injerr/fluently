<?php
require_once 'config/Database.php';
require_once 'controllers/Controller.php';

class MainController extends Controller{
    protected PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
        // Controllers
    }

    public function handleRequest(){
        $option = $_GET['option'] ?? 'index';

        match($option){
            'index' => view('./views/index.php'),
            default => view('./views/comps/404/404.php')
        };
    }

}