<?php

namespace App\Services\DataBase;

use PDO;

class MyPDO implements DBInterface
{
    private const DSN = 'mysql:dbname=UsersData;host=127.0.0.1;port=3306';
    private const USER_NAME = 'root';
    private const PASSWORD = '';

    private $connect;

    public function __construct()
    {
        try {
            $this->connect = new PDO(self::DSN, self::USER_NAME, self::PASSWORD);
        } catch (\PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }
    }

    public function select(string $sql, array $userData): array
    {
        $stmt = $this->connect->prepare($sql);
        $stmt->execute($userData);
        $a = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($a === false) { //селект обязан вернуть массив, а фетч возвр фолс
            return [];
        } else {
            return $a;
        }
    }

    public function insert(string $sql, array $userData): int
    {
        $stmt = $this->connect->prepare($sql);
        try {
            $stmt->execute($userData);
            return $this->connect->lastInsertId();
        } catch (\PDOException $exception) {
            echo 'Ошибка при добавлении нового пользователя ' . $exception->getMessage();
        }

        return 0;
    }

    public function update(string $sql, $userData): bool
    {
        $stmt = $this->connect->prepare($sql);
        return $stmt->execute($userData);
    }
}