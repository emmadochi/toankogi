<?php

// For PHP built-in server: serve static files as-is
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

require_once __DIR__ . '/../app/bootstrap.php';

use App\Core\App;

$app = new App();
