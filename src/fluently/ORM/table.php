<?php

class Table {

    public static mixed $commands = [];

    public static function table(string $name, stdClass $table){
        //TODO
        $db = getDBConnection();
    }

    public static function id(string $name) {
        return "CREATE TABLE $name";
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
}