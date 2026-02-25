<?php
require_once 'models/User.php';
require_once 'Controller.php';

class UserController extends Controller{
    private User $modelo;
    private PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
        $this->modelo = new User($this->db);
    }

    public function create() {
        User::create([
            'id' => null,
            'user' => 'Jeremy',
            'password' => 'Jeremy'
        ]);
        view('./views/index.php');
    }

    public function mostrarLista() {
        //
    }

    public function mostrarFormulario($id = null) {
        //
    }

    public function procesar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //
        }
    }

    public function borrar($id) {
        //
    }
}