<?php

/**
 * String calculator sum string numbers.
 */

declare(strict_types=1);

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
     * @var int Delimiter chars length
     */
    const DEFINE_DELIMITER_TAGS_LENGTH = 2;

    /**
     * @var string Default delimiter
     */
    const DEFAULT_DELIMITER = ',';

    /**
     * @var array Negative numbers
     */
    private $negative;

    /**
     * @var array Array of all string delimiters
     */
    private $delimiters;

    /**
     * @var \App\StringCalculator\StringCalculatorLogger
     */
    private $logger;

    /**
     * StringCalculator constructor.
     *
     * @param \App\StringCalculator\StringCalculatorLogger $logger
     */
    public function __construct(StringCalculatorLogger $logger = null)
    {
        $this->negative = [];
        $this->delimiters = [];
        $this->logger = $logger;
    }

    /**
     * Add string values.
     *
     * @param string $components Components to add
     *
     * @return int
     */
    public function add(string $components): int
    {
        $components = $this->determineDelimiter($components);

        $components = $this->replaceDelimiters($components);

        $components = explode(self::DEFAULT_DELIMITER, $components);

        $sum = $this->addComponents($components);

        $this->log($sum);

        return $sum;
    }

    /**
     * Replace all delimiters to default one.
     *
     * @param string $components Components to split
     *
     * @return string
     */
    private function replaceDelimiters(string $components): string
    {
        foreach ($this->delimiters as $delimiter) {
            $components = str_replace($delimiter, self::DEFAULT_DELIMITER, $components);
        }
        $components = str_replace('\n', self::DEFAULT_DELIMITER, $components);

        return $components;
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
        if (substr($components, 0, self::DEFINE_DELIMITER_TAGS_LENGTH) === '//') {
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

    /**
     * Log sum.
     *
     * @param int $sum Sum of operation.
     */
    private function log(int $sum)
    {
        if (!is_null($this->logger)) {
            $this->logger->logSum($sum);
        }
    }
}
