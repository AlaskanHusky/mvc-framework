<?php

namespace Framework\Controllers;

use Framework\Core\Controller;


class MainController extends Controller
{
    public function indexAction()
    {
        $this->view->render('Главная страница');
    }
}