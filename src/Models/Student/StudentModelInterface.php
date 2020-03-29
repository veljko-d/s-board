<?php

namespace App\Models\Student;

use App\Domain\Student;

/**
 * Interface StudentModelInterface
 *
 * @package App\Models\Student
 */
interface StudentModelInterface
{
    /**
     * @param int $id
     *
     * @return Student
     */
    public function getStudent(int $id): Student;

    /**
     * @param int $id
     *
     * @return array
     */
    public function getGrades(int $id): array;
}
