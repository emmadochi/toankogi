<?php

// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'toan_kogi_revenue');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// Public Root
define('PUBROOT', dirname(APPROOT) . '/public');

// URL Root (Dynamic)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost:3001';
$script = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '/index.php';
$publicDir = rtrim(dirname($script), '/\\');
define('URLROOT', $protocol . "://" . $host . $publicDir);
// Site Name
define('SITENAME', 'TOAN Kogi State | Tricycle Tax & Registration');
