<?php

namespace App\Christmas\src;

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
    public function toggleFirstLine($lightsMap)
    {
        reset($lightsMap);
        $firstKey = key($lightsMap);

        foreach ($lightsMap[$firstKey] as &$lightsRow) {
            $lightsRow = (int) !$lightsRow;
        }

        return $lightsMap;
    }

    public function turnOnLightsRange($lightsMap, $start, $end)
    {
        for ($i = $start; $i <= $end; $i++) {
            for ($j = $start; $j <= $end; $j++) {
                $lightsMap[$i][$j] = 1;
            }
        }
        return $lightsMap;
    }

    public function generateMap()
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

$a = new ChristmasLights();
$lightsMap = $a->generateMap();
$lightsMap = $a->toggleFirstLine($lightsMap);
$lightsMap = $a->turnOnLightsRange($lightsMap, 499, 500);

//echo '<pre>';
//foreach ($lightsMap as $lightsRows) {
//
//    foreach ($lightsRows as $lightsRow) {
//        echo $lightsRow . " ";
//    }
//
//    echo "\n";
//}
//echo '</pre>';
