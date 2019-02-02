<?php

function url($path){
    $url = require(CONFIG.'app.php'); 
    $url = $url['url'];

    return $url.'/'.$path;
}
