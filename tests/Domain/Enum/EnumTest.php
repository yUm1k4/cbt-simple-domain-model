<?php

namespace Domain\Enum;

use App\Domain\Enum\ExamStatus;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals('upcoming', ExamStatus::UPCOMING->value);
        $this->assertEquals('ongoing', ExamStatus::ONGOING->value);
        $this->assertEquals('completed', ExamStatus::COMPLETED->value);
    }

    public function testStatusTransitions(): void
    {
        $status = ExamStatus::UPCOMING;
        $this->assertTrue($status->canTransitionTo(ExamStatus::ONGOING));
        $this->assertFalse($status->canTransitionTo(ExamStatus::COMPLETED));
    }
}