<?php

/**
 * String calculator sum string numbers.
 */

declare(use_strict = 1);

namespace App\StringCalculator;

/**
 * Class StringCalculator
 *
 * @package App\StringCalculator
 */
class StringCalculator
{
    /**
     * @param string $components Components to add
     *
     * @return int
     */
    public function add(string $components): int
    {
        if (empty($components)) {
            return 0;
        }
        $componentsArr = explode(',', $components);

        return $this->addComponents($componentsArr);
    }

    /**
     * @param array $components Components to add
     *
     * @return int
     */
    private function addComponents(array $components): int
    {
        $sum = 0;
        foreach ($components as $item) {
            $sum += $item;
        }

        return $sum;
    }
}