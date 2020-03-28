<?php

namespace Tests\Unit\Domain\SchoolBoard;

use App\Domain\SchoolBoard\CSM;
use App\Domain\SchoolBoard\SchoolBoard;
use App\Domain\SchoolBoard\SchoolBoardBuilder;
use App\Exceptions\InvalidTypeException;
use Tests\AbstractTestCase;

/**
 * Class SchoolBoardBuilderTest
 *
 * @package Tests\Unit\Domain\SchoolBoard
 */
class SchoolBoardBuilderTest extends AbstractTestCase
{
    /**
     * @var
     */
    protected $schoolBoardBuilder;

    /**
     * @setUp
     */
    public function setUp(): void
    {
        $this->schoolBoardBuilder = new SchoolBoardBuilder();
    }

    /**
     * @test
     */
    public function testBuildSchoolBoardIncorrectType()
    {
        $this->expectException(InvalidTypeException::class);

        $this->schoolBoardBuilder->build(15);
    }

    /**
     * @test
     */
    public function testBuildSchoolBoard()
    {
        $schoolBoard = $this->schoolBoardBuilder->build(1);

        $this->assertInstanceOf(
            SchoolBoard::class,
            $schoolBoard,
            'Created object is not the instance of the SchoolBoard class.'
        );
    }

    /**
     * @throws InvalidTypeException
     * @throws \ReflectionException
     */
    public function testObjectsAreEqual()
    {
        $schoolBoard = $this->schoolBoardBuilder->build(1);
        $csm = new CSM();

        $this->assertEquals(
            $schoolBoard,
            $csm,
            'Objects are not equal.'
        );
    }
}
