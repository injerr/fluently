<?php

// $dir = "database/{$argv[1]}.php";
$date = date("Y_m_d_hms");
$table = str_replace("--model=",'',strtolower($argv[1]));
$dir = "database/{$date}_create_{$table}_table.php";

if (!file_exists($dir)) {
    if (empty($argv[1])) {
        echo "Debes especificar el modelo con --model...\n";
        return;
    }
    
    echo "Creando el archivo de migración...\n";
    
$php = <<<PHP
<?php

return new class
{
    /**
     * Create the migrations
     */
    public function up(): void
    {
        Schema::create('$table', function (Table \$table) {

        });

    }

    /**
     * Delete the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('$table');
    }
};

PHP;

    $result = file_put_contents($dir,$php);
    if ($result) {
        echo "Archivo de migración creado correctamente.\n";
    }else{
        echo "Ha habido algun error extraño.\n";
    }

}else{
    echo $dir."\n";
    echo "Ya existe";
}