<?php
require 'models/Model.php';
class User extends Model {

    protected static string $primaryKey = 'id';
    protected static string $table = "users";
    protected static array $fillable = [
        'id',
        'user',
        'password'
    ];

}