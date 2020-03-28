<?php

namespace Tests\Unit\Domain;

use App\Domain\Student;
use ReflectionClass;
use Tests\AbstractTestCase;

/**
 * Class StudentTestCase
 *
 * @package Tests\Unit\Domain
 */
class StudentTestCase extends AbstractTestCase
{
    /**
     * @return Student
     * @throws \ReflectionException
     */
    public function buildStudent()
    {
        $student = new Student();

        $reflectionClass = new ReflectionClass(Student::class );

        $properties = [
            'id'              => 3,
            'name'            => 'Dallas',
            'school_board_id' => 2,
        ];

        foreach ($properties as $key => $value) {
            $property = $reflectionClass->getProperty($key);
            $property->setAccessible(true);
            $property->setValue($student, $value);
        }

        $student->setGrades([8, 9, 7, 8]);

        return $student;
    }
}
