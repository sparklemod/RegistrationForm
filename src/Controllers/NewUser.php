<?php

namespace App\Controllers;

use App\Services\DataBase\Doctrine;
use Doctrine\ORM\EntityManager;

class NewUser extends BaseController
{
    private EntityManager $em;
    public function __construct()
    {
        parent::__construct();
        $this->em = Doctrine::getEntityManager();
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
            $this->em->persist($user); //persist принимает класс сущности. делает подготовку к записи. далее нужно сд запись
            $this->em->flush(); //делает запись
            $user->getId();
            header("Location: /?c=NewUser&m=account");
        } else {
            echo "Некорректные данные";
        }
    }

    public function account()
    {
        $this->render('newUser/account', ['user' => $this->getInfo()]);
    }

    public function edit()
    {
        $this->render('newUser/edit', ['user' => $this->getInfo()]);

        if ($this->inputCheck() && !$this->isUserExist($_POST['email'])) {
            $user = new \App\Entity\User();
            $this->em->findBy('id');
            $user->setEmail($_POST['email'])->setName($_POST['name'])->setPass(md5($_POST['pass']));
            $this->em->persist($user); //persist принимает класс сущности. делает подготовку к записи. далее нужно сд запись
            $this->em->flush(); //делает запись
            $user->getId();

            header("Location: /?c=newUser&m=account");
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