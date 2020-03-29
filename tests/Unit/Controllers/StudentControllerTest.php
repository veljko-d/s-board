<?php

namespace Tests\Unit\Controllers;

use App\Actions\Student\GetStudentResultAction;
use App\Controllers\StudentController;
use Tests\Unit\ControllerTestCase;

/**
 * Class StudentControllerTest
 *
 * @package Tests\Unit\Controllers
 */
class StudentControllerTest extends ControllerTestCase
{
    /**
     * @return StudentController
     */
    private function getController(): StudentController
    {
        return new StudentController(
            $this->request,
            $this->redirect,
            $this->sessionManager,
            $this->templateEngine
        );
    }

    /**
     * @test
     */
    public function testGetStudentResults()
    {
        $controller = $this->getController();

        $getStudentResultAction = $this->createMock(GetStudentResultAction::class);

        $message = 'Results.';

        $getStudentResultAction->expects($this->once())
            ->method('execute')
            ->with($this->equalTo(1))
            ->will($this->returnValue($message));

        $result = $controller->getStudentResult(1, $getStudentResultAction);

        $this->assertSame(
            $result,
            $message,
            'Response object is not the expected one.'
        );
    }
}
