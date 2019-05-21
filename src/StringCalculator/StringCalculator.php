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
    /**
     * @var array
     */
    private $delimiters;

    public function __construct()
    {
        $this->delimiter = ',';
        $this->negative = [];
        $this->delimiters = [];
    }

    /**
     * @param string $components Components to add
     *
     * @return int
     */
    public function add(string $components): int
    {
        $components = $this->determineDelimiter($components);

        foreach ($this->delimiters as $delimiter) {
            $components = str_replace($delimiter, ',', $components);
        }
        $components = str_replace('\n', ',', $components);

        $components = explode(',', $components);

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
     * @param string $components Calculator add action components
     *
     * @return string
     */
    private function determineDelimiter(string $components): string
    {
        if (substr($components, 0,self::DEFINE_DELIMITER_TAGS_LENGTH) === '//') {
            $length = strpos($components, '\n') - self::DEFINE_DELIMITER_TAGS_LENGTH;
            $delimiter = substr($components, self::DEFINE_DELIMITER_TAGS_LENGTH, $length);

            preg_match_all('/\[(.*?)\]/', $delimiter, $results, PREG_SET_ORDER, 0);
            foreach ($results as $result) {
                $this->delimiters[] = $result[1];
            }
            $components = substr($components, $length + self::DEFINE_DELIMITER_TAGS_LENGTH);
        }

        return $components;
    }
}