<?php

use \Core\Classes\Router as Router;

$router = new Router;

// Routes

$router->get('', 'IndexController@index');

$router->_404('IndexController@_404');

// End
return $router;
