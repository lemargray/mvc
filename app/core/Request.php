<?php

namespace Lemmy;

class Request
{
	private $requestObject;
	private $uriObject;

	public function __construct()
	{
		$this->requestObject = \Zend\Diactoros\ServerRequestFactory::fromGlobals(
		    $_SERVER,
		    $_GET,
		    $_POST,
		    $_COOKIE,
		    $_FILES
		);
	}

	private function getRequestObject()
	{
		return $this->requestObject;
	}

	public function get($key)
	{
		return rtrim($this->getRequestObject()->getQueryParams()[$key], '/');
	}

	public function method()
	{
		return $this->getRequestObject()->getMethod();
	}

	public function getPath()
	{
		return $this->getRequestObject()->getUri()->getPath();
	}

	public function getBasePath()
	{
		$queryString = $this->getRequestObject()->getQueryParams()['url'];
		$path = $this->getPath();
		$pattern = preg_replace('/\//', '\/', $queryString);
		$pattern = '/'.$pattern.'/';
		$basePath = preg_replace($pattern, '', $path);
		return preg_replace($pattern, '',$path);
	}
}