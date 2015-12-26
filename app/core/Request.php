<?php

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
		//$this->uriObject = new Zend\Diactoros\Uri($this->getRequestObject()->getUri());
		//echo "__construct";
	}

	public function getRequestObject()
	{
		return $this->requestObject;
	}

	public function get($key)
	{
		return rtrim($this->getRequestObject()->getQueryParams()['url'], '/');//rawurldecode(parse_url($this->getRequestObject()->getQueryParams()[$key], PHP_URL_PATH));
	}

	public function method()
	{
		return $this->getRequestObject()->getMethod();
	}
}