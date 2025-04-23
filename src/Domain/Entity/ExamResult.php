<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\ExamId;
use App\Domain\ValueObject\Score;

class ExamResult
{
    public function __construct(
        private string $id,
        private ExamId $examId,
        private Score $score,
        private \DateTimeImmutable $submittedAt,
        private array $answers
    )
    {
    }

    // Getter methods
    public function getScore(): Score
    {
        return $this->score;
    }

    public function getSubmittedAt(): \DateTimeImmutable
    {
        return $this->submittedAt;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}