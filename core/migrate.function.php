<?php

function migrate(){
    $files = scandir(DB.'Migrations/');
    foreach($files as $file){
        if($file == '.' || $file == '..' || explode('.', $file)[0] == '') continue;
        $class = 'DB\\Migrations\\'.str_replace(['_', '.php'], '', $file);
        $obj = new $class;

        $obj->migrate();
    } 
}

function rollback(){
    $files = scandir(DB.'Migrations/');
        foreach($files as $file){
            if($file == '.' || $file == '..' || explode('.', $file)[0] == '') continue;
            $class = 'DB\\Migrations\\'.str_replace(['_', '.php'], '', $file);
            $obj = new $class;

            $obj->rollback();
        }
}
