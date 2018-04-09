<?php

namespace Framework\Core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        $path = 'Framework/Views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            require_once $path;
            $content = ob_get_clean();
            require_once 'Framework/Views/layouts/' . $this->layout . '.php';
        }
    }

    public function redirect($url) {
        header('location:'. $url);
    }

    public static function errorCode($code)
    {
        $path = 'Framework/Views/errors/' . $code . '.php';
        http_response_code($code);
        if(file_exists($path)) {
            require_once $path;
        }
        exit;
    }
}