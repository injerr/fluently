<?php
require_once './src/fluently/Request.php';
class Route {
    public static $matched = false;
    public static $routes = [];

    // public static function get($path,$callback){

    //     //Si ya ha habido match en la ruta devolvemos
    //     if (self::$matched) return;
    //     if ($_SERVER['REQUEST_METHOD'] !== "GET") return;

    //     //Extraer todas los segmentos de la url
    //     [$params,$path] = self::matchRoute($path);
 
    //     //Comprobación de variables tipo {id}
    //     if ($_SERVER['REQUEST_URI'] == $path || $_SERVER['REQUEST_URI'] == $path."/") {

    //         if (self::handleCallback($callback)) return;

    //         $class = $callback[0];
    //         $method = $callback[1];

    //         if (class_exists($class)) {
    //             //Obtengo el metodo y sus parametros
    //             $metodo = new ReflectionMethod($class, $method);
    //             $parametros = $metodo->getParameters();

    //             //Ordenamos los parametros antes de ejecutarlos
    //             $args = [];
    //             foreach ($parametros as $param) {
    //                 $paramName = $param->getName();
    //                 if (isset($params[$paramName])) {
    //                     $args[] = $params[$paramName];
    //                 } elseif ($param->isOptional()) {
    //                     $args[] = $param->getDefaultValue();
    //                 } else {
    //                     throw new Exception("Falta el parámetro obligatorio: $paramName");
    //                 }
    //             }

    //             // Ejecutar el método con los argumentos ordenados
    //             $instancia = new $class();
    //             $metodo->invokeArgs($instancia, $args);
    //             unset($instancia);

    //             self::$matched = true;
    //             exit;
    //         }
            
    //     }
    // }

    public static function get($path,$callback){
        self::$routes["GET"][$path] = $callback;
    }

    public static function post($path,$callback){
        self::$routes["POST"][$path] = $callback;
    }
    public static function put($path,$callback){
        self::$routes["PUT"][$path] = $callback;
    }

    public static function delete($path,$callback){
        self::$routes["DELETE"][$path] = $callback;
    }
    public static function resolve(Request $request){
        $method = $request->method();
        $requestPath = $request->requestUri();
        // $callback = self::$routes[$method][$requestPath] ?? null;
        // if ($callback != null) {
        //     self::handleClassMethod($callback[0],$callback[1],self::getParams($request->requestUri()));
        // }
        $matched = false;
        foreach (self::$routes[$method] as $routePath => $callback) {

            if(self::match($routePath,$requestPath)){
                $params = self::getParams($routePath,$request->requestUri());
                if (is_callable($callback)) {
                    self::handleCallback($callback);
                    $matched = true;
                    break;
                }
                if (class_exists($callback[0])) {
                    self::handleClassMethod($callback[0],$callback[1],$params);
                    $matched = true; 
                    break;
                }
                break;
            }
        }

        if (!$matched) {
            if (isset(self::$routes["FALLBACK"])) {
                $callback = self::$routes["FALLBACK"];
                $params = self::getParams($routePath,$request->requestUri());
                if (is_callable($callback)) {
                    self::handleCallback($callback);

                }else if (class_exists($callback[0])) {
                    self::handleClassMethod($callback[0],$callback[1],$params);
                }
            }else{
                view('./src/utils/default404.php');
            }
        }
    }

    public static function match($routePath,$path): bool{
        $match = true;
        if ($routePath === $path) { return $match; }
        $segments =  explode("/",$routePath);
        $requestSegments = explode("/",$path);

        $requestSegments = array_filter($requestSegments, function ($value) {
            return $value !== "";
        });

        $segments = array_filter($segments, function ($value) {
            return $value !== "";
        });

        if (count($segments) !== count($requestSegments)) {
            $match = false;
        }
        foreach ($segments as $i => $segment) {
            if (!str_contains($segment,"{") && $segment !== $requestSegments[$i]) {
                $match = false;
            }
        }
        return $match;
    }

    public static function fallback($callback) {
        self::$routes["FALLBACK"] = $callback;
    }

    public static function handleClassMethod($class,$method,$params) {
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
    
    public static function getParams($path,$requestPath) {
        $params = [];
        $requestSegments = explode("/",$requestPath);
        $segments = explode("/",$path);
        $segments = array_filter($segments, function ($value) {
            return $value !== "";
        });
        $requestSegments = array_filter($requestSegments, function ($value) {
            return $value !== "";
        });

        foreach ($segments as $i => $segment) {
            if (str_starts_with($segment,"{") & str_ends_with($segment,"}")){
                $keyname = str_replace(["{","}"],"",$segment);
                $segments[$i] = $requestSegments[$i];
                $params[$keyname] = $segments[$i];
            }
        }
        return $params;
    }

}