<?php

namespace Tests\Unit\Domain;

use App\Domain\Student;

/**
 * Class StudentTest
 *
 * @package Tests\Unit\Domain
 */
class StudentTest extends StudentTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testClassInstance()
    {
        $student = $this->buildStudent();

        $this->assertInstanceOf(
            Student::class,
            $student,
            'Created object is not the instance of the Student class.'
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetData()
    {
        $student = $this->buildStudent();

        $this->assertSame(
            3,
            $student->getId(),
            'ID is incorrect.'
        );

        $this->assertSame(
            'Dallas',
            $student->getName(),
            'Name is incorrect.'
        );

        $this->assertSame(
            2,
            $student->getSchoolBoardId(),
            'SchoolBoard ID is incorrect.'
        );

        $this->assertSame(
            [8, 9, 7, 8],
            $student->getGrades(),
            'Grades are incorrect.'
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testCalcAverageGrade()
    {
        $student = $this->buildStudent();

        $this->assertSame(
            8.0,
            $student->calcAverageGrade(),
            'Average grade is incorrect.'
        );
    }
}
