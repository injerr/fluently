<?php

class Column {
    public string $name;
    public string $type;
    public ?int $length = null;
    public ?string $numberLength;
    public bool $nullable = false;
    public bool $unique;
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
}

    /**
     *          Schema::create('categories', function (Blueprint $table) {
     *          $table->id();
     *          $table->string('name');
     *          $table->string('icon')->nullable();
     *          $table->string('color')->default('#f3f4f6')->nullable();
     *          $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
     *          $table->timestamps();
     *      });
     */