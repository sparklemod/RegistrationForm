<?php

namespace App;

use App\Services\SessionPHP;

class Router
{
    public function behave()
    {
        (new SessionPHP())->start();

        $pathController = "\App\Controllers";
        $controller = $pathController . "\\" . ucfirst($_GET['c']);
        $method = strtolower($_GET['m']);

        if (!class_exists($controller)){
            die("Некорректный запрос");
        }

        $class = new $controller();

        if (!method_exists($class,$method)){
            die("Некорректный запрос");
        }

        $class->$method();
    }
}