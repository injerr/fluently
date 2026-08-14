<?php

class Table {
    public string $table;
    public string $primaryKey;
    public array $columns;
    public static mixed $commands = [];

    public function __construct(string $table, string $primaryKey = 'id'){
        $this->table = $primaryKey;
        $this->table = $table;
    }

    public function id() {
        // $this->commands[] = new Column('id','BIGINT UNSIGNED');
        // $sql = 'BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY';
        $col = new Column('id',"BIGINT UNSIGNED");
        $col->unique()->primary()->autoIncrement();
        $this->columns[] = $col;
        return $col;
    }

    public function string(string $name,int $length = 255){
        $col = new Column($name,"string",$length);
        $this->columns[] = $col;
        return $col;
    }

    public function integer(string $name){
        $col = new Column($name,"int");
        $this->columns[] = $col;
        return $col;
    }

    public function decimal(string $name, int $literal,int $decimal){
        if ($literal < $decimal) {
            throw new Exception("Literal can't be lower than decimal part");
        }
        $col = new Column($name,"float");
        $col->numberLength = "$literal,$decimal";
        $this->columns[] = $col;
        return $col;
    }

    public function foreign(string $name){
        $col = new Column($name,'');
        $col->foreign = true;
        $this->columns[] = $col;
        return $col;
    }
    /**
     *      Schema::create('categories', function (Blueprint $table) {
     *          $table->id();
     *          $table->string('name');
     *          $table->string('icon')->nullable();
     *          $table->string('color')->default('#f3f4f6')->nullable();
     *          $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
     *          $table->timestamps();
     *      });
     */
}