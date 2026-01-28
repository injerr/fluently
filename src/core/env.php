<?php
$envdir = "./.env";
$env = file($envdir, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($env as $linea) {

    if (!str_contains($linea, '=')) continue;

    $linea=trim($linea);
    [$key, $value] = explode("=", $linea, 2);

    $_ENV[$key] = $value;
    putenv("$key=$value");
}