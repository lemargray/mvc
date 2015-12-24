<?php

class Controller
{
	public function view($file, $data = [])
	{
		//global $view_folder;
		$loader = new Twig_loader_filesystem(VIEW_FOLDER);
		$twig = new Twig_Environment($loader);
		echo $twig->render($file, $data);
	}
}