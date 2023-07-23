<?php

namespace App\Controllers;


use Jenssegers\Blade\Blade;

class BaseController
{
    private Blade $template;

    public function __construct()
    {
        $this->template = new Blade(__DIR__ . '/../Views', __DIR__ . '/../Views/Cache');
    }

    public function render(string $template, array $data)
    {
        echo $this->template->render($template, $data);

    }


}