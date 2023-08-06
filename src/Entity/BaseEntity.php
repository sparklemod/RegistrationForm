<?php

namespace App\Entity;

abstract class BaseEntity
{

    public function toArray(): array
    {
        return $this->getArray();
    }

    abstract protected function getArray(): array;

}