<?php

namespace App\MarsRover\test;

use App\MarsRover\src\MarsRover;
use PHPUnit\Framework\TestCase;

/**
 * Class MarsRoverTest
 * @package App\MarsRover\test
 */
class MarsRoverTest extends TestCase
{
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
    public function testMarsRover(int $x, int $y) : void
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
    public function testWrongInitialPoints(int $x, int $y) : void
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
    public function testMarsRoverCommandInput(int $n, int $s, int $e, int $w) : void
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
    public function testMarsRoverWrongCommandInput(int $n, int $s, int $e, int $w) : void
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
    public function testMarsRoverWrongCommandInputTypes(int $n, int $s, int $e, int $w) : void
    {
        $marsRover = new MarsRover(1, 1);

        $this->expectException(\TypeError::class);
        $marsRover->validateCommandInput($n, $s, $e, $w);
    }
}
