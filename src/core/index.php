<?php
require_once './src/utils/helpers.php';
require_once './config/Database.php';
require_once './src/fluently/Request.php';
require_once './src/fluently/Response.php';
require_once './src/fluently/ViewEngine.php';
require_once './src/fluently/ORM/Query.php';
require_once './src/fluently/ORM/DB.php';
require_once './src/fluently/ORM/Schema.php';
require_once './src/fluently/ORM/Table.php';
require_once './src/fluently/ORM/Column.php';

array_shift($argv);
$command = $argv[0] ?? '';

$commands = [
    'make->controller' => 'commands/makeController.php',
    'make->model' => 'commands/makeModel.php',
    'make->view' => 'commands/makeView.php',
    'make->migration' => 'commands/makeMigration.php',
    'migrate' => 'commands/migrate.php',
    'migrate->refresh' => 'commands/migrateRefresh.php',
    'serve' => 'commands/serve.php'
];


// Verificar si el comando existe
if (!isset($commands[$command])) {
    echo "El Comando '$command' no existe\n";
    exit;
}

// Ejecutar comando
require $commands[$command];