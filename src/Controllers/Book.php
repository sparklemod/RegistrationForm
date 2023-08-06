<?php

namespace App\Controllers;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

class Book extends BaseController
{
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = $this->em->getRepository(\App\Entity\User::class);
    }

    public function create()
    {
        $this->render('User/books', []);

        if (empty($_POST)) {
            return;
        }

        $user = $this->getRepository(\App\Entity\User::class)->find($this->session->getUserID());
        $book = new \App\Entity\Book();
        $book->setName($_POST['name'])
            ->setAuthor($_POST['author'])
            ->setEdition($_POST['edition'])
            ->setYear($_POST['year'])
            ->setUsers([$user]);
        $this->em->persist($book);
        $this->em->flush();
    }
//edit , list, delete
}