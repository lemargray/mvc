<?php

class UserController extends Controller
{
	public function index($data)
	{
		//return "Lemar is the best programmer ever!";
		$person = new Person;
		$person->fname = 'Lemar';
		$person->lname = 'Gray';
		//return "Lemar";
		$this->view('index.html', $data);
	}
}

Class Person
{
	public $fname;
	public $lname;
}