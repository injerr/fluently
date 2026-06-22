<?php

abstract class Model {
    protected static string $primaryKey = 'id';
    protected static string $table;
    protected static array $fillable;

    public static function __callStatic($method, $args){

        $builder = new Query(static::$table);

        return $builder->$method(...$args);
    }

    public static function all() {
        $table = self::getTable();
        $db = getDBConnection();
        
        $stmt = $db->query("SELECT * FROM $table");
        return $stmt->fetchAll();
    }

    public static function create(array $data){
        $tablename = self::getTable();
        $db = getDBConnection(); // we get the connection with the database
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
        return $stmt->execute($insertValues);
    }

    public static function update(mixed $data, int $id){
        // $id = 1; // Need to do a var for an instanced object
        $tablename = self::getTable();
        $primaryKey = self::getPrimaryKey();
        $db = getDBConnection();
        $values = [];

        $fillable = self::getFillable();
        foreach ($fillable as $column) { 
            if (array_key_exists($column,$data)) {
                if ($data[$column] == null) { continue; };
                $values[$column] = $data[$column];
            }else{
                continue;
            }
            
        }

        // TO DO Verificaciones required, tipos, etc...
        // $placeholders = [];
        // foreach ($values as $column => $value) {
        //     $placeholders[] = '?';
        // }
   
        $UPDATEVALUES = []; // format : key = ?,
        foreach ($values as $column => $value) {
            $insertValue = $value;
            if (is_string($value)) {
                $insertValue = "'$value'";
            }
            $UPDATEVALUES[] = $column." = ".$insertValue;
        }
        $updateStream = implode(',', $UPDATEVALUES);
        print_r($updateStream);
        $sql = "UPDATE $tablename SET $updateStream WHERE $primaryKey = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
    }

    public static function destroy(int $id){
        $table = static::$table;
        $primaryKey = static::$primaryKey;
        $db = getDBConnection();

        $sql = "DELETE FROM $table WHERE $primaryKey = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    } 

    public static function find($id) {
        $table = static::$table;
        $primaryKey = static::$primaryKey;
        $db = getDBConnection();

        $sql = "SELECT * FROM $table WHERE $primaryKey = ?";        
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_OBJ);
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
    public static function getPrimaryKey() : string {
        return static::$primaryKey ?? 'id';
    }
}