<?php

$dir = "views/{$argv[1]}.php";
// Extraer la carpeta de la ruta
$folder = dirname($dir);

// Si la carpeta no existe, crearla recursivamente
if (!is_dir($folder)) {
    mkdir($folder, 0775, true); // true = crea carpetas padres si no existen
    echo "Carpeta '$folder' creada.\n";
}

if (!file_exists($dir)) {
    echo "Creando la vista...\n";

$php = <<<PHP
<?php

PHP;

    $result = file_put_contents($dir,$php);
    if ($result) {
        echo "Vista creada correctamente.\n";
    }else{
        echo "Ha habido algun error extraño.\n";
    }

}else{
    echo $dir."\n";
    echo "Ya existe";
}