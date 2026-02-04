<?php
require_once './controllers/MainController.php';

class App{
    public function run(){
        session_start();
        require_once './Route.php';
    }
}
