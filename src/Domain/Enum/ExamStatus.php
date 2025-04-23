<?php

namespace App\Domain\Enum;

enum ExamStatus: string
{
    case UPCOMING = 'upcoming';
    case ONGOING = 'ongoing';
    case COMPLETED = 'completed';

    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }

    public function canTransitionTo(ExamStatus $newStatus): bool
    {
        return match ($this) {
            self::UPCOMING => $newStatus === self::ONGOING,
            self::ONGOING => $newStatus === self::COMPLETED,
            self::COMPLETED => false,
        };
    }
}