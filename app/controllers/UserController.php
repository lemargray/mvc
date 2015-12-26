<?php

class UserController extends Controller
{
	public function index($data)
	{
		return $this->view('index.html', $data);
	}
}