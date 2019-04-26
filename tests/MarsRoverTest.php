<?php

declare(strict_types = 1);

namespace Test;

use App\MarsRover\MarsRover;
use PHPUnit\Framework\TestCase;

/**
 * Class MarsRoverTest
 * @package App\MarsRover\test
 */
class MarsRoverTest extends TestCase
{
    //We don't use types declaration in tests (excepts data providers)

    /**
     * @return array
     */
    public function initialPointsProvider() : array
    {
        return [
            [1, 2]
        ];
    }

    /**
     * @return array
     */
    public function initialWrongPointsProvider() : array
    {
        return [
            ['a', 2]
        ];
    }

    /**
     * @return array
     */
    public function commandPointsProvider() : array
    {
        return [
            [1, 0, 1, 0]
        ];
    }

    /**
     * @return array
     */
    public function commandWrongPointsProvider() : array
    {
        return [
            [1, 0, 1, 1],
            [3, 9, 1, 1],
            [0, 0, 0, 0],
        ];
    }

    /**
     * @return array
     */
    public function commandWrongPointsTypesProvider() : array
    {
        return [
            [1, 0, 'a', 1]
        ];
    }

    /**
     * @dataProvider initialPointsProvider
     * @param int $x
     * @param int $y
     */
    public function testMarsRover($x, $y)
    {
        $marsRover = new MarsRover($x, $y);
        $this->assertInstanceOf(MarsRover::class, $marsRover);

        $this->assertIsInt($marsRover->getX());
        $this->assertIsInt($marsRover->getY());
    }

    /**
     * @dataProvider initialWrongPointsProvider
     * @param int $x
     * @param int $y
     */
    public function testWrongInitialPoints($x, $y)
    {
        $this->expectException(\TypeError::class);
        new MarsRover($x, $y);
    }

    /**
     * @dataProvider commandPointsProvider
     * @param int $n
     * @param int $s
     * @param int $e
     * @param int $w
     */
    public function testMarsRoverCommandInput($n, $s, $e, $w)
    {
        $marsRover = new MarsRover(1, 2);

        $marsRover->validateCommandInput($n, $s, $e, $w);
        $this->assertTrue(true);

    }

    /**
     * @dataProvider commandWrongPointsProvider
     * @param int $n
     * @param int $s
     * @param int $e
     * @param int $w
     */
    public function testMarsRoverWrongCommandInput($n, $s, $e, $w)
    {
        $marsRover = new MarsRover(1, 1);

        $this->expectException(\DomainException::class);
        $marsRover->validateCommandInput($n, $s, $e, $w);
    }

    /**
     * @dataProvider commandWrongPointsTypesProvider
     * @param int $n
     * @param int $s
     * @param int $e
     * @param int $w
     */
    public function testMarsRoverWrongCommandInputTypes($n, $s, $e, $w)
    {
        $marsRover = new MarsRover(1, 1);

        $this->expectException(\TypeError::class);
        $marsRover->validateCommandInput($n, $s, $e, $w);
    }
}
