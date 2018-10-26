<?php

namespace Lemmy;

use Psr\Http\Message\ServerRequestInterface;

class Request
{
	private $requestObject;
	private $uriObject;

	public function __construct(ServerRequestInterface $requestObject)
	{
		$this->requestObject = $requestObject;
	}

	private function getRequestObject()
	{
		return $this->requestObject;
	}

	public function get($key)
	{
		$queryObject = $this->getRequestObject()->getQueryParams();

		if (empty($queryObject)) {
			return "/";
		}

		return rtrim($queryObject[$key], '/');
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