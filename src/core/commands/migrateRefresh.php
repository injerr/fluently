<?php

//If the --model is written
$flags = [];
$model = "";
array_shift($argv);
foreach ($argv as $arg) {
    if (str_contains('--model=',$arg)) {
        $model = str_replace('--model=','',$arg);
    }
    if (str_contains($arg,"--")) {
        $flags[] = $arg;
    }else{
        echo "La flag $arg no existe.\n";
        echo "Cerrando la ejecución de migración.\n";
        return;
    }
}


$migrations = glob("database/*.php");

foreach ($migrations as $migration) {
    if (isset($model) && !str_contains($migration, $model)) {
        continue;
    }

    $object = require_once $migration;
    $object->down();
    $object->up();

    if (isset($model)) {
        return;
    }
}