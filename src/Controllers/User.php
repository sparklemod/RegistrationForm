<?php

namespace App\Controllers;

use App\DataBase\Mysqli;

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
        //делать проверку пришел ли пост. если да, то и з данных поста собирать скл запрос на инсерт. в классе скл добавить инсерт.
        $this->render('User/registration', []);
    }

    public function getInfo()
    {
        $user = $this->mysqli->select("SELECT * FROM `Users` WHERE id=2");
        $this->render('User/info', ['user' => $user,'pass'=>123]);
    }

}