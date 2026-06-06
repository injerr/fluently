<?php

class Response{
    public function __construct(){

    }

    public static function json(mixed $data, ?int $status = 200){
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
    }
}

