<?php

require '/../config/app.php';
require_once 'App.php';
require_once 'Controller.php';
require_once 'Route.php';
require_once APP_FOLDER.'Route.php';
// use Illuminate\Support\Facades\Route as Route;
// //require BASE_FOLDER.'vendor/illuminate/Support/Route.php';
// //require_once 'Route.php';
// // Route::get('/', function(){
// // 	echo 'just a test';
// // });
// require '/../config/app.php';
// require APP_FOLDER.'../vendor/autoload.php';
// use Illuminate\Container\Container;
// use Illuminate\Events\Dispatcher;
// use Illuminate\Http\Request;
// use Illuminate\Routing\Router;
// require_once 'App.php';
// require_once 'Controller.php';
// //$router = new Router;
// Illuminate\Support\ClassLoader::register();
// Illuminate\Support\ClassLoader::addDirectories(array(CONTROLLER_FOLDER, MODEL_FOLDER));
// $events = new Dispatcher(new Container);
// // Create the router instance
// $router = new Router($events);
// // Load the routes
// //require_once 'routes.php';
// $router->get('/', 'UserController@index');
// $router->get('test', function(){
// 	return 'Working!';
// });
// // Create a request from server variables
// $request = Request::capture();
// // Dispatch the request through the router
// $response = $router->dispatch($request);
// // Send the response back to the browser
// $response->send();



//require_once APP_FOLDER.'Route.php';

// echo '<br>path: ' . $app_folder;

// require $app_folder . '/controllers/home.php';

// $home = new Home;
// $home->index();