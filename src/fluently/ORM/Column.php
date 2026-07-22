<?php

class Column {
    public string $name;
    public string $type;
    public string $nullable;
    public string $default;
    //constrains

    public function __construct(){
        throw new \Exception('Not implemented');
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