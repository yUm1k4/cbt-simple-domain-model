<?php

namespace Domain\ValueObject;

use App\Domain\ValueObject\ExamId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ExamIdTest extends TestCase
{
    public function testValidExamId(): void {
        $uuid = Uuid::uuid4()->toString();
        $examId = new ExamId($uuid);
        $this->assertEquals($uuid, (string) $examId);
    }

    public function testInvalidExamIdThrowsException(): void {
        $this->expectException(InvalidArgumentException::class);
        new ExamId('invalid-uuid');
    }
}