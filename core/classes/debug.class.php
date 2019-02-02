<?php

namespace Core\Classes;

class Debug
{
    public static function _404($url){
        echo '<style>';
        echo '.not-found{width:100%;border: 1px solid red}';
        echo '</style>';
        echo '<div class="not-found"><pre>';
        echo 'URL '.$url->getUrl('string').' was not found<br/><br/>';
        echo 'url tokens<br/><br/>';
        print_r($url->getUrl('tokens'));
        echo '</pre></div>';
    }
}
