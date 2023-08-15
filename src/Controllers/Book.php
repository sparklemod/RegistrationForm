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


    public function edit()
    {

        $this->render('Book/edit', ['book' => $this->getInfo()]);

        if ($this->inputCheck()) {
            $user = $this->repository->find($this->session->getUserID());
            $user->setEmail($_POST['email'])->setName($_POST['name'])->setPass(md5($_POST['pass']));
            $this->em->persist($user);
            $this->em->flush();

            header("Location: /?c=newUser&m=account");
        }
    }

    private function getInfo()
    {
        if (!$this->session->isAuth()) {
            header("Location: /?c=newUser&m=logIn");
        } else {
            $id = $this->session->getUserID();
            $user = $this->repository->find($id);
            return $user->toArray();
        }

    }


//edit , list, delete*/
}

