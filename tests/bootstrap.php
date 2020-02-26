<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ .'/../bootstrap/providers.php';

// make sure all errors are cached
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
