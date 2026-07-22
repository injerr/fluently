<?php

class Request {
    public string $method;
    
    public function __construct(){
        $this->method = self::method();
    }

    public static function method(){
        return strtoupper($_SERVER['REQUEST_METHOD']) ?? strtoupper($_POST['_method']);
    }

    public static function input(string $name) : mixed {
        $body = self::body();
        return $_POST[$name] ?? $body[$name] ?? null;
    }

    public static function header($input = 'all') : mixed {
        $headers = getallheaders();
        if ($input == 'all') {
            return $headers;
        }else {
            return isset($headers[$input]) ? $headers[$input] : '';
        }
    }

    public static function body() : mixed {
        return json_decode(file_get_contents('php://input'),true);
    }

    public static function ip() : string {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function requestUri() : string {
        return $_SERVER['REQUEST_URI'];
    }
}