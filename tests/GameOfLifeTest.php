<?php


namespace Tests;

use App\GameOfLife\GameOfLife;
use PHPUnit\Framework\TestCase;

/**
 * Class GameOfLifeTest
 * @package Tests
 */
class GameOfLifeTest extends TestCase
{
    /**
     * @var GameOfLife
     */
    public $gameOfLife;


    /**
     * @return array
     */
    public function gameOfLifeProvider()
    {
        return [
            [
                [
                    [
                        1,
                        0,
                        1,
                        0
                    ]
                ],
                [
                    [
                        0,
                        0,
                        1,
                        0
                    ]
                ],
                [
                    [
                        1,
                        1,
                        1,
                        0
                    ]
                ],
                [
                    [
                        0,
                        0,
                        0,
                        0
                    ]
                ],
            ]
        ];
    }


    /**
     *
     */
    function setUp()
    {
        $this->gameOfLife = new GameOfLife();
    }

    /**
     * Test if class exists
     */
    function testClassExists()
    {
        $classInstance = $this->gameOfLife instanceof GameOfLife;
        $this->assertEquals(true, $classInstance);
    }

    /**
     * Test initial game map structure
     */
    function testGeneratedStartData()
    {
        //input array 4x4
        $startData = $this->gameOfLife->generateStartData();
        $this->assertIsArray($startData);

        $totalRows = 0;
        foreach ($startData as $array) {
            $totalRows += count($array);
            $this->assertIsArray($array);
            $this->assertCount(4, $array);
        }
        $this->assertCount(4, $startData);
        $this->assertEquals(16, $totalRows);
    }

    /**
     * Test initial game map states
     * @dataProvider gameOfLifeProvider
     * @param array $startData
     */
    function testInitialLifeStates($startData)
    {
        foreach ($startData as $rowIndex => $rows) {
            foreach ($rows as $colIndex => $value) {
                self::assertIsBool(boolval($value));
            }
        }
    }


    /**
     * Test if cell state changed
     * @dataProvider gameOfLifeProvider
     * @param array $startData
     */
    function testStateChange($startData)
    {
        $newStates = [];

        foreach ($startData as $rowIndex => $rows) {
            foreach ($rows as $colIndex => $value) {
                $newStates[$rowIndex][$colIndex] = $this->gameOfLife->sumCellScore($startData, $rowIndex, $colIndex);
                $this->assertIsInt($newStates[$rowIndex][$colIndex]);
            }
        }
    }

    /**
     * Test if game ended correctly
     */
    function testEndOfGame()
    {
        $startGameOfLifeMap = $this->gameOfLife->generateStartData();

        $changedGameOfLifeMap = $this->gameOfLife->changeStatus($startGameOfLifeMap);

        $initialRow = '';
        foreach ($startGameOfLifeMap as $rowIndex => $rows) {
            foreach ($rows as $colIndex => $value) {
                $initialRow .= $value;
            }
        }
        $updatedRow = '';

        foreach ($changedGameOfLifeMap as $rowIndex => $rows) {
            foreach ($rows as $colIndex => $value) {
                $updatedRow .= $value;
            }
        }
        if ($initialRow === $updatedRow) {
            self::assertEquals($initialRow, $updatedRow);
        }

        $i = 0;
        while ($i < 10) {
            $changedGameOfLifeMap = $this->gameOfLife->changeStatus($changedGameOfLifeMap);
            $updatedRow = '';
            foreach ($changedGameOfLifeMap as $rowIndex => $rows) {
                foreach ($rows as $colIndex => $value) {
                    $updatedRow .= $value;
                }
            }

            if ($initialRow === $updatedRow) {
                self::assertEquals($initialRow, $updatedRow);
                break;
            }

            $initialRow = $updatedRow;

            $i++;
        }
    }

}