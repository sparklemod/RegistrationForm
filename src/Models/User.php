<?php

namespace App\Models;

use App\Entity\User as UserEntity;
use App\Repository\UserRepository;
use App\Services\DataBase\Doctrine;
use App\Services\SessionPHP;

class User
{
    private UserRepository $repository;
    private SessionPHP $session;

    public function __construct(SessionPHP $session)
    {
        $this->session = $session;
        $this->repository = new UserRepository();
    }

    public function registration(array $data): int
    {
        if ($this->inputCheck($data) && $this->checkPass($data['pass']) && !$this->isUserExist($data['email'])) {
            $user = new UserEntity();
            $user->setEmail($data['email'])->setName($data['name'])->setPass(md5($data['pass']));
            Doctrine::getEntityManager()->persist($user);
            Doctrine::getEntityManager()->flush();
            return $user->getId();
        } else {
            return 0;
        }
    }

    public function logIn(array $data): ?int
    {
        $user = $this->repository->findOneBy(['email' => $data['email'], 'pass' => md5($data['pass'])]);

        if ($user) {
            return $user->getId();
        }

        return null;
    }

    public function edit(array $data): void
    {
        $user = $this->repository->find($this->session->getUserID());
        if (!$data['pass'] && $this->inputCheck($data)) {
            $user->setEmail($data['email'])->setName($_POST['name']);
        }
        if ($data['pass'] && $this->checkPass($data['pass']) && $this->inputCheck($data)) {
            $user->setEmail($data['email'])->setName($data['name'])->setPass(md5($data['pass']));
        }
        Doctrine::getEntityManager()->persist($user);
        Doctrine::getEntityManager()->flush();
    }

    private function isUserExist(string $email): bool
    {
        $user = $this->repository->findBy(['email' => $email]);

        if (!$user) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function inputCheck(array $data): bool
    {
        return
            (
                isset($data['name']) && strlen($data['name']) < 50 && strlen($data['name']) > 3 &&
                isset($data['email']) && strlen($data['email']) < 50 && strlen($data['email']) > 3
            );
    }

    private function checkPass(string $pass): bool
    {
        return ($pass && strlen($pass) < 50 && strlen($pass) > 3);
    }

    public function getInfo(): ?array
    {
        if ($this->session->isAuth()) {
            $user = $this->repository->find($this->session->getUserID());
            return $user->toArray();
        }

        return null;
    }
}