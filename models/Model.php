<?php

abstract class Model {

    public static function all() {
        $class = static::class;
        $table = self::getTable($class);
        $db = Database::conectar();
        $stmt = $db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    public static function create(array $data){
        $classname = static::class; // we get the classname
        $tablename = self::getTable();
        $db = Database::conectar(); // we get the conecction with the database
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

    /**
     * This function returns the tablename of the class given
     * 
     * @param $class is the classname of the model we want to get its table
     * @return string $tablename;
     */
    public static function getTable() : string {
        $class = static::class;
        $obj = new ReflectionClass($class);

        if ($obj->hasProperty('table')) {
            $prop = $obj->getProperty('table');
            $tablename = $prop->getValue();
        } else {
            $tablename = strtolower($class) . 's';
        }

        return $tablename;
    }

    //En proceso
    public static function getFillable() : array {
        $obj = new ReflectionClass(static::class);
        $fillable = [];

        if ($obj->hasProperty('fillable')) {
            $prop = $obj->getProperty('fillable');
            $fillable = $prop->getValue();
        }

        return $fillable;
    }
}