<?php

namespace App\Actions\Student;

use App\Core\Loggers\LoggerInterface;
use App\Domain\Student;
use App\Models\Student\StudentModelInterface;

/**
 * Class AbstractStudentAction
 *
 * @package App\Actions\Student
 */
abstract class AbstractStudentAction
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var StudentModelInterface
     */
    protected $studentModel;

    /**
     * @var Student
     */
    protected $student;

    /**
     * AbstractStudentAction constructor.
     *
     * @param LoggerInterface       $logger
     * @param StudentModelInterface $studentModel
     * @param Student               $student
     */
    public function __construct(
        LoggerInterface $logger,
        StudentModelInterface $studentModel,
        Student $student
    ) {
        $this->logger = $logger;
        $this->studentModel = $studentModel;
        $this->student = $student;
    }
}
