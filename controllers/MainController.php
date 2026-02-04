<?php
require_once 'config/Database.php';
require_once 'controllers/Controller.php';

class MainController extends Controller{
    protected PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
        // Controllers
    }

    public function home() {
        view('./views/index.php');
    }

    public function random() {
        view('./views/random.php');
    }

    public function redirect() {
        redirect('/random');
    }

    public function err404(){
        view('./views/comps/404/404.php');
    }

}