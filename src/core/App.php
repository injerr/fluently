<?php
require_once './src/fluently/Request.php';
class App{
    public function run(){
        session_start();
        $request = new Request(); 
        
        require_once './web.php';
        Route::resolve($request);
        
    }
}
