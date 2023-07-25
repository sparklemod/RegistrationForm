<?php

namespace App\Controllers;

use App\Services\DataBase\Mysqli;

class User extends BaseController
{
    private Mysqli $mysqli;

    public function __construct()
    {
        parent::__construct();
        $this->mysqli = new Mysqli();
    }

    public function registration()
    {
        $this->render('User/registration', []);

        if (empty($_POST)) {
            return;
        }
//ошибки обработать разные + предложение авторизации
        if ($this->inputCheck() && !$this->isUserExist($_POST['email'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $id = $this->mysqli->insert("INSERT INTO `Users` (`name`,`email`,`pass`) VALUES ('$name','$email','$pass')");
            $this->session->setUserID($id);
            header("Location: /?c=user&m=account");

        } else {
            echo "Недопустимая длина строки";
        }
    }

    public function logIn()
    {
        $this->render('User/authorization', []);

        if(isset($_POST['name']) && isset($_POST['pass'])) {
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            $id = $this->mysqli->select("SELECT id FROM `Users` WHERE name='{$name}' AND pass='{$pass}'");
            $this->session->setUserID($id['id']);
            header("Location: /?c=user&m=account");
        }
    }

    public function account()
    {
        $this->render('User/account', ['user' => $this->getInfo()]);
    }

    public function edit()
    {
        $this->render('User/edit', ['user' => $this->getInfo()]);

        if ($this->inputCheck()) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $id = $this->session->getUserID();
            $this->mysqli->update("UPDATE `Users` SET  `email` = '$email', `pass` = '$pass', `name` = '$name' WHERE id='$id'");
            header("Location: /?c=user&m=account");
        }
    }

    public function logOut()
    {
        $this->session->destroySession();
        header("Location: /?c=user&m=logIN");
    }

    private function getInfo()
    {
        if (!$this->session->isAuth()) {
            header("Location: /?c=user&m=logIn");
        } else {
            $id = $this->session->getUserID();
            return $this->mysqli->select("SELECT * FROM `Users` WHERE id=" . $id);
        }
    }

    private function isUserExist(string $email): bool
    {
        return !empty($this->mysqli->select("SELECT id FROM `Users` WHERE email='{$email}'"));
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