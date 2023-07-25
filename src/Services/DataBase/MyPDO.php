<?php

namespace App\Services\DataBase;

class MyPDO implements DBInterface
{//в конструкторе методы пдо //принимается отдается то же самое что в ит

    public function select(string $sql): array
    {
        // TODO: Implement select() method.
    }

    public function insert(string $sql): int
    {
        // TODO: Implement insert() method.
    }

    public function update(string $sql): bool
    {
        // TODO: Implement update() method.
    }
}