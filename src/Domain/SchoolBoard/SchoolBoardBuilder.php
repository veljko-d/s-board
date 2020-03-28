<?php

namespace App\Domain\SchoolBoard;

use App\Core\Container\Container;
use App\Exceptions\InvalidTypeException;
use ReflectionException;

/**
 * Class SchoolBoardBuilder
 *
 * @package App\Domain\SchoolBoard
 */
class SchoolBoardBuilder
{
    /**
     * @const
     */
    private const CSM = 1;

    /**
     * @const
     */
    private const CSMB = 2;

    /**
     * @const
     */
    private const TYPES = [
        self::CSM  => CSM::class,
        self::CSMB => CSMB::class,
    ];

    /**
     * @param int $schoolBoardId
     *
     * @return SchoolBoard
     * @throws InvalidTypeException
     * @throws ReflectionException
     */
    public function build(int $schoolBoardId): SchoolBoard
    {
        if (!isset(self::TYPES[$schoolBoardId])) {
            throw new InvalidTypeException("Invalid bind type: $schoolBoardId");
        }

        return (Container::getInstance())->get(self::TYPES[$schoolBoardId]);
    }
}
