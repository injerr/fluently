<?php
require_once 'config/Database.php';
require_once 'controllers/Controller.php';

class MainController extends Controller{
    protected PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function handleRequest(){
        $option = $_GET['option'] ?? 'index';
        $action = $_GET['action'] ?? 'listar';
        $id = $_GET['id'] ?? null;

        match($option){
            'index' => view('./views/index.html'),
            default => view('./views/comps/404/404.php')
        };
    }

}