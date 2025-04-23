<?php

namespace App\Domain\ValueObject;

class QuestionId
{
    public function __construct(private readonly string $id)
    {
    }

    public function __toString(): string
    {
        return $this->id;
    }
}