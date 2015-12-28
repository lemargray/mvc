<?php

namespace Lemmy;

use Zend\Diactoros\Response;

class Router
{
	private $status;
	private $handler;
	private $data;
	private $routeInfo;
	private $dispatcher;

	public function __construct()
	{
		$this->dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $route) {
		    require __DIR__ . '/../app/routes.php';
		});
	}

	public function dispatch($httpMethod, $url)
	{
		$this->routeInfo = $this->dispatcher->dispatch($httpMethod, $url);
		$this->processDistach();
	}

	private function processDistach()
	{
		switch ($this->routeInfo[0]) {
		    case \FastRoute\Dispatcher::NOT_FOUND:
		        // ... 404 Not Found
		        echo "404 NOT_FOUND";
		        break;
		    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		        $allowedMethods = $this->routeInfo[1];
		        // ... 405 Method Not Allowed
		        echo "METHOD_NOT_ALLOWED {$allowedMethods}";
		        break;
		    case \FastRoute\Dispatcher::FOUND:
		    	list($this->status, $this->handler, $this->data) = $this->routeInfo;
		        if (is_callable($this->handler))
		        {
		            $returned = call_user_func($this->handler, $this->data);
		            $this->output($returned);
		            break;
		        }
				else if (preg_match('/@/', $this->handler))
		        {
		            list($class, $method) = explode('@', $this->handler);
		            $controller = "\App\Controllers\\" . $class;
		            $controller = new $controller();
		            $returned = $controller->$method($this->data);
		            $this->output($returned);
		            break;
		        }
		}
	}

	private function output($returned)
	{
		if ( empty($returned) )
		{
			$response = new Response\EmptyResponse();
		}
		else if ($returned instanceof \zend\Diactoros\Response)
		{	
			 $response = $returned;
		}
	    else if (is_object($returned) || is_array($returned))
	    {
	        $response = new Response\JsonResponse($returned);
	    }
	    else if (preg_match('/<html>/', $returned))
	    {
	    	$response = new Response\HtmlResponse($returned);
	    }
	    else if ( is_string($returned) )
	    {
	    	$response = new Response\TextResponse($returned);
	    }
		$emitter = new \Zend\Diactoros\Response\SapiEmitter();
		$emitter->emit($response);
	}
}