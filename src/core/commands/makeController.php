<?php

$dir = "controllers/{$argv[1]}.php";

if (!file_exists($dir)) {
    echo "Creando el controlador...\n";
    $model_name = ucwords(str_replace("Controller","",$argv[1]));

$php = <<<PHP
<?php
require_once 'models/$model_name.php';
require_once 'Controller.php';

class {$argv[1]} extends Controller{
    private $model_name \$modelo;

    public function __construct(PDO \$db) {
        \$this->modelo = new $model_name(\$db);
    }

    public function mostrarLista() {
        //
    }

    public function mostrarFormulario(\$id = null) {
        //
    }

    public function procesar() {
        if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
            //
        }
    }

    public function borrar(\$id) {
        //
    }
}
PHP;

    $result = file_put_contents($dir,$php);
    if ($result) {
        echo "Controlador creado correctamente.\n";
    }else{
        echo "Ha habido algun error extraño.\n";
    }

}else{
    echo $dir."\n";
    echo "Ya existe";
}