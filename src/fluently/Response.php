<?php

class Response{
    public function __construct(){

    }

    public static function json(mixed $data){
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

