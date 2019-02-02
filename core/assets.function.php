<?php

function assets($file){
    $url = require(CONFIG.'app.php');
    $url = $url['url'];
    $path = "$url/public/assets/";
    if(strpos($file, '.css') !== false){
        $path .= 'css/' . $file;
    }
    else{
        $path .= 'js/' . $file;
    }
    return $path;
}
