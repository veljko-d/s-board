<?php

namespace Tests\Unit\Domain\SchoolBoard;

use App\Domain\SchoolBoard\CSM;
use Tests\Unit\Domain\StudentTestCase;

/**
 * Class CSMTest
 *
 * @package Tests\Unit\Domain\SchoolBoard
 */
class CSMTest extends StudentTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetAverage()
    {
        $csm = new CSM();
        $student = $this->buildStudent();

        $this->assertEquals(
            8.0,
            $csm->getAverage($student),
            'Average grade is incorrect.'
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetFinal()
    {
        $csm = new CSM();
        $student = $this->buildStudent();

        $this->assertEquals(
            'Pass',
            $csm->getFinal($student),
            'Student final is incorrect.'
        );
    }
}
