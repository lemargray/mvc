<?php

require_once '../app/core/init.php';

require APP_FOLDER . 'core/Request.php';

require APP_FOLDER . 'core/FastRoute.php';

require APP_FOLDER . 'core/Router.php';

$request = new Request();

define('BASE_PATH', $request->getBasePath());

$router = new Router();

$router->dispatch($request->method(), $request->get('/url'));