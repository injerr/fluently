<?php

abstract class Model {
    protected static string $primaryKey = 'id';
    protected static string $table;
    protected static array $fillable;

    public static function all() {
        $table = self::getTable();
        $db = Database::conectar();
        
        $stmt = $db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    public static function create(array $data){
        $tablename = self::getTable();
        $db = Database::conectar(); // we get the connection with the database
        $values = [];

        $fillable = self::getFillable(); // Returns the fillable if exists
        foreach ($fillable as $column) { // sorting the values
            if ($data[$column] == null) { continue; };
            $values[$column] = $data[$column];
        }

        // TO DO Verificaciones required, tipos, etc...
        $placeholders = [];
        foreach ($values as $column => $value) {
            $placeholders[] = '?';
        }

        $columns = implode(',',array_keys($values));
        $insertValues = array_values($values);
        $placeholders = implode(", ", $placeholders);

        $sql = "INSERT INTO $tablename ($columns) VALUES ($placeholders)";
        $stmt = $db->prepare($sql);
        $stmt->execute($insertValues);
    }

    public static function find($id) {
        $table = static::$table;
        $primaryKey = static::$primaryKey;
        $db = Database::conectar();

        $sql = "SELECT * FROM $table WHERE $primaryKey = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * This function returns the tablename of the class given
     * 
     * @return string $tablename;
     */
    public static function getTable() : string {
        $class = static::class;
        return static::$table ?? strtolower($class) . 's';
    }

    /**
     * This function returns the fillable columns of the class/model given
     * 
     * @return array $fillable;
     */
    public static function getFillable() : array {
        return static::$fillable ?? [];
    }

    /**
     * This function returns the primary key  of the class/model given
     * 
     * @return string $primaryKey;
     */
    public function getPrimaryKey() : string {
        return static::$primaryKey ?? 'id';
    }
}