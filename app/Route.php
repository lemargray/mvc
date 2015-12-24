<?php

Route::get('/testing', function(){
	echo "testing";
});

Route::get('/', function(){
    echo "<form action='/sandbox/mvc/public/' method='post'><input type='submit' value='Submit'>";
});

Route::post('/', function(){
    echo 'Welcome to the home page post request';
});

Route::get('lem', 'UserController@index');

Route::get('lem/{id}/{name}', function(){

});