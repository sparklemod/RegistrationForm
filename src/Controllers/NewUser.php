<?php

namespace App\Controllers;

use App\Services\DataBase\Doctrine;
use Doctrine\ORM\EntityManager;

class NewUser extends BaseController
{
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = $this->em->getRepository(\App\Entity\User::class);
    }

    public function registration()
    {
        $this->render('User/registration', []);
        if (empty($_POST)) {
            return;
        }

        if ($this->inputCheck() && !$this->isUserExist($_POST['email'])) {
            $user = new \App\Entity\User();
            $user->setEmail($_POST['email'])->setName($_POST['name'])->setPass(md5($_POST['pass']));
            $this->em->persist($user);
            $this->em->flush();
            $this->session->setUserID($user->getId());
            header("Location: /?c=NewUser&m=account");
        } else {
            echo "Некорректные данные";
        }
    }

    public function account()
    {
        $this->render('User/account', ['user' => $this->getInfo()]);
    }

    public function logIn()
    {
        $error = '';

        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $user = $this->repository->findOneBy(['email' => $_POST['email'], 'pass' => md5($_POST['pass'])]);

            if ($user) {
                $this->session->setUserID($user->getId());
                header("Location: /?c=newUser&m=account");
            }

            $error = "Такого пользователя нет";
        }

        $this->render('User/authorization', ['msg' => $error]);
    }

    public function edit()
    {
        $this->render('User/edit', ['user' => $this->getInfo()]);

        if ($this->inputCheck()) {
            $user = $this->repository->find($this->session->getUserID());
            $user->setEmail($_POST['email'])->setName($_POST['name'])->setPass(md5($_POST['pass']));
            $this->em->persist($user);
            $this->em->flush();

            header("Location: /?c=newUser&m=account");
        }
    }

    public function logOut()
    {
        $this->session->destroySession();
        header("Location: /?c=newUser&m=logIn");
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

    private function isUserExist(string $email): bool
    {
        $user =
            $this->em
                ->getRepository(\App\Entity\User::class)
                ->findBy(['email' => $email]); //вернет или юзера или нул

        if (!$user) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function inputCheck(): bool
    {
        return
            (
                isset($_POST['name']) && strlen($_POST['name']) < 50 && strlen($_POST['name']) > 3 &&
                isset($_POST['email']) && strlen($_POST['email']) < 50 && strlen($_POST['email']) > 3 &&
                isset($_POST['pass']) && strlen($_POST['pass']) < 50 && strlen($_POST['pass']) > 3
            );
    }

}