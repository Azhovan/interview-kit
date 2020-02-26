<?php


use Project\Database\Database;

$providers = [
    'classFQN' => 'classFQN'
];

// If container is not loaded(when running unit tests) then
// create new instance
$container = isset($container) ? $container : new Illuminate\Container\Container;

// Binding services into the container
// all of these services will be auto-injected during the runtime
// as a dependency inside of the controller's constructor
foreach ($providers as $alias => $concrete) {
    $container->instance($alias, new $concrete);
}

// Load database configuration
$database = new Database();
$database->registerConfiguration();

// Loads environment variables from .env
$env = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$env->load();
