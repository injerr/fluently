<?php

class Schema {
    public static function create(string $tablename, Closure $callback) {
        $table = new Table($tablename);
        $callback($table);
        return $table;
    }
    
    public static function update(Table $table, Closure $callback) {
        $callback($table);
        return $table;
    }
}