<?php
require_once './controllers/MainController.php';


class App{
    public function run(){
        // $mainController = new MainController();
        // $mainController->handleRequest();
        session_start();
        require_once './web.php';
    }
}
