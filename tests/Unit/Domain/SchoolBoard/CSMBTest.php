<?php

namespace Tests\Unit\Domain\SchoolBoard;

use App\Domain\SchoolBoard\CSMB;
use Tests\Unit\Domain\StudentTestCase;

/**
 * Class CSMBTest
 *
 * @package Tests\Unit\Domain\SchoolBoard
 */
class CSMBTest extends StudentTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetAverage()
    {
        $csmb = new CSMB();
        $student = $this->buildStudent();

        $this->assertEquals(
            8.33,
            $csmb->getAverage($student),
            'Average grade is incorrect.'
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetFinal()
    {
        $csmb = new CSMB();
        $student = $this->buildStudent();

        $this->assertEquals(
            'Pass',
            $csmb->getFinal($student),
            'Student final is incorrect.'
        );
    }
}
