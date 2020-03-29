<?php

namespace App\Models\Student;

use App\Models\AbstractModel;
use App\Domain\Student;
use PDO;
use PDOException;
use App\Exceptions\DbException;
use App\Exceptions\NotFoundException;

/**
 * Class StudentModel
 *
 * @package App\Models\Student
 */
class StudentModel extends AbstractModel implements StudentModelInterface
{
    /**
     * @const
     */
    const CLASSNAME = Student::class;

    /**
     * @param int $id
     *
     * @return Student
     * @throws DbException
     * @throws NotFoundException
     */
    public function getStudent(int $id): Student
    {
        $query = 'SELECT * FROM students WHERE id = :id';

        try {
            $student = $this->db->fetchAll(
                $query,
                [':id' => $id],
                PDO::FETCH_CLASS,
                self::CLASSNAME
            );
        } catch (PDOException $e) {
            throw new DbException($e->getMessage());
        }

        if (empty($student)) {
            throw new NotFoundException('Student not found.');
        }

        return $student[0];
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws DbException
     * @throws NotFoundException
     */
    public function getGrades(int $id): array
    {
        $query = 'SELECT grade
            FROM student_grades
            WHERE student_id = :id';

        try {
            $grades = $this->db->fetchAll(
                $query,
                [':id' => $id],
                PDO::FETCH_COLUMN
            );
        } catch (PDOException $e) {
            throw new DbException($e->getMessage());
        }

        if (empty($grades)) {
            throw new NotFoundException('List of grades empty.');
        }

        return $grades;
    }
}
