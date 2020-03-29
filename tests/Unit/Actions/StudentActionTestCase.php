<?php

namespace Tests\Unit\Actions;

use App\Core\Loggers\MonologDriver;
use App\Domain\Student;
use App\Models\Student\StudentModel;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\Unit\Domain\StudentTestCase;

/**
 * Class StudentActionTestCase
 *
 * @package Tests\Unit\Actions
 */
abstract class StudentActionTestCase extends StudentTestCase
{
    /**
     * @var MonologDriver|MockObject
     */
    protected $logger;

    /**
     * @var StudentModel|MockObject
     */
    protected $studentModel;

    /**
     * @var Student|MockObject
     */
    protected $student;

    /**
     * @setUp
     */
    public function setUp(): void
    {
        $this->logger = $this->createMock(MonologDriver::class);
        $this->studentModel = $this->createMock(StudentModel::class);
        $this->student = $this->createMock(Student::class);
    }
}
