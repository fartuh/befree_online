<?php

namespace Core\Classes;

class URL
{

    /*
     *  This class is responsible for working with URL/URI
     */

    private 
        $url,
        $url_tokens,
        $site;

    public function __construct($url){
        $this->url = strip_tags(trim($url));
        $this->url_tokens = explode('/', trim($url));
    }

    public function getUrl($type = 'tokens'){
        if($type == 'tokens')
            return $this->url_tokens;
        else if($type == 'string')
            return $this->url;
    }

    public function __toString(){
        return $this->getUrl('string');
    }

    public function __clone(){

    }
}
