<?php

namespace Core\Classes;

class Controller
{

    protected function config($type){
        return require(CONFIG.$type.'.php');
    }

    protected function view($__name, $__params = []){
        foreach($__params as $__key => $__param){
            $$__key = $__param;
        }
        include(CORE . 'assets.function.php');
        require(PUB . "views/$__name.php");
    }

}
