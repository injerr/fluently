<?php

class Column {
    public string $name;
    public string $type;
    public ?int $length = null;
    public ?string $numberLength;
    public bool $nullable = false;
    public bool $unique;
    public bool $unsigned;
    public bool $primary;
    public bool $foreign;
    public string $references;
    public string $onTable;
    public bool $ai;
    public bool $cascadeOnDelete;
    public bool $nullOnDelete;
    public bool $cascadeOnUpdate;
    public bool $nullOnUpdate;
    //constrains

    public function __construct(string $name, ?string $type = null, ?int $length = null){
        $this->name = $name;
        $this->type = $type;
        $this->length = $length;
    }
    
    public function unique(){
        $this->unique = true;
        return $this;
    }
    
    public function primary(){
        $this->primary = true;
        return $this;
    }

    public function autoIncrement(){
        $this->ai = true;
        return $this;
    }
    
    public function nullable(){
        $this->nullable = true;
        return $this;
    }
    
    public function unsigned(){
        $this->unsigned = true;
        return $this;
    }

    public function references(string $columnName){
        $this->references = $columnName;
        return $this;
    }

    public function on(string $tablename){
        $this->onTable = $tablename;
        return $this;
    }
    public function cascadeOnDelete(){
        $this->cascadeOnDelete = true;
        return $this;
    }

    public function nullOnDelete(){
        $this->nullOnDelete = true;
        return $this;
    }

    public function cascadeOnUpdate(){
        $this->cascadeOnUpdate = true;
        return $this;
    }

    public function nullOnUpdate(){
        $this->nullOnUpdate = true;
        return $this;
    }

    public function toSQL(){
        $nullable = isset($this->nullable) && $this->nullable == false ? "NOT NULL" : "";
        $unique = isset($this->unique) && $this->unique == true ? "UNIQUE" : "";
        $primary = isset($this->primary) && $this->primary == true ? "PRIMARY KEY" : "";
        $unsigned = isset($this->unsigned) && $this->unsigned == true ? "UNSIGNED" : "";
        $ai = isset($this->ai) && $this->ai == true ? "AUTO_INCREMENT" : "";

        $references = "";
        $type = "";
        $length = null;

        switch ($this->type) {
            case 'string':
                $type = "VARCHAR";
                $length = "({$this->length})";
                break;
            case 'int':
                $type = "INT";
                break;
            case 'bigint':
                $type = "BIGINT";
                break;
            case 'float':
                $type = "FLOAT";
                $length = "({$this->numberLength})";
                break;
            case 'double':
                $type = "DOUBLE";
                $length = "({$this->numberLength})";
                break;
            
            default:
                $type = "VARCHAR(255)";
                break;
        }

        if (isset($this->foreign) && $this->foreign) {
            $db = Database::conectar();
            $sql = "
                SELECT COLUMN_TYPE
                FROM INFORMATION_SCHEMA.COLUMNS
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = :table
                AND COLUMN_NAME = :column
            ";

            $stmt = $db->prepare($sql);

            $stmt->execute([
                'table' => $this->onTable,
                'column' => $this->references
            ]);

            $type = $stmt->fetchColumn();
            $opts = ""; //CREAR SISTEMA ON DELETE CASCADE ETC...
            $references = "REFERENCES {$this->onTable}({$this->references}) $opts";
        }

        if ( (isset($this->primary) && $this->primary) || (isset($this->foreign) && $this->foreign)) {
            $nullable = "";
        }
        return preg_replace('/\s+/', ' ', trim("{$this->name} $type$length $unsigned $ai $primary $references $nullable $unique"));
    }
}