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
        print_r($_POST);

        if (empty($_POST)) {
            return;
        }

        if ($this->registrationCheck()) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $id = $this->mysqli->insert("INSERT INTO `Users` (`name`,`email`,`pass`) VALUES ('$name','$email','$pass')");
            $this->session->setUserID($id);
            header("Location: /?c=user&m=getInfo");
        } else {
            echo "Недопустимая длина строки";
        }
    }

    public function getInfo()
    {
        if (!$this->session->isAuth())
        {
            header("Location: /?c=user&m=registration");
        }else {
            $id = $this->session->getUserID();
            $user = $this->mysqli->select("SELECT * FROM `Users` WHERE id=". $id);
            $this->render('User/info', ['user' => $user]);
        }
    }

    private function registrationCheck(): bool
    {
        return
            (
                isset($_POST['name']) && strlen($_POST['name']) < 50 && strlen($_POST['name']) > 5 &&
                isset($_POST['email']) && strlen($_POST['email']) < 50 && strlen($_POST['email']) > 5 &&
                isset($_POST['pass']) && strlen($_POST['pass']) < 50 && strlen($_POST['pass']) > 5
            );
    }

}