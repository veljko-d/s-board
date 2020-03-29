<?php

namespace Tests\Unit\Actions\Student;

use App\Actions\Student\GetStudentResultAction;
use App\Domain\SchoolBoard\CSMB;
use App\Domain\SchoolBoard\SchoolBoardBuilder;
use App\Exceptions\NotFoundException;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\Unit\Actions\StudentActionTestCase;

/**
 * Class GetStudentResultActionTest
 *
 * @package Tests\Unit\Actions\Student
 */
class GetStudentResultActionTest extends StudentActionTestCase
{
    /**
     * @var SchoolBoardBuilder|MockObject
     */
    private $schoolBoardBuilder;

    /**
     * @setUp
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->schoolBoardBuilder = $this->createMock(SchoolBoardBuilder::class);
    }

    /**
     * @return GetStudentResultAction
     */
    private function getGetStudentResultAction(): GetStudentResultAction
    {
        return new GetStudentResultAction(
            $this->logger,
            $this->studentModel,
            $this->student,
            $this->schoolBoardBuilder
        );
    }

    /**
     * @test
     */
    public function testStudentNotFound()
    {
        $getGetStudentResultAction = $this->getGetStudentResultAction();

        $message = 'Student not found.';

        $this->studentModel->expects($this->once())
            ->method('getStudent')
            ->with($this->equalTo(15))
            ->will($this->throwException(new NotFoundException($message)));

        $this->studentModel->expects($this->never())
            ->method('getGrades');

        $result = $getGetStudentResultAction->execute(15);

        $this->assertSame(
            $message,
            $result,
            'Result is not as expected.'
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetResultsListOfGradesEmpty()
    {
        $getGetStudentResultAction = $this->getGetStudentResultAction();
        $student = $this->buildStudent();
        $student->setGrades([]);

        $message = 'List of grades empty.';

        $this->studentModel->expects($this->once())
            ->method('getStudent')
            ->with($this->equalTo(3))
            ->will($this->returnValue($student));

        $this->studentModel->expects($this->once())
            ->method('getGrades')
            ->with($this->equalTo(3))
            ->will($this->throwException(new NotFoundException($message)));

        $this->schoolBoardBuilder->expects($this->never())
            ->method('build');

        $result = $getGetStudentResultAction->execute(3);

        $this->assertSame(
            $message,
            $result,
            'Result is not as expected.'
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetResults()
    {
        $getGetStudentResultAction = $this->getGetStudentResultAction();
        $student = $this->buildStudent();
        $student->setGrades([]);
        $csmb = $this->createMock(CSMB::class);

        $message = 'Results';

        $this->studentModel->expects($this->once())
            ->method('getStudent')
            ->with($this->equalTo(3))
            ->will($this->returnValue($student));

        $this->studentModel->expects($this->once())
            ->method('getGrades')
            ->with($this->equalTo(3))
            ->will($this->returnValue([6, 8, 7]));

        $this->schoolBoardBuilder->expects($this->once())
            ->method('build')
            ->with($this->equalTo(2))
            ->will($this->returnValue($csmb));

        $csmb->expects($this->once())
            ->method('returnResults')
            ->with($this->equalTo($student))
            ->will($this->returnValue($message));

        $result = $getGetStudentResultAction->execute(3);

        $this->assertSame(
            $message,
            $result,
            'Result is not as expected.'
        );
    }
}
