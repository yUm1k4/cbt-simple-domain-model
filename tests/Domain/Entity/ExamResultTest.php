<?php

namespace Domain\Entity;

use App\Domain\Entity\ExamResult;
use App\Domain\ValueObject\ExamId;
use App\Domain\ValueObject\Score;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ExamResultTest extends TestCase
{
    public function testExamResultCreation(): void {
        $examId = new ExamId(Uuid::uuid4()->toString());
        $score = new Score(75);
        $answers = ['q1' => 'A', 'q2' => 'B'];

        $result = new ExamResult(
            'result-123',
            $examId,
            $score,
            new \DateTimeImmutable(),
            $answers
        );

        $this->assertEquals(75, $result->getScore()->getValue());
        $this->assertCount(2, $result->getAnswers());
        $this->assertEquals('A', $result->getAnswers()['q1']);
    }
}