<?php

/*********************************
* This Class is not is use
*********************************/

class App
{

    protected $controller = 'home';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {

        //Route::match();
        Route::respond();

    }
}