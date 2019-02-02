<?php

namespace Core\Classes;

class Router
{
    private 
        $get = [],
        $post = [],
        $_404 = null;

    public function __construct(){

    }

    public function get($url, $controller){
        $this->get[$url] = $controller;
    }

    public function post($url, $controller){
        $this->post[$url] = $controller;
    }

    public function group($prefix, $function){
        $function($prefix);
    }

    public function matchGet($url_arr){
        $set_urls = $this->get;

        foreach($set_urls as $url => $controller){
            $get_arr = explode('/', $url);
            $params = false;

            for($i=0;$i<count($get_arr);$i++){
                if(!isset($url_arr[$i])){
                    continue(2);
                }
                if(count($get_arr) != count($url_arr)){
                    continue(2);
                }

                if($get_arr[$i] == $url_arr[$i]){
                    continue;
                }
                else if(isset(explode('{', $get_arr[$i])[1])){
                    $params[trim($get_arr[$i], '{}')] = $url_arr[$i];
                    continue;
                }
                else{
                    continue(2);
                }
            }

            return ['controller' => $controller, 'params' => $params];
        }
        return false;
    }

    public function matchPost($url_arr){
        $set_urls = $this->post;

        foreach($set_urls as $url => $controller){
            $get_arr = explode('/', $url);
            $params = false;

            for($i=0;$i<count($get_arr);$i++){
                if(!isset($url_arr[$i])){
                    continue(2);
                }
                if(count($get_arr) != count($url_arr)){
                    continue(2);
                }

                if($get_arr[$i] == $url_arr[$i]){
                    continue;
                }
                else if(isset(explode('{', $get_arr[$i])[1])){
                    $params[trim($get_arr[$i], '{}')] = $url_arr[$i];
                    continue;
                }
                else{
                    continue(2);
                }
            }

            return ['controller' => $controller, 'params' => $params];
        }
        return false;
    }

    public function _404($controller){
        $this->_404 = $controller;
    }

    public function get404(){
        return $this->_404;
    }

}
