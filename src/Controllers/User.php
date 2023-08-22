<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use App\Services\DataBase\Doctrine;
use Doctrine\ORM\EntityManager;

class User extends BaseController
{
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new UserRepository();
    }

    public function registration()
    {
        $this->render('User/registration', []);

        if (empty($_POST)) {
            return;
        }

        $userID = (new \App\Models\User())->registration($_POST);

        if ($userID === 0) {
            echo "Некорректные данные";
            exit;
        }

        $this->session->setUserID($userID);
        header("Location: /?c=User&m=account");
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
                header("Location: /?c=User&m=account");
            }

            $error = "Такого пользователя нет";
        }

        $this->render('User/authorization', ['msg' => $error]);
    }

    public function edit()
    {
        $this->render('User/edit', ['user' => $this->getInfo()]);
        if (empty($_POST)) {
            return;
        }
        $user = $this->repository->find($this->session->getUserID());

        if (!$_POST['pass'] && $this->inputCheck()) {
            $user->setEmail($_POST['email'])->setName($_POST['name']);
        }
        if ($_POST['pass'] && $this->checkPass() && $this->inputCheck()) {
            $user->setEmail($_POST['email'])->setName($_POST['name'])->setPass(md5($_POST['pass']));
        }
        $this->em->persist($user);
        $this->em->flush();

        header("Location: /?c=User&m=account");

    }

    public function logOut()
    {
        $this->session->destroySession();
        header("Location: /?c=User&m=logIn");
    }

    private function getInfo()
    {
        if (!$this->session->isAuth()) {
            header("Location: /?c=User&m=logIn");
        } else {
            $id = $this->session->getUserID();
            return (new \App\Models\User())->getInfo($id);
        }

    }


}