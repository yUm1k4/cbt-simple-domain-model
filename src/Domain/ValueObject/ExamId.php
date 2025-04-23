<?php

namespace App\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

class ExamId
{
    public function __construct(private string $id)
    {
        if (!Uuid::isValid($id)) {
            throw new \InvalidArgumentException("Invalid ExamId format.");
        }
    }

    public function __toString(): string
    {
        return $this->id;
    }
}