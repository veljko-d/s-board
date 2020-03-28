<?php

namespace App\Domain\SchoolBoard;

use App\Domain\Student;

/**
 * Class SchoolBoard
 *
 * @package App\Domain\SchoolBoard
 */
abstract class SchoolBoard
{
    /**
     * @const
     */
    protected const PASS = 'Pass';

    /**
     * @const
     */
    protected const FAIL = 'Fail';

    /**
     * @param Student $student
     *
     * @return float
     */
    abstract public function getAverage(Student $student): float;

    /**
     * @param Student $student
     *
     * @return string
     */
    abstract public function getFinal(Student $student): string;

    /**
     * @param Student $student
     *
     * @return mixed
     */
    abstract public function returnResults(Student $student);
}
