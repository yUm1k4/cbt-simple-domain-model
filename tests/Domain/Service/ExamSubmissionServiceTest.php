<?php

namespace Tests\Domain\Service;

use App\Domain\Entity\Exam;
use App\Domain\Enum\ExamStatus;
use App\Domain\Repository\ExamRepositoryInterface;
use App\Domain\Repository\ExamResultRepositoryInterface;
use App\Domain\Service\ExamSubmissionService;
use App\Domain\ValueObject\ExamId;
use App\Domain\ValueObject\QuestionId;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ExamSubmissionServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSubmitExam(): void
    {
        $service = new ExamSubmissionService();
        $exam = $this->createSampleExam();

        $userAnswers = [
            'q1' => 'A',
            'q2' => 'B'
        ];

        // Mock repositories
        $result = $service->submitExam(
            $exam,
            $userAnswers,
            $this->createMock(ExamRepositoryInterface::class),
            $this->createMock(ExamResultRepositoryInterface::class)
        );

        $this->assertEquals(15, $result->getScore()->getValue());
    }

    private function createSampleExam(): Exam
    {
        $examId = new ExamId(Uuid::uuid4()->toString());
        $exam = new Exam(
            $examId,
            'PHP Basic Test',
            30,
            new \DateTimeImmutable('+1 day'),
            ExamStatus::UPCOMING
        );

        // Tambahkan pertanyaan 1
        $exam->addQuestion(
            new QuestionId('q1'),
            'Apa hasil dari 2 + 2?',
            ['A' => '3', 'B' => '4', 'C' => '5'],
            'A',
            10   // Poin
        );

        // Tambahkan pertanyaan 2
        $exam->addQuestion(
            new QuestionId('q2'),
            'Apa kepanjangan dari PHP?',
            ['A' => 'Hypertext Processor', 'B' => 'Hypertext Preprocessor', 'C' => 'Programming Hypertext'],
            'B',
            5    // Poin
        );

        return $exam;
    }
}