<?php

namespace App\Models;

use App\Entity\User as UserEntity;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Services\DataBase\Doctrine;

class User
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function registration(array $data): int
    {
        if ($this->inputCheck() && $this->checkPass() && !$this->isUserExist($data['email'])) {
            $user = new UserEntity();
            $user->setEmail($data['email'])->setName($data['name'])->setPass(md5($data['pass']));
            Doctrine::getEntityManager()->persist($user);
            Doctrine::getEntityManager()->flush();
            return $user->getId();
        } else {
            return 0;
        }
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

    private function inputCheck(): bool
    {
        return
            (
                isset($_POST['name']) && strlen($_POST['name']) < 50 && strlen($_POST['name']) > 3 &&
                isset($_POST['email']) && strlen($_POST['email']) < 50 && strlen($_POST['email']) > 3
            );
    }

    private function checkPass(): bool
    {
        return (isset($_POST['pass']) && strlen($_POST['pass']) < 50 && strlen($_POST['pass']) > 3);
    }

    public function getInfo($userID): array
    {
        $user = $this->repository->find($userID);
        return $user->toArray();
    }


}