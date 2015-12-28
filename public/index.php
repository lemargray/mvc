<?php

require __DIR__.'/../vendor/autoload.php';

$request = new \Lemmy\Request();

$router = new \Lemmy\Router();

$router->dispatch($request->method(), $request->get('url'));