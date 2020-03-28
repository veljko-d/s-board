<?php

namespace App\Domain\SchoolBoard;

use App\Domain\Student;

/**
 * Class CSM
 *
 * @package App\Domain\SchoolBoard
 */
class CSM extends SchoolBoard
{
    /**
     * @param Student $student
     *
     * @return float
     */
    public function getAverage(Student $student): float
    {
        return $student->calcAverageGrade();
    }

    /**
     * @param Student $student
     *
     * @return string
     */
    public function getFinal(Student $student): string
    {
        if ($this->getAverage($student) >= 7) {
            return self::PASS;
        }

        return self::FAIL;
    }

    /**
     * @param Student $student
     *
     * @return false|mixed|string
     */
    public function returnResults(Student $student)
    {
        header("Content-Type: application/json");

        $result = [
            'id'            => $student->getId(),
            'name'          => $student->getName(),
            'grades'        => $student->getGrades(),
            'average grade' => $this->getAverage($student),
            'final result'  => $this->getFinal($student),
        ];

        return json_encode($result);
    }
}
