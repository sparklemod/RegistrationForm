<?php

namespace App\Controllers;

use App\Repository\BookRepository;
use App\Repository\UserRepository;

class Book extends BaseController
{
    private \App\Models\Book $book;
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->isAuth()) {
            header("Location: /?c=newUser&m=logIn");
            exit;
        }
        $this->book = new \App\Models\Book();
    }

    public function create()
    {
        $this->render('Book/create', []);

        if (empty($_POST)) {
            return;
        }
        (new \App\Models\Book())->create($this->session->getUserID(), $_POST);
        header("Location: /?c=book&m=list");
    }

    public function list()
    {
        $this->render('Book/list', ['books' => $this->book->getByUserId($this->session->getUserID())]);
    }

    public function edit()
    {
        $book = (new BookRepository())->find($_GET['id']);
        $this->render('Book/edit', ['book' => $book->toArray()]);

        if (empty($_POST)) {
            return;
        }

        $year = new \DateTime($_POST['year']); //дейт тайм спросить
        $book->setName($_POST['name'])
            ->setAuthor($_POST['author'])
            ->setEdition($_POST['edition'])
            ->setYear($year);
        $this->em->persist($book);
        $this->em->flush();
        header("Location: /?c=book&m=list");
    }

    public function delete()
    {
        $book = (new BookRepository())->find($_GET['id']);
        $this->em->remove($book);
        $this->em->flush();
        header("Location: /?c=book&m=list");
    }

}

