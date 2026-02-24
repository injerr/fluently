<?php

abstract class Model {

    public static function all() {
        $class = static::class;
        $table = self::getTable($class);
        $db = Database::conectar();
        $stmt = $db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
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
}