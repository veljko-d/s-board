<?php

namespace Tests\Unit\Models;

use App\Exceptions\DbException;
use App\Exceptions\NotFoundException;
use App\Models\Student\StudentModel;
use Tests\Unit\ModelTestCase;

/**
 * Class StudentModelTest
 *
 * @package Tests\Unit\Models
 */
class StudentModelTest extends ModelTestCase
{
    /**
     * @var array
     */
    protected $tables = [
        'school_boards',
        'students',
        'student_grades',
    ];

    /**
     * @var StudentModel
     */
    protected $studentModel;

    /**
     * @setUp
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->studentModel = new StudentModel($this->db);
    }

    /**
     * @throws NotFoundException
     * @throws DbException
     */
    public function testStudentNotFound()
    {
        $this->expectException(NotFoundException::class);

        $this->studentModel->getStudent(55);
    }

    /**
     * @throws DbException
     * @throws NotFoundException
     */
    public function testGetStudent()
    {
        $schoolBoardId = $this->addSchoolBoard();
        $studentId = $this->addStudent($schoolBoardId);

        $student = $this->studentModel->getStudent($studentId);

        $this->assertSame(
            'Dallas',
            $student->getName(),
            'Student name is not as expected.'
        );

        $this->assertSame(
            $schoolBoardId,
            $student->getSchoolBoardId(),
            'SchoolBoard ID is not as expected.'
        );
    }

    /**
     * @throws DbException
     * @throws NotFoundException
     */
    public function testListOfGradesEmpty()
    {
        $this->expectException(NotFoundException::class);

        $schoolBoardId = $this->addSchoolBoard();
        $studentId = $this->addStudent($schoolBoardId);

        $this->studentModel->getGrades($studentId);
    }

    /**
     * @throws DbException
     * @throws NotFoundException
     */
    public function testGetGrades()
    {
        $grades = [7, 9, 8, 7];

        $schoolBoardId = $this->addSchoolBoard();
        $studentId = $this->addStudent($schoolBoardId);
        $this->addStudentGrades($grades, $studentId);

        $this->assertEquals(
            $grades,
            $this->studentModel->getGrades($studentId),
            'Student grades are not as expected.'
        );
    }

    /**
     * @return int
     */
    private function addSchoolBoard(): int
    {
        $params = ['name' => 'ABC'];

        $query = 'INSERT INTO school_boards (name)
			VALUES (:name)';

        $this->db->execute($query, $params);

        return $this->db->lastInsertId();
    }

    /**
     * @param int $schoolBoardId
     *
     * @return int
     */
    private function addStudent(int $schoolBoardId): int
    {
        $params = [':name' => 'Dallas', ':school_board_id' => $schoolBoardId];

        $query = 'INSERT INTO students (name, school_board_id)
			VALUES (:name, :school_board_id)';

        $this->db->execute($query, $params);

        return $this->db->lastInsertId();
    }

    /**
     * @param array $grades
     * @param int   $studentId
     */
    private function addStudentGrades(array $grades, int $studentId)
    {
        foreach ($grades as $key => $grade) {
            $this->insertStudentGrade($grade, $studentId);
        }
    }

    /**
     * @param int $grade
     * @param int $studentId
     */
    private function insertStudentGrade(int $grade, int $studentId)
    {
        $params = [':grade' => $grade, ':student_id' => $studentId];

        $query = 'INSERT INTO student_grades (grade, student_id)
			VALUES (:grade, :student_id)';

        $this->db->execute($query, $params);
    }
}
