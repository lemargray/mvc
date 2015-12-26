<?php

use Zend\Diactoros\Response;

class Router
{
	private $status;
	private $handler;
	private $data;
	private $dispatcher;

	public function __construct()
	{
		$this->dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
		    require APP_FOLDER . 'routes.php';
		});
	}

	public function dispatch($httpMethod, $url)
	{
		@list($this->status, $this->handler, $this->data) = $this->dispatcher->dispatch($httpMethod, $url);
		$this->processDistach();
	}

	private function processDistach()
	{
		switch ($this->status) {
		    case FastRoute\Dispatcher::NOT_FOUND:
		        // ... 404 Not Found
		        echo "404 NOT_FOUND";
		        break;
		    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		        $allowedMethods = $this->handler;
		        // ... 405 Method Not Allowed
		        echo "METHOD_NOT_ALLOWED {$allowedMethods}";
		        break;
		    case FastRoute\Dispatcher::FOUND:
		        if (is_callable($this->handler))
		        {
		            $returned = call_user_func($this->handler, $this->data);
		            $this->output($returned);
		            break;
		        }
				else if (preg_match('/@/', $this->handler))
		        {
		            @list($class, $method) = explode('@', $this->handler);
		            require CONTROLLER_FOLDER . $class . '.php';
		            $controller = new $class();
		            $returned = $controller->$method($this->data);
		            $this->output($returned);
		            break;
		        }
		}
	}

	private function output($returned)
	{
		if ( is_null($returned) || empty($returned) )
		{
			return;
		}
		if ($returned instanceOf Zend\Diactoros\Response)
		{
			 $response = $returned;
		}
	    if (is_object($returned) || is_array($returned))
	    {
	        $response = new Response\JsonResponse($returned);
	    }
	    else if (preg_match('/<html>/', $returned))
	    {
	    	$response = Response\HtmlReponse($returned);
	    }
	    else if ( is_string($returned) )
	    {
	    	$response = new  Response\TextResponse($returned);
	    }
		$emitter = new Zend\Diactoros\Response\SapiEmitter();
		$emitter->emit($response);
	}
}