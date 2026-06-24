<?php

class Query {
    private string $table;
    private string $orderColumn;
    private string $orderDirection = 'asc';
    private array $wheres = [];
    private string $method = "SELECT";
    private PDO $db;

    public function __construct(?string $table = ''){
        $this->table = $table;
        $this->db = getDBConnection();
    }

    // Este en todo caso deberia ir en utils al igual que httpResponse
    public static function table(string $tablename) {
        $query = new Query($tablename); 
        return $query;
    }

    /**
     * This functions orders the query
     * 
     * @param string $column is the name of the column to order
     * @param string $direction is 'asc' by default and its the direction of the order
     * 
     * @return Query instance
     */
    public function orderBy(string $column, string $direction = 'asc'): Query  {
        $direction = trim(strtolower($direction));
        if ($direction != 'asc' && $direction != 'desc')  {
            throw new Exception('The direction for order is not correct.');
        }
        $this->orderColumn = trim(htmlspecialchars($column));
        $this->orderDirection = $direction;
        return $this;
    }
    
    /**
     * This functions prepares the where condition for the query
     * 
     * @param string $column The name of the column for the conditioning
     * @param string $operator The expression for the where '=' '>' '<=' '!=' etc...
     * @param mixed $value The value of the condition
     * 
     * @return Query Returns the same query with the changes applied
     */
    public function where(string $column, string $operator, mixed $value): Query{
        
        if (is_string($value)) {
            $this->wheres[] = "$column $operator '$value'";
        }else{
            $this->wheres[] = "$column $operator $value";
        }
       
        return $this;
    }
    
    /**
     * This functions executes the Query builded and returns the results in an a array of objects
     * 
     * @param $column By default '*' returns all columns, it can be an string or array of strings of the names of the columns to return
     * @return array $objectlist It returns the object of the sql query once executed 
     */
    public function get($column = '*'): array {
        $query = "";

        if (is_array($column)) {
            $column = implode(",",$column);
        }
        
                
        $order = isset($this->orderColumn) ? "ORDER BY {$this->orderColumn} {$this->orderDirection}" : "";
        $where = $this->wheres != [] ? "WHERE ".implode(",",$this->wheres) : '' ;
        
        $query = "SELECT $column FROM {$this->table} $where $order";
            
        // $query = "{$this->method} * FROM {$this->table}";

        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }

    /**
     * This functions returns the first object of the query created
     * 
     * @param mixed $columns By default '*' returns all columns, it can be an string or array of strings of the names of the columns to return
     * @return stdClass $object Returns the first object or null if doesnt exist
     */
    public function first($columns = '*'): stdClass {
        $query = "";

        if (is_array($columns)) {
            $columns = implode(",",$columns);
        }
        
        $order = isset($this->orderColumn) ? "ORDER BY {$this->orderColumn} {$this->orderDirection}" : "";
        $where = $this->wheres != [] ? "WHERE ".implode(",",$this->wheres) : '' ;
        
        $query = "SELECT $columns FROM {$this->table} $where $order";
            
        // $query = "{$this->method} * FROM {$this->table}";

        $stmt = $this->db->query($query);
        return $stmt->fetch() ?: null;
    }

    public function update(mixed $data, ?int $id = null){
        //TODO
    }

    public function insert(){
        //TODO
    }

    public function insertGetId(mixed $data){
        $tablename = $this->table;
        $values = [];

        $fillable = DB::getTableColumns($tablename); // Returns the fillable if exists
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
        $stmt = $this->db->prepare($sql);
        $stmt->execute($insertValues);
        return $this->db->lastInsertId();
    }

    /**
     * This function returns all the objects of the model (it can only be called from a model like User::all()
     * 
     * @param mixed $column By default '*' returns all columns, it can be an string or array of strings of the names of the columns to return
     */
    public function all(mixed $column = '*') {
        return $this->get($column);
    }

}