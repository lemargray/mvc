<?php

namespace App\Controllers;

use Lemmy\Controller;

class UserController extends Controller
{
	public function index($data)
	{
		return \Lemmy\redirect('/users');
		return \Lemmy\view('index.html', $data);
	}
}