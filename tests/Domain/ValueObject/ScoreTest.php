<?php

namespace Domain\ValueObject;

use App\Domain\ValueObject\Score;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ScoreTest extends TestCase
{
    public function testValidScore(): void
    {
        $score = new Score(85);
        $this->assertEquals(85, $score->getValue());
        $this->assertTrue($score->isPassing(70));
        $this->assertFalse($score->isPassing(90));
    }

    public function testNegativeScoreThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Score(-5);
    }
}