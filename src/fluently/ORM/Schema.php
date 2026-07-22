<?php

class Schema {
    public static function create($tablename, Closure $callback) {
        
    }
}
/**
 *     Schema::create('categories', function (Blueprint $table) {
 *          $table->id();
 *          $table->string('name');
 *          $table->string('icon')->nullable();
 *          $table->string('color')->default('#f3f4f6')->nullable();
 *          $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
 *          $table->timestamps();
 *      });
 */