<?php
require_once 'models/User.php';
require_once 'Controller.php';

class UserController extends Controller{
    private User $modelo;

    public function __construct(PDO $db) {
        $this->modelo = new User($db);
    }
    
    public function handleRequest(){
        $action = $_GET['action'] ?? 'listar';
        $id = $_GET['id'] ?? null;
        match ($action) {
            'listar'  => $this->mostrarLista(),
            'nuevo'   => $this->mostrarFormulario(),
            'editar'  => $this->mostrarFormulario($id),
            'guardar' => $this->procesar(),
            'eliminar'=> $this->borrar($id),
            default   => $this->mostrarLista(),
        };
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