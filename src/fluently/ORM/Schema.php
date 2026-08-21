<?php

class Schema {
    public static function create(string $tablename, Closure $callback){
        $db = getDBConnection();
        $table = new Table($tablename);
        $callback($table);
        //return $table;
        $columns = [];
        foreach ($table->columns as $column) {
            if ($column instanceof Column) {
                $columns[] = $column->toSQL();
            }
        }
        $columns = implode(",",$columns);
        
        $sql = "CREATE TABLE IF NOT EXISTS $tablename (
            $columns
        )";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }
    
    public static function update(Table $table, Closure $callback) {
        $callback($table);
        return $table;
    }

    public static function dropIfExists(string $table) {
        $db = getDBConnection();
        $table = trim(htmlspecialchars($table));
        $sql = "DROP TABLE IF EXISTS $table";
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }
}