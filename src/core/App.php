<?php
require_once './src/utils/helpers.php';
require_once './src/fluently/Request.php';
require_once './src/fluently/Response.php';
require_once './src/fluently/ViewEngine.php';
require_once './src/fluently/ORM/Query.php';
require_once './src/fluently/ORM/DB.php';
require_once './src/fluently/ORM/Schema.php';
require_once './src/fluently/ORM/Table.php';
require_once './src/fluently/ORM/Column.php';

class App{
    public function run(){
        try {
            session_start();
            $request = new Request(); 
            require_once './web.php';
            Route::resolve($request);
        } catch (\Throwable $th) {
            $template = './src/utils/defaultPages/errorShowcase.php';
            echo ViewEngine::render($template,compact('th'));
        }
    }
}
