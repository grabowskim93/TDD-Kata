<?php

namespace App\ChristmasLights\tests;

use App\Christmas\src\ChristmasLights;
use PHPUnit\Framework\TestCase;

/**
 * Class ChristmasLightsTest
 * @package App\tests
 */
class ChristmasLightsTest extends TestCase
{
    public function testChristmasLightExists()
    {
        $class = new ChristmasLights();
        $this->assertEquals(true, $class instanceof ChristmasLights);
    }

    public function lightsMapProvider()
    {
        return [
            [
                [
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1]
                ]
            ]
        ];
    }

    /**
     * @dataProvider lightsMapProvider
     * @param array $lightsMap
     */
    public function testLightsMap($lightsMap)
    {
        $this->assertEquals(10, count($lightsMap));
        foreach ($lightsMap as $lightMapRows) {
            $this->assertEquals(10, count($lightMapRows));
        }
    }

    /**
     * @dataProvider lightsMapProvider
     * @param array $lightsMap
     * @return array
     */
    public function testToggleFirstLine($lightsMap)
    {
        reset($lightsMap);
        $firstKey = key($lightsMap);

        $this->assertEquals(0, $firstKey);

        $christmasLights = new ChristmasLights();
        $lightsMapToggled = $christmasLights->toggleFirstLine($lightsMap);
        foreach ($lightsMap[$firstKey] as $rowKey => $item) {
            $this->assertEquals(!$item, $lightsMapToggled[$firstKey][$rowKey]);
        }

        return $lightsMapToggled;
    }

    /**
     * @dataProvider lightsMapProvider
     * @param array $lightsMap
     */
    public function testRangeLightsOn($lightsMap)
    {
        $startRow = 4;
        $endRow = 6;

        $christmasLights = new ChristmasLights();
        $updatedMap = $christmasLights->turnOnLightsRange($lightsMap, $startRow, $endRow);

        $this->assertEquals(1, $updatedMap[$startRow][$startRow]);
    }

    /**
     *
     */
    public function testGenerateLightsMap()
    {
        $christmasLights = new ChristmasLights();
        $lightsMap = $christmasLights->generateMap();

        $this->assertIsArray($lightsMap);
        $this->assertEquals(1000, count($lightsMap));
    }

    /**
     * @depends testToggleFirstLine
     * @dataProvider lightsMapProvider
     */
    public function testTotalBrightnessTurnOn($lightsMap)
    {
        $christmasLights = new ChristmasLights();
        $lightsMapToggled = $christmasLights->toggleFirstLine($lightsMap);
        $values = array_count_values($lightsMapToggled[0]);

        $this->assertEquals(10, $values[1]);
    }

    /**
     * @depends testToggleFirstLine
     * @dataProvider lightsMapProvider
     */
    public function testTotalBrightnessToggle($lightsMap)
    {
        $startRow = 4;
        $endRow = 6;

        $christmasLights = new ChristmasLights();
        $updatedMap = $christmasLights->turnOnLightsRange($lightsMap, $startRow, $endRow);

        $brightnessSum = 0;
        for ($i = $startRow; $i <= $endRow; $i++) {
            for ($j = $startRow; $j <= $endRow; $j++) {
                $brightnessSum += ($updatedMap[$i][$j] * 2);
            }
        }

        $this->assertEquals(18, $brightnessSum);
    }
}
