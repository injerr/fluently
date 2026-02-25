<?php

abstract class Model {

    public static function all() {
        $class = static::class;
        $table = self::getTable($class);
        $db = Database::conectar();
        $stmt = $db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    //En proceso
    public static function create(array $params) {
        $class = static::class;
        $db = Database::conectar();
        $values = [];
        
        foreach ($params as $key => $value) {
            $values[] = $value;
        }

        $table = self::getTable($class);
        $fillable = implode(",",self::getFillable($class));

        $placeholders = [];
        foreach (self::getFillable($class) as $key => $value) {
            $placeholders[] = '?';
        }
        $placeholders = implode(", ", $placeholders);
        $sql = "INSERT INTO $table ($fillable) VALUES ($placeholders)";
        $stmt = $db->prepare($sql);
        $stmt->execute($values);
    }

    public static function getTable($class) : string {
        $obj = new ReflectionClass($class);

        if ($obj->hasProperty('table')) {
            $prop = $obj->getProperty('table');
            $table = $prop->getValue();
        } else {
            $table = strtolower($class) . 's';
        }

        return $table;
    }

    //En proceso
    public static function getFillable($class) : array {
        $obj = new ReflectionClass($class);

        if ($obj->hasProperty('fillable')) {
            $prop = $obj->getProperty('fillable');
            $fillable = $prop->getValue();
        }

        return $fillable;
    }
}