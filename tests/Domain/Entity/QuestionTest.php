<?php

namespace Domain\Entity;

use App\Domain\Entity\Question;
use App\Domain\ValueObject\ExamId;
use App\Domain\ValueObject\QuestionId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class QuestionTest extends TestCase
{
    public function testValidQuestionCreation(): void
    {
        $question = new Question(
            new QuestionId('q1'),
            new ExamId(Uuid::uuid4()->toString()),
            'What is PHP?',
            ['A' => 'Programming Language', 'B' => 'Markup Language'],
            'A',
            10
        );

        $this->assertEquals(10, $question->getPoints());
        $this->assertEquals('A', $question->getCorrectAnswer());
    }

    public function testInvalidCorrectAnswerThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Question(
            new QuestionId('q1'),
            new ExamId(Uuid::uuid4()->toString()),
            'Invalid Question',
            ['A' => 'Wrong', 'B' => 'Right'],
            'C', // Correct answer not in options
            5
        );
    }
}