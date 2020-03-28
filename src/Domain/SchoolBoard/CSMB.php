<?php

namespace App\Domain\SchoolBoard;

use App\Domain\Student;
use SimpleXMLElement;

/**
 * Class CSMB
 *
 * @package App\Domain\SchoolBoard
 */
class CSMB extends SchoolBoard
{
    /**
     * @param Student $student
     *
     * @return float
     */
    public function getAverage(Student $student): float
    {
        if (count($grades = $student->getGrades()) > 2) {
            rsort($grades);
            array_pop($grades);

            $average = array_sum($grades) / count($grades);

            return round($average, 2);
        }

        return $student->calcAverageGrade();
    }

    /**
     * @param Student $student
     *
     * @return string
     */
    public function getFinal(Student $student): string
    {
        if ($this->getAverage($student) > 8) {
            return self::PASS;
        }

        return self::FAIL;
    }

    /**
     * @param Student $student
     *
     * @return mixed
     */
    public function returnResults(Student $student)
    {
        header ("Content-Type: text/xml");

        $xml = new SimpleXMLElement('<results/>');

        $xml->addChild('id', $student->getId());
        $xml->addChild('name', $student->getName());
        $xml->addChild('grades');

        foreach ($student->getGrades() as $grade) {
            $xml->grades->addChild('grade', $grade);
        }

        $xml->addChild('average_grade', $this->getAverage($student));
        $xml->addChild('final_result', $this->getFinal($student));

        return $xml->asXML();
    }
}
