<?php

namespace App\Services\DataBase;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Doctrine
{
    private static ?Doctrine $instance = NULL;
    private EntityManager $entityManager;

    private function __construct()
    {
        $this->connection();
    }

    public static function getEntityManager(): EntityManager //вызывается черзе этот метод, конструктор недоступен
    {
        if (self::$instance === null) {
            self::$instance = new self; //в статичной переменной будет хранииться текущий класс(как если бы я с другого класса брала публ методы)
        }

        return self::$instance->entityManager; //создаем класс из самого класса и обращаемся к полю этого класса.
    }

    private function connection()
    {
        $paths = [__DIR__ . '/../../Entity/']; //сущности представления БД в виде классов
        $proxyDir = __DIR__ . "/DoctrineProxies"; //прокси это каталог где будут создваться прокси класс для самой доктрины (внутр класы доктр через кот она работает)
        $config = ORMSetup::createAnnotationMetadataConfiguration(
            $paths, false, $proxyDir
        );

        $driverManager = DriverManager::getConnection(
            [
                'driver' => 'pdo_mysql',
                'user' => 'root',
                'password' => '',
                'dbname' => 'UsersData',
                'host' => 'localhost',
                'charset' => 'utf8',
                'driverOptions' => [
                    1002 => 'SET NAMES utf8'
                ]
            ],
            $config
        );

        $this->entityManager = new EntityManager($driverManager,$config);
    }

}