<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Exam;
use App\Domain\ValueObject\ExamId;

interface ExamRepositoryInterface
{
    public function find(ExamId $id): ?Exam;

    public function save(Exam $exam): void;
}