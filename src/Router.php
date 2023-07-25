<?php

namespace App;

use App\Services\SessionPHP;

class Router
{
    public function behave()
    {
        (new SessionPHP())->start();

        $pathController = "\App\Controllers";
        $controller = $pathController . "\\" . ucfirst($_GET['c']); //преобразует первый символ строки в верхний регистр.
        $method = strtolower($_GET['m']); //преобразовывает строку в нижний регистр.

        if (!class_exists($controller)){
            die("Некорректный запрос");
        }

        $class = new $controller(); //взяли название и по нему создали экземпляр

        if (!method_exists($class,$method)){
            die("Некорректный запрос");
        }

        $class->$method();
    }
}