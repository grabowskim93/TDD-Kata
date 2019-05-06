<?php

namespace App\GameOfLife;

/**
 * Class GameOfLife
 * @package App\GameOfLife
 */
class GameOfLife
{
    /**
     * @return array
     */
    public function generateStartData()
    {
        $initialMap = [];
        $initialRows = 4;

        for ($i=1; $i <= $initialRows; $i++) {
            for ($j = 1; $j <= $initialRows; $j++) {
                if ($j == $initialRows || $i == $initialRows) {
                    $initialMap[$i][$j] = 0;
                } else {
                    $initialMap[$i][$j] = rand(0,1);
                }
            }
        }

        return $initialMap;
    }

    /**
     * @param array $startData
     * @param int $rowIndex
     * @param int $colIndex
     * @return int|mixed
     */
    public function sumCellScore($startData, $rowIndex, $colIndex)
    {
        $startXPoint = $rowIndex - 1;
        $endXPoint = $rowIndex + 1;
        $startYPoint = $colIndex - 1;
        $endYPoint = $colIndex + 1;
        $sum = 0;

        for ($i = $startXPoint ; $i <= $endXPoint; $i++) {
            for ($j= $startYPoint; $j <= $endYPoint; $j++) {
                if ($rowIndex === $i && $colIndex === $j) {
                    continue;
                }

                if (!isset($startData[$i]) || !isset($startData[$i][$j])) {
                    continue;
                }
                $sum += $startData[$i][$j];
            }
        }

        return $sum;
    }

    /**
     * @param array $startData
     * @return array
     */
    public function changeStatus($startData)
    {
        $newStates = [];
        $newMap = [];

        foreach ($startData as $rowIndex => $rows) {
            foreach ($rows as $colIndex => $value) {
                $newStates[$rowIndex][$colIndex] = $this->sumCellScore($startData, $rowIndex, $colIndex);
            }
        }

        foreach ($newStates as $rowIndex => $rows) {
            foreach ($rows as $colIndex => $value) {
                if ($value == 3) {
                    $newMap[$rowIndex][$colIndex] = 1;
                } elseif ($value == 2 && $startData[$rowIndex][$colIndex] == 1) {
                    $newMap[$rowIndex][$colIndex] = 1;
                } else {
                    $newMap[$rowIndex][$colIndex] = 0;
                }
            }
        }

        return $newMap;
    }

}