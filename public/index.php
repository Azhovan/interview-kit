<?php

require_once __DIR__ . "./../vendor/autoload.php";

/*
 * Create a service container
 * and request from server variables
 */
$container = new Illuminate\Container\Container;
$request = Illuminate\Http\Request::capture();
$container->instance('Illuminate\Http\Request', $request);

/*
 * Create the router instance
 * Create Route Events and load predefined routes
 */
$events = new Illuminate\Events\Dispatcher($container);
$router = new Illuminate\Routing\Router($events, $container);

// Load routes
require_once __DIR__ . './../routes/api.php';
// Load providers
require_once __DIR__ . '/../bootstrap/providers.php';

/*
 * Dispatch the request through the router
 * Send the response back to the browser
 */
$response = $router->dispatch($request);
$response->send();
