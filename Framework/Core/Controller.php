<?php

namespace Framework\Core;

abstract class Controller
{
    public $route;
    public $view;
    public $model;
    public $acl;

    public function __construct($route)
    {
        $this->route = $route;
        $this->checkACL();
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name)
    {
        $path = 'Framework\Models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }

    }

    public function checkACL()
    {
        $this->acl = require_once 'Framework/ACL/' . ucfirst($this->route['controller']) . '.php';
        if ($this->isACL('all')) {
            return true;
        } else {
            return false;
        }
    }

    public function isACL($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}