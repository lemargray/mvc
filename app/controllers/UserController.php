<?php

namespace App\Controllers;

use Lemmy\Controller;

class UserController extends Controller
{
	public function index($data)
	{
		//return $this->redirect('/users');
		return $this->view('index.html', $data);
	}
}