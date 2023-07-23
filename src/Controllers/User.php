<?php

namespace App\Controllers;

use App\DataBase\Mysqli;

class User extends BaseController
{
    private Mysqli $mysqli;
    private int $userID;

    public function __construct()
    {
        parent::__construct();
        $this->mysqli = new Mysqli();
    }

    public function registration()
    {
        //делать проверку пришел ли пост. если да, то и з данных поста собирать скл запрос на инсерт. в классе скл добавить инсерт.
        //в методе логина после всех проверок и регистрации сессии ставишь этот хедер. header("Location: /?c=user&m=getInfo");
        $this->render('User/registration', []);

        print_r($_POST);

        if (isset($_POST['name']) && $_POST['name'] < 50 && $_POST['name'] > 5 &&
            isset($_POST['email']) && $_POST['email'] < 50 && $_POST['email'] > 5 &&
            isset($_POST['pass']) && $_POST['pass'] < 50 && $_POST['pass'] > 5)
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            $this->userID = $this->mysqli->insert("INSERT INTO `Users` (`name`,`email`,`pass`) VALUES ('$name','$email','$pass')");
            $this->header("Location: /?c=user&m=getInfo");
        } else {
            echo "Недопустимая длина строки";
        }
    }

    public function getInfo()
    {
        $user = $this->mysqli->select("SELECT * FROM `Users` WHERE id='$this->userID'");
        $this->render('User/info', ['user' => $user]);
    }

}