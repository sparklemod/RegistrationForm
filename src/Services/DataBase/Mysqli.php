<?php

namespace App\Services\DataBase;

class Mysqli
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

        if (!$this->connect) {
            die ("Failed to connect to MySQL: " . mysqli_error($this->connect));
        }
    }

    public function select(string $sql)
    {
        return $this->connect->query($sql)->fetch_assoc();
    }

    public function insert(string $sql)
    {

        if ($this->connect->query($sql) === TRUE) {
            echo "Вы успешно зарегистрировались";
            return $this->connect->insert_id;

        } else {
            echo "Error: " . $sql . "<br>" . $this->connect->error;
        }

    }



}