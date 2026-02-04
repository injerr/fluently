<?php
$req = false;
class Route {
    public static function get($path,$callback){
        if ($_SERVER['REQUEST_URI'] == $path || $_SERVER['REQUEST_URI'] == $path."/") {

            if (class_exists($callback[0])) {
                $method = $callback[1];
                $ob = new $callback[0];
                $ob->$method();
                unset($ob);
                $req = true;
                exit;
            }else{
                call_user_func($callback);
                exit;
            }
            
        }
    }
}

try {
    require_once('web.php');
    if (!$req) {
        redirect('**');
        require_once('web.php');
    }
} catch (Exception $th) {
    redirect();
}