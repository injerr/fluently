<?php

class Route {
    public static $matched = false;

    public static function get($path,$callback){

        //Si ya ha habido match en la ruta devolvemos
        if (self::$matched) return;

        //Extraer todas los segmentos de la url
        [$params,$path] = self::matchRoute($path);
 
        //Comprobación de variables tipo {id}
        if ($_SERVER['REQUEST_URI'] == $path || $_SERVER['REQUEST_URI'] == $path."/") {

            if (self::handleCallback($callback)) return;

            $class = $callback[0];
            $method = $callback[1];

            if (class_exists($class)) {
                //Obtengo el metodo y sus parametros
                $metodo = new ReflectionMethod($class, $method);
                $parametros = $metodo->getParameters();

                //Ordenamos los parametros antes de ejecutarlos
                $args = [];
                foreach ($parametros as $param) {
                    $paramName = $param->getName();
                    if (isset($params[$paramName])) {
                        $args[] = $params[$paramName];
                    } elseif ($param->isOptional()) {
                        $args[] = $param->getDefaultValue();
                    } else {
                        throw new Exception("Falta el parámetro obligatorio: $paramName");
                    }
                }

                // Ejecutar el método con los argumentos ordenados
                $instancia = new $class();
                $metodo->invokeArgs($instancia, $args);
                unset($instancia);

                self::$matched = true;
                exit;
            }
            
        }
    }

    public static function fallback($callback){
        if (!self::$matched) {
            if (self::handleCallback($callback)) return;

            if (class_exists($callback[0])) {
                $method = $callback[1];
                $ob = new $callback[0];
                $ob->$method();
                unset($ob);
                exit;
            }
        }
    }

    public static function handleCallback($callback) {
        if (is_callable($callback)) {
            $res = $callback();
            if ($res != null) {
                echo json_encode($res);
            }
            
            self::$matched = true;
            return true;
        }

        return false;
    }

    public static function matchRoute($path) {
        $params = [];
        $requestSegments = explode("/",$_SERVER['REQUEST_URI']);
        $segments = explode("/",$path);

        if (count($segments) !== count($requestSegments)) {
            self::$matched = false;
            return;
        }

        foreach ($segments as $i => $segment) {
            if (str_starts_with($segment,"{") & str_ends_with($segment,"}")){
                $keyname = str_replace(["{","}"],"",$segment);
                $segments[$i] = $requestSegments[$i];
                $params[$keyname] = $segments[$i];
            }
        }
        $path = implode("/",$segments);
        $_SERVER['REQUEST_URI'] = implode("/",$requestSegments);
        return [$params,$path];
    }
}

