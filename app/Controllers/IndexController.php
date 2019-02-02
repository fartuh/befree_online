<?php

namespace App\Controllers;

use \Core\Classes\DB;
use \App\Models\User;

class IndexController extends Controller
{
    public function index(){
        $user = $_SESSION['user'];

        $stmt = User::prepare("SELECT * FROM users WHERE user = ?");
        $stmt->execute([$user]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);


        if(!isset($data['user'])){

            $stmt = User::prepare("INSERT INTO users(user) VALUES(?)");
            $stmt->execute([$user]);

            $stmt = User::prepare("SELECT * FROM users WHERE user = ?");
            $stmt->execute([$user]);
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        }

        $this->view('index', ['user' => $user, 'data' => $data]);
    }

    public function _404($params){
        echo 'url ' . $params['url'] . ' doesn\'t exist';
    }
}
