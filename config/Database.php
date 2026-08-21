<?php
require_once "./src/core/env.php";

class Database {
    private static ?PDO $connection = null;

    public static function conectar(): PDO {
        if (self::$connection != null) {
            return self::$connection;
        }
        try {
            $dsn = $_ENV['DB_CONNECTION'].":host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'].";charset=utf8mb4";
                self::$connection = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //PDO::FETCH_OBJ hace que el fetch devuelva siempre objeto el dato como objeto
                PDO::ATTR_EMULATE_PREPARES => false
            ]);

            return self::$connection;
        } catch (PDOException $e) {
            //die("Error de conexión: " . $e->getMessage());
            throw new Error("Error de conexión: " . $e->getMessage());
        }
    }
}