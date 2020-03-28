<?php

namespace App\Domain;

/**
 * Class Student
 *
 * @package App\Domain
 */
class Student
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $school_board_id;

    /**
     * @var array
     */
    private $grades;

    /**
     * @var string
     */
    private $created_at;

    /**
     * @var string
     */
    private $updated_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSchoolBoardId(): int
    {
        return $this->school_board_id;
    }

    /**
     * @return array
     */
    public function getGrades(): array
    {
        return $this->grades;
    }

    /**
     * @param array $grades
     */
    public function setGrades(array $grades): void
    {
        $this->grades = $grades;
    }

    /**
     * @return float
     */
    public function calcAverageGrade(): float
    {
        $average = array_sum($this->getGrades()) / count($this->getGrades());

        return round($average, 2);
    }
}
