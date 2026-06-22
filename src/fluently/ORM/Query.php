<?php

class Query {
    private string $table;
    private string $orderColumn;
    private string $orderDirection = 'asc';
    private array $wheres = [];
    private string $method = "SELECT";
    private PDO $db;

    public function __construct(string $table){
        $this->table = $table;
        $this->db = getDBConnection();
    }

    // Este en todo caso deberia ir en utils al igual que httpResponse
    public static function table(string $tablename) {
        $query = new Query($tablename); 
        return $query;
    }

    public function orderBy(string $column, string $direction = 'asc'): Query  {
        $direction = trim(strtolower($direction));
        if ($direction != 'asc' && $direction != 'desc')  {
            throw new Exception('The direction for order is not correct.');
        }
        $this->orderColumn = trim(htmlspecialchars($column));
        $this->orderDirection = $direction;
        return $this;
    }

    public function where($column,$expression,$value){
        
        if (is_string($value)) {
            $this->wheres[] = "$column $expression '$value'";
        }else{
            $this->wheres[] = "$column $expression $value";
        }
       
        return $this;
    }
    
    // Funcion que ejecutara en base al method y las variables
    public function get($column = '*') {
        $query = "";

        if (is_array($column)) {
            $column = implode(",",$column);
        }
        
        switch ($this->method) {
            case 'SELECT':
                
                $order = isset($this->orderColumn) ? "ORDER BY {$this->orderColumn} {$this->orderDirection}" : "";
                $where = $this->wheres != [] ? "WHERE ".implode(",",$this->wheres) : '' ;
                
                $query = "SELECT $column FROM {$this->table} $where $order";
                // print_r($query);
                break;
            
            case 'UPDATE':
                break;
            
            default:
                $query = "SELECT $column FROM {$this->table}";
                break;
        }
        // $query = "{$this->method} * FROM {$this->table}";

        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }

}