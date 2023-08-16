<?php

namespace App\Repository;

use App\Services\DataBase\Doctrine;
use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository
{
    public function __construct()
    {
        $em = Doctrine::getEntityManager();
        parent::__construct($em, $em->getClassMetadata(static::class));
    }
}