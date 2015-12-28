<?php

class UserController extends Controller
{
	public function index($data)
	{
		return view('index.html', $data);
	}
}