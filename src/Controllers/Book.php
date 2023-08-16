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
        $this->render('Book/create', []);

        if (empty($_POST)) {
            return;
        }

        $user = $this->getRepository(\App\Entity\User::class)->find($this->session->getUserID());
        $book = new \App\Entity\Book();
        $year= new \DateTime($_POST['year']);
        var_dump(date('Y-m-d',strtotime("01/01/" . $_POST['year'])));
        $book->setName($_POST['name'])
            ->setAuthor($_POST['author'])
            ->setEdition($_POST['edition'])
            ->setYear($year)
            ->setUsers([$user]);
        $this->em->persist($book);
        $this->em->flush();

    }

    public function list()
    {
        $this->render('Book/list', ['books' => $this->getBooks()]);
    }


    public function edit()
    {

        $books = $this->em->getRepository(\App\Entity\Book::class);

        $book = $books->find($_GET['id']);
        $this->render('Book/edit', ['book' => $book->toArray()]);
        if (empty($_POST)) {
            return;
        }
        $year= new \DateTime($_POST['year']);
        $book->setName($_POST['name'])
            ->setAuthor($_POST['author'])
            ->setEdition($_POST['edition'])
            ->setYear($year);
        $this->em->persist($book);
        $this->em->flush();

        header("Location: /?c=book&m=list");

    }

    private function getBooks()
    {
        if (!$this->session->isAuth()) {
            header("Location: /?c=newUser&m=logIn");
        } else {
            $id = $this->session->getUserID();
            return $this->repository->find($id)->getBooks();
        }

    }


//edit , list, delete*/
}

