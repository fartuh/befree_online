<?php

namespace App\Middlewares;

class UserCheck
{
    public function handle($request){
        global $config;

        if(isset($_SESSION['user'])){
            return true;
        }
    }

    public function fail(){
        $_SESSION['user'] = 'user_'.sha1(rand(0, 99999) * rand(0, 99999));
        header("Location: ".$config['app']['url']);
        exit();

    }
}
