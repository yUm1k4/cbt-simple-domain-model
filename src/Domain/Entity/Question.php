<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\ExamId;
use App\Domain\ValueObject\QuestionId;

class Question
{
    public function __construct(
        private QuestionId $id,
        private ExamId     $examId,
        private string     $text,
        private array      $options,
        private string     $correctAnswer,
        private int        $points
    )
    {
        $this->validate();
    }

    private function validate(): void
    {
        if (!array_key_exists($this->correctAnswer, $this->options)) {
            throw new \InvalidArgumentException("Correct answer must be one of the options");
        }
    }

    // Getter methods
    public function getId(): QuestionId
    {
        return $this->id;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function getCorrectAnswer(): string
    {
        return $this->correctAnswer;
    }
}