<?php

namespace App\Models;

use App\Entity\Book as BookEntity;
use App\Repository\UserRepository;
use App\Services\DataBase\Doctrine;
use DateTime;

class Book
{
    public function create(int $userID, array $data)
    {
        $user = (new UserRepository())->find($userID);
        $book = new BookEntity();
        $year = new DateTime($data['year']);
        $book->setName($data['name'])
            ->setAuthor($data['author'])
            ->setEdition($data['edition'])
            ->setYear($year)
            ->addUser($user);
        $user->addBook($book);
        Doctrine::getEntityManager()->persist($book);
        Doctrine::getEntityManager()->flush();

    }

    public function getByUserId($id)
    {
        $user = (new UserRepository())->find($id);

        if ($user) {
            return $user->getBooks();
        } else {
            return [];
        }
    }

}