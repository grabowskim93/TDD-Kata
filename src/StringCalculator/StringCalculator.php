<?php

/**
 * String calculator sum string numbers.
 */

declare(use_strict = 1);

namespace App\StringCalculator;

use DomainException;

/**
 * Class StringCalculator
 *
 * @package App\StringCalculator
 */
class StringCalculator
{
    /**
     * @var string
     */
    private $delimiter;
    /**
     * @var array
     */
    private $negative;

    public function __construct()
    {
        $this->delimiter = ',';
        $this->negative = [];
    }

    /**
     * @param string $components Components to add
     *
     * @return int
     */
    public function add(string $components): int
    {
        $components = $this->determineDelimiter($components);

        $components = $this->explodeByDelimiter(',', $components);
        $components = $this->explodeByDelimiter('\n', $components);

        $components = explode($this->delimiter, $components);

        return $this->addComponents($components);
    }

    /**
     * @param array $components Components to add
     *
     * @return int
     */
    private function addComponents(array $components)
    {
        $sum = 0;
        foreach ($components as $item) {
            if (empty($item)) {
                $item = 0;
            }

            if ($item < 0) {
                $this->negative[] = $item;
                continue;
            }

            $sum += $item;
        }

        if (!empty($this->negative)) {
            throw new DomainException('Negative numbers are not allowed. Passed: ' . implode(',', $this->negative));
        }

        return $sum;
    }

    /**
     * @param string $delimiter String delimiter
     * @param string $components Calculator add action components
     *
     * @return string
     */
    private function explodeByDelimiter(string $delimiter, string $components): string
    {
        $exploded = [];

        $componentsArr = explode($delimiter, $components);

        foreach ($componentsArr as $item) {
            $exploded[] = $item;
        }

        return implode($this->delimiter, $exploded);
    }

    /**
     * @param string $components Calculator add action components
     *
     * @return string
     */
    private function determineDelimiter(string $components): string
    {
        if (substr($components, 0,2) === '//') {
            $this->delimiter = substr($components, 2, 1);
            $components = substr($components, '3');
        }

        return $components;
    }
}