<?php

use Illuminate\Http\Response;
use Illuminate\Routing\Router as Route;

/*
 *
 * Your API Routes
 *
 */
$router->group(['namespace' => 'Project\Controllers', 'prefix' => 'users'], function (Route $router) {

    // $router->post('/', 'UserController@create');


});



/*
 *
 * Catch Undefined Routes.
 *
 */
$router->any('{any}', function () {
    return Response::create(
        'Your resource does not exist', Response::HTTP_NOT_FOUND
    );
})->where('any', '(.*)');
