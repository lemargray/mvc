<?php

$route->addRoute('GET', 'users', function(){
	return "Shereka kinda looks hot today";//array( 'fname' => 'Lemar', 'lname' => 'Gray');
});

$route->addRoute('GET', 'users/{id}', 'UserController@index');
    // {id} must be a number (\d+)
$route->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
$route->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');