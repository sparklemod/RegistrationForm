<?php

namespace App\Controllers;

use App\Models\Uploader;

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
        if (!empty($_POST)) {
            $userID = $this->model->registration($_POST);

            if ($userID !== 0) {
                $this->session->setUserID($userID);
                header("Location: /?c=User&m=account");
                exit;
            }

            $error = "Некорректные данные";
        }

        $this->render('User/registration', ['message' => ($error ?? '')]);
    }

    public function account()
    {
        if (!$this->session->isAuth()) {
            header("Location: /?c=User&m=logIn");
            exit;
        }

        if (isset($_POST['uploadIcon'])) {
            $result = (new Uploader())->accountIconUpdate($this->session->getUserID());

            if ($result !== TRUE) {
                $error = $result;
            }
        }

        $user = $this->model->getInfo();
        $this->render('User/account', ['user' => $user, 'message' => $error ?? '']);
    }

    public function logIn()
    {
        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $userID = $this->model->logIn($_POST);

            if ($userID) {
                $this->session->setUserID($userID);
                header("Location: /?c=User&m=account");
            }

            $error = "Такого пользователя нет";
        }

        $this->render('User/authorization', ['message' => ($error ?? '')]);
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