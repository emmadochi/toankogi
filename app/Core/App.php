<?php

namespace App\Core;

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (isset($url[0])) {
            $controllerPath = APPROOT . '/Controllers/' . ucfirst($url[0]) . '.php';
            if (file_exists($controllerPath)) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }

        $controllerClassName = "App\\Controllers\\" . $this->controller;
        $this->controller = new $controllerClassName;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        
        // Fallback for servers not using .htaccess (like php -S)
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $basePath = dirname($scriptName);
        
        // Remove basePath from requestUri if it exists at the start
        if ($basePath !== '/' && $basePath !== '\\' && strpos($requestUri, $basePath) === 0) {
            $urlPath = substr($requestUri, strlen($basePath));
        } else {
            $urlPath = $requestUri;
        }

        $urlPath = trim($urlPath, '/');
        
        if ($urlPath === '' || $urlPath === 'index.php') {
            return [];
        }

        return explode('/', filter_var($urlPath, FILTER_SANITIZE_URL));
    }
}
