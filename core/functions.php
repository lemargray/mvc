<?php

namespace Lemmy;

use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Response\TextResponse;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response;


/**********************************************
* Functions shared between handlers of request
**********************************************/

function view($file, array $data = [])
{
	$view_folder = __DIR__ . '/../app/views';
	$loader = new \Twig_loader_filesystem($view_folder);
	$twig = new \Twig_Environment($loader);
	return new HtmlResponse($twig->render($file, $data));
}

function redirect(string $uri, int $status = 302, array $headers = [] )
{
	$request = new \Lemmy\Request();
	$url = $request->getBasePath().ltrim($uri, '/');
	$redirectResponse = new RedirectResponse($url, $status, $headers);
	return $redirectResponse;
}

function json($data) {
	if (is_object($data) || is_array($data)) {
        return new Response\JsonResponse($data);
    }

    //throw a Application error exception and catch it later
}

function text($text) {
	if (is_string($text)) {
    	return new Response\TextResponse($text);
    }

    //throw a Application error exception and catch it later
}

function nothing() {
	return new Response\EmptyResponse();
}

function response(Response $response){
	return $resposne;
}