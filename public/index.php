<?php

require __DIR__.'/../vendor/autoload.php';

$request = new \Lemmy\Request(
	\Zend\Diactoros\ServerRequestFactory::fromGlobals(
	    $_SERVER,
	    $_GET,
	    $_POST,
	    $_COOKIE,
	    $_FILES
	)
);

$router = new \Lemmy\Router(
	new \Zend\Diactoros\Response\SapiEmitter(),
	\FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $route) {
	    require __DIR__ . '/../app/routes.php';
	})
);

$router->dispatch($request->method(), $request->get('url'));