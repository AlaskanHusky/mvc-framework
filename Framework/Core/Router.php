<?php

namespace Framework\Core;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $routes = require_once 'Framework/Config/Routes.php';
        foreach ($routes as $key => $value) {
            $this->add($key, $value);
        }
    }

    public function add($route, $params)
    {
        // Преобразуем маршрут к необходимому виду для использования регулярных выражений
        $route = '#^' . $route . '#';
        $this->routes[$route] = $params;
    }

    public function match()
    {
        // Удаляем '/' из запрашиваемого адреса
        $url = trim($_SERVER['REQUEST_URI'], '/');
        if (strpos($url, 'public') !== false) {
            exit;
        }
        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match()) {
            // Формируем путь к контроллеру (обратный слеш в пути используется для замены директивы use)
            $path = 'Framework\Controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if(class_exists($path)) {
                $action = $this->params['action'] . 'Action';
                if(method_exists($path, $action)) {
                    // Создаем экземпляр необходимого контроллера
                    $controller = new $path($this->params);
                    $controller->$action();

                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}