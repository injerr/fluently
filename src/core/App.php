<?php
require_once './controllers/MainController.php';

class App{
    public function run(){
        $mainController = new MainController();
        $mainController->handleRequest();
    }
}
