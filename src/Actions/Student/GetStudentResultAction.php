<?php

namespace App\Actions\Student;

use App\Core\Loggers\LoggerInterface;
use App\Domain\SchoolBoard\SchoolBoardBuilder;
use App\Domain\Student;
use App\Exceptions\DbException;
use App\Exceptions\InvalidTypeException;
use App\Exceptions\NotFoundException;
use App\Models\Student\StudentModelInterface;
use ReflectionException;

/**
 * Class GetStudentResultAction
 *
 * @package App\Actions\Student
 */
class GetStudentResultAction extends AbstractStudentAction
{
    /**
     * @var SchoolBoardBuilder
     */
    private $schoolBoardBuilder;

    /**
     * GetStudentResultAction constructor.
     *
     * @param LoggerInterface       $logger
     * @param StudentModelInterface $studentModel
     * @param Student               $student
     * @param SchoolBoardBuilder    $schoolBoardBuilder
     */
    public function __construct(
        LoggerInterface $logger,
        StudentModelInterface $studentModel,
        Student $student,
        SchoolBoardBuilder $schoolBoardBuilder
    ) {
        parent::__construct($logger, $studentModel, $student);

        $this->schoolBoardBuilder = $schoolBoardBuilder;
    }

    /**
     * @param int $id
     *
     * @return mixed|string
     */
    public function execute(int $id)
    {
        try {
            return $this->getResults($id);
        } catch (DbException $e) {
            $this->logger->error('Error getting student: ' . $e->getMessage());
            return $e->getMessage();
        } catch (NotFoundException | InvalidTypeException | ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws InvalidTypeException
     * @throws ReflectionException
     */
    private function getResults(int $id)
    {
        $student = $this->studentModel->getStudent($id);
        $schoolBoardId = $student->getSchoolBoardId();
        $grades = $this->studentModel->getGrades($id);
        $student->setGrades($grades);

        $schoolBoard = $this->schoolBoardBuilder->build($schoolBoardId);

        return $schoolBoard->returnResults($student);
    }
}
