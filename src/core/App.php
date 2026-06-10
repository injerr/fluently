<?php
include_once './src/utils/helpers.php';
require_once './src/fluently/Request.php';
require_once './src/fluently/Response.php';
class App{
    public function run(){
        try {
            session_start();
            $request = new Request(); 
            require_once './web.php';
            Route::resolve($request);
        } catch (\Throwable $th) {
            view('./src/utils/defaultPages/errorShowcase.php',compact('th'));
        }
    }
}
