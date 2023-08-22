<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<Book>
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
