<?php

namespace Lemmy;

use Zend\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\EmitterInterface;

class Router
{
	private $status;
	private $handler;
	private $data;
	private $routeInfo;
	private $dispatcher;
	private $emitter;

	public function __construct(EmitterInterface $emitter, $dispatcher)
	{
		$this->emitter = $emitter;
		$this->dispatcher = $dispatcher;
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
		        if (is_callable($this->handler)) {
		            $returned = call_user_func($this->handler, $this->data);
		            $this->output($returned);
		            break;
		        }
				else if (preg_match('/@/', $this->handler)) {
		            list($class, $method) = explode('@', $this->handler);
		            $controller = "\App\Controllers\\" . $class;
		            $controller = new $controller();
		            $returned = $controller->$method($this->data);
		            $this->output($returned);
		            break;
		        }
		}
	}

	private function output($response)
	{
		$this->emitter->emit($response);
	}
}