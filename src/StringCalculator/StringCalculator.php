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
    const DEFINE_DELIMITER_TAGS_LENGTH = 2;
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
            if (empty($item) || $item >= 1000) {
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
        if (substr($components, 0,self::DEFINE_DELIMITER_TAGS_LENGTH) === '//') {
            $length = strpos($components, '\n') - self::DEFINE_DELIMITER_TAGS_LENGTH;
            $this->delimiter = substr($components, self::DEFINE_DELIMITER_TAGS_LENGTH, $length);

            $components = substr($components, $length + self::DEFINE_DELIMITER_TAGS_LENGTH);
        }

        return $components;
    }
}