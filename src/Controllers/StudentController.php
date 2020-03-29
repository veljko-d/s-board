<?php

namespace App\Controllers;

use App\Actions\Student\GetStudentResultAction;

/**
 * Class StudentController
 *
 * @package App\Controllers
 */
class StudentController extends AbstractController
{
    /**
     * @param int                    $id
     * @param GetStudentResultAction $getStudentResultAction
     *
     * @return mixed|void
     */
    public function getStudentResult(
        int $id,
        GetStudentResultAction $getStudentResultAction
    ) {
        return $getStudentResultAction->execute($id);
    }
}
