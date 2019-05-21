<?php

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
     * @param string $components
     *
     * @return int
     */
    public function add(string $components): int
    {
        if (empty($components)) {
            return 0;
        }
        $componentsArr = explode(',', $components);

        return $componentsArr[0] + $componentsArr[1];
    }
}