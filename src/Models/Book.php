<?php

namespace App\Models;

use App\Entity\Book as BookEntity;
use App\Repository\BookRepository;
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

    public function edit(int $bookID, array $data)
    {
        $book = (new BookRepository())->find($bookID);
        $year = new \DateTime($_POST['year']);
        $book->setName($data['name'])
            ->setAuthor($data['author'])
            ->setEdition($data['edition'])
            ->setYear($year);
        Doctrine::getEntityManager()->persist($book);
        Doctrine::getEntityManager()->flush();
    }

    public function delete(int $bookID)
    {
        $book = (new BookRepository())->find($_GET['id']);
        Doctrine::getEntityManager()->remove($book);
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