<?php

// Включаем вывод всех ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Функция для debug'а
function debug($str)
{
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit(0);
}