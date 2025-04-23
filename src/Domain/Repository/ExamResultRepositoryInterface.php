<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\ExamResult;

interface ExamResultRepositoryInterface
{
    public function save(ExamResult $result): void;

    public function nextIdentity(): string;
}