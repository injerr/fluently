<?php

class Route {
    public static $matched = false;
    public static function get($path,$callback){
        if ($_SERVER['REQUEST_URI'] == $path || $_SERVER['REQUEST_URI'] == $path."/") {

            if (class_exists($callback[0])) {
                $method = $callback[1];
                $ob = new $callback[0];
                $ob->$method();
                unset($ob);
                self::$matched = true;
                exit;
            }else{
                call_user_func($callback);
                exit;
            }
            
        }
    }

    public static function fallback($callback){
        if (self::$matched == false) {
            if (is_callable($callback)) {
                $res = $callback();
                if (is_array($res)) {
                    print_r($res);
                }else{
                    echo $res;
                }
                self::$matched = true;
                return;
            }
            if (class_exists($callback[0])) {
                $method = $callback[1];
                $ob = new $callback[0];
                $ob->$method();
                unset($ob);
                exit;
            }else{
                call_user_func($callback);
                exit;
            }
        }
    }

}