<?php

use Zend\Diactoros\Response\RedirectResponse;

/**********************************************
* Functions shared between handlers of request
**********************************************/

function view($file, $data = [])
{
	$loader = new Twig_loader_filesystem(VIEW_FOLDER);
	$twig = new Twig_Environment($loader);
	return $twig->render($file, $data);
}

function redirect($uri, $status = 302, array $headers = [] )
{
	$url = BASE_PATH.ltrim($uri, '/');
	$redirectResponse = new RedirectResponse($url, $status, $headers);
	return $redirectResponse;
}