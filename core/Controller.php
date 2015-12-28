<?php

namespace Lemmy;

/********************************
* Base Class for Controllers
********************************/

class Controller
{
	public function view($file, $data = [])
	{
		return view($file, $data);
	}

	public function redirect($uri, $status = 302, array $headers = [] )
	{
		return redirect($uri, $status, $headers);
	}
}