<?php

namespace App\Router;

class Route {

    private static $routes = [];

    public static function get(string $uri, callable $action){
        array_push(self::$routes,[
            "uri" => $uri , 
            "action" => $action, 
            "method" => 'get'
        ]);
    }
    public static function post(string $uri, callable $action){
        array_push(self::$routes,[
            "uri" => $uri , 
            "action" => $action, 
            "method" => 'post'
        ]);
    }

    // list of routes defined 
    public static function list():array{
        return array_map(function($el){
            return $el['uri'];
        }, self::$routes);
    }

    public static function run($basePath)
    {
        $uri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        foreach(self::$routes as $route){

            if(preg_match('#^'.$route['uri'].'$#',$uri, $matches) && $route['method'] == $method){
                $result = $route; 
                break;
            }
        }

        // if we find a matching route 
        if(!empty($result)){

            // $matches will contain the uri (example: /posts/1) as first element, so we get rid of that 
            // use print_r($matches) to check what elements it contains
            array_shift($matches);
            call_user_func_array($result['action'],$matches);
        }else{
            echo "No such route defined";
        }
    }
}

?>