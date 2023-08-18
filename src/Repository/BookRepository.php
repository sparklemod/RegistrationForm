<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\ORM\EntityRepository;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[] findAll()
 * @method Book[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends BaseRepository
{

    protected function getEntity(): string
    {
        return Book::class;
    }
}
