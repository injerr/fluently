<?php
require_once 'config/Database.php';
require_once 'controllers/Controller.php';

class MainController extends Controller{
    protected PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
        // Controllers
    }

    public function apitesting($id = null){
        view('apitesting',compact('id'));
    }

    public function home() {
        view('index');
    }

    public function random($some = null) {
        view('random',compact('some'));
    }

    public function redirect() {
        redirect('/random');
    }

    public function err404(){
        view('comps.404.404');
    }

}