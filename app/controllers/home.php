<?php

class Home extends Controller
{

    public function index($name = '')
    {
        echo 'home/index' . $name;
    }
}