<?php

define('ROOT', __DIR__.'/');
define('CONFIG', ROOT.'config/');
define('APP', ROOT.'app/');
define('PUB', ROOT.'public/');
define('DB', ROOT.'db/');
define('CORE', ROOT.'core/');
define('CLASSES', CORE.'classes/');
define('MODULES', CORE.'modules/');

define('METHOD', $_SERVER['REQUEST_METHOD']);

// Require functions
require(CORE.'autoload.function.php');
require(CORE.'migrate.function.php');
require(CORE.'url.function.php');


use \Core\Classes\URL as URL;
use \Core\Classes\App as App;
use \Core\Classes\DB as DB;
use \Core\Classes\Debug as Debug;


// Require config
$config['app'] = require(CONFIG.'app.php');
define('DEBUG', $config['app']['debug']);


// Let's get URL from the GET parameter and give it to URL class
$url = new URL($_GET['url']);


// Debugging

if(DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
else{
    error_reporting(0);
    ini_set('display_errors', 0);
}


// Require routes
$router = require(CONFIG.'urls.php');


// Matching routes
if(METHOD == 'GET'){
    http_response_code(200);
    $matched = $router->matchGet($url->getUrl());
}
else if(METHOD == 'POST'){
    http_response_code(200);
    $matched = $router->matchPost($url->getUrl());
}
else{
    http_response_code(405);
    exit('This HTTP method is not allowed');
}


// Handling 404 error
if($matched == false){
    if(DEBUG){
        Debug::_404($url);
        exit();
    }

    $controller = $router->get404();
    if($controller == null)
        exit('Error 404 not found');
    $matched = ['controller' => $controller, 'params' => ['url' => $url->getUrl('string')]];
}

// Middlewares
session_start();

$middlewares = scandir(APP . 'Middlewares');

foreach($middlewares as $middleware){
    if($middleware == '.' || $middleware == '..' || explode('.', $middleware)[0] == '') continue;

    $middleware = str_replace('.php', '', $middleware);

    $class = '\\App\\Middlewares\\'.$middleware;

    $obj = new $class();
    
    $result = $obj->handle(['url' => $url->getUrl('string'), 'urlObject' => $url, 'controller' => $matched['controller']]);

    if($result != true){
        $mid = '\\App\\Middlewares\\'.$middleware;
        $mid = new $mid();
        if(method_exists($mid, 'fail')){
            $mid->fail();
            exit();
        } 
        else{
            echo "error in the middleware $middleware";
            exit();
        }
    }
}


// DB connection
$config['db'] = require(CONFIG.'db.php');

$db_config = $config['db'];

switch($db_config['db']){
    case null:
        break;
    case 'mysql':
        $mysql = $db_config['mysql'];
        $dsn = 'mysql:host='.$mysql['host'].';dbname='.$mysql['name'].';charset='.$mysql['charset'];
        DB::connect($dsn, $mysql['user'], $mysql['pass']);
        break;
    case 'sqlite3':
        $file = $db_config['sqlite3']['file'];
        $dsn = 'sqlite:'.DB.'sqlite3/'.$file;
        DB::connect($dsn, '', '', true);
        break;
}


if(file_exists(ROOT.'migrate.php'))
    require(ROOT.'migrate.php');
   

$params = $matched['params'];

// Let's get the information
$controller = $matched['controller'];

// Looking for a controller that will handle the request
App::findController($controller, $params);

// Closing the db connection
DB::close();
