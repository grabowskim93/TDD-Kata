<?php

declare(strict_types=1);

namespace App\StringCalculator;

class StringCalculatorLogger
{
    /**
     * @var string
     */
    private $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    /**
     * @param int $sum
     *
     * @return bool
     */
    public function logSum(int $sum): bool
    {
        return error_log('Sum: ' . $sum . ' \\n', 3, $this->directory);
    }
}
