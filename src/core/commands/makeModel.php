<?php

$dir = "models/{$argv[1]}.php";

if (!file_exists($dir)) {
    echo "Creando el modelo...\n";
    $model_name = ucwords($argv[1]);
    $table = strtolower($model_name."s");

$php = <<<PHP
<?php
require 'models/Model.php';

class $model_name extends Model {
    public function __construct(private PDO \$db) {}

    public function listar(): array {
        return \$this->db->query("SELECT * FROM $table ORDER BY id DESC")->fetchAll();
    }

    public function obtenerPorId(int \$id): ?array {
        \$stmt = \$this->db->prepare("SELECT * FROM $table WHERE id = ?");
        \$stmt->execute([\$id]);
        return \$stmt->fetch() ?: null;
    }

    public function guardar(?int \$id = null): bool {
        if (\$id) {
            //
            return false;
        }
        //
        return false;
    }

    public function eliminar(int \$id): bool {
        \$stmt = \$this->db->prepare("DELETE FROM $table WHERE id = ?");
        return \$stmt->execute([\$id]);
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
    echo "El modelo ya existe";
}