<?php

namespace Framework\Controllers;

use Framework\Core\Controller;

class AccountController extends Controller
{
    public function loginAction()
    {
        $this->view->render('Вход');
    }

    public function registerAction()
    {
        $this->view->render('Регистрация');
    }
}