<?php

include_once __DIR__.'/../vendor/autoload.php';

use App\Services\DataBase\Doctrine;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\YamlFile;
use Doctrine\Migrations\DependencyFactory;

$config = new YamlFile(__DIR__ . '/../migrations.yml');

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager(Doctrine::getEntityManager()));