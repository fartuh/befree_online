<?php

namespace Core\Classes;

class App
{
    public static function findController($controller, $params){

        // Getting names of a controller and a method
        $path = explode('@', $controller);
        $method = $path[1];
        $controller = '\App\Controllers\\'.$path[0];


        $app = new $controller();
        if($params == false)
            return $app->$method();
        else
            return $app->$method($params);
    }
}
