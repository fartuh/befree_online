<?php

namespace App\Middlewares;

class Middleware
{
    public function handle($request){
        return true;
    }

    public function fail(){
        echo 'failed';
    }
}
