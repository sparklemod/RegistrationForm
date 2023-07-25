<?php

namespace App\Services;

class SessionPHP
{
    public function start()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


    }

    public function setUserID(int $id)
    {
        $_SESSION['userID'] = $id;
    }

    public function getUserID(): int
    {
        return $_SESSION['userID'];
    }

    public function isAuth(): bool
    {
        return (isset($_SESSION['userID']));
    }

}