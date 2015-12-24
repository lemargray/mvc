<?php

require BASE_FOLDER.'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    require APP_FOLDER . 'routes.php';
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_GET['url'], PHP_URL_PATH));

list($status, $handler, $data) = $dispatcher->dispatch($httpMethod, $uri);
switch ($status) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo "NOT_FOUND";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $handler;
        // ... 405 Method Not Allowed
        echo "METHOD_NOT_ALLOWED";
        break;
    case FastRoute\Dispatcher::FOUND:
        if (is_callable($handler))
        {
            $returned = call_user_func($handler);
            if (is_object($returned) || is_array($returned))
            {
                $returned =  json_encode($returned);
            }
            echo $returned;
            break;
        }

        if (preg_match('/@/', $handler))
        {
            list($class, $method) = explode('@', $handler);
            require CONTROLLER_FOLDER . $class . '.php';
            $controller = new $class();
            $controller->$method($data);
            break;
        }
}