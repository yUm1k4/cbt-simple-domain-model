<?php

namespace App\Domain\Entity;

use App\Domain\Enum\ExamStatus;
use App\Domain\ValueObject\ExamId;
use App\Domain\ValueObject\QuestionId;

class Exam
{
    private array $questions = [];
    private string $title;
    private ExamId $id;
    private int $duration;
    private \DateTimeImmutable $scheduledAt;
    private ExamStatus $status = ExamStatus::UPCOMING;

    public function __construct(
        ExamId             $id,
        string             $title,
        int                $duration, // in minutes
        \DateTimeImmutable $scheduledAt,
        ExamStatus         $status = ExamStatus::UPCOMING
    )
    {
        $this->status = $status;
        $this->scheduledAt = $scheduledAt;
        $this->duration = $duration;
        $this->id = $id;
        $this->title = $title;
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->duration <= 0) {
            throw new \InvalidArgumentException("Duration must be positive");
        }
    }

    public function addQuestion(QuestionId $id, string $text, array $options, string $correctAnswer, int $points): void
    {
        $this->questions[] = new Question(
            $id,
            $this->id,
            $text,
            $options,
            $correctAnswer,
            $points
        );
    }

    // Getter methods
    public function getId(): ExamId
    {
        return $this->id;
    }

    public function getStatus(): ExamStatus
    {
        return $this->status;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }
}