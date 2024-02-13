<?php

namespace App\Repository;

use App\Services\DataBase\Doctrine;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    public function __construct()
    {
        $em = Doctrine::getEntityManager();
        parent::__construct($em, $em->getClassMetadata($this->getEntity())); //через статик получает текущий класс а не наследника
    }

    protected abstract function getEntity(): string;
}