<?php

namespace App\Christmas;

/**
 * Class ChristmasLights
 * @package App
 */
class ChristmasLights
{
    /**
     * @param array $lightsMap
     * @return array
     */
    public function toggleFirstLine(array $lightsMap) : array
    {
        reset($lightsMap);
        $firstKey = key($lightsMap);

        foreach ($lightsMap[$firstKey] as &$lightsRow) {
            $lightsRow = (int) !$lightsRow;
        }

        return $lightsMap;
    }

    /**
     * @param array $lightsMap Full map of lights
     * @param int $start Start point
     * @param int $end End point
     *
     * @return array Map of turned on lights
     */
    public function turnOnLightsRange(array $lightsMap, int $start, int $end) : array
    {
        for ($i = $start; $i <= $end; $i++) {
            for ($j = $start; $j <= $end; $j++) {
                $lightsMap[$i][$j] = 1;
            }
        }
        return $lightsMap;
    }

    /**
     * Generates maps of turned off lights
     *
     * @return array
     */
    public function generateMap() : array
    {
        $lightMap = [];

        for ($i = 0; $i < 1000; $i++) {
            for ($j = 0; $j < 1000; $j++) {
                $lightMap[$i][$j] = 0;
            }
        }

        return $lightMap;
    }
}