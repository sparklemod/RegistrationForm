<?php

namespace App\Controllers;

use App\Services\DataBase\Doctrine;
use App\Services\SessionPHP;
use Doctrine\ORM\EntityManager;
use Jenssegers\Blade\Blade;

class BaseController
{
    private Blade $template;
    protected SessionPHP $session;
    protected EntityManager $em;

    public function __construct()
    {
        $this->template = new Blade(__DIR__ . '/../Views', __DIR__ . '/../Views/Cache');
        $this->session = new SessionPHP();
        $this->em = Doctrine::getEntityManager();
    }

    protected function getRepository(string $class){
        return $this->em->getRepository($class);
    }

    public function render(string $template, array $data)
    {
        echo $this->template->render($template, $data);

    }


}