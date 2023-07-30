<?php

namespace App\Services\DataBase;

interface DBInterface
{
    public function select(string $sql, array $userData): array;

    public function insert(string $sql, array $userData): int;

    public function update(string $sql, array $userData): bool;
}