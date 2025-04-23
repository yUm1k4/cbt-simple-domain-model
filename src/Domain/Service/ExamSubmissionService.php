<?php

namespace App\Domain\Service;

use App\Domain\Entity\Exam;
use App\Domain\Entity\ExamResult;
use App\Domain\Repository\ExamRepositoryInterface;
use App\Domain\Repository\ExamResultRepositoryInterface;
use App\Domain\ValueObject\Score;

class ExamSubmissionService
{
    public function submitExam(
        Exam $exam,
        array $userAnswers,
        ExamRepositoryInterface $examRepository,
        ExamResultRepositoryInterface $resultRepository
    ): ExamResult {
        if ($exam->getStatus()->isCompleted()) {
            throw new \DomainException("Exam has already ended");
        }

        $score = 0;

        foreach ($exam->getQuestions() as $question) {
            $idQuestion = (string) $question->getId();
            $answer = $userAnswers[$idQuestion] ?? null;

            if ($answer === $question->getCorrectAnswer()) {
                $score += $question->getPoints();
            }
        }

        $examResult = new ExamResult(
            $resultRepository->nextIdentity(),
            $exam->getId(),
            new Score($score),
            new \DateTimeImmutable(),
            $userAnswers
        );

        $resultRepository->save($examResult);
        return $examResult;
    }
}