<?php

spl_autoload_register(function ($class) {
    $str = '';
    $c = 0;
    $arr = explode('\\', $class);


    if($arr[0] == 'App')
        $type = 'app';
    else if($arr[0] == 'DB')
        $type = 'db';
    else
        $type = 'class';


    foreach($arr as $path){
        $c += 1;
        if($c == 1){
            $str .= $path;
            continue;

        }
        $str .= '/' . $path;

    }

    if($type == 'app'){
        $str = str_replace('App', 'app', $str);
        require($str.'.php');
    }
    else if($type == 'db'){
        $str = str_replace('DB', 'db', $str);
        require($str.'.php');
    }
    else{
        require(strtolower($str) . '.class.php');
    }
});
