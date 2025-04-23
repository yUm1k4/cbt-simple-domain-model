<?php

namespace Domain\ValueObject;

use App\Domain\ValueObject\QuestionId;
use PHPUnit\Framework\TestCase;

class QuestionIdTest extends TestCase
{
    public function testQuestionIdCreation(): void {
        $id = new QuestionId('q1');
        $this->assertEquals('q1', (string)$id);
    }
}