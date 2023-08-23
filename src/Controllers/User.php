<?php

namespace App\Controllers;

class User extends BaseController
{
    private \App\Models\User $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Models\User($this->session);
    }

    public function registration()
    {
        $this->render('User/registration', []);

        if (empty($_POST)) {
            return;
        }

        $userID = $this->model->registration($_POST);

        if ($userID === 0) {
            echo "Некорректные данные";
            exit;
        }

        $this->session->setUserID($userID);
        header("Location: /?c=User&m=account");
    }

    public function account()
    {
        $user = $this->model->getInfo();

        if (!$user) {
            header("Location: /?c=User&m=logIn");
        }

        $this->render('User/account', ['user' => $user]);
    }

    public function logIn()
    {
        $error = '';

        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $userID = $this->model->logIn($_POST);
            if ($userID) {
                $this->session->setUserID($userID);
                header("Location: /?c=User&m=account");
            } else {
                $error = "Такого пользователя нет";
            }
        }

        $this->render('User/authorization', ['msg' => $error]);
    }

    public function edit()
    {
        $this->render('User/edit', ['user' => $this->model->getInfo()]);

        if (empty($_POST)) {
            return;
        }

        $this->model->edit($_POST);
        header("Location: /?c=User&m=account");
    }

    public function logOut()
    {
        $this->session->destroySession();
        header("Location: /?c=User&m=logIn");
    }
}