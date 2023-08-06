<?php

namespace App\Services\DataBase;

class Mysqli implements DBInterface
{
    private const HOST = '127.0.0.1';
    private const USER_NAME = 'root';
    private const PASSWORD = '';
    private const DB_NAME = 'UsersData';

    private $connect;


    public function __construct()
    {
        $this->connect = mysqli_connect(
            self::HOST,
            self::USER_NAME,
            self::PASSWORD,
            self::DB_NAME
        );
        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        if (!$this->connect) {
            die ("Failed to connect to MySQL: " . mysqli_error($this->connect));
        }
    }

    public function select(string $sql, $userData): array
    {
        $sql = $this->binding($sql, $userData);
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = $result->fetch_all(MYSQLI_ASSOC);
        if (count($data) > 1) {
            return $data;
        } else {
            return (current($data) ?: []); //проверка на бул ?: а ?? проверка на NULL
        }

    }

    public function insert(string $sql, $userData): int
    {
        try {
            $sql = $this->binding($sql, $userData);
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();

            return $this->connect->insert_id;
        } catch (\mysqli_sql_exception $exception) {
            echo 'Ошибка при добавлении нового пользователя ' . $exception->getMessage();
        }

        return 0;
    }

    public function update(string $sql, $userData): bool
    {
        $sql = $this->binding($sql, $userData);
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();

        return TRUE;
    }

    private function binding(string $sql, $userData): string
    {
        foreach ($userData as $key => $value) {
            $sql = str_replace($key, var_export($value, TRUE), $sql); //если тру то возвр. значение, если фолс то выводит на экран.
        }

        return $sql;
    }


}