<?php

class App{
    public function run(){
        session_start();
        require_once './web.php';
    }
}
