<?php

namespace App\Services\DataBase;

interface DBInterface
{
    public function select(string $sql): array;

    public function insert(string $sql): int;

    public function update(string $sql): bool;
}