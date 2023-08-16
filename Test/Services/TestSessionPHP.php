<?php

namespace Test\Services;

use App\Services\SessionPHP;
use PHPUnit\Framework\TestCase;

class TestSessionPHP extends TestCase
{
    public function testSetUserID()
    {
        $session = new SessionPHP();
        $session->setUserID(2);
        $this->assertEquals(2, $_SESSION['userID']);
    }

    public function testGetUserID()
    {
        $session = new SessionPHP();
        $this->assertEquals(0,$session->getUserID());
        $session->setUserID(10);
        $this->assertEquals(10,$session->getUserID());
    }

    public function testIsAuth()
    {
        $session = new SessionPHP();
        $this->assertEquals(false,$session->isAuth());
        $session->setUserID(10);
        $this->assertEquals(true,$session->isAuth());
    }
}
