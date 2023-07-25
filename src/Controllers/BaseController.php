<?php

namespace App\Controllers;


use App\Services\SessionPHP;
use Jenssegers\Blade\Blade;

class BaseController
{
    private Blade $template;
    protected SessionPHP $session;

    public function __construct()
    {
        $this->template = new Blade(__DIR__ . '/../Views', __DIR__ . '/../Views/Cache');
        $this->session = new SessionPHP();
    }

    public function render(string $template, array $data)
    {
        echo $this->template->render($template, $data);

    }


}