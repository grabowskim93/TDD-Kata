<?php

namespace App\tests;

use App\MarsRover;
use PHPUnit\Framework\TestCase;

class MarsRoverTest extends TestCase
{
    public function initialPointsProvider()
    {
        return [
            [1, 2]
        ];
    }

    public function initialWrongPointsProvider()
    {
        return [
            ['a', 2]
        ];
    }

    public function commandPointsProvider()
    {
        return [
            [1, 0, 1, 0]
        ];
    }

    public function commandWrongPointsProvider()
    {
        return [
            [1, 0, 1, 1],
            [3, 9, 1, 1],
            [0, 0, 0, 0],
        ];
    }

    public function commandWrongPointsTypesProvider()
    {
        return [
            [1, 0, 'a', 1]
        ];
    }

    /**
     * @dataProvider initialPointsProvider
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
     */
    public function testWrongInitialPoints($x, $y)
    {
        $this->expectException(\TypeError::class);
        new MarsRover($x, $y);
    }

    /**
     * @dataProvider commandPointsProvider
     */
    public function testMarsRoverCommandInput($n, $s, $e, $w)
    {
        $marsRover = new MarsRover(1, 2);

        $marsRover->validateCommandInput($n, $s, $e, $w);
        $this->assertTrue(true);

    }

    /**
     * @dataProvider commandWrongPointsProvider
     */
    public function testMarsRoverWrongCommandInput($n, $s, $e, $w)
    {
        $marsRover = new MarsRover(1, 1);

        $this->expectException(\DomainException::class);
        $marsRover->validateCommandInput($n, $s, $e, $w);
    }

    /**
     * @dataProvider commandWrongPointsTypesProvider
     */
    public function testMarsRoverWrongCommandInputTypes($n, $s, $e, $w)
    {
        $marsRover = new MarsRover(1, 1);

        $this->expectException(\TypeError::class);
        $marsRover->validateCommandInput($n, $s, $e, $w);
    }
}
