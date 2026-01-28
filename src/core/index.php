<?php
array_shift($argv);
$command = $argv[0] ?? '';

$commands = [
    'make->controller' => 'commands/makeController.php',
    'make->model' => 'commands/makeModel.php',
    'make->view' => 'commands/makeView.php',
    'serve' => 'commands/serve.php'
];


// Verificar si el comando existe
if (!isset($commands[$command])) {
    echo "El Comando '$command' no existe\n";
    exit;
}

// Ejecutar comando
require $commands[$command];