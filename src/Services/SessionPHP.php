<?php

namespace App\Services;

class SessionPHP
{
    private const DAY_IN_MINUTES = 60 * 24;

    public function start()
    {
        session_start(['cookie_lifetime' => self::DAY_IN_MINUTES]);
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

    public function destroySession()
    {
        session_destroy();
        setcookie("PHPSESSID", '', time() - 360000, '/');
    }

}