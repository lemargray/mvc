<?php

namespace Lemmy;

use Zend\Diactoros\Response\RedirectResponse;

/**********************************************
* Functions shared between handlers of request
**********************************************/

function view($file, $data = [])
{
	$loader = new \Twig_loader_filesystem(__DIR__ . "/../views");
	$twig = new \Twig_Environment($loader);
	return $twig->render($file, $data);
}

function redirect($uri, $status = 302, array $headers = [] )
{
	$request = new \Lemmy\Request();
	$url = $request->getBasePath().ltrim($uri, '/');
	$redirectResponse = new RedirectResponse($url, $status, $headers);
	return $redirectResponse;
}