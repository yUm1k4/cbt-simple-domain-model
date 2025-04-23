<?php

namespace App\Domain\ValueObject;

class Score
{
    public function __construct(private int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException("Score cannot be negative");
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function isPassing(int $passingGrade): bool
    {
        return $this->value >= $passingGrade;
    }
}