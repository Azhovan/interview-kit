<?php
// This command will set up the database by running the all migrations
// migration files are exist in ./database/migrations directory
require __DIR__ . "/../vendor/autoload.php";

use Chat\Database\Database;
use Dotenv\Dotenv;
use Illuminate\Filesystem\Filesystem as Storage;

// Loads environment variables from .env
// by this line all environment variables will be
// available when getenv() triggered
$env = Dotenv::createImmutable(__DIR__ .'/../');
$env->load();

// Load database configuration
$database = new Database();
$database->registerConfiguration();

// Run migrations
// we are going to explode the name of file into chunks
// then, Make first character uppercase and
// finally create class name by concatenating those parts

$handler = new Storage();
$migrations = $handler->glob('./database/migrations/*_*.php');

foreach ($migrations as $migration) {
    $handler->requireOnce($migration);
    $filenameParts = explode('_', $file = $handler->name($migration));

    foreach ($filenameParts as $key => $part) {
        $filenameParts[$key] = ucfirst($part);
    }

    // build class name, if class exist in autoloader
    $class = implode('', $filenameParts);
    if (!class_exists($class)) {
        throw new RuntimeException(sprintf(
            "Class %s does not exist.",
            $class
        ));
    }
    $migrationObject = new $class();
    if (method_exists($migrationObject, 'up')) {
        $migrationObject->up();
    }
    // output it in terminal
    vprintf("%sCreated Migration: %s%s\n", ['[32m ', $file, ' [0m']);
}



