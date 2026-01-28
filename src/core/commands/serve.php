<?php

$port = "8000";

if (isset($argv[1]) && str_contains($argv[1],"--port=")) {
    if (preg_match('/^[0-9]{4}$/',$argv[1])) {
        $port = str_replace("--port=","",$argv[1]);
    }else{
        echo "El puerto indicado no es valido.\nUsando el puerto por defecto...\n";
    }
    
}

passthru("php -S localhost:$port -t ./");