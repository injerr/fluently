<?php
class DB {
    public static function getTableColumns(string $table){
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$_ENV['DB_NAME']."' AND TABLE_NAME = '".$table."'";
        return getDBConnection()->query($query)->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function raw(string $rawSQL) : string {
        return $rawSQL;        
    }
}