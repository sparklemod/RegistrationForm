<?php

namespace App\Controllers;

use App\Services\DataBase\Mysqli;

class User extends BaseController
{
    private Mysqli $sql;

    public function __construct()
    {
        parent::__construct();
        $this->sql = new Mysqli();
    }

    public function registration()
    {
        $this->render('User/registration', []);

        if (empty($_POST)) {
            return;
        }

        if ($this->inputCheck() && !$this->isUserExist($_POST['email'])) {
            $userData = array(
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':pass' => md5($_POST['pass'])
            );

            $id = $this->sql->insert("INSERT INTO Users (`name`, `email`, `pass`) VALUES (:name, :email, :pass)", $userData);
            $this->session->setUserID($id);
            header("Location: /?c=user&m=account");

        } else {
            echo "Недопустимая длина строки";
        }
    }

    public function logIn()
    {
        $this->render('User/authorization', []);

        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $userData = array(
                ':email' => $_POST['email'],
                ':pass' => md5($_POST['pass'])
            );

            $id = $this->sql->select("SELECT id FROM Users WHERE `email`= :email AND `pass` = :pass", $userData);
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
            $userData = [
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':pass' => md5($_POST['pass']),
                ':id' => $this->session->getUserID()
            ];

            $this->sql->update("UPDATE Users SET `name`=:name, `email` = :email, `pass` = :pass WHERE `id` =:id", $userData);
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
            $userData = array(
                ':id' => $id
            );
            return $this->sql->select("SELECT * FROM Users WHERE `id`=:id", $userData);
        }
    }

    private function isUserExist(string $email): bool
    {
        $userData = [
            ':email' => $email
        ];
        var_dump($userData);
        var_dump($this->sql->select("SELECT id FROM Users WHERE `email` =:email", $userData));
        return !empty($this->sql->select("SELECT id FROM Users WHERE `email` =:email", $userData));

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